<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Property;
use App\Models\Project;
use App\Models\Blogs\Post;
use App\Models\Investor;
use App\Models\Slug;
use App\Models\Page;
use App\Models\Configration;
use App\Models\Advertisement;
use App\Models\BlogPost;
use App\Models\Consult;
use App\Models\Contact;
use App\Models\PgRules;
use Illuminate\Support\Str;

use Illuminate\Routing\Controller;

class FrontendController extends Controller
{
    use \App\Emails;
    private $agent;

    public function __construct()
    {
        $this->agent = new \Jenssegers\Agent\Agent;
    }

    public function index()
    {
        $categories                 = Category::where('status', 'published')->get();
        $featured_properties        = Property::where('moderation_status', 'approved')->where('type', 'sell')->orderBy('created_at', 'desc')->limit(9)->get();
        $featured_properties_rent   = Property::where('moderation_status', 'approved')->where('type', 'rent')->orderBy('created_at', 'desc')->limit(9)->get();

        $featured_project           = Project::orderBy('created_at', 'desc')->limit(9)->get();
        $recent_viwed_properties    = $this->recentlyViewedProperties();
        $latest_blogs               = BlogPost::orderBy('created_at', 'desc')->limit(3)->get();

        $result = $this->agent->isMobile();
        if ($result) {
            return view('front.mobile.home', compact('categories', 'featured_properties_rent', 'featured_properties', 'featured_project', 'recent_viwed_properties', 'latest_blogs'));
        } else {
            return view('front.index', compact('categories', 'featured_properties_rent', 'featured_properties', 'featured_project', 'recent_viwed_properties', 'latest_blogs'));
        }
    }


    public function searchByTitle(Request $request, $properties, $type = '', $purpose = "Residential")
    {
        // Initialize the search title with the number of results and default category
        $searchByTitle = $properties->count() . " results | ";
        // Append keywords to the title if present in the request
        if ($request->filled('s') && is_array($request->s) && count($request->s) > 0) {
            $keywords = implode(', ', $request->s);
            $searchByTitle .=  $keywords . ', ';
        }

        // if ($request->has('type') && $request->type != '') {
        $searchByTitle .= $purpose . " Properties for " . ucfirst($type);
        // }

        // Append city to the title if present in the request
        if ($request->has('city') && $request->city != '') {
            $cityName  =  $request->city  == 'null' ? 'all' :  $request->city;
            $searchByTitle .= " in " . $cityName . ', Bangalore';
        } else {
            $searchByTitle .= " in Bangalore";
        }



        return $searchByTitle; // Return the generated search title
    }

    public function properties(Request $request)
    {
        $type = $request->type ?? '';
        $query = Property::query()->where('moderation_status', 'approved');

        if ($request->filled('type') && $request->type == 'commercial') {
            $mode  = $request->type;
            $query->where('mode',  $mode);
        } else if ($request->filled('type') && $request->type == 'plot') {
            $plot  = 'Plot and Land';
            $query->whereHas('categories', function ($query) use ($plot) {
                $query->where('name', $plot);
            });
        } else if ($request->filled('type') && $request->type != '' && $request->type != 'null') {
            $query->where('type',  $request->type);
        } else {
        }

        $property_query = $this->ShortcutFilterProperties($query, $request);

        $propertySearchKeywords = $this->propertySearchKeywords($request, $type);

        if (isset($propertySearchKeywords['properties'])) {
            $keywordProperties = $propertySearchKeywords['properties'];
        } else {
            $keywordProperties = collect();
        }

        if (isset($propertySearchKeywords['similarProperties'])) {
            $similarProperties = $propertySearchKeywords['similarProperties'];
        } else {
            $similarProperties = collect();
        }



        $properties = $property_query->get();

        $similarProperties = $this->similarPropertiesFilter($properties, $type);

        $properties = $properties->merge($keywordProperties);

        if ($request->ajax()) {

            if ($request->has('tab') && $request->tab == 'sale') {
                $property_query = $property_query->where('type', 'sell');
            } else if ($request->has('tab') && $request->tab == 'sale') {
                $property_query = $property_query->where('type', 'rent');
            }

            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

        $builders = Investor::get();
        $cities = Property::groupBy('locality')->orderBy('locality', 'asc')->pluck('locality');
        $categories = Category::where('status', 'published')->get();

        $readyToMoveProjects = Project::where('construction_status', 'ready_to_move')->orWhere('construction_status', 'new_launch')->get();


        $pageTitle = 'Residential Properties for Sale, Rent, and Lease in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = 'Explore a wide range of residential properties including houses, apartments, flats, and more for sale, rent, or lease in Bangalore and Karnataka. Find your dream home today!';
        $pageKeywords = 'residential properties for sale, residential properties for rent, apartments for rent in Bangalore, houses for sale in Karnataka, flats for sale in Bangalore, affordable homes in Karnataka, residential real estate in Bangalore, buy house in Karnataka, rental homes Bangalore, lease properties Karnataka';

        $projects    = Project::pluck('name');

        $searchByTitle = $this->searchByTitle($request, $properties, '', "Residential");

        $result = $this->agent->isMobile();
        if ($result) {
            return view('front.mobile.property-index', compact('type', 'properties', 'categories', 'cities', 'builders', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'projects', 'similarProperties', 'readyToMoveProjects'));
        } else {
            return view('front.properties.index', compact('type', 'properties', 'categories', 'cities', 'builders', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'projects', 'similarProperties', 'readyToMoveProjects'));
        }
    }


    public function PropertiesForSale(Request $request)
    {
        $query = Property::query()->where('type', 'sell')->where('moderation_status', 'approved');

        $property_query = $this->ShortcutFilterProperties($query, $request);

        $builders = Investor::get();
        $cities = Property::where('type', 'sell')
            ->where('moderation_status', 'approved')
            ->distinct('locality')
            ->orderBy('locality', 'asc')
            ->pluck('locality');

        $categories = Category::where('status', 'published')->where('has_sell', 1)->get();


        $type = 'sell';
        $projects    = Project::WhereHas('properties', function ($subQuery) use ($type) {
            $subQuery->where('type', $type)
                ->where('moderation_status', 'approved');
        })->pluck('name');

        $propertySearchKeywords = $this->propertySearchKeywords($request, $type);

        if (isset($propertySearchKeywords['properties'])) {
            $keywordProperties = $propertySearchKeywords['properties'];
        } else {
            $keywordProperties = collect();
        }

        if (isset($propertySearchKeywords['similarProperties'])) {
            $similarProperties = $propertySearchKeywords['similarProperties'];
        } else {
            $similarProperties = collect();
        }

        $properties = $property_query->get();

        $similarPropertiesFilter = $this->similarPropertiesFilter($properties, $type);

        $similarProperties = $similarPropertiesFilter->merge($similarProperties);

        $properties = $properties->merge($keywordProperties);

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

        $readyToMoveProjects = Project::where('construction_status', 'ready_to_move')->orWhere('construction_status', 'new_launch')->get();

        $searchByTitle = $this->searchByTitle($request, $properties, 'Sale', "Residential");

        $pageTitle = 'Properties for Sale in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = 'Browse a wide selection of properties for sale in Bangalore and Karnataka. Find houses, apartments, plots, and more to buy at competitive prices.';
        $pageKeywords = 'properties for sale, houses for sale in Bangalore, apartments for sale in Karnataka, buy homes in Bangalore, residential plots for sale in Karnataka, real estate for sale, commercial properties for sale, affordable homes for sale, property listings in Bangalore';
        $result = $this->agent->isMobile();
        if ($result) {
            return view('front.mobile.property-index', compact('properties', 'categories', 'cities', 'builders', 'type', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'projects', 'similarProperties', 'readyToMoveProjects'));
        } else {
            return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'projects', 'similarProperties', 'readyToMoveProjects'));
        }
    }
    public function PropertiesForRent(Request $request)
    {
        $query = Property::query()->where('type', 'rent')->where('status', 'renting')->where('moderation_status', 'approved');
        $property_query = $this->ShortcutFilterProperties($query, $request);
        $builders = Investor::get();
        $cities = Property::where('type', 'rent')
            ->where('moderation_status', 'approved')
            ->distinct('locality')
            ->orderBy('locality', 'asc')
            ->pluck('locality');

        $categories = Category::where('status', 'published')->where('has_rent', 1)->get();

        $type = 'rent';
        $projects    = Project::WhereHas('properties', function ($subQuery) use ($type) {
            $subQuery->where('type', $type)
                ->where('moderation_status', 'approved');
        })->pluck('name');

        $propertySearchKeywords = $this->propertySearchKeywords($request, $type);
        if (isset($propertySearchKeywords['properties'])) {
            $keywordProperties = $propertySearchKeywords['properties'];
        } else {
            $keywordProperties = collect();
        }

        if (isset($propertySearchKeywords['similarProperties'])) {
            $similarProperties = $propertySearchKeywords['similarProperties'];
        } else {
            $similarProperties = collect();
        }

        $properties = $property_query->get();

        $similarPropertiesFilter = $this->similarPropertiesFilter($properties, $type);

        $similarProperties = $similarPropertiesFilter->merge($similarProperties);

        $properties = $properties->merge($keywordProperties);

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

        $readyToMoveProjects = Project::where('construction_status', 'ready_to_move')->orWhere('construction_status', 'new_launch')->get();


        $searchByTitle = $this->searchByTitle($request, $properties, 'Rent', "Residential");


        $pageTitle = 'Properties for Rent in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = 'Explore a variety of properties for rent in Bangalore and Karnataka. Find apartments, houses, PG accommodations, and more at competitive rental prices.';
        $pageKeywords = 'properties for rent, apartments for rent in Bangalore, houses for rent in Karnataka, rental properties in Bangalore, PG accommodation in Karnataka, rental flats in Bangalore, commercial spaces for rent, affordable houses for rent in Karnataka, paying guest accommodation, real estate rentals';
        $result = $this->agent->isMobile();
        if ($result) {
            return view('front.mobile.property-index', compact('properties', 'categories', 'cities', 'builders', 'type', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'projects', 'similarProperties', 'readyToMoveProjects'));
        } else {
            return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'projects', 'similarProperties', 'readyToMoveProjects'));
        }
    }
    public function PropertiesForPlot(Request $request)
    {

        $category   = 'Plot and Land';
        $query      = Property::query()
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            })
            ->where('moderation_status', 'approved');

        $property_query = $this->ShortcutFilterProperties($query, $request);
        $builders   = Investor::get();
        $cities     = Property::query()
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            })
            ->where('moderation_status', 'approved')
            ->groupBy('locality')->pluck('locality');

        $categories = Category::where('status', 'published')->get();
        $type       = 'plot';
        $propertySearchKeywords = $this->propertySearchKeywords($request, $type);
        if (isset($propertySearchKeywords['properties'])) {
            $keywordProperties = $propertySearchKeywords['properties'];
        } else {
            $keywordProperties = collect();
        }

        if (isset($propertySearchKeywords['similarProperties'])) {
            $similarProperties = $propertySearchKeywords['similarProperties'];
        } else {
            $similarProperties = collect();
        }


        $projects    = Project::WhereHas('properties', function ($subQuery) use ($type) {
            $subQuery
                ->where('moderation_status', 'approved')
                ->whereHas('categories', function ($query) {
                    $query->where('name', 'Plot and Land');
                });
        })->pluck('name');



        $properties = $property_query->get();
        $similarPropertiesFilter = $this->similarPropertiesFilter($properties, $type);

        $similarProperties = $similarPropertiesFilter->merge($similarProperties);

        $properties = $properties->merge($keywordProperties);

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }


        $readyToMoveProjects = Project::where('construction_status', 'ready_to_move')->orWhere('construction_status', 'new_launch')->get();

        $searchByTitle = $this->searchByTitle($request, $properties, 'Plot and Lands', "Residential");


        $pageTitle = 'Plots for Sale in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = "Browse a variety of residential and commercial plots for sale in Bangalore and Karnataka. Find your ideal plot for construction, investment, or development.";
        $pageKeywords = "plots for sale, residential plots in Bangalore, commercial plots in Karnataka, land for sale in Bangalore, investment land in Karnataka, real estate plots, agricultural plots in Karnataka, plot for construction, buy plots in Bangalore, land investment opportunities";

        $result = $this->agent->isMobile();
        if ($result) {
            return view('front.mobile.property-index', compact('properties', 'categories', 'cities', 'builders', 'type', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'projects', 'similarProperties', 'readyToMoveProjects'));
        } else {
            return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'projects', 'similarProperties', 'readyToMoveProjects'));
        }
    }
    public function PropertiesForPg(Request $request)
    {
        $type = 'pg';
        $query = Property::query()->where('type', 'pg')->where('status', 'renting')->where('moderation_status', 'approved');
        $property_query = $this->ShortcutFilterProperties($query, $request);
        $builders = Investor::get();
        $cities = Property::where('type', 'pg')
            ->where('moderation_status', 'approved')
            ->distinct('locality')
            ->orderBy('locality', 'asc')
            ->pluck('locality');

        $categories = Category::WhereHas('properties', function ($subQuery) use ($type) {
            $subQuery->where('type', $type)->where('moderation_status', 'approved');
        })->where('status', 'published')->get();


        $propertySearchKeywords = $this->propertySearchKeywords($request, $type);
        if (isset($propertySearchKeywords['properties'])) {
            $keywordProperties = $propertySearchKeywords['properties'];
        } else {
            $keywordProperties = collect();
        }

        if (isset($propertySearchKeywords['similarProperties'])) {
            $similarProperties = $propertySearchKeywords['similarProperties'];
        } else {
            $similarProperties = collect();
        }


        $projects    = Project::WhereHas('properties', function ($subQuery) use ($type) {
            $subQuery->where('type', $type)
                ->where('moderation_status', 'approved');
        })->pluck('name');


        if ($request->filled('occupancy') && $request->occupancy !== '' && $request->occupancy != 'null') {
            if (is_array($request->occupancy)) {
                $occupancy = $request->occupancy;
            } else {
                $occupancy = explode(',', $request->occupancy);
            }


            if (!empty(array_intersect($occupancy, ['single', 'double', 'capsule']))) {
                $query->whereIn('occupancy_type', $occupancy);
            } else {
                $query->where('occupancy_type', '!=', 'single')->where('occupancy_type', '!=', 'double');
            }
        }

        if ($request->filled('availability') && $request->availability !== '' && $request->availability != 'null') {
            if (is_array($request->availability)) {
                $availability = $request->availability;
            } else {
                $availability = explode(',', $request->availability);
            }

            $query->whereIn('available_for', $availability);
        }




        $properties = $property_query->get();

        $similarPropertiesFilter = $this->similarPropertiesFilter($properties, $type);

        $similarProperties = $similarPropertiesFilter->merge($similarProperties);

        $properties = $properties->merge($keywordProperties);

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }


        $readyToMoveProjects = Project::where('construction_status', 'ready_to_move')->orWhere('construction_status', 'new_launch')->get();

        $searchByTitle = $this->searchByTitle($request, $properties, 'PG', "Residential");


        $pageTitle = 'PG Accommodation for Rent in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = 'Explore a variety of Paying Guest (PG) accommodations for rent in Bangalore and Karnataka. Find affordable PGs, private rooms, and shared spaces that suit your needs.';
        $pageKeywords = 'PG accommodation in Bangalore, paying guests in Karnataka, PG for rent in Bangalore, affordable PGs in Bangalore, PG rooms for rent in Karnataka, private rooms for rent in Bangalore, shared PG accommodation, budget PGs in Bangalore, PG spaces near IT hubs, PGs for students in Bangalore, PG rental properties in Karnataka, PG facilities in Bangalore';
        $result = $this->agent->isMobile();
        if ($result) {
            return view('front.mobile.property-index', compact('properties', 'categories', 'cities', 'builders', 'type', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'projects', 'similarProperties', 'readyToMoveProjects'));
        } else {
            return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'projects', 'similarProperties', 'readyToMoveProjects'));
        }
    }


    public function PropertiesForCommercial(Request $request)
    {

        $query          = Property::query()->where('mode', 'commercial')
            ->where('moderation_status', 'approved');
        $property_query = $this->ShortcutFilterProperties($query, $request);
        $builders       = Investor::get();
        $cities         = Property::where('mode', 'commercial')
            ->where('moderation_status', 'approved')
            ->groupBy('locality')
            ->pluck('locality');

        $type           = 'commercial';

        $categories     = Category::where('status', 'published')->where('has_commercial', 1)->get();

        $projects    = Project::WhereHas('properties', function ($subQuery) use ($type) {
            $subQuery->where('mode', 'commercial')
                ->where('moderation_status', 'approved');
        })->pluck('name');


        $propertySearchKeywords = $this->propertySearchKeywords($request, $type);
        if (isset($propertySearchKeywords['properties'])) {
            $keywordProperties = $propertySearchKeywords['properties'];
        } else {
            $keywordProperties = collect();
        }

        if (isset($propertySearchKeywords['similarProperties'])) {
            $similarProperties = $propertySearchKeywords['similarProperties'];
        } else {
            $similarProperties = collect();
        }


        if (($request->has('tab') && $request->tab == 'sale') || $request->has('type') && $request->type == 'commercial-sale') {
            $property_query = $property_query->where('type', 'sell');
        } else if (($request->has('tab') && $request->tab == 'rent') || $request->has('type') && $request->type == 'commercial-rent') {
            $property_query = $property_query->where('type', 'rent');
        }

        $properties = $property_query->get();

        $similarPropertiesFilter = $this->similarPropertiesFilter($properties, $type);

        $similarProperties = $similarPropertiesFilter->merge($similarProperties);

        $properties = $properties->merge($keywordProperties);

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

        $readyToMoveProjects = Project::whereIn('construction_status', [
            'ready_to_move',
            'new_launch',
            'under_construction',
        ])->get();



        $searchByTitle = $this->searchByTitle($request, $properties, '', "Commercial");


        $pageTitle = 'Commercial Properties for Sale & Rent in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = 'Discover a wide range of commercial properties for sale and rent in Bangalore and Karnataka. From office spaces to retail shops, find the perfect location for your business.';
        $pageKeywords = 'commercial properties for sale in Bangalore, commercial properties for rent in Karnataka, office spaces for rent in Bangalore, retail shops for sale in Karnataka, commercial real estate in Bangalore, business spaces for lease in Bangalore, commercial property investment in Karnataka, commercial land for sale in Bangalore, office buildings for rent in Karnataka, shops for rent in Bangalore, commercial plots for sale, industrial properties for rent, commercial space for lease';

        $result = $this->agent->isMobile();
        if ($result) {
            return view('front.mobile.property-index', compact('properties', 'categories', 'cities', 'builders', 'type', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'projects', 'similarProperties', 'readyToMoveProjects'));
        } else {
            return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'projects', 'similarProperties', 'readyToMoveProjects'));
        }
    }



    public function searchByProjectTitle(Request $request, $properties, $type = '', $purpose = "Residential")
    {
        // Initialize the search title with the number of results and default category
        $searchByTitle = $properties->count() . " results | ";
        // Append keywords to the title if present in the request
        if ($request->filled('s') && is_array($request->s) && count($request->s) > 0) {
            $keywords = implode(', ', $request->s);
            $searchByTitle .=  $keywords . ', ';
        }
        // if ($request->has('type') && $request->type != '') {
        $searchByTitle .= ucfirst($type) . " Projects";
        // }

        // Append city to the title if present in the request
        if ($request->has('city') && $request->city != '') {
            $cityName  =  $request->city  == 'null' ? 'all' :  $request->city;
            $searchByTitle .= " in " . $cityName . ', Bangalore';
        } else {
            $searchByTitle .= " in Bangalore";
        }



        return $searchByTitle; // Return the generated search title
    }


    public function projects(Request $request)
    {
        $query = Project::query();

        // Filters for projects...
        $project_query = $this->ShortcutFilterProjects($query, $request);

        /////////////////////////////////
        $projectSearchKeywords = $this->projectSearchKeywords($request, $request->type);

        if (isset($projectSearchKeywords['properties'])) {
            $keywordProjects = $projectSearchKeywords['properties'];
        } else {
            $keywordProjects = collect();
        }

        if (isset($projectSearchKeywords['similarProjects'])) {
            $similarProjects = $projectSearchKeywords['similarProjects'];
        } else {
            $similarProjects = collect();
        }

        //////////////////////////////////
        $projects = $project_query->get();


        $similarProjectsFilter = $this->similarProjectFilter($projects, $request->type);

        $similarProjects = $similarProjectsFilter->merge($similarProjects);



        //  similarProjects

        $projects = $projects->merge($keywordProjects);

        if ($request->ajax()) {
            $html = view('front.shortcuts.projects.items', compact('projects'))->render();
            return response()->json(['html' => $html]);
        }

        $cities = Project::whereNotnull('locality')->orderBy('locality', 'asc')->distinct('locality')->pluck('locality');

        $categories = Category::where('status', 'published')->get();
        $builders =  Investor::WhereHas('projects')->get();

        $searchByTitle = $this->searchByProjectTitle($request, $projects, '', "");

        $pageTitle = 'All Real Estate Projects: New Launch, Ready to Launch & Under Construction in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = 'Explore a variety of real estate projects including new launches, ready-to-launch, and under-construction properties in Bangalore and Karnataka. Find your dream home or investment opportunity today.';
        $pageKeywords = 'new launch real estate projects in Bangalore, ready to launch projects in Karnataka, under construction properties in Bangalore, residential projects in Karnataka, commercial projects Bangalore, real estate investment Bangalore, new homes Bangalore, property projects in Karnataka, builder projects Bangalore, new construction properties, affordable housing projects Karnataka, residential development Bangalore, upcoming projects Bangalore, ongoing construction in Karnataka';
        $result = $this->agent->isMobile();
        if ($result) {
            return view('front.mobile.project-index', compact('projects', 'categories', 'cities', 'builders', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'similarProjects'));
        } else {
            return view('front.projects.index', compact('projects', 'categories', 'cities', 'builders', 'pageTitle', 'pageDescription', 'pageKeywords', 'searchByTitle', 'similarProjects'));
        }
    }

    public function propertyDetails($uid, $slug)
    {
        $property = Property::where('slug', $slug)->where('moderation_status', 'approved')->where('unique_id', $uid)->first() ?? abort(404);
        $recent_properties = $this->recentlyViewedProperties();
        $rules = PgRules::get();
        $property->increment('views');
        $categories                 = Category::where('status', 'published')->get();

        $pageTitle = $property->name . ' | New Door Ventures';
        $pageDescription = $property->content;
        $pageKeywords = 'property for sale, property for rent, PG accommodation, residential plots, commercial properties, rental properties in Bangalore, sale properties in Karnataka, residential properties for sale, commercial spaces for lease, PGs in Bangalore, land for sale in Karnataka, affordable properties in Bangalore, buy rent or lease property in Karnataka, real estate Bangalore, residential real estate Bangalore, commercial real estate Karnataka';

        $locality = $property->locality;
        $type = $property->type;
        $bhk = $property->number_bedroom;
        $price = $property->price;

        // Calculate the price range
        $minPrice = $price - ($price * 0.40); // 40% less
        $maxPrice = $price + ($price * 0.30); // 30% more

        $similarProperties = Property::where(function ($query) use ($locality, $bhk) {
            $query->where('locality', $locality)
                ->orWhere('number_bedroom', '<=', $bhk);
        })
            ->whereBetween('price', [$minPrice, $maxPrice]) // Filter by price range
            ->where('type', $type)
            ->where('moderation_status', 'approved')
            ->where('id', '!=', $property->id) // Exclude the current property
            ->get();





        $result = $this->agent->isMobile();


        if ($property->mode == 'Commercial') {
            if ($property->category && $property->category->name == 'Plot and Land') {
                if ($result) {
                    return view('front.mobile.plot-property', compact('categories', 'property', 'recent_properties', 'pageTitle', 'pageDescription', 'pageKeywords', 'similarProperties'));
                } else {
                    return view('front.properties.plot-property', compact('categories', 'property', 'recent_properties', 'pageTitle', 'pageDescription', 'pageKeywords', 'similarProperties'));
                }
            }

            if ($result) {
                return match ($property->type) {
                    'sell', 'rent' => view('front.mobile.commercial-rent-sale-single', compact('categories', 'property', 'recent_properties', 'pageTitle', 'pageDescription', 'pageKeywords', 'similarProperties')),
                    default => abort(404),
                };
            } else {
                return match ($property->type) {
                    'sell', 'rent' => view('front.properties.commercial-rent-sale-single', compact('categories', 'property', 'recent_properties', 'pageTitle', 'pageDescription', 'pageKeywords', 'similarProperties')),
                    default => abort(404),
                };
            }
        }

        if ($property->category && $property->category->name == 'Plot and Land') {
            if ($result) {
                return view('front.mobile.plot-property', compact('categories', 'property', 'recent_properties', 'pageTitle', 'pageDescription', 'pageKeywords', 'similarProperties'));
            } else {
                return view('front.properties.plot-property', compact('categories', 'property', 'recent_properties', 'pageTitle', 'pageDescription', 'pageKeywords', 'similarProperties'));
            }
        }

        if ($result) {
            return match ($property->type) {

                'sell', 'rent' => view('front.mobile.sale-rent-single', compact('categories', 'property', 'recent_properties', 'pageTitle', 'pageDescription', 'pageKeywords', 'pageTitle', 'pageDescription', 'pageKeywords', 'similarProperties')),
                'pg' => view('front.mobile.pg-single', compact('categories', 'property', 'recent_properties', 'rules', 'pageTitle', 'pageDescription', 'pageKeywords', 'pageTitle', 'pageDescription', 'pageKeywords', 'similarProperties')),
                default => abort(404),
            };
        } else {
            return match ($property->type) {
                'sell', 'rent' => view('front.properties.single', compact('categories', 'property', 'recent_properties', 'pageTitle', 'pageDescription', 'pageKeywords', 'pageTitle', 'pageDescription', 'pageKeywords', 'similarProperties')),
                'pg' => view('front.properties.pg-single', compact('categories', 'property', 'recent_properties', 'rules', 'pageTitle', 'pageDescription', 'pageKeywords', 'pageTitle', 'pageDescription', 'pageKeywords', 'similarProperties')),
                default => abort(404),
            };
        }
    }

    public function projectDetails($uid, $slug)
    {
        $project = Project::where('slug', $slug)->where('unique_id', $uid)->first() ?? abort(404);
        $project->increment('views');
        $configurations = Configration::get();
        $advertisement = Advertisement::inRandomOrder()->first();
        $pageTitle = $project->name . ' | New Door Ventures';
        $pageDescription = $project->content;
        $pageKeywords = 'new launch projects, under construction projects, ready to launch properties, real estate projects in Bangalore, residential projects, commercial projects in Karnataka, real estate builders in Bangalore, upcoming property launches, real estate development, investment in property, new construction projects in Karnataka, real estate investment opportunities, residential apartments, commercial spaces for sale in Bangalore';
        $categories                 = Category::where('status', 'published')->get();

        $result = $this->agent->isMobile();
        if ($result) {
            return view('front.mobile.project-single', compact('categories', 'project', 'configurations', 'advertisement', 'pageTitle', 'pageDescription', 'pageKeywords'));
        } else {
            return view('front.projects.single', compact('categories', 'project', 'configurations', 'advertisement', 'pageTitle', 'pageDescription', 'pageKeywords'));
        }
    }

    public function contact()
    {
        $pageTitle = 'Contact Us | New Door Ventures';
        $pageDescription = 'Get in touch with New Door Ventures for any inquiries or support regarding real estate properties in Bangalore and Karnataka. We are here to assist you with your real estate needs.';
        $pageKeywords = 'contact New Door Ventures, real estate inquiries, property consultation, real estate support Bangalore, get in touch with real estate experts, property queries Karnataka, real estate advice, property help Bangalore, contact us for real estate, customer support real estate, contact real estate company';
        return view('front.contact', compact('pageTitle', 'pageDescription', 'pageKeywords'));
    }

    public function blogList()
    {
        $blogs = BlogPost::get();
        $pageTitle = 'Latest Real Estate News & Blogs | New Door Ventures';
        $pageDescription = 'Stay updated with the latest trends, tips, and insights on real estate in Bangalore and Karnataka. Read our blogs for expert advice on property buying, renting, and leasing.';
        $pageKeywords = 'real estate blogs, property news, real estate tips, Bangalore real estate, Karnataka property updates, real estate trends, property buying advice, property rental tips, leasing properties, real estate experts Bangalore, real estate news Karnataka, new property developments, property market insights, real estate investment tips, property for sale Bangalore, property rental Karnataka';

        return view('front.news.index', compact('blogs', 'pageTitle', 'pageDescription', 'pageKeywords'));
    }

    public function blogDetails($slug)
    {
        $blog = BlogPost::where('slug', $slug)->firstOrFail();
        $blogs = BlogPost::where('slug', '!=', $slug)->get();
        $blog->increment('views');
        $pageTitle = $blog->title . ' | New Door Ventures Blog';
        $pageDescription = Str::limit($blog->content, 160);
        $pageKeywords = 'real estate blog, property buying tips, property rental advice, ';

        return view('front.news.single', compact('blog', 'blogs', 'pageTitle', 'pageDescription', 'pageKeywords'));
    }

    public function page($slug)
    {
        $page_id = Slug::where('key', $slug)->pluck('reference_id')->first() ?? abort(404);
        $page = Page::findOrFail($page_id);

        $pageTitle = $page->name . ' | New Door Ventures Blog';
        $pageDescription = Str::limit($page->content, 160);
        $pageKeywords = '';


        return view('front.page', compact('page', 'pageTitle', 'pageDescription', 'pageKeywords'));
    }

    private function recentlyViewedProperties()
    {
        $cookieName = 'recently_viewed_properties';
        $jsonRecentlyViewedProperties = $_COOKIE[$cookieName] ?? null;

        if (!$jsonRecentlyViewedProperties) {
            return collect();
        }

        $propertyIds = collect(json_decode($jsonRecentlyViewedProperties))->pluck('id');

        return Property::whereIn('id', $propertyIds)->get() ?? collect();
    }



    public function searchingInKeywords(Request $request)
    {

        if ($request->type == 'projects' || $request->type  == 'new-launch') {
            $items = $this->searchProjects($request);
        } else {
            // Fetch filtered properties
            $items = $this->searchProperties($request);
        }


        return  $items;
        // Render the view with the items
        // return view('front.shortcuts.search-suggestion', compact('items'))->render();
    }



    public function searchProperties(Request $request)
    {
        if ($request->filled('k') && $request->k != '') {
            $keyword = $request->k;


            if ($request->filled('type') && $request->type != '' && $request->type == 'buy') {
                $type = 'sell';
            } else if ($request->filled('type') && $request->type != '' && $request->type == 'rent') {
                $type = 'rent';
            } else if ($request->filled('type') && $request->type != '' && $request->type == 'pg') {
                $type = 'pg';
            } else if ($request->filled('type') && $request->type != '' && $request->type == 'plot') {
                $type = 'plot';
            } else if ($request->filled('type') && $request->type != '' && $request->type == 'commercial') {
                $type = 'commercial';
            } else {
                $type = 'sell';
            }

            if ($type == 'plot') {
                // Query 1: Search in 'city'
                $cities = Property::query()
                    ->where('moderation_status', 'approved')
                    ->where('city', 'LIKE', "%{$keyword}%")
                    ->where('city', '!=', '')
                    ->whereHas('categories', function ($query) {
                        $query->where('name', 'Plot and Land');
                    })
                    ->distinct()
                    ->pluck('city') // Pluck distinct city names
                    ->map(function ($city) {
                        return [
                            'value' => $city, // Actual city name
                            'display' => "{$city}" // Formatted as city, city
                        ];
                    })
                    ->toArray();

                // Query 2: Search in 'locality'
                $localities = Property::query()
                    ->where('moderation_status', 'approved')
                    ->where('locality', 'LIKE', "%{$keyword}%")
                    ->where('locality', '!=', '')
                    ->whereHas('categories', function ($query) {
                        $query->where('name', 'Plot and Land');
                    })
                    ->distinct()
                    ->select(['locality', 'city']) // Include both locality and city
                    ->get()
                    ->map(function ($locality) {
                        return [
                            'value' => $locality->locality, // Actual locality name
                            'display' => "{$locality->locality}, {$locality->city}" // Formatted as locality, city
                        ];
                    })
                    ->toArray();

                // Query 3: Search in associated 'project name'
                $projects = Project::query()
                    ->where(function ($query) use ($keyword) {
                        $query->orWhere('name', 'LIKE', "%{$keyword}%")
                            ->orWhere('city', 'LIKE', "%{$keyword}%")
                            ->orWhere('locality', 'LIKE', "%{$keyword}%");
                    })
                    // ->orWhere('name', 'LIKE', "%{$keyword}%")
                    // ->orWhere('city', 'LIKE', "%{$keyword}%")
                    // ->orWhere('locality', 'LIKE', "%{$keyword}%")
                    ->WhereHas('properties', function ($subQuery) use ($type) {
                        $subQuery
                            ->where('moderation_status', 'approved')
                            ->whereHas('categories', function ($query) {
                                $query->where('name', 'Plot and Land');
                            });
                    })
                    // ->whereHas('categories', function ($query) {
                    //     $query->where('name', 'Plot and Land');
                    // })
                    ->where('name', 'LIKE', "%{$keyword}%")
                    ->distinct()
                    ->select(['name', 'locality', 'city']) // Include name, locality, and city
                    ->get()
                    ->map(function ($project) {
                        return [
                            'value' => $project->name, // Actual project name
                            'display' => "{$project->name}, {$project->locality}, {$project->city}" // Formatted as name, locality, city
                        ];
                    })
                    ->toArray();
            } else {
                // Query 1: Search in 'city'
                $cities = Property::query()
                    ->where('moderation_status', 'approved')
                    ->where('city', 'LIKE', "%{$keyword}%")
                    ->where('city', '!=', '')
                    ->where('type', $type)
                    ->distinct()
                    ->pluck('city') // Pluck the distinct city names
                    ->map(function ($city) {
                        return [
                            'value' => $city, // Actual city name for value
                            'display' => "{$city}" // Formatted as city, city for display
                        ];
                    })
                    ->toArray();

                // Query 2: Search in 'locality'
                // $localities = Property::query()
                //     ->where('moderation_status', 'approved')
                //     ->where('locality', 'LIKE', "%{$keyword}%")
                //     ->where('locality', '!=', '')
                //     ->where('type', $type)
                //     ->distinct()
                //     ->pluck('locality')->toArray();
                $localities = Property::query()
                    ->where('moderation_status', 'approved')
                    ->where('locality', 'LIKE', "%{$keyword}%")
                    ->where('locality', '!=', '')
                    ->where('type', $type)
                    ->distinct()
                    ->select(['locality', 'city'])
                    ->get()
                    ->map(function ($locality) {
                        return [
                            'value' => $locality->locality,
                            'display' => "{$locality->locality},{$locality->city}"
                        ];
                    })
                    ->toArray();

                if ($type != 'pg') {
                    // Query 3: Search in associated 'project name'
                    $projects = Project::query()
                        ->where(function ($query) use ($keyword) {
                            $query->orWhere('name', 'LIKE', "%{$keyword}%")
                                ->orWhere('city', 'LIKE', "%{$keyword}%")
                                ->orWhere('locality', 'LIKE', "%{$keyword}%");
                        })
                        // ->whereHas('properties', function ($subQuery) use ($type) {
                        //     $subQuery->where('type', $type);
                        // })
                        ->distinct()
                        ->select(['name', 'locality', 'city'])
                        ->get()
                        ->map(function ($project) {
                            return [
                                'value' => $project->name, // Project name as the value
                                'display' => "{$project->name}, {$project->locality}, {$project->city}" // Display formatted as project_name, locality, city
                            ];
                        })
                        ->toArray();
                } else if ($type == 'pg') {
                    $projects = collect();
                }
            }

            $results = [];

            if (count($cities) > 0) {
                $results['cities'] = $cities;
            }

            if (count($localities) > 0) {
                $results['localities'] = $localities;
            }

            if (count($projects) > 0) {
                $results['projects'] = $projects;
            }
            // Return the results as a JSON response
            return response()->json($results);
        }

        return response()->json([]);
    }

    public function propertySearchKeywords(Request $request, $type = null)
    {
        if ($request->has('s') && $request->filled('s')) {
            $keywords = is_array($request->s) ? $request->s : [$request->s];
            // Fetch City-based Properties
            $cityProperties = Property::query()
                ->where('moderation_status', 'approved')
                ->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->orWhere('city', 'LIKE', "%{$keyword}%");
                    }
                });

            if ($type != null  && in_array($type, ['sell', 'rent', 'pg'])) {
                $cityProperties->where('type', $type);
            } else if ($type === 'commercial') {
                $cityProperties->where('mode', 'commercial');
            }
            $cityProperties = $cityProperties->distinct()->get();

            // Fetch Project-based Properties
            $projectIds = Project::query()
                ->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->orWhere('name', "$keyword");
                    }
                })
                ->pluck('id');
            // Fetch Locality-based Properties
            $localityProperties = Property::query()
                ->where('moderation_status', 'approved')
                ->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->orWhere('locality', 'LIKE', "%{$keyword}%");
                    }
                });

            if ($type != null  && in_array($type, ['sell', 'rent', 'pg'])) {
                $localityProperties->where('type', $type);
            } else if ($type === 'commercial') {
                $localityProperties->where('mode', 'commercial');
            }
            $localityProperties = $localityProperties->distinct()->get();

            $proejctsProperties = collect();
            if ($projectIds) {
                $proejctsProperties = Property::whereIn('project_id', $projectIds);
                if (in_array($type, ['sell', 'rent', 'pg'])) {
                    $proejctsProperties->where('type', $type);
                } else if ($type === 'commercial') {
                    $proejctsProperties->where('mode', 'commercial');
                }
                $proejctsProperties = $proejctsProperties->distinct()->get();
            }

            // Merge City, Project, and Locality Properties
            $mergeProperties = $cityProperties->merge($proejctsProperties)->merge($localityProperties);
            $mergedProperties = $mergeProperties->unique('id')->values();
            $similarProperties = collect();

            if ($type == 'pg') {
                $similarProperties = $this->similarPropertiesPg($mergeProperties, $type);
            } else {
                $similarProperties = $this->similarProperties($mergeProperties, $type);
            }

            if ($similarProperties->count() == 0) {
                $similarProperties = $this->similarItems($type, true);
            }



            // if (in_array($type, ['sell', 'rent'])) {
            //     $similarProperties->whereNotNull('project_id')->whereNotNull('number_bedroom');
            // }


            return ['properties' => $mergedProperties, 'similarProperties' => $similarProperties];
        }

        return array(); // Return an empty collection if no keywords are provided
    }

    public function similarProperties($mergeProperties, $type = null)
    {
        $similarProperties = Property::query()
            ->where('moderation_status', 'approved')
            ->where(function ($query) use ($mergeProperties) {
                $query->whereIn('locality', $mergeProperties->pluck('locality')->filter()->unique())
                    ->orWhereIn('city', $mergeProperties->pluck('city')->filter()->unique())
                    ->orWhereIn('price', $mergeProperties->pluck('price')->filter()->unique())
                    ->orWhereIn('project_id', $mergeProperties->pluck('project_id')->filter()->unique())
                    ->orWhereIn('number_bedroom', $mergeProperties->pluck('number_bedroom')->filter()->unique())
                    ->orWhereIn('sub_locality', $mergeProperties->pluck('sub_locality')->filter()->unique())
                    ->orWhereIn('landmark', $mergeProperties->pluck('landmark')->filter()->unique());
            });
        if ($type != null  && in_array($type, ['sell', 'rent', 'pg'])) {
            $similarProperties->where('type', $type);
        } else if ($type === 'commercial') {
            $similarProperties->where('mode', 'commercial');
        } else if ($type === 'plot') {
            $similarProperties->whereHas('categories', function ($query) {
                $query->where('name', 'Plot and Land');
            });
        }
        $similarProperties = $similarProperties->whereNotNull('project_id')->whereNotNull('price')->whereNotNull('city')->whereNotNull('locality')->whereNotNull('number_bedroom')->whereNotNull('sub_locality')->whereNotNull('landmark')->distinct()
            ->get();

        return $similarProperties;
    }

    public function similarPropertiesPg($mergeProperties, $type)
    {
        $similarProperties = Property::query()
            ->where('moderation_status', 'approved')
            ->where(function ($query) use ($mergeProperties) {
                $query->whereIn('locality', $mergeProperties->pluck('locality')->filter()->unique())
                    ->orWhereIn('city', $mergeProperties->pluck('city')->filter()->unique())
                    ->orWhereIn('price', $mergeProperties->pluck('price')->filter()->unique())
                    ->orWhereIn('project_id', $mergeProperties->pluck('project_id')->filter()->unique())
                    ->orWhereIn('number_bedroom', $mergeProperties->pluck('number_bedroom')->filter()->unique())
                    ->orWhereIn('sub_locality', $mergeProperties->pluck('sub_locality')->filter()->unique())
                    ->orWhereIn('landmark', $mergeProperties->pluck('landmark')->filter()->unique());
            })->where('type', $type);
        $similarProperties = $similarProperties->whereNotNull('price')->whereNotNull('city')->whereNotNull('locality')->whereNotNull('sub_locality')->whereNotNull('landmark')->distinct()
            ->get();

        return $similarProperties;
    }


    public function similarPropertiesFilter($mergeProperties, $type)
    {
        $similarProperties = Property::query()
            ->where('moderation_status', 'approved')
            ->where(function ($query) use ($mergeProperties) {
                $query->whereIn('locality', $mergeProperties->pluck('locality')->filter()->unique())
                    ->orWhereIn('city', $mergeProperties->pluck('city')->filter()->unique())
                    ->orWhereIn('price', $mergeProperties->pluck('price')->filter()->unique())
                    ->orWhereIn('project_id', $mergeProperties->pluck('project_id')->filter()->unique())
                    ->orWhereIn('number_bedroom', $mergeProperties->pluck('number_bedroom')->filter()->unique())
                    ->orWhereIn('sub_locality', $mergeProperties->pluck('sub_locality')->filter()->unique())
                    ->orWhereIn('landmark', $mergeProperties->pluck('landmark')->filter()->unique());
            });

        if ($type != null  && in_array($type, ['sell', 'rent', 'pg'])) {
            $similarProperties->where('type', $type);
        } else if ($type === 'commercial') {
            $similarProperties->where('mode', 'commercial');
        } else if ($type === 'plot') {
            $similarProperties->whereHas('categories', function ($query) {
                $query->where('name', 'Plot and Land');
            });
        }

        $similarProperties = $similarProperties->whereNotNull('project_id')->whereNotNull('price')->whereNotNull('city')->whereNotNull('locality')->whereNotNull('number_bedroom')->whereNotNull('sub_locality')->whereNotNull('landmark')->distinct()
            ->get();

        return $similarProperties;
    }


    public function projectSearchKeywords(Request $request, $type = null)
    {
        if ($request->has('s') && $request->filled('s')) {
            $keywords = is_array($request->s) ? $request->s : [$request->s];

            // Fetch City-based Properties
            $cityProperties = Project::query()
                ->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->orWhere('city', 'LIKE', "%{$keyword}%");
                    }
                })
                ->when(isset($type) && in_array($type, ['new_launch', 'ready_to_move', 'under_construction']), function ($query) use ($type) {
                    $query->where('construction_status', $type);
                });
            $cityProperties = $cityProperties->distinct()->get();

            // Fetch Project-based Properties
            $projectIds = Project::query()
                ->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->orWhere('name', 'LIKE', "%{$keyword}%");
                    }
                })
                ->when(isset($type) && in_array($type, ['new_launch', 'ready_to_move', 'under_construction']), function ($query) use ($type) {
                    $query->where('construction_status', $type);
                })
                ->pluck('id');

            // Fetch Locality-based Properties
            $localityProperties = Project::query()
                ->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->orWhere('locality', 'LIKE', "%{$keyword}%");
                    }
                })
                ->when(isset($type) && in_array($type, ['new_launch', 'ready_to_move', 'under_construction']), function ($query) use ($type) {
                    $query->where('construction_status', $type);
                });

            $localityProperties = $localityProperties->distinct()->get();

            $proejctsProperties = collect();
            if ($projectIds) {
                $proejctsProperties = Property::whereIn('project_id', $projectIds);
                if (in_array($type, ['sell', 'rent', 'pg'])) {
                    $proejctsProperties->where('type', $type);
                } else if ($type === 'commercial') {
                    $proejctsProperties->where('mode', 'commercial');
                }
                $proejctsProperties->distinct()
                    ->get();
            }

            // Merge City, Project, and Locality Properties
            $mergedProjects = $cityProperties->merge($localityProperties)
                ->unique('id') // Remove duplicates based on ID
                ->values(); // Reindex the collection


            $mergeProperties = $cityProperties->merge($proejctsProperties)->merge($localityProperties);
            $mergedProjects = $mergeProperties->unique('id')->values();
            $similarProperties = collect();

            $similarProjects = $this->similarProperties($mergeProperties, $type);


            if ($similarProjects->count() == 0) {
                $similarProjects = $this->similarItems($type, false);
            }





            return ['projects' => $mergedProjects, 'similarProjects' => $similarProjects];
        }
    }

    public function searchProjects(Request $request)
    {
        if ($request->filled('k') && $request->k != '') {
            $keyword = $request->k;

            $type = ($request->type == 'new-launch' ? 'new_launch' : $request->type);

            // Query 1: Search in 'city'
            // $cities = Project::query()
            //     ->where('city', 'LIKE', "%{$keyword}%")
            //     ->when(isset($type) && in_array($type, ['new_launch', 'ready_to_move', 'under_construction']), function ($query) use ($type) {
            //         $query->where('construction_status', $type);
            //     })
            //     ->where('city', '!=', '')
            //     ->distinct()
            //     ->pluck('city')->toArray();


            $cities = Property::query()
                ->where('city', 'LIKE', "%{$keyword}%")
                ->where('city', '!=', '')
                ->when(isset($type) && in_array($type, ['new_launch', 'ready_to_move', 'under_construction']), function ($query) use ($type) {
                    $query->where('construction_status', $type);
                })
                ->distinct()
                ->pluck('city') // Pluck the distinct city names
                ->map(function ($city) {
                    return [
                        'value' => $city, // Actual city name for value
                        'display' => "{$city}" // Formatted as city, city for display
                    ];
                })
                ->toArray();




            // Query 2: Search in 'locality'
            // $localities = Project::query()
            //     ->where('locality', 'LIKE', "%{$keyword}%")
            //     ->when(isset($type) && in_array($type, ['new_launch', 'ready_to_move', 'under_construction']), function ($query) use ($type) {
            //         $query->where('construction_status', $type);
            //     })
            //     ->where('locality', '!=', '')
            //     ->distinct()
            //     ->pluck('locality')->toArray();

            $localities = Property::query()
                ->where('moderation_status', 'approved')
                ->where('locality', 'LIKE', "%{$keyword}%")
                ->where('locality', '!=', '')
                ->when(isset($type) && in_array($type, ['new_launch', 'ready_to_move', 'under_construction']), function ($query) use ($type) {
                    $query->where('construction_status', $type);
                })
                ->distinct()
                ->select(['locality', 'city'])
                ->get()
                ->map(function ($locality) {
                    return [
                        'value' => $locality->locality,
                        'display' => "{$locality->locality},{$locality->city}"
                    ];
                })
                ->toArray();

            // Query 3: Search in associated 'project name'
            // $projects = Project::where('name', 'LIKE', "%{$keyword}%")
            //     ->when(isset($type) && in_array($type, ['new_launch', 'ready_to_move', 'under_construction']), function ($query) use ($type) {
            //         $query->where('construction_status', $type);
            //     })
            //     ->distinct()
            //     ->pluck('name')->toArray();
            $projects = Project::query()
                ->where(function ($query) use ($keyword) {
                    $query->orWhere('name', 'LIKE', "%{$keyword}%")
                        ->orWhere('city', 'LIKE', "%{$keyword}%")
                        ->orWhere('locality', 'LIKE', "%{$keyword}%");
                })
                ->when(isset($type) && in_array($type, ['new_launch', 'ready_to_move', 'under_construction']), function ($query) use ($type) {
                    $query->where('construction_status', $type);
                })
                ->distinct()
                ->select(['name', 'locality', 'city'])
                ->get()
                ->map(function ($project) {
                    return [
                        'value' => $project->name, // Project name as the value
                        'display' => "{$project->name}, {$project->locality}, {$project->city}" // Display formatted as project_name, locality, city
                    ];
                })
                ->toArray();
        }



        $results = [];

        if (count($cities) > 0) {
            $results['cities'] = $cities;
        }

        if (count($localities) > 0) {
            $results['localities'] = $localities;
        }

        if (count($projects) > 0) {
            $results['projects'] = $projects;
        }

        // Return the results as a JSON response
        return response()->json($results);
    }

    function ShortcutFilterProperties($query, $request)
    {
        // Keyword search
        if ($request->filled('k') && $request->k != '' && $request->k != 'null') {
            $query->where('name', 'LIKE', '%' . $request->k . '%')
                ->orWhere('content', 'LIKE', '%' . $request->k . '%');
        }


        if ($request->filled('s') && is_array($request->s)) {
            foreach ($request->s as $keyword) {
                if ($keyword != '' && $keyword != 'null') {

                    $query->where(function ($query) use ($keyword) {
                        $query->where('city', $keyword)
                            ->orWhere('content', $keyword)
                            ->orWhere('locality', $keyword);
                        // $query->where('city', 'LIKE', '%' . $keyword . '%')
                        //     ->orWhere('content', 'LIKE', '%' . $keyword . '%')
                        //     ->orWhere('locality', 'LIKE', '%' . $keyword . '%');
                        // ->orWhereHas('categories', function ($subQuery) use ($keyword) {
                        //     $subQuery->where('name', 'LIKE', "%{$keyword}%");
                        // });
                    });
                }
            }
        }

        // // City filter
        if ($request->filled('city') && $request->city !== '' && $request->city != 'null') {
            $query->where('locality', 'LIKE', '%' .  $request->city . '%');
        }


        // // City filter
        if ($request->filled('location') && $request->location !== '' && $request->location != 'null') {

            $query->where('locality', 'LIKE', '%' .  $request->location . '%');
        }

        // Category filter
        if ($request->filled('categories') && $request->categories !== '' && $request->categories != 'null') {
            if (is_array($request->categories)) {
                $categories = $request->categories;
            } else {
                $categories = explode(',', $request->categories);
            }


            $query->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('name', $categories);
            });
        }


        // Bedrooms filter
        if ($request->filled('bedrooms') && $request->bedrooms !== '' && $request->bedrooms != 'null') {
            if (is_array($request->bedrooms)) {
                $bedrooms = $request->bedrooms;
            } else {
                $bedrooms = explode(',', $request->bedrooms);
            }
            $query->whereIn('number_bedroom', $bedrooms);
        }

        // // Ownership filter
        if ($request->filled('ownership') && $request->ownership !== '' && $request->ownership != 'null') {
            if (is_array($request->ownership)) {
                $ownership = $request->ownership;
            } else {
                $ownership = explode(',', $request->ownership);
            }
            $query->whereIn('ownership', $ownership);
        }

        // Furnishing filter
        if ($request->filled('furnishing') && $request->furnishing !== '' && $request->furnishing != 'null') {
            $query->whereIn('furnishing', $request->furnishing);
        }

        // Budget filter
        if (
            $request->filled('min_price') && $request->filled('max_price') &&
            is_numeric($request->min_price) && is_numeric($request->max_price)
        ) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        if ($request->filled('project') && $request->project !== '' && $request->project != 'null') {
            $projectId = Project::where('name', $request->project)->pluck('id');

            if ($projectId) {
                $query->whereIn('project_id', $projectId)->get();
            }
        }

        return $query;
    }

    function similarItems($type, $is_propertyy = true)
    {
        if ($is_propertyy) {
            $similar = Property::query();
            if (in_array($type, ['sell', 'rent', 'pg'])) {
                $similar->where('type', $type);
            } else if ($type === 'commercial') {
                $similar->where('mode', 'commercial');
            } else if ($type === 'plot') {
                $similar->whereHas('categories', function ($query) {
                    $query->where('name', 'Plot and Land');
                });
            }
            $similar = $similar->distinct()->limit(24)->get();
        } else {
            $similar = Project::query();

            $similar = $similar->distinct()->limit(24)->get();
        }
        return $similar;
    }

    function ShortcutFilterProjects($query, $request)
    {
        // Keyword search
        if ($request->filled('k') && $request->k != '' && $request->k != 'null') {
            $query->where('name', 'LIKE', '%' . $request->k . '%')
                ->orWhere('content', 'LIKE', '%' . $request->k . '%');
        }


        if ($request->filled('s') && is_array($request->s)) {
            foreach ($request->s as $keyword) {
                if ($keyword != '' && $keyword != 'null') {

                    $query->where(function ($query) use ($keyword) {
                        $query->where('name', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('content', 'LIKE', '%' . $keyword . '%')
                            ->orWhere('locality', 'LIKE', '%' . $keyword . '%');
                        // ->orWhereHas('categories', function ($subQuery) use ($keyword) {
                        //     $subQuery->where('name', 'LIKE', "%{$keyword}%");
                        // });
                    });
                }
            }
        }

        // // City filter
        if ($request->filled('city') && $request->city !== '' && $request->city != 'null') {
            $query->where('locality', $request->city);
        }


        // Category filter
        if ($request->filled('categories') && $request->categories !== '' && $request->categories != 'null') {
            if (is_array($request->categories)) {
                $categories = $request->categories;
            } else {
                $categories = explode(',', $request->categories);
            }
            $query->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('name', $categories);
            });
        }


        // Budget filter
        if (
            $request->filled('min_price') && $request->filled('max_price') &&
            is_numeric($request->min_price) && is_numeric($request->max_price)
        ) {
            $query->where('price_from', '>=', $request->min_price)
                ->where('price_to', '<=', $request->max_price);
        }


        if ($request->filled('builder') && $request->builder !== '' && $request->builder != 'null') {
            $builderIds = Investor::where('name', $request->builder)->pluck('id');
            if ($builderIds) {
                $query->where('investor_id', $builderIds)->get();
            }
        }

        if ($request->filled('construction') && $request->construction !== '' && $request->construction != 'null') {
            $query->whereIn('construction_status', $request->construction);
        }

        return $query;
    }

    public function similarProjects($mergeProperties, $type = null)
    {
        $similarProjects = Property::query()
            ->where('moderation_status', 'approved')
            ->where(function ($query) use ($mergeProperties) {
                $query->whereIn('locality', $mergeProperties->pluck('locality')->filter()->unique())
                    ->orWhereIn('city', $mergeProperties->pluck('city')->filter()->unique())
                    ->orWhereIn('price', $mergeProperties->pluck('price')->filter()->unique())
                    ->orWhereIn('project_id', $mergeProperties->pluck('project_id')->filter()->unique())
                    ->orWhereIn('number_bedroom', $mergeProperties->pluck('number_bedroom')->filter()->unique())
                    ->orWhereIn('sub_locality', $mergeProperties->pluck('sub_locality')->filter()->unique())
                    ->orWhereIn('landmark', $mergeProperties->pluck('landmark')->filter()->unique());
            });
        if ($type != null  && in_array($type, ['sell', 'rent', 'pg'])) {
            $similarProjects->where('type', $type);
        } else if ($type === 'commercial') {
            $similarProjects->where('mode', 'commercial');
        } else if ($type === 'plot') {
            $similarProjects->whereHas('categories', function ($query) {
                $query->where('name', 'Plot and Land');
            });
        }
        $similarProjects = $similarProjects->whereNotNull('project_id')->whereNotNull('price')->whereNotNull('city')->whereNotNull('locality')->whereNotNull('number_bedroom')->whereNotNull('sub_locality')->whereNotNull('landmark')->distinct()
            ->get();

        return $similarProjects;
    }

    public function similarProjectFilter($mergeProperties, $type)
    {
        $similarProperties = Property::query()
            ->where('moderation_status', 'approved')
            ->where(function ($query) use ($mergeProperties) {
                $query->whereIn('locality', $mergeProperties->pluck('locality')->filter()->unique())
                    ->orWhereIn('city', $mergeProperties->pluck('city')->filter()->unique())
                    ->orWhereIn('price', $mergeProperties->pluck('price')->filter()->unique())
                    ->orWhereIn('project_id', $mergeProperties->pluck('project_id')->filter()->unique())
                    ->orWhereIn('number_bedroom', $mergeProperties->pluck('number_bedroom')->filter()->unique())
                    ->orWhereIn('sub_locality', $mergeProperties->pluck('sub_locality')->filter()->unique())
                    ->orWhereIn('landmark', $mergeProperties->pluck('landmark')->filter()->unique());
            });

        if ($type != null  && in_array($type, ['sell', 'rent', 'pg'])) {
            $similarProperties->where('type', $type);
        } else if ($type === 'commercial') {
            $similarProperties->where('mode', 'commercial');
        } else if ($type === 'plot') {
            $similarProperties->whereHas('categories', function ($query) {
                $query->where('name', 'Plot and Land');
            });
        }

        $similarProperties = $similarProperties->whereNotNull('project_id')->whereNotNull('price')->whereNotNull('city')->whereNotNull('locality')->whereNotNull('number_bedroom')->whereNotNull('sub_locality')->whereNotNull('landmark')->distinct()
            ->get();

        return $similarProperties;
    }

    public function postConsult(Request $request)
    { // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'content' => 'nullable|string',
            'project_id' => 'nullable|integer',
            'property_id' => 'nullable|integer',
        ]);

        // Check for duplicate submission
        $existingConsult = Consult::where('ip_address', $request->ip());

        if($request->type == 'project'){
            $existingConsult = $existingConsult->where('project_id', $request->data_id);
        }
        else if($request->type == 'property'){
            $existingConsult = $existingConsult->where('property_id', $request->data_id);
        }
        else{
            return response()->json([
                'error' => true,
                'message' => 'Invalid Request.',
            ]);
        }

        $existingConsult = $existingConsult->first();

        //     ->where(function ($query) use ($request) {
        //         $query->where('property_id', $request->property_id)
        //             ->orWhere('project_id', $request->project_id);
        //     })->first();


        if ($existingConsult) {
            return response()->json([
                'error' => true,
                'message' => 'You have already submitted a request, we will get in touch with you shortly.',
            ]);
        }

        // Save the consult record

        try {
            if ($request->has('data_id') && $request->data_id != '') {
                $lead              = new Consult();
                $lead->name        = $request->name;
                $lead->email       = $request->email;
                $lead->phone       = $request->phone;
                if ($request->type == 'project') {
                    $lead->project_id  = $request->data_id;
                } else {
                    $lead->property_id  =   $request->data_id;
                }

                $lead->ip_address = $request->ip();
                $lead->status = 'unread';
                $lead->save();

                $this->adminContactReceived($request);

                return response()->json([
                    'error' => false,
                    'message' => 'Thank you, we have received your request, we will get in touch with you shortly.',
                    'data' => [
                        'next_page' => null, // Or set a URL for redirection if needed
                    ],
                ]);
            } else {
                return response()->json([
                    'error' => true,
                    'message' => 'An error occurred while submitting your request. Please try again later.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while submitting your request. Please try again later.',
            ]);
        }
    }

    public function postContactForm(Request $request)
    {
        try {
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone ?? 1;
            $contact->subject = $request->subject;
            $contact->content = $request->content;
            $contact->status = 'unread';
            $contact->save();

            $this->adminContactReceived($request);

            return response()->json([
                'error' => false,
                'message' => 'Thank you, we have received your request, we will get in touch with you shortly.',
                'data' => [
                    'next_page' => null, // Or set a URL for redirection if needed
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => 'An error occurred while submitting your request. Please try again later.',
            ]);
        }
    }
}
