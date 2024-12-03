<?php

namespace App\Http\Controllers\Backend;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Media\Facades\RvMedia;
use Botble\RealEstate\Facades\RealEstateHelper;
use Botble\RealEstate\Forms\ProjectForm;
use Botble\RealEstate\Http\Requests\ProjectRequest;
use Botble\RealEstate\Models\Configration;
use Botble\RealEstate\Models\ConfigrationDetail;
use Botble\RealEstate\Models\CustomFieldValue;
use Botble\RealEstate\Models\Project;
use Botble\RealEstate\Models\ProjectPriceVariations;
use Botble\RealEstate\Models\ProjectSpecification;
use Botble\RealEstate\Services\SaveFacilitiesService;
use Botble\RealEstate\Services\StoreProjectCategoryService;
use Botble\RealEstate\Tables\ProjectTable;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProjectController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this
            ->breadcrumb()
            ->add(trans('plugins/real-estate::project.name'), route('project.index'));
    }

    public function index(ProjectTable $dataTable)
    {
        $this->pageTitle(trans('plugins/real-estate::project.name'));

        return $dataTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/real-estate::project.create'));

        return ProjectForm::create()->renderForm();
    }

    public function store(
        ProjectRequest $request,
        StoreProjectCategoryService $projectCategoryService,
        SaveFacilitiesService $saveFacilitiesService
    ) {

        DB::beginTransaction();
        try {
            $videos[] = $request->input('videos') ?? [];
            if ($request->filled('youtube_video')) {
                $request->merge(['youtube_video' => $this->getYouTubeVideoId($request->input('youtube_video'))]);
            }
            $request->merge(['images' => array_filter($request->input('images', []))]);
            $request->merge(['videos' => array_filter($videos)]);
            $request->merge(['master_images' => array_filter($request->input('master_images', []))]);



            // $request->merge(['city_id' => 6]);
            $project = Project::query()->create($request->input());

            if (RealEstateHelper::isEnabledCustomFields()) {
                $this->saveCustomFields($project, $request->input('custom_fields', []));
            }

            $project->slug             = Str::slug($request->name);
            $project->unique_id        = auth('account')->id() . date('mYdhisa');
            $project->save();

            $this->saveConfigrationFields($project, $request->input('configration', []));

            $this->saveSpecificationFields($project, $request->input('specifications', []));

            $this->savePriceUnitFields($project, $request->input('unitDetails', []));

            $project->features()->sync($request->input('features', []));

            $saveFacilitiesService->execute($project, $request->input('facilities', []));

            $projectCategoryService->execute($request, $project);

            event(new CreatedContentEvent(PROJECT_MODULE_SCREEN_NAME, $request, $project));


            DB::commit();


            return $this
                ->httpResponse()
                ->setPreviousUrl(route('project.index'))
                ->setNextUrl(route('project.edit', $project->id))
                ->setMessage(trans('core/base::notices.create_success_message'));
        } catch (\Exception $e) {

            DB::rollBack();
            // Return error response if something goes wrong
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function edit(int|string $id, Request $request)
    {
        $project = Project::query()->findOrFail($id);

        $this->pageTitle(trans('plugins/real-estate::project.edit') . ' "' . $project->name . '"');

        event(new BeforeEditContentEvent($request, $project));

        return ProjectForm::createFromModel($project)->renderForm();
    }

    public function update(
        ProjectRequest $request,
        int|string $id,
        StoreProjectCategoryService $projectCategoryService,
        SaveFacilitiesService $saveFacilitiesService
    ) {

        DB::beginTransaction();
        try {
            $project = Project::query()->findOrFail($id);

            $videos[] = $request->input('videos') ?? [];
            $request->merge(['videos' => array_filter($videos)]);
            $request->merge(['images' => array_filter($request->input('images', []))]);
            if ($request->filled('youtube_video')) {
                $request->merge(['youtube_video' => $this->getYouTubeVideoId($request->input('youtube_video'))]);
            }
            $request->merge(['master_images' => array_filter($request->input('master_images', []))]);



            // $request->merge(['city_id' => 6]);
            // $project = Project::query()->create($request->input());

            $project->fill($request->input());
            $project->slug             = Str::slug($request->name);
            if ($project->unique_id == '') {
                $project->unique_id    = auth('account')->id() . date('mYdhisa');
            }
            $project->save();

            if (RealEstateHelper::isEnabledCustomFields()) {
                $this->saveCustomFields($project, $request->input('custom_fields', []));
            }


            $this->saveConfigrationFields($project, $request->input('configration', []));

            $this->saveSpecificationFields($project, $request->input('specifications', []));

            $this->savePriceUnitFields($project, $request->input('unitDetails', []));

            $project->features()->sync($request->input('features', []));

            $saveFacilitiesService->execute($project, $request->input('facilities', []));

            $projectCategoryService->execute($request, $project);


            // $request->merge(['images' => array_filter($request->input('images', []))]);

            // // $request->merge(['city_id' => 6]);

            // $project->fill($request->input());
            // $project->save();

            // if (RealEstateHelper::isEnabledCustomFields()) {
            //     $this->saveCustomFields($project, $request->input('custom_fields', []));
            // }


            // $project->features()->sync($request->input('features', []));

            // $saveFacilitiesService->execute($project, $request->input('facilities', []));

            // $projectCategoryService->execute($request, $project);


            event(new UpdatedContentEvent(PROJECT_MODULE_SCREEN_NAME, $request, $project));

            DB::commit();

            return $this
                ->httpResponse()
                ->setPreviousUrl(route('project.index'))
                ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (\Exception $e) {

            DB::rollBack();
            // Return error response if something goes wrong
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(int|string $id, Request $request)
    {
        try {
            $project = Project::query()->findOrFail($id);
            $project->delete();

            event(new DeletedContentEvent(PROJECT_MODULE_SCREEN_NAME, $request, $project));

            return $this
                ->httpResponse()
                ->setMessage(trans('core/base::notices.delete_success_message'));
        } catch (Exception $exception) {
            return $this
                ->httpResponse()
                ->setError()
                ->setMessage($exception->getMessage());
        }
    }

    protected function formatCustomFields(array $customFields = []): array
    {
        $newCustomFields = [];

        foreach ($customFields as $item) {
            $customField = null;

            if ($item['id']) {
                $customField = CustomFieldValue::query()->find($item['id']);
                $customField->fill($item);
            } else {
                Arr::forget($item, 'id');
                $customField = new CustomFieldValue($item);
            }

            $newCustomFields[] = $customField;
        }

        return $newCustomFields;
    }

    protected function saveCustomFields(Project $project, array $customFields = []): void
    {
        $customFields = $this->formatCustomFields($customFields);

        $project->customFields()
            ->whereNotIn('id', collect($customFields)->pluck('id')->all())
            ->delete();

        $project->customFields()->saveMany($customFields);
    }


    protected function formatConfigrationFields(array $configrationFields = []): array
    {
        $newCustomFields = [];

        foreach ($configrationFields as $item) {
            $customField = null;

            if ($item['id']) {
                $customField = Configration::query()->find($item['id']);
                $customField->fill($item);
            } else {
                Arr::forget($item, 'id');
                $customField = new Configration($item);
            }

            $newCustomFields[] = $customField;
        }

        return $newCustomFields;
    }


    protected function saveConfigrationFields(Project $project, array $configrationFields = []): void
    {

        // $configrationFields = $this->formatConfigrationFields($configrationFields);

        // // Check and log the IDs in custom fields
        // $customFieldIds = collect($configrationFields)->pluck('id')->all();
        // // \Log::info('Custom field IDs to keep: ', $customFieldIds);

        // // Delete custom fields that are not in the new list
        // $project->configration()
        //     ->whereNotIn('re_configration_details.id', $customFieldIds)
        //     ->delete();

        // \Log::info("Deleted custom fields count: " . $deletedCount);


        // Save the new custom fields
        // $project->configration()->saveMany($configrationFields);

        ConfigrationDetail::where('reference_id', $project->id)
            ->where('reference_type', 'Botble\RealEstate\Models\Project')
            ->delete();

        foreach ($configrationFields as $confValue) {
            $confItm                  = new ConfigrationDetail();
            $confItm->reference_id    = $project->id;
            $confItm->configration_id = $confValue['id'];
            $confItm->distance        = $confValue['distance'];
            $confItm->reference_type  = 'Botble\RealEstate\Models\Project';
            $confItm->save();
        }
    }


    protected function saveSpecificationFields(Project $project, array $specificationFields = []): void
    {


        ProjectSpecification::where('project_id', $project->id)->delete();

        foreach ($specificationFields as $specValue) {
            $specification              = new ProjectSpecification();
            $specification->project_id    = $project->id;
            $specification->name          = null;
            $specification->image        = $specValue['imagePath'];
            $specification->description    = $specValue['description'];
            $specification->save();
        }
    }


    protected function savePriceUnitFields(Project $project, array $unitDetails = []): void
    {
        ProjectPriceVariations::where('project_id', $project->id)->delete();

        foreach ($unitDetails as $priceValue) {
            $priceVari              = new ProjectPriceVariations();
            $priceVari->project_id    = $project->id;
            $priceVari->unit_type    = $priceValue['unit_type'];
            $priceVari->size        = $priceValue['size'];
            $priceVari->price        = $priceValue['price'];
            $priceVari->save();
        }
    }


    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:10240', // Adjust the validation as needed
        ]);


        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads/images', $fileName, 'public');

        return response()->json([
            'success' => true,
            'fileUrl' => asset('storage/' . $filePath),
            'fileName' => $filePath
        ]);

        // $file = $request->file('file');
        // $path = $this->storeFiles($file);
        // $fileName = time() . '_' . $file->getClientOriginalName();
        // $filePath = $file->storeAs('uploads/images', $fileName, 'public');

        // return response()->json([
        //     'success' => true,
        //     'fileUrl' => asset('storage/' . $path),
        //     'fileName' => $fileName
        // ]);
    }


    protected function storeFiles($file)
    {

        $paths = '';
        $folderPath = 'projects';

        $result = RvMedia::handleUpload($file, 15, $folderPath, true);

        $result = RvMedia::handleUpload($file, 15);
        if (isset($result['data'])) {
            $paths =  $result['data']->url;
        }


        return $paths;
    }


    protected function getYouTubeVideoId($url)
    {
        // Parse the URL
        $parsedUrl = parse_url($url);

        // Validate the host
        $validHosts = ['www.youtube.com', 'youtube.com', 'm.youtube.com', 'youtu.be'];
        if (!in_array($parsedUrl['host'], $validHosts)) {
            return false; // Not a valid YouTube URL
        }

        // Handle short URLs (youtu.be)
        if ($parsedUrl['host'] === 'youtu.be') {
            return trim($parsedUrl['path'], '/'); // Video ID is in the path
        }

        // Handle long URLs (youtube.com)
        parse_str($parsedUrl['query'] ?? '', $queryParams);
        return $queryParams['v'] ?? false; // Return video ID if it exists, or false otherwise
    }
}
