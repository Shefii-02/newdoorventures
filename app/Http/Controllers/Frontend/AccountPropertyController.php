<?php

namespace App\Http\Controllers\Frontend;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Facades\EmailHandler;
use App\Http\Controllers\Frontend\BaseController;
use App\Http\Requests\PropertyRequest;
use App\Interfaces\PropertyInterface;
use App\Models\Account;
use App\Models\AccountActivityLog;
use App\Models\Category;
use App\Models\CustomField;
use App\Models\CustomFieldValue;
use App\Models\Facility;
use App\Models\FacilityDistance;
use App\Models\Feature;
use App\Models\Furnishing;
use App\Models\PgRules;
use App\Models\Project;
use App\Models\Property;
use App\Models\RuleDetails;
use App\Services\StorePropertyCategoryService;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Botble\Media\Services\UploadsManager;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Exception;

use Illuminate\Routing\Controller;


class AccountPropertyController extends Controller
{
    public function __construct(

        //     protected AccountInterface $accountRepository,
            // protected PropertyInterface $propertyRepository,
        //     protected AccountActivityLogInterface $activityLogRepository,
        //     protected UploadsManager $uploadManager

    )
    {
        //     OptimizerHelper::disable();
        $this->middleware('auth:account');
        $user = auth('account')->user();
    }

    // protected function breadcrumb(): Breadcrumb
    // {
    //     return parent::breadcrumb()
    //         ->add(
    //             'Dashboard',
    //             route('public.account.dashboard')
    //         )
    //         ->add(
    //             'Properties',
    //             route('public.account.properties.index')
    //         );
    // }

    public function index(Request $request)
    {
       
        $user = auth('account')->user();

        $query = Property::orderBy('created_at','desc')->where('author_id', $user->id);

        // Apply search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                    ->orWhere('location', 'LIKE', "%$search%")
                    ->orWhere('type', 'LIKE', "%$search%");
            });
        }

        $properties = $query->paginate(30);

        if ($request->ajax()) {
            $rows = view('seller.properties.items', compact('properties'))->render();
            $pagination = view('seller.properties.pagination', compact('properties'))->render();
            return response()->json(['rows' => $rows, 'pagination' => $pagination]);
        }

        return view('seller.properties.index', compact('properties'));
    }


    public function create()
    {
        // ->canPost()
        if (! auth('account')->user()) {
            return back()->with(['error_msg' => trans('plugins/real-estate::package.add_credit_alert')]);
        }

        $user       = auth('account')->user();

        $categories = Category::where('status', 'published')->get();

        $projects   = Project::get();

        $has_rent   = Category::where('has_rent', 1)->get();

        $has_sell   = Category::where('has_sell', 1)->get();

        $has_pg     = Category::where('has_pg', 1)->get();

        $furnishing = Furnishing::where('status', 'published')->get();

        $facilities = Facility::where('status', 'published')->get();

        $features   = Feature::where('status', 'published')->get();

        $customFields = CustomField::get();

        $pg_rules = PgRules::orderBy('type', 'desc')->get();



        return view('seller.properties.create', compact('user', 'categories', 'projects', 'has_rent', 'has_sell', 'has_pg', 'furnishing', 'features', 'facilities', 'customFields', 'pg_rules'));

        // return AccountPropertyForm::create()->renderForm();

    }

    public function store(
        PropertyRequest $request,
        // StorePropertyCategoryService $propertyCategoryService,
        // SaveFacilitiesService $saveFacilitiesService,
        // SaveRulesInformation $saveRulesInformation
      
    ) {


        // ->canPost()
        if (! auth('account')->user()) {
            return back()->with(['error_msg' => 'Invalid Attempt']);
        }

        DB::beginTransaction();

        try {
            $property = new Property();

            $categories[] = $request->category ?? '';

            $request->merge(['categories' => $categories]);


            $imagePath = null;
            $videoPath = null;

            // Handle images upload
            if ($request->hasFile('images')) {
                $imagePath = $this->storeFiles($request->file('images'));
            }

            // Handle videos upload
            if ($request->hasFile('videos')) {
                $videoPath = $this->storeFiles($request->file('videos'));
            }

            $youtube_video = '';
            if ($request->filled('youtube_video')) {
                $youtube_video = $this->getYouTubeVideoId($request->input('youtube_video'));
            }

            $property->name             = $request->property_name;
            $property->slug             = Str::slug($request->property_name);
            $property->type             = $request->mode;
            $property->mode             = $request->type;
            $property->project_id       = $request->project;
            $property->number_bedroom   = $request->room;
            $property->number_bathroom  = $request->bathroom;
            $property->number_floor     = $request->total_floor;
            $property->content          = $request->unique_info;
            $property->square           = $request->super_built_up_area;
            $property->price            = $request->price;
            $property->images           = $imagePath;
            $property->video            = $videoPath;
            $property->unique_id        = auth('account')->id() . date('mYdhisa');

            $property->author_id        = auth('account')->id();
            $property->author_type      = Account::class;
            $property->moderation_status = 'peding';
            $property->furnishing_status = $request->has('furnishing_status') ? $request->furnishing_status : 'unfurnished';
            $property->construction_status = $request->available_status;
            $property->expire_date      = '2030-12-30';
            $property->never_expired    = 1;
            $property->latitude         = $request->latitude;
            $property->longitude        = $request->longitude;
            $property->unit_info        = $request->unit_info;
            $property->location         = $request->location_info;
            $property->youtube_video    = $youtube_video;
            $property->city             = $request->city;
            $property->locality         = $request->locality;
            $property->sub_locality     = $request->sub_locality;
            $property->apartment        = $request->apartment;
            $property->landmark         = $request->landmark;
            $property->available_floor  = $request->available_floor;
            $property->balconies        = $request->balconies;
            $property->carpet_area      = $request->carpet_area;
            $property->built_up_area    = $request->built_up_area;
            $property->covered_parking  = $request->covered_parking;
            $property->open_parking     = $request->open_parking;
            $property->property_age     = $request->property_age;
            $property->possession       = $request->possession;
            $property->ownership        = $request->ownership;
            $property->all_include      = $request->has('all_include') ? 1 : 0;
            $property->tax_include      = $request->has('tax_include') ? 1 : 0;
            $property->negotiable       = $request->has('negotiable') ? 1 : 0;
            $property->cover_image      = $request->has('coverImage') ? 1 : '';
            $property->occupancy_type   = $request->has('occupancy_type') ? $request->occupancy_type : '';
            $property->available_for    = $request->has('available_for') ? $request->available_for : '';
            $property->plot_area        = $request->plot_area ?? '';
            $property->moderation_status = $request->has('moderation_status') ? $request->moderation_status : 'draft';
            if ($request->mode == 'sell') {
                $property->status       = 'selling';
            } else {
                $property->status       = 'renting';
            }
            $property->save();


            $property->features()->sync($request->input('amenities', []));
            if ($request->furnishing_status != 'unfurnished') {
                $property->furnishing()->sync($request->input('furnishing', []));
            }

            $this->saveCustomFields($property, $request->input('custom_fields', [])); //moredetail


            $this->saveFacilitiesService($property, $request->input('facilities', []));

            // $saveFacilitiesService->execute($property, $request->input('facilities', []));  // landmark

            $this->propertyCategoryService($request, $property);

            // $saveRulesInformation->execute($property, $request->type, $request->input('rule', []));
            $this->saveRulesInformation($property, $request->input('rule', []));





            // $property->fill(array_merge($this->processRequestData($request), [
            //     'author_id' => auth('account')->id(),
            //     'author_type' => Account::class,
            // ]));

            // $property->expire_date = Carbon::now()->addDays(RealEstateHelper::propertyExpiredDays());

            // if (setting('enable_post_approval', 1) == 0) {
            //     $property->moderation_status = ModerationStatusEnum::APPROVED;
            // }

            // $property->save();

            // if (RealEstateHelper::isEnabledCustomFields()) {
            //     $this->saveCustomFields($property, $request->input('custom_fields', []));
            // }

            // $property->features()->sync($request->input('features', []));

            // $saveFacilitiesService->execute($property, $request->input('facilities', []));

            // $propertyCategoryService->execute($request, $property);

            // event(new CreatedContentEvent(PROPERTY_MODULE_SCREEN_NAME, $request, $property));

            AccountActivityLog::query()->create([
                'action' => 'create_property',
                'reference_name' => $property->name,
                'reference_url' => route('user.properties.edit', $property->id),
            ]);

            // if (RealEstateHelper::isEnabledCreditsSystem()) {
            //     $account = Account::query()->findOrFail(auth('account')->id());
            //     $account->credits--;
            //     $account->save();
            // }

            // EmailHandler::setModule(REAL_ESTATE_MODULE_SCREEN_NAME)
            //     ->setVariableValues([
            //         'post_name' => $property->name,
            //         'post_url' => route('property.edit', $property->id),
            //         'post_author' => $property->author->name,
            //     ])
            //     ->sendUsingTemplate('new-pending-property');

            DB::commit();


            Session::flash('success_msg', trans('core/base::notices.create_success_message'));



            return response()->json([
                'status' => 'success',
                'message' => trans('core/base::notices.create_success_message'),
                'redirect' => route('user.properties.index')
            ]);

            // return $this
            //     ->httpResponse()
            //     ->setPreviousUrl(route('public.account.properties.index'))
            //     ->setNextUrl(route('public.account.properties.edit', $property->id))
            //     ->setMessage(trans('core/base::notices.create_success_message'));

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
        $property = Property::where([
            'id' => $id,
            'author_id' => auth('account')->id(),
            'author_type' => Account::class,
        ])->first() ?? abort(404);
        

        if (! $property) {
            abort(404);
        }

        $user = auth('account')->user();
        $categories = Category::where('status', 'published')->get();
        $projects = Project::get();

        $has_rent = Category::where('has_rent', 1)->get();
        $has_sell = Category::where('has_sell', 1)->get();
        $has_pg = Category::where('has_pg', 1)->get();

        $furnishing = Furnishing::where('status', 'published')->get();
        $facilities = Facility::where('status', 'published')->get();

        $features = Feature::where('status', 'published')->get();

        $customFields = CustomField::get();

        $pg_rules = PgRules::orderBy('type', 'desc')->get();

        // event(new BeforeEditContentEvent($request, $property));

        // $this->pageTitle(trans('plugins/real-estate::property.edit') . ' "' . $property->name . '"');

        return view('seller.properties.edit', compact('user', 'categories', 'projects', 'has_rent', 'has_sell', 'has_pg', 'furnishing', 'features', 'facilities', 'customFields', 'property', 'pg_rules'));


        // return AccountPropertyForm::createFromModel($property)
        //     ->renderForm();
    }

    public function update(
        int|string $id,
        PropertyRequest $request,
        // StorePropertyCategoryService $propertyCategoryService,
        // SaveFacilitiesService $saveFacilitiesService,
        // SaveRulesInformation $saveRulesInformation
    ) {

        $property = Property::where([
            'id' => $id,
            'author_id' => auth('account')->id(),
            'author_type' => Account::class,
        ])->first() ?? abort(404);

        if (! $property) {
            abort(404);
        }

        DB::beginTransaction();

        try {



            $categories[] = $request->category ?? '';


            $request->merge(['categories' => $categories]);

            $imagePath = null;
            $videoPath = null;

            // Handle images upload
            if ($request->hasFile('images')) {
                $imagePath = $this->storeFiles($request->file('images'));
            }

            // Handle videos upload
            if ($request->hasFile('videos')) {
                $videoPath = $this->storeFiles($request->file('videos'));
            }

            $youtube_video = '';
            if ($request->filled('youtube_video')) {
                $youtube_video = $this->getYouTubeVideoId($request->input('youtube_video'));
            }


            // Find images and videos that were removed by comparing with the new ones
            $removedImages = array_diff($property->images ?? [], $request->existingImage ?? []);
            $removedVideos = array_diff($property->video ?? [], $request->existingVideo ?? []);



            // Merge the existing and new images and videos to get the final list
            $NewimagePath = array_merge($imagePath ?? [], $request->existingImage ?? []);
            $NewvideoPath = array_merge($videoPath ?? [], $request->existingVideo ?? []);

            foreach ($removedImages ?? [] as $imageLoc) {
                try {
                    // Check if the original image file exists before unlinking
                    $imagePath = public_path('storage/' . $imageLoc);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }

                    // Get the filename without extension for thumbnail checks
                    // $filename = pathinfo($imageLoc, PATHINFO_FILENAME);

                    // // Check if each thumbnail file exists before unlinking
                    // $thumb150x150 = public_path('storage/' . $filename . '-150x150.png');
                    // if (file_exists($thumb150x150)) {
                    //     unlink($thumb150x150);
                    // }

                    // $thumb600x400 = public_path('storage/' . $filename . '-600x400.png');
                    // if (file_exists($thumb600x400)) {
                    //     unlink($thumb600x400);
                    // }

                    // $thumb600x600 = public_path('storage/' . $filename . '-600x600.png');
                    // if (file_exists($thumb600x600)) {
                    //     unlink($thumb600x600);
                    // }
                } catch (Exception $e) {
                    // Handle exceptions if needed
                    // For example, log the error: Log::error($e->getMessage());
                }
            }

            foreach ($removedVideos ?? [] as $videoLoc) {
                unlink('storage/' . $videoLoc);
            }

            $old_type  = $property->type;

            $property->name             = $request->property_name;
            $property->slug             = Str::slug($request->property_name);
            $property->type             = $request->mode;
            $property->mode             = $request->type;
            $property->project_id       = $request->project;
            $property->number_bedroom   = $request->room;
            $property->number_bathroom  = $request->bathroom;
            $property->number_floor     = $request->total_floor;
            $property->content          = $request->unique_info;
            $property->square           = $request->super_built_up_area;
            $property->price            = $request->price;
            $property->images           = $NewimagePath;
            $property->video            = $NewvideoPath;
            if ($property->unique_id == '') {
                $property->unique_id        = auth('account')->id() . date('mYdhisa');
            }
            $property->author_id        = auth('account')->id();
            $property->author_type      = Account::class;
            // $property->moderation_status = ModerationStatusEnum::PENDING;
            $property->furnishing_status = $request->has('furnishing_status') ? $request->furnishing_status : 'unfurnished';
            $property->construction_status = $request->available_status;
            $property->expire_date      = '2050-12-30';
            $property->never_expired    = 1;
            $property->latitude         = $request->latitude;
            $property->longitude        = $request->longitude;
            $property->unit_info        = $request->unit_info;
            $property->location         = $request->location_info;
            $property->city             = $request->city;
            $property->locality         = $request->locality;
            $property->sub_locality     = $request->sub_locality;
            $property->apartment        = $request->apartment;
            $property->youtube_video    = $youtube_video;
            $property->landmark         = $request->landmark;
            $property->available_floor  = $request->available_floor;
            $property->balconies        = $request->balconies;
            $property->carpet_area      = $request->carpet_area;
            $property->built_up_area    = $request->built_up_area;
            $property->covered_parking  = $request->covered_parking;
            $property->open_parking     = $request->open_parking;
            $property->property_age     = $request->property_age;
            $property->possession       = $request->possession;
            $property->ownership        = $request->ownership;
            $property->all_include      = $request->has('all_include') ? 1 : 0;
            $property->tax_include      = $request->has('tax_include') ? 1 : 0;
            $property->negotiable       = $request->has('negotiable') ? 1 : 0;
            $property->cover_image      = $request->has('coverImage') ? 1 : '';
            $property->occupancy_type   = $request->has('occupancy_type') ? $request->occupancy_type : '';
            $property->available_for    = $request->has('available_for') ? $request->available_for : '';
            $property->plot_area        = $request->plot_area ?? '';
            if ($request->mode == 'sell') {
                if ($request->property_status == 'sold') {
                    $property->status       = 'sold';
                    $property->moderation_status = 'sold';
                } elseif ($request->property_status == 'not_available') {
                    $property->status       = 'not_available';
                    $property->moderation_status = 'not_available';
                } else {
                    $property->status       = 'selling';
                }
            } else {
                if ($request->property_status == 'rented') {
                    $property->status       = 'rented';
                    $property->moderation_status = 'rented';
                } elseif ($request->property_status == 'not_available') {
              
                    $property->status       = 'not_available';
                    $property->moderation_status = 'not_available';
                } else {
                    $property->status       = 'renting';
                }
            }

            if ($old_type != $request->mode || $request->property_status == 'pending') {

                $property->moderation_status = 'pending';
            }

            
            $property->save();




            $property->features()->sync($request->input('amenities', []));
            if ($request->furnishing_status != 'unfurnished') {
                $property->furnishing()->sync($request->input('furnishing', []));
            }


            $this->saveCustomFields($property, $request->input('custom_fields', [])); //moredetail


            $this->saveFacilitiesService($property, $request->input('facilities', []));

            // $saveFacilitiesService->execute($property, $request->input('facilities', []));  // landmark

            $this->propertyCategoryService($request, $property);

            // $saveRulesInformation->execute($property, $request->type, $request->input('rule', []));
            $this->saveRulesInformation($property, $request->input('rule', []));


            // $saveFacilitiesService->execute($property, $request->input('facilities', []));  // landmark

            // $this->saveCustomFields($property, $request->input('custom_fields', [])); //moredetail

            // $propertyCategoryService->execute($request, $property);

            // $saveRulesInformation->execute($property, $request->type, $request->input('rule', []));

            // $property->fill($this->processRequestData($request));

            // $property->save();

            // if (RealEstateHelper::isEnabledCustomFields()) {
            //     $this->saveCustomFields($property, $request->input('custom_fields', []));
            // }

            // $property->features()->sync($request->input('features', []));

            // $saveFacilitiesService->execute($property, $request->input('facilities', []));

            // $propertyCategoryService->execute($request, $property);

            // event(new UpdatedContentEvent(PROPERTY_MODULE_SCREEN_NAME, $request, $property));

            AccountActivityLog::query()->create([
                'action' => 'update_property',
                'reference_name' => $property->name,
                'reference_url' => route('user.properties.edit', $property->id),
            ]);
            DB::commit();

            // SlugHelper::createSlug($property);

            Session::flash('success_msg', trans('core/base::notices.update_success_message'));

            return response()->json([
                'status' => 'success',
                'message' => trans('core/base::notices.update_success_message'),
                'redirect' => route('user.properties.index')
            ]);


            // return $this
            //     ->httpResponse()
            //     ->setPreviousUrl(route('public.account.properties.index'))
            //     ->setNextUrl(route('public.account.properties.edit', $property->id))
            //     ->setMessage(trans('core/base::notices.update_success_message'));
        } catch (\Exception $e) {

            DB::rollBack();
            // Return error response if something goes wrong
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    // protected function processRequestData(Request $request): array
    // {
    //     $shortcodeCompiler = shortcode()->getCompiler();

    //     $request->merge([
    //         'content' => $shortcodeCompiler->strip($request->input('content'), $shortcodeCompiler->whitelistShortcodes()),
    //     ]);

    //     $except = [
    //         'is_featured',
    //         'author_id',
    //         'author_type',
    //         'expire_date',
    //     ];

    //     foreach ($except as $item) {
    //         $request->request->remove($item);
    //     }

    //     return $request->input();
    // }

    public function destroy(int|string $id)
    {
        $property = Property::where([
            'id' => $id,
            'author_id' => auth('account')->id(),
            'author_type' => Account::class,
        ])->first() ?? abort(404);


        if (! $property) {
            abort(404);
        }

        $property->delete();

        AccountActivityLog::query()->create([
            'action' => 'delete_property',
            'reference_name' => $property->name,
        ]);

        return $this
            ->httpResponse()
            ->setMessage(__('Delete property successfully!'));
    }

    // public function renew(int|string $id)
    // {
    //     $property = Property::query()->findOrFail($id);

    //     $account = auth('account')->user();

    //     if (RealEstateHelper::isEnabledCreditsSystem() && $account->credits < 1) {
    //         return $this
    //             ->httpResponse()
    //             ->setError()
    //             ->setMessage(__("You don't have enough credit to renew this property!"));
    //     }

    //     $property->expire_date = $property->expire_date->addDays(RealEstateHelper::propertyExpiredDays());
    //     $property->save();

    //     if (RealEstateHelper::isEnabledCreditsSystem()) {
    //         $account->credits--;
    //         $account->save();
    //     }

    //     return $this
    //         ->httpResponse()
    //         ->setMessage(__('Renew property successfully'));
    // }

    protected function saveCustomFields(Property $property, array $customFields = []): void
    {

        $customFields = CustomFieldValue::formatCustomFields($customFields);

        DB::table('re_custom_field_values')->where('reference_type', 'App\Models\Property')->where('reference_id', $property->id)->delete();
        
        $property->customFields()->saveMany($customFields);
    }



    protected function saveFacilitiesService(Property $property, array $facilities = []): void
    {

        FacilityDistance::where('reference_id', $property->id)->delete();

        foreach ($facilities as $facilityValue) {
            if ($facilityValue['id'] != '') {
                $faciDistance              = new FacilityDistance();
                $faciDistance->reference_id  = $property->id;
                $faciDistance->facility_id   = $facilityValue['id'];
                $faciDistance->reference_type = 'App\Models\Property';
                $faciDistance->distance        = $facilityValue['distance'] ?? '';
                $faciDistance->save();
            }
        }
    }


    protected function saveRulesInformation(Property $property, array $rule = []): void
    {
        RuleDetails::where('reference_id', $property->id)->delete();

        if ($property->type == 'pg') {
            foreach ($rule as $ruleValue) {
                if ($ruleValue['id'] != '') {
                    $ruleNew              = new RuleDetails();
                    $ruleNew->reference_id  = $property->id;
                    $ruleNew->rule_id   = $ruleValue['id'];
                    $ruleNew->reference_type = 'App\Models\Property';
                    $ruleNew->value        = $ruleValue['value'] ?? '';
                    $ruleNew->save();
                }
            }
        }
    }

    protected function propertyCategoryService($request,Property $property){
        $categories = $request->input('categories', []);
        if (is_array($categories)) {
            if ($categories) {
                $property->categories()->sync($categories);
            } else {
                $property->categories()->detach();
            }
        }
    }


    protected function storeFiles($files)
    {

        $filePaths = []; // Array to store file paths with keys

        // Loop through each file
        foreach ($files as $index => $file) {

            // $fileName = auth('account')->user()->id . '-' . time() . '-' . Str::slug(File::basename($file->getClientOriginalName())) . '.' . $file->getClientOriginalExtension();

            $folderPath = 'properties';
            $result = uploadFile($file, $folderPath, 'public');

            if (isset($result)) {
                $paths =  $result;
                $filePaths[$index + 1] = $paths;
            }
        }

        return $filePaths;
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
