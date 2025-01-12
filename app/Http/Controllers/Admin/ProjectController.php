<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Configration;
use App\Models\ConfigrationDetail;
use App\Models\CustomFieldValue;
use App\Models\Facility;
use App\Models\FacilityDistance;
use App\Models\Feature;
use App\Models\Investor;
use App\Models\Project;
use App\Models\ProjectPriceVariations;
use App\Models\ProjectSpecification;
use AppServices\StoreProjectCategoryService;
use Botble\RealEstate\Services\SaveFacilitiesService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!permission_check('Project List')) {
            return abort(404);
        }

        //
        $query = Project::orderBy('created_at', 'desc');
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('location', 'LIKE', "%$search%");
            });
            // $query->whereHas('account', function ($q) use ($search) {
            //     $q->where('first_name', 'LIKE', "%$search%")
            //     ->orWhere('last_name', 'LIKE', "%$search%");
            // });
        }

        if ($request->has('created_at') && $request->created_at != '') {
            $startOfDay = date('Y-m-d 00:00:00', strtotime($request->created_at));
            $endOfDay = date('Y-m-d 23:59:59', strtotime($request->created_at));

            $query->where('created_at', '>=', $startOfDay)
                ->where('created_at', '<=', $endOfDay);
        }


        $projects = $query->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!permission_check('Project Add')) {
            return abort(404);
        }

        //
        $configration = Configration::query()->select(['id', 'name'])->get();
        $facilities   = Facility::query()->select(['id', 'name'])->get();
        $categories   = Category::get();
        $builders     = Investor::get();
        $features     = Feature::get();
        $specifications = DB::table('specifications')->orderBy('display_order', 'asc')->get();

        return view('admin.projects.form', compact('configration', 'facilities', 'categories', 'builders', 'features', 'specifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (!permission_check('Project Add')) {
            return abort(404);
        }

        DB::beginTransaction();
        try {
            $videos[] = $request->input('videos') ?? [];
            if ($request->filled('youtube_video')) {
                $request->merge(['youtube_video' => $this->getYouTubeVideoId($request->input('youtube_video'))]);
            }

            if ($request->hasFile('new_normal_images')) {
                $imagePath = $this->storeFiles($request->file('new_normal_images'), $request->coverImage);
                // $images = $this->storeFiles($request->file('new_normal_images'));
            } else {
                $images = null;
            }

            if ($request->hasFile('new_master_plan_images')) {
                $master_images = $this->storeFiles($request->file('new_master_plan_images'));
            } else {
                $master_images = [];
            }

            $images           =  isset($imagePath['filePaths']) ? $imagePath['filePaths'] : '';
            $cover_image      =  isset($imagePath['coverImagePath']) ? $imagePath['coverImagePath'] : '';

            $request->merge(['images' => $images, 'master_plan_images' => $master_images, 'cover_image' => $cover_image]);
            $request->merge(['videos' => array_filter($videos)]);

            // $request->merge(['images' => array_filter($request->input('images', []))]);
            // $request->merge(['videos' => array_filter($videos)]);
            // $request->merge(['master_images' => array_filter($request->input('master_images', []))]);

            // $request->merge(['city_id' => 6]);
            $project = Project::query()->create($request->input());

            $this->saveCustomFields($project, $request->input('custom_fields', []));


            $project->slug             = Str::slug($request->name);
            $project->unique_id        = auth('account')->id() . date('mYdhisa');
            $project->save();

            $this->saveConfigrationFields($project, $request->input('configration', []));

            $this->saveSpecificationFields($project, $request);

            $this->savePriceUnitFields($project, $request->input('unitDetails', []));

            $project->features()->sync($request->input('features', []));

            $this->saveFacilitiesService($project, $request->input('facilities', []));

            $this->projectCategoryService($request, $project);

            DB::commit();
            Session::flash('success_msg', 'Successfully Created');

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Created',
                'redirect' => route('admin.projects.index')
            ]);
        } catch (\Exception $e) {

            Log::notice("message");
            ('Validation failed: Project error');
            Log::info("message");
            ('Time ' . date('d-m-Y H:i:s'));
            Log::error('Validation Errors: ' . $e);

            DB::rollBack();
            // Return error response if something goes wrong
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        if (!permission_check('Project Edit')) {
            return abort(404);
        }

        //
        $project      = Project::where('id', $id)->first() ?? abort(404);
        $configration = Configration::query()->select(['id', 'name'])->get();
        $facilities   = Facility::query()->select(['id', 'name'])->get();
        $categories   = Category::get();
        $builders     = Investor::get();
        $features     = Feature::get();
        $specifications = DB::table('specifications')->orderBy('display_order', 'asc')->get();
        return view('admin.projects.form', compact('configration', 'facilities', 'categories', 'builders', 'features', 'project', 'specifications'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if (!permission_check('Project Edit')) {
            return abort(404);
        }

        DB::beginTransaction();

        try {
            $project = Project::query()->findOrFail($id);


            $imagePath = null;
            $imagePath2 = null;

            // Handle images upload
            if ($request->hasFile('new_normal_images')) {
                $imagePath = $this->storeFiles($request->file('new_normal_images'), $request->coverImage);
                // $imagePath = $this->storeFiles($request->file('new_normal_images'));
            }

            if ($request->hasFile('new_master_plan_images')) {
                $imagePath2 = $this->storeFiles($request->file('new_master_plan_images'));
            }


            // Find images and videos that were removed by comparing with the new ones
            if (is_array($project->images)) {
                $removedImages  = array_diff($project->images ?? [], $request->existingImage ?? []);
            }
            if (is_array($project->master_plan_images)) {

                $removedImages2 = array_diff($project->master_plan_images ?? [], $request->existingImageMaster ?? []);
            }

            // Merge the existing and new images and videos to get the final list
            $NewimagePath = array_merge($imagePath['filePaths'] ?? [], $request->existingImage ?? []);
            $NewimagePath2 = array_merge($imagePath2['filePaths'] ?? [], $request->existingImageMaster ?? []);

            foreach ($removedImages ?? [] as $imageLoc) {
                try {
                    // Check if the original image file exists before unlinking
                    $UnlinkimagePath = public_path('images/' . $imageLoc);
                    if (file_exists($UnlinkimagePath)) {
                        unlink($UnlinkimagePath);
                    }
                } catch (Exception $e) {
                }
            }

            foreach ($removedImages2 ?? [] as $imageLoc2) {
                try {
                    // Check if the original image file exists before unlinking
                    $UnlinkimagePath2 = public_path('images/' . $imageLoc2);
                    if (file_exists($UnlinkimagePath2)) {
                        unlink($UnlinkimagePath2);
                    }
                } catch (Exception $e) {
                }
            }


            $videos[] = $request->input('videos') ?? [];
            if ($request->filled('youtube_video')) {
                $request->merge(['youtube_video' => $this->getYouTubeVideoId($request->input('youtube_video'))]);
            }

            // if ($request->hasFile('new_normal_images')) {
            //     $images = $this->storeFiles($request->file('new_normal_images'));
            // } else {
            //     $images = null;
            // }

            // if ($request->hasFile('new_master_plan_images')) {
            //     $master_images = $this->storeFiles($request->file('new_master_plan_images'));
            // } else {
            //     $master_images = [];
            // }

            // $images           =  isset($imagePath['filePaths']) ? $imagePath['filePaths'] : '';
            $cover_image      =  isset($imagePath['coverImagePath']) ? $imagePath['coverImagePath'] : '';


            $request->merge(['images' => $NewimagePath, 'master_plan_images' => $NewimagePath2, 'cover_image' => $cover_image]);
            $request->merge(['videos' => array_filter($videos)]);


            $project->fill($request->input());
            $project->slug             = Str::slug($request->name);
            if ($project->unique_id == '') {
                $project->unique_id    = auth('account')->id() . date('mYdhisa');
            }
            $project->save();


            $this->saveCustomFields($project, $request->input('custom_fields', []));

            $this->saveConfigrationFields($project, $request->input('configration', []));

            $this->saveSpecificationFields($project, $request);

            $this->savePriceUnitFields($project, $request->input('unitDetails', []));

            $project->features()->sync($request->input('features', []));

            $this->saveFacilitiesService($project, $request->input('facilities', []));

            $this->projectCategoryService($request, $project);

            DB::commit();
            Session::flash('success_msg', 'Successfully Updated');

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Updated',
                'redirect' => route('admin.projects.index')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            // Return error response if something goes wrong
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        //

        if (!permission_check('Project Delete')) {
            return abort(404);
        }

        if (auth('web')->user()->acc_type == 'superadmin') {

            $project = Project::withTrashed()->whereId($id)->first() ?? abort(404);

            DB::beginTransaction();
            try {
                foreach ($project->images  ?? [] as $imageLoc) {
                    $imagePath = public_path('images/' . $imageLoc);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                FacilityDistance::where('reference_id', $project->id)->delete();
                DB::table('re_custom_field_values')->where('reference_type', 'App\Models\Project')->where('reference_id', $project->id)->delete();
                ConfigrationDetail::where('reference_id', $project->id)
                    ->where('reference_type', 'App\Models\Project')
                    ->delete();
                ProjectSpecification::where('project_id', $project->id)->delete();
                ProjectPriceVariations::where('project_id', $project->id)->delete();
                $project->categories()->detach();
                $project->features()->detach();

                $project->forceDelete();
                // $property->delete();
                DB::commit();
                Session::flash('success_msg', 'Successfully Deleted');
                if ($request->has('from') && $request->from == 'trash') {
                    return redirect()->route('admin.trash.index')->with('success_msg', 'Project  deleted!');
                }

                return redirect()->route('admin.projects.index')->with('success_msg', 'Project deleted!');
            } catch (Exception $e) {
                DB::rollBack();
                // Return error response if something goes wrong
                return response()->json([
                    'status' => 'failed_msg',
                    'message' => $e->getMessage(),
                ], 500);
            }
        } else {
            DB::beginTransaction();
            try {
                Project::where('id', $id)->delete();
                DB::commit();
                Session::flash('success_msg', 'Successfully Deleted');
                return redirect()->route('admin.projects.index')->with('success_msg', 'Project deleted!');
            } catch (Exception $e) {
                DB::rollBack();
                // Return error response if something goes wrong
                return response()->json([
                    'status' => 'failed_msg',
                    'message' => $e->getMessage(),
                ], 500);
            }
        }
    }



    protected function saveFacilitiesService(Project $project, array $facilities = []): void
    {

        FacilityDistance::where('reference_id', $project->id)->delete();

        foreach ($facilities ?? [] as $facilityValue) {

            if ($facilityValue['id'] != '') {
                $faciDistance              = new FacilityDistance();
                $faciDistance->reference_id  = $project->id;
                $faciDistance->facility_id   = $facilityValue['id'];
                $faciDistance->reference_type = 'App\Models\Project';
                $faciDistance->distance        = $facilityValue['distance'] ?? '';
                $faciDistance->save();
            }
        }
    }



    protected function propertyCategoryService($request, Project $project)
    {
        $categories = $request->input('categories', []);
        if (is_array($categories)) {
            if ($categories) {
                $project->categories()->sync($categories);
            } else {
                $project->categories()->detach();
            }
        }
    }


    // protected function storeFiles($files)
    // {

    //     $filePaths = []; // Array to store file paths with keys

    //     // Loop through each file
    //     foreach ($files ?? [] as $index => $file) {

    //         // $fileName = auth('account')->user()->id . '-' . time() . '-' . Str::slug(File::basename($file->getClientOriginalName())) . '.' . $file->getClientOriginalExtension();

    //         $folderPath = 'projects';
    //         $result = uploadFile($file, $folderPath, 'public', true);

    //         if (isset($result)) {
    //             $paths =  $result;
    //             $filePaths[$index + 1] = $paths;
    //         }
    //     }

    //     return $filePaths;
    // }

    protected function storeFiles($files, $coverImage = null)
    {
        $filePaths = [];
        $coverImagePath = "";

        foreach ($files ?? [] as $index => $file) {
            $folderPath = 'projects';

            $result = uploadFile($file, $folderPath, 'public', true);

            if ($result) {
                $filePaths[$index + 1] = $result;

                if ($file->getClientOriginalName() === $coverImage) {
                    $coverImagePath = $result;
                }
            } else {
                throw new \Exception("Failed to upload file: " . $file->getClientOriginalName());
            }
        }

        return [
            'filePaths' => $filePaths,
            'coverImagePath' => $coverImagePath,
        ];
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

    protected function saveCustomFields(Project $project, array $customFields = []): void
    {
        $customFields = $this->formatCustomFields($customFields);

        $project->customFields()
            ->whereNotIn('id', collect($customFields)->pluck('id')->all())
            ->delete();

        $project->customFields()->saveMany($customFields);
    }

    protected function formatCustomFields(array $customFields = []): array
    {
        $newCustomFields = [];

        foreach ($customFields ?? [] as $item) {
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


    protected function formatConfigrationFields(array $configrationFields = []): array
    {
        $newCustomFields = [];

        foreach ($configrationFields ?? [] as $item) {
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
        ConfigrationDetail::where('reference_id', $project->id)
            ->where('reference_type', 'App\Models\Project')
            ->delete();

        foreach ($configrationFields ?? [] as $confValue) {

            if ($confValue['id'] != '') {
                $confItm                  = new ConfigrationDetail();
                $confItm->reference_id    = $project->id;
                $confItm->configration_id = $confValue['id'];
                $confItm->distance        = $confValue['value'] ?? '';
                $confItm->reference_type  = 'App\Models\Project';
                $confItm->save();
            }
        }
    }


    protected function saveSpecificationFields(Project $project, Request $request): void
    {
        ProjectSpecification::where('project_id', $project->id)->delete();
        $specificationFields = $request->specifications;
        foreach ($specificationFields ?? [] as $index => $specValue) {
            // if (isset($specValue['image']) && $request->hasFile("specifications.$index.image")) {
            //     $path = uploadFile($specValue['image'], 'projects');
            //     if (file_exists('images/'.$specValue['eXimagePath'])) {
            //         unlink('images/'.$specValue['eXimagePath']);
            //     }
            // } else {
            //     $path = isset($specValue['eXimagePath']) ?? null;
            // }
            if ($specValue['description'] != '' || $specValue['description'] != null) {
                $specification              = new ProjectSpecification();
                $specification->project_id    = $project->id;
                $specification->name          = $specValue['name'];;
                $specification->image        = $specValue['image'];
                $specification->description    = $specValue['description'];
                $specification->save();
            }
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


    protected function projectCategoryService($request, Project $property)
    {
        $categories = $request->input('categories', []);
        if (is_array($categories)) {
            if ($categories) {
                $property->categories()->sync($categories);
            } else {
                $property->categories()->detach();
            }
        }
    }
}
