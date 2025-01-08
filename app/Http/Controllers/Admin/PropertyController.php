<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PropertyRequest;
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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PropertyController extends Controller
{

    use \App\Emails;


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Property::where('moderation_status', 'pending');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
                // ->orWhere('location', 'LIKE', "%$search%")
                // ->orWhere('type', 'LIKE', "%$search%");
            });
        }

        if ($request->has('staff') && $request->staff != '') {
            $query = $query->where('author_id', $request->staff);
        }

        if ($request->has('created_at') && $request->created_at != '') {
            $start_date = $request->created_at . ' 00:00:00';
            $end_date = $request->created_at . ' 23:59:59';
            $query = $query->whereBetween('created_at', [$start_date, $end_date]);
        }



        $properties = $query->paginate(10);

        if ($request->ajax()) {
            $rows = view('admin.properties.items', compact('properties'))->render();
            $pagination = view('admin.properties.pagination', compact('properties'))->render();
            return response()->json(['rows' => $rows, 'pagination' => $pagination]);
        }

        $staffs = Account::where('is_staff', '1')->get();

        return view('admin.properties.pending', compact('properties', 'staffs'));
    }

    public function approved(Request $request)
    {
        $query = Property::where('moderation_status', 'approved')->orderBy('id', 'desc');
        //      orderByRaw("
        //     CASE 
        //         WHEN moderation_status = 'pending' THEN 1
        //         WHEN moderation_status = 'approved' THEN 2
        //         WHEN moderation_status = 'suspended' THEN 3
        //         ELSE 4
        //     END
        // ");
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
                //         ->orWhere('location', 'LIKE', "%$search%")
                //         ->orWhere('type', 'LIKE', "%$search%")
                //         ->orWhere('moderation_status', 'LIKE', "%$search%");
            });
            // $query->whereHas('account', function ($q) use ($search) {
            //     $q->where('first_name', 'LIKE', "%$search%")
            //     ->orWhere('last_name', 'LIKE', "%$search%");
            // });
        }

        if ($request->has('staff') && $request->staff != '') {
            $query = $query->where('author_id', $request->staff);
        }

        if ($request->has('created_at') && $request->created_at != '') {
            $start_date = $request->created_at . ' 00:00:00';
            $end_date = $request->created_at . ' 23:59:59';

            $query = $query->whereBetween('created_at', [$start_date, $end_date]);
        }

        $properties = $query->paginate(10);

        if ($request->ajax()) {
            $rows = view('admin.properties.items', compact('properties'))->render();
            $pagination = view('admin.properties.pagination', compact('properties'))->render();
            return response()->json(['rows' => $rows, 'pagination' => $pagination]);
        }

        $staffs = Account::where('is_staff', '1')->get();
        return view('admin.properties.approved', compact('properties', 'staffs'));
    }


    public function suspended(Request $request)
    {
        $query = Property::where('moderation_status', 'suspended')->orderBy('id', 'desc');
        // orderByRaw("
        //         CASE 
        //             WHEN moderation_status = 'pending' THEN 1
        //             WHEN moderation_status = 'approved' THEN 2
        //             WHEN moderation_status = 'suspended' THEN 3
        //             ELSE 4
        //         END
        //     ");
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
                // ->orWhere('location', 'LIKE', "%$search%")
                // ->orWhere('type', 'LIKE', "%$search%")
                // ->orWhere('moderation_status', 'LIKE', "%$search%");
            });
            // $query->whereHas('account', function ($q) use ($search) {
            //     $q->where('first_name', 'LIKE', "%$search%")
            //     ->orWhere('last_name', 'LIKE', "%$search%");
            // });
        }

        if ($request->has('staff') && $request->staff != '') {
            $query = $query->where('author_id', $request->staff);
        }

        if ($request->has('created_at') && $request->created_at != '') {
            $start_date = $request->created_at . ' 00:00:00';
            $end_date = $request->created_at . ' 23:59:59';
            $query = $query->whereBetween('created_at', [$start_date, $end_date]);
        }



        $properties = $query->paginate(10);

        if ($request->ajax()) {
            $rows = view('admin.properties.items', compact('properties'))->render();
            $pagination = view('admin.properties.pagination', compact('properties'))->render();
            return response()->json(['rows' => $rows, 'pagination' => $pagination]);
        }

        $staffs = Account::where('is_staff', '1')->get();
        return view('admin.properties.suspended', compact('properties', 'staffs'));
    }


    public function soldRented(Request $request)
    {
        $query = Property::where(function ($q) {
            $q->where('moderation_status', "sold")
                ->orWhere('moderation_status', "rented");
        })->orderBy('id', 'desc');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%");
                // ->orWhere('location', 'LIKE', "%$search%")
                // ->orWhere('type', 'LIKE', "%$search%")
                // ->orWhere('moderation_status', 'LIKE', "%$search%");
            });
            // $query->whereHas('account', function ($q) use ($search) {
            //     $q->where('first_name', 'LIKE', "%$search%")
            //     ->orWhere('last_name', 'LIKE', "%$search%");
            // });
        }


        if ($request->has('staff') && $request->staff != '') {
            $query = $query->where('author_id', $request->staff);
        }

        if ($request->has('created_at') && $request->created_at != '') {
            $start_date = $request->created_at . ' 00:00:00';
            $end_date = $request->created_at . ' 23:59:59';
            $query = $query->whereBetween('created_at', [$start_date, $end_date]);
        }



        $properties = $query->paginate(10);

        if ($request->ajax()) {
            $rows = view('admin.properties.items', compact('properties'))->render();
            $pagination = view('admin.properties.pagination', compact('properties'))->render();
            return response()->json(['rows' => $rows, 'pagination' => $pagination]);
        }

        $staffs = Account::where('is_staff', '1')->get();
        return view('admin.properties.sold-rented', compact('properties', 'staffs'));
    }



    protected function saveCustomFields(Property $property, array $customFields = []): void
    {
        $customFields = CustomFieldValue::formatCustomFields($customFields);
        DB::table('re_custom_field_values')->where('reference_id', $property->id)->delete();
        $property->customFields()->saveMany($customFields);
    }



    protected function saveFacilitiesService(Property $property, array $facilities = []): void
    {

        FacilityDistance::where('reference_id', $property->id)->delete();

        foreach ($facilities ?? [] as $facilityValue) {
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
            foreach ($rule ?? [] as $ruleValue) {
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

    protected function propertyCategoryService($request, Property $property)
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


    protected function storeFiles($files, $coverImage = null)
    {
        $filePaths = [];
        $coverImagePath = "";

        foreach ($files ?? [] as $index => $file) {
            $folderPath = 'properties';

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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $categories = Category::where('status', 'published')->get();

        $projects   = Project::get();

        $has_rent   = Category::where('has_rent', 1)->get();

        $has_sell   = Category::where('has_sell', 1)->get();

        $has_pg     = Category::where('has_pg', 1)->get();

        $furnishing = Furnishing::where('status', 'published')->get();

        $facilities = Facility::where('status', 'published')->get();

        $features   = Feature::where('status', 'published')->get();

        $customFields = CustomField::get();

        $accounts     = Account::where('status', 'approved')->orderBy('is_staff', 'desc')->orderBy('first_name', 'asc')->get();

        $pg_rules = PgRules::orderBy('type', 'desc')->get();

        return view('admin.properties.create', compact('categories', 'projects', 'has_rent', 'has_sell', 'has_pg', 'furnishing', 'features', 'facilities', 'customFields', 'pg_rules', 'accounts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyRequest $request)
    {


        DB::beginTransaction();

        try {
            $property = new Property();

            $categories[] = $request->category ?? '';

            $request->merge(['categories' => $categories]);


            $imagePath = null;
            $videoPath = null;

            // Handle images upload
            if ($request->hasFile('images')) {
                $imagePath = $this->storeFiles($request->file('images'), $request->coverImage);
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
            $property->images           = isset($imagePath['filePaths']) ? $imagePath['filePaths'] : '';
            $property->video            = $videoPath;
            $property->unique_id        = $request->account . date('mYdhisa');

            $property->author_id        = $request->account;
            $property->author_type      = Account::class;

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
            $property->balconies        = $request->balconie;
            $property->carpet_area      = $request->carpet_area;
            $property->built_up_area    = $request->built_up_area;
            $property->covered_parking  = $request->covered_parking;
            $property->open_parking     = $request->open_parking;
            $property->property_age     = $request->property_age;
            $property->possession       = $request->possession;
            $property->ownership        = $request->ownership;
            $property->other_rooms      = $request->has('other_rooms') && count($request->other_rooms) > 0 ? implode(',', $request->other_rooms) : null;
            $property->all_include      = $request->has('all_include') ? 1 : 0;
            $property->tax_include      = $request->has('tax_include') ? 1 : 0;
            $property->negotiable       = $request->has('negotiable') ? 1 : 0;

            $property->occupancy_type   = $request->has('occupancy_type') ? $request->occupancy_type : '';
            $property->available_for    = $request->has('available_for') ? $request->available_for : '';
            $property->plot_area        = $request->plot_area ?? '';
            $property->open_sides       = $request->open_sides;
            $property->pantry           = $request->pantry ?? '';
            $property->washroom         = $request->washroom ?? 0;
            $property->cabin            = $request->cabin ?? 0;
            $property->seats            = $request->seats ?? 0;
            $property->units_on_floor   = $request->units_on_floor ?? 0;
            $property->ac_count         = $request->ac_count ?? 0;
            $property->fans_count       = $request->fans_count ?? 0;
            $property->work_stations    = $request->work_stations ?? 0;
            $property->chairs_count     = $request->chairs_count ?? 0;
            $property->plot_type        = $request->plot_type ?? '';
            $property->cover_image      =  isset($imagePath['coverImagePath']) ? $imagePath['coverImagePath'] : '';
            $property->moderation_status = 'approved';
            $property->built_suit       = $request->has('built_suit') ? 1 : 0;

            if ($request->mode == 'sell') {
                $property->status       = 'selling';
            } else {
                $property->status       = 'renting';
            }
            $property->save();


            if ($request->furnishing_status == 'furnished') {
                $furnishingIds = Furnishing::whereStatus('published')->pluck('id');

                $request->merge(['furnishing' => $furnishingIds]);
            }


            $property->features()->sync($request->input('amenities', []));
            // if ($request->furnishing_status != 'unfurnished') {
            $property->furnishing()->sync($request->input('furnishing', []));
            // }

            $this->saveCustomFields($property, $request->input('custom_fields', [])); //moredetail


            $this->saveFacilitiesService($property, $request->input('facilities', []));



            $this->propertyCategoryService($request, $property);


            $this->saveRulesInformation($property, $request->input('rule', []));


            // event(new CreatedContentEvent(PROPERTY_MODULE_SCREEN_NAME, $request, $property));

            AccountActivityLog::query()->create([
                'action' => 'create_property',
                'reference_name' => $property->name,
                'reference_url' => route('admin.properties.edit', $property->id),
            ]);

            $this->adApproved($property);
            DB::commit();
            Session::flash('success_msg', 'Successfully Created');

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Created',
                'redirect' => route('admin.properties.index')
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $property = Property::findOrFail($id);
        if ($property->type == 'pg') {
            return view('admin.properties.pg-single', compact('property'));
        } else if ($property->category->name == 'Plot and Land') {
            return view('admin.properties.plot-single', compact('property'));
        } else {
            return view('admin.properties.rent-sale-single', compact('property'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $property = Property::where(['id' => $id])->first() ?? abort(404);


        if (! $property) {
            abort(404);
        }


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

        $accounts     = Account::where('status', 'approved')->orderBy('is_staff', 'desc')->orderBy('first_name', 'asc')->get();

        return view('admin.properties.edit', compact('categories', 'projects', 'has_rent', 'has_sell', 'has_pg', 'furnishing', 'features', 'facilities', 'customFields', 'property', 'pg_rules', 'accounts'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     //
    //     $property = Property::findOrFail($id);


    //     $property->update($request->only('moderation_status'));

    //     if ($request->moderation_status == 'approved' && $property->moderation_status != 'approved') {
    //         $this->adApproved($property);
    //     } else if ($request->moderation_status == 'suspended' && $property->moderation_status != 'suspended') {
    //         $this->adSuspended($property);
    //     }

    //     return redirect()->route('admin.properties.index')->with('success', 'Status updated successfully!');
    // }

    // public function update(Request $request, string $id)
    // {
    //     $property = Property::findOrFail($id);

    //     $previousStatus = $property->moderation_status;
    //     $property->update($request->only('moderation_status'));

    //     // Handle transitions based on the status
    //     switch ($request->moderation_status) {
    //         case 'approved':
    //             if ($previousStatus == 'pending') {
    //                 $this->adApproved($property); // Handle pending to approved
    //             } elseif (in_array($previousStatus, ['rented', 'sold'])) {
    //                 $this->adRePublished($property); // Handle re-approval of sold/rented properties
    //             }
    //             break;

    //         case 'suspended':
    //             if (in_array($previousStatus, ['pending', 'approved'])) {
    //                 $this->adSuspended($property); // Handle transition to suspended
    //             }
    //             break;

    //         case 'rented':
    //         case 'sold':
    //             if ($previousStatus == 'approved') {
    //                 $this->adCompleted($property); // Handle approved to rented/sold
    //             }
    //             break;

    //         default:
    //             break;
    //     }
    //     Session::flash('success_msg', 'Status updated successfully!');
    //     return redirect()->back();
    // }


    /**
     * Remove the specified resource from storage.
     */

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
                $imagePath = $this->storeFiles($request->file('images'), $request->coverImage);
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
            // $removedImages = array_diff($property->images ?? [], $request->existingImage ?? []);
            // $removedVideos = array_diff($property->video ?? [], $request->existingVideo ?? []);

            // Merge the existing and new images and videos to get the final list
            $NewimagePath = array_merge($imagePath['filePaths'] ?? [], $request->existingImage ?? []);
            $NewvideoPath = array_merge($videoPath ?? [], $request->existingVideo ?? []);

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

            foreach ($removedVideos ?? [] as $videoLoc) {
                unlink('images/' . $videoLoc);
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
                $property->unique_id        = $request->account . date('mYdhisa');
            }
            $property->author_id        = $request->account;
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
            $property->balconies        = $request->balconie;
            $property->carpet_area      = $request->carpet_area;
            $property->built_up_area    = $request->built_up_area;
            $property->covered_parking  = $request->covered_parking;
            $property->open_parking     = $request->open_parking;
            $property->property_age     = $request->property_age;
            $property->possession       = $request->possession;
            $property->ownership        = $request->ownership;
            $property->open_sides       = $request->open_sides;
            $property->other_rooms      = $request->has('other_rooms') && count($request->other_rooms) > 0 ? implode(',', $request->other_rooms) : null;
            $property->all_include      = $request->has('all_include') ? 1 : 0;
            $property->tax_include      = $request->has('tax_include') ? 1 : 0;
            $property->negotiable       = $request->has('negotiable') ? 1 : 0;
            $property->cover_image      = (isset($imagePath['coverImagePath']) && strlen($imagePath['coverImagePath']) > 3) ? $imagePath['coverImagePath'] : $request->coverImage;
            $property->occupancy_type   = $request->has('occupancy_type') ? $request->occupancy_type : '';
            $property->available_for    = $request->has('available_for') ? $request->available_for : '';
            $property->plot_area        = $request->plot_area ?? '';
            $property->pantry           = $request->pantry ?? '';
            $property->washroom         = $request->washroom ?? 0;
            $property->cabin            = $request->cabin ?? 0;
            $property->seats            = $request->seats ?? 0;
            $property->units_on_floor   = $request->units_on_floor ?? 0;
            $property->ac_count         = $request->ac_count ?? 0;
            $property->fans_count       = $request->fans_count ?? 0;
            $property->work_stations    = $request->work_stations ?? 0;
            $property->chairs_count     = $request->chairs_count ?? 0;
            $property->plot_type        = $request->plot_type ?? '';
            $property->moderation_status = $request->property_status ?? 'pending';
            $property->built_suit       = $request->has('built_suit') ? 1 : 0;

            $property->save();

            $property->features()->sync($request->input('amenities', []));

            if ($request->furnishing_status == 'furnished') {

                $furnishingIds = Furnishing::whereStatus('published')->pluck('id');

                $request->merge(['furnishing' => $furnishingIds]);
            }

            // if ($request->furnishing_status != 'unfurnished') {
            $property->furnishing()->sync($request->input('furnishing', []));
            // }



            $this->saveCustomFields($property, $request->input('custom_fields', [])); //moredetail


            $this->saveFacilitiesService($property, $request->input('facilities', []));

            // $saveFacilitiesService->execute($property, $request->input('facilities', []));  // landmark

            $this->propertyCategoryService($request, $property);

            // $saveRulesInformation->execute($property, $request->type, $request->input('rule', []));
            $this->saveRulesInformation($property, $request->input('rule', []));


            AccountActivityLog::query()->create([
                'action' => 'update_property',
                'reference_name' => $property->name,
                'reference_url' => route('admin.properties.edit', $property->id),
            ]);
            DB::commit();



            // SlugHelper::createSlug($property);

            Session::flash('success_msg', 'Successfully Updated');

            return response()->json([
                'status' => 'success',
                'message' => 'Successfully Updated',
                'redirect' => 'back'
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


    public function multiDestroy(Request $request)
    {
        if ($request->has('delete_property') && $request->filled('delete_property') && is_array($request->delete_property)) {
            foreach ($request->delete_property ?? [] as $delId) {
                DB::beginTransaction();
                try {
                    $property = Property::where('id', $delId)->first() ?? abort(404);
                    $this->adDeleted($property);
                    $property->delete();
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                    // Return error response if something goes wrong
                    Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
                    return redirect()->back();
                }
            }
            Session::flash('success_msg', 'Successfully Deleted');
            return redirect()->back();
        }
    }

    public function destroy(Request $request, string $id)
    {
        if (!permission_check('Property Delete')) {
            return abort(404);
        }

        if (auth('web')->user()->acc_type == 'superadmin') {
            $property = Property::withTrashed()
                ->with('author')
                ->whereId($id)
                ->first() ?? abort(404);
            DB::beginTransaction();
            try {
                foreach ($property->images  ?? [] as $imageLoc) {
                    $imagePath = public_path('images/' . $imageLoc);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                FacilityDistance::where('reference_id', $property->id)->delete();
                RuleDetails::where('reference_id', $property->id)->delete();
                DB::table('re_custom_field_values')->where('reference_type', 'App\Models\Property')->where('reference_id', $property->id)->delete();
                DB::table('re_property_categories')->where('property_id', $id)->delete();
                DB::table('re_property_furnishing')->where('property_id', $id)->delete();
                $this->adDeleted($property);

                $property->forceDelete();

                // $property->delete();

                DB::commit();
                Session::flash('success_msg', 'Successfully Deleted');
                if ($request->has('from') && $request->from == 'trash') {
                    return redirect()->route('admin.trash.index');
                }
                return redirect()->back();
            } catch (Exception $e) {
                DB::rollBack();
                // Return error response if something goes wrong
                Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
                return redirect()->back();
            }
        } else {
            DB::beginTransaction();
            try {
                $property = Property::where('id', $id)->first() ?? abort(404);
                $this->adDeleted($property);
                $property->delete();
                DB::commit();
                Session::flash('success_msg', 'Successfully Deleted');
                return redirect()->back();
            } catch (Exception $e) {
                DB::rollBack();
                // Return error response if something goes wrong
                Session::flash('failed_msg', 'Failed..!' . $e->getMessage());
                return redirect()->back();
            }
        }
    }
}
