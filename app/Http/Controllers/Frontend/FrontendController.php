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

    public function index()
    {
        $categories                 = Category::where('status', 'published')->get();
        $featured_properties        = Property::where('moderation_status', 'approved')->where('type', 'sell')->get();
        $featured_properties_rent   = Property::where('moderation_status', 'approved')->where('type', 'rent')->get();

        $featured_project           = Project::get();
        $recent_viwed_properties    = $this->recentlyViewedProperties();
        $latest_blogs               = BlogPost::orderBy('created_at', 'desc')->limit(3)->get();

        return view('front.index', compact('categories', 'featured_properties_rent', 'featured_properties', 'featured_project', 'recent_viwed_properties', 'latest_blogs'));
    }

    public function properties(Request $request)
    {


        $query = Property::query()->where('moderation_status', 'approved')
            ->where(function ($q) {
                $q->where('status', "selling")
                    ->orWhere('status', "renting");
            });

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

        // Other filters...

        $properties = $property_query->get();

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
        $cities = Property::groupBy('locality')->pluck('locality');
        $categories = Category::where('status', 'published')->get();

        $pageTitle = 'Residential Properties for Sale, Rent, and Lease in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = 'Explore a wide range of residential properties including houses, apartments, flats, and more for sale, rent, or lease in Bangalore and Karnataka. Find your dream home today!';
        $pageKeywords = 'residential properties for sale, residential properties for rent, apartments for rent in Bangalore, houses for sale in Karnataka, flats for sale in Bangalore, affordable homes in Karnataka, residential real estate in Bangalore, buy house in Karnataka, rental homes Bangalore, lease properties Karnataka';

        return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders','pageTitle','pageDescription','pageKeywords'));
    }


    public function PropertiesForSale(Request $request)
    {
        $query = Property::query()->where('type', 'sell')->where('status', 'selling')->where('moderation_status', 'approved');

        $property_query = $this->ShortcutFilterProperties($query, $request);

        $builders = Investor::get();
        $cities = Property::where('type', 'sell')
            ->where('moderation_status', 'approved')
            ->where(function ($q) {
                $q->where('status', "selling")
                    ->orWhere('status', "renting");
            })
            ->groupBy('locality')->pluck('locality');

        $categories = Category::where('status', 'published')->where('has_sell', 1)->get();
        $type = 'sell';

        $properties = $property_query->get();

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

    

        $pageTitle = 'Properties for Sale in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = 'Browse a wide selection of properties for sale in Bangalore and Karnataka. Find houses, apartments, plots, and more to buy at competitive prices.';
        $pageKeywords = 'properties for sale, houses for sale in Bangalore, apartments for sale in Karnataka, buy homes in Bangalore, residential plots for sale in Karnataka, real estate for sale, commercial properties for sale, affordable homes for sale, property listings in Bangalore';


        return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type','pageTitle','pageDescription','pageKeywords'));
    }
    public function PropertiesForRent(Request $request)
    {
        $query = Property::query()->where('type', 'rent')->where('status', 'renting')->where('moderation_status', 'approved');
        $property_query = $this->ShortcutFilterProperties($query, $request);
        $builders = Investor::get();
        $cities = Property::where('type', 'rent')
            ->where('moderation_status', 'approved')
            ->where(function ($q) {
                $q->where('status', "selling")
                    ->orWhere('status', "renting");
            })
            ->groupBy('locality')
            ->pluck('locality');
        $categories = Category::where('status', 'published')->where('has_rent', 1)->get();
        $type = 'rent';


        $properties = $property_query->get();

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }


        $pageTitle = 'Properties for Rent in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = 'Explore a variety of properties for rent in Bangalore and Karnataka. Find apartments, houses, PG accommodations, and more at competitive rental prices.';
        $pageKeywords = 'properties for rent, apartments for rent in Bangalore, houses for rent in Karnataka, rental properties in Bangalore, PG accommodation in Karnataka, rental flats in Bangalore, commercial spaces for rent, affordable houses for rent in Karnataka, paying guest accommodation, real estate rentals';

        return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type', 'pageTitle','pageDescription','pageKeywords'));
    }
    public function PropertiesForPlot(Request $request)
    {
        $category   = 'Plot and Land';
        $query      = Property::query()
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            })
            ->where('moderation_status', 'approved')
            ->where(function ($q) {
                $q->where('status', "selling")
                    ->orWhere('status', "renting");
            });

        $property_query = $this->ShortcutFilterProperties($query, $request);
        $builders   = Investor::get();
        $cities     = Property::query()
            ->whereHas('categories', function ($query) use ($category) {
                $query->where('name', $category);
            })
            ->where('moderation_status', 'approved')
            ->where(function ($q) {
                $q->where('status', "selling")
                    ->orWhere('status', "renting");
            })
            ->groupBy('locality')->pluck('locality');
        $categories = Category::where('status', 'published')->get();
        $type = 'plot';


        $properties = $property_query->get();

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

        $pageTitle = 'Plots for Sale in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = "Browse a variety of residential and commercial plots for sale in Bangalore and Karnataka. Find your ideal plot for construction, investment, or development.";
        $pageKeywords = "plots for sale, residential plots in Bangalore, commercial plots in Karnataka, land for sale in Bangalore, investment land in Karnataka, real estate plots, agricultural plots in Karnataka, plot for construction, buy plots in Bangalore, land investment opportunities";
    

        return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type','pageTitle','pageDescription','pageKeywords'));
    }
    public function PropertiesForPg(Request $request)
    {
        $query = Property::query()->where('type', 'pg')->where('status', 'renting')->where('moderation_status', 'approved');
        $property_query = $this->ShortcutFilterProperties($query, $request);
        $builders = Investor::get();
        $cities = Property::where('type', 'pg')
            ->where('moderation_status', 'approved')
            ->where(function ($q) {
                $q->where('status', "selling")
                    ->orWhere('status', "renting");
            })
            ->groupBy('locality')->pluck('locality');
        $categories = Category::where('status', 'published')->get();

        $type = 'pg';

        $properties = $property_query->get();

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

        $pageTitle = 'PG Accommodation for Rent in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = 'Explore a variety of Paying Guest (PG) accommodations for rent in Bangalore and Karnataka. Find affordable PGs, private rooms, and shared spaces that suit your needs.';
        $pageKeywords = 'PG accommodation in Bangalore, paying guests in Karnataka, PG for rent in Bangalore, affordable PGs in Bangalore, PG rooms for rent in Karnataka, private rooms for rent in Bangalore, shared PG accommodation, budget PGs in Bangalore, PG spaces near IT hubs, PGs for students in Bangalore, PG rental properties in Karnataka, PG facilities in Bangalore';

        return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type','pageTitle','pageDescription','pageKeywords'));
    }


    public function PropertiesForCommercial(Request $request)
    {

        $query          = Property::query()->where('mode', 'commercial')
            ->where('moderation_status', 'approved')
            ->where(function ($q) {
                $q->where('status', "selling")
                    ->orWhere('status', "renting");
            });
        $property_query = $this->ShortcutFilterProperties($query, $request);
        $builders       = Investor::get();
        $cities         = Property::where('mode', 'commercial')
            ->where('moderation_status', 'approved')
            ->where(function ($q) {
                $q->where('status', "selling")
                    ->orWhere('status', "renting");
            })
            ->groupBy('locality')
            ->pluck('locality');

        $categories     = Category::where('status', 'published')->where('has_commercial', 1)->get();
        $type           = 'commercial';

        if (($request->has('tab') && $request->tab == 'sale') || $request->has('type') && $request->type == 'commercial-sale') {
            $property_query = $property_query->where('type', 'sell');
        } else if (($request->has('tab') && $request->tab == 'rent') || $request->has('type') && $request->type == 'commercial-rent') {
            $property_query = $property_query->where('type', 'rent');
        }

        $properties = $property_query->get();

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

        $pageTitle = 'Commercial Properties for Sale & Rent in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = 'Discover a wide range of commercial properties for sale and rent in Bangalore and Karnataka. From office spaces to retail shops, find the perfect location for your business.';
        $pageKeywords = 'commercial properties for sale in Bangalore, commercial properties for rent in Karnataka, office spaces for rent in Bangalore, retail shops for sale in Karnataka, commercial real estate in Bangalore, business spaces for lease in Bangalore, commercial property investment in Karnataka, commercial land for sale in Bangalore, office buildings for rent in Karnataka, shops for rent in Bangalore, commercial plots for sale, industrial properties for rent, commercial space for lease';
    

        return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type','pageTitle','pageDescription','pageKeywords'));
    }



    public function projects(Request $request)
    {
        $query = Project::query();

        // Filters for projects...
        $project_query = $this->ShortcutFilterProjects($query, $request);

        $projects = $project_query->get();

        if ($request->ajax()) {
            $html = view('front.shortcuts.projects.items', compact('projects'))->render();
            return response()->json(['html' => $html]);
        }

        $cities = Project::groupBy('locality')->whereNotnull('locality')->pluck('locality');
        $categories = Category::where('status', 'published')->get();
        $builders = Investor::get();

        $pageTitle = 'All Real Estate Projects: New Launch, Ready to Launch & Under Construction in Bangalore & Karnataka | New Door Ventures';
        $pageDescription = 'Explore a variety of real estate projects including new launches, ready-to-launch, and under-construction properties in Bangalore and Karnataka. Find your dream home or investment opportunity today.';
        $pageKeywords = 'new launch real estate projects in Bangalore, ready to launch projects in Karnataka, under construction properties in Bangalore, residential projects in Karnataka, commercial projects Bangalore, real estate investment Bangalore, new homes Bangalore, property projects in Karnataka, builder projects Bangalore, new construction properties, affordable housing projects Karnataka, residential development Bangalore, upcoming projects Bangalore, ongoing construction in Karnataka';

        return view('front.projects.index', compact('projects', 'categories', 'cities', 'builders','pageTitle','pageDescription','pageKeywords'));
    }

    public function propertyDetails($uid, $slug)
    {
        $property = Property::where('slug', $slug)->where('unique_id', $uid)->first() ?? abort(404);
        $recent_properties = $this->recentlyViewedProperties();
        $rules = PgRules::get();
        $property->increment('views');

        $pageTitle = $property->name.' | New Door Ventures';
        $pageDescription = $property->content;
        $pageKeywords = 'property for sale, property for rent, PG accommodation, residential plots, commercial properties, rental properties in Bangalore, sale properties in Karnataka, residential properties for sale, commercial spaces for lease, PGs in Bangalore, land for sale in Karnataka, affordable properties in Bangalore, buy rent or lease property in Karnataka, real estate Bangalore, residential real estate Bangalore, commercial real estate Karnataka';



        if ($property->mode == 'Commercial') {
            if ($property->category && $property->category->name == 'Plot and Land') {
                return view('front.properties.commercial-plot-property', compact('property', 'recent_properties','pageTitle','pageDescription','pageKeywords'));
            }

            return match ($property->type) {
                'sell', 'rent' => view('front.properties.commercial-rent-sale-single', compact('property', 'recent_properties','pageTitle','pageDescription','pageKeywords')),
                default => abort(404),
            };
        }

        if ($property->category && $property->category->name == 'Plot and Land') {
            return view('front.properties.plot-property', compact('property', 'recent_properties','pageTitle','pageDescription','pageKeywords'));
        }

        return match ($property->type) {
            'sell', 'rent' => view('front.properties.single', compact('property', 'recent_properties','pageTitle','pageDescription','pageKeywords','pageTitle','pageDescription','pageKeywords')),
            'pg' => view('front.properties.pg-single', compact('property', 'recent_properties', 'rules','pageTitle','pageDescription','pageKeywords','pageTitle','pageDescription','pageKeywords')),
            default => abort(404),
        };
    }

    public function projectDetails($uid, $slug)
    {
        $project = Project::where('slug', $slug)->where('unique_id', $uid)->first() ?? abort(404);
        $project->increment('views');
        $configurations = Configration::get();
        $advertisement = Advertisement::inRandomOrder()->first();
        $pageTitle = $project->name.' | New Door Ventures';
        $pageDescription = $project->content;
        $pageKeywords = 'new launch projects, under construction projects, ready to launch properties, real estate projects in Bangalore, residential projects, commercial projects in Karnataka, real estate builders in Bangalore, upcoming property launches, real estate development, investment in property, new construction projects in Karnataka, real estate investment opportunities, residential apartments, commercial spaces for sale in Bangalore';
    

        return view('front.projects.single', compact('project', 'configurations', 'advertisement','pageTitle','pageDescription','pageKeywords'));
    }

    public function contact()
    {
        $pageTitle = 'Contact Us | New Door Ventures';
        $pageDescription = 'Get in touch with New Door Ventures for any inquiries or support regarding real estate properties in Bangalore and Karnataka. We are here to assist you with your real estate needs.';
        $pageKeywords = 'contact New Door Ventures, real estate inquiries, property consultation, real estate support Bangalore, get in touch with real estate experts, property queries Karnataka, real estate advice, property help Bangalore, contact us for real estate, customer support real estate, contact real estate company';
        return view('front.contact',compact('pageTitle','pageDescription','pageKeywords'));
    }

    public function blogList()
    {
        $blogs = BlogPost::get();
        $pageTitle = 'Latest Real Estate News & Blogs | New Door Ventures';
        $pageDescription = 'Stay updated with the latest trends, tips, and insights on real estate in Bangalore and Karnataka. Read our blogs for expert advice on property buying, renting, and leasing.';
        $pageKeywords = 'real estate blogs, property news, real estate tips, Bangalore real estate, Karnataka property updates, real estate trends, property buying advice, property rental tips, leasing properties, real estate experts Bangalore, real estate news Karnataka, new property developments, property market insights, real estate investment tips, property for sale Bangalore, property rental Karnataka';
    
        return view('front.news.index', compact('blogs','pageTitle','pageDescription','pageKeywords'));
    }

    public function blogDetails($slug)
    {
        $blog = BlogPost::where('slug', $slug)->firstOrFail();
        $blogs = BlogPost::where('slug', '!=', $slug)->get();

        $pageTitle = $blog->title . ' | New Door Ventures Blog';
        $pageDescription = Str::limit($blog->content, 160);
        $pageKeywords = 'real estate blog, property buying tips, property rental advice, ' . implode(', ', $blog->tags->pluck('name')->toArray());

        return view('front.news.single', compact('blog', 'blogs','pageTitle','pageDescription','pageKeywords'));
    }

    public function page($slug)
    {
        $page_id = Slug::where('key', $slug)->pluck('reference_id')->first() ?? abort(404);
        $page = Page::findOrFail($page_id);

        $pageTitle = $page->name . ' | New Door Ventures Blog';
        $pageDescription = Str::limit($page->content, 160);
        $pageKeywords = '';


        return view('front.page', compact('page','pageTitle','pageDescription','pageKeywords'));
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
            $route_name = 'projects';
        } else {
            // Fetch filtered properties
            $items = $this->searchProperties($request);
            $route_name = 'properties';
        }



        // Render the view with the items
        return view('front.shortcuts.filters.search-suggestion', compact('items', 'route_name'))->render();
    }

    public function searchProperties(Request $request)
    {

        // // Keyword-based Search
        if ($request->filled('k') && $request->k != '') {
            $query = Property::query();
            // Columns to retrieve
            $query->where('moderation_status', 'approved'); // Approved properties only

            // // Handle 'type' filters
            if ($request->filled('type')) {
                $type = $request->type;
                switch ($type) {
                    case 'sale':
                        $query->where('type', 'sell')
                            ->whereDoesntHave('categories', function ($subQuery) {
                                $subQuery->where('name', 'Plot and Land');
                            });
                        break;
                    case 'rent':
                        $query->where('type', $type)
                            ->whereDoesntHave('categories', function ($subQuery) {
                                $subQuery->where('name', 'Plot and Land');
                            });
                        break;

                    case 'pg':
                        $query->where('type', 'pg');
                        break;

                    case 'plot':
                        $query->whereHas('categories', function ($subQuery) {
                            $subQuery->where('name', 'Plot and Land');
                        });
                        break;

                    default:
                        return collect(); // Return an empty collection if type is invalid
                }
            }

            $keyword = $request->k;

            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('slug', 'LIKE', "%{$keyword}%")
                    ->orWhere('description', 'LIKE', "%{$keyword}%")
                    ->orWhere('content', 'LIKE', "%{$keyword}%")
                    ->orWhere('location', 'LIKE', "%{$keyword}%")
                    ->orWhere('city', 'LIKE', "%{$keyword}%")
                    ->orWhere('locality', 'LIKE', "%{$keyword}%")
                    ->orWhere('sub_locality', 'LIKE', "%{$keyword}%")
                    ->orWhere('number_bedroom', 'LIKE', "%{$keyword}%")
                    ->orWhere('apartment', 'LIKE', "%{$keyword}%")
                    ->orWhere('landmark', 'LIKE', "%{$keyword}%")
                    ->orWhereHas('categories', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'LIKE', "%{$keyword}%");
                    })
                    ->orWhereHas('project', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'LIKE', "%{$keyword}%");
                    });
            });
            return $query->get();
        }

        return collect();
    }


    public function searchProjects(Request $request)
    {
        // // Keyword-based Search
        if ($request->filled('k') && $request->k != '') {
            $query = Project::query();

            // // Handle 'type' filters
            // if ($request->filled('type')) {
            //     $type = $request->type;
            //     switch ($type) {
            //         case 'projects':
            //             $query->where('construction_status', '!=' ,'new_launch');
            //             break;
            //         case 'new-lanuch':
            //             $query->where('construction_status', 'new_launch');
            //             break;
            //         default:
            //             return collect(); // Return an empty collection if type is invalid
            //     }
            // }

            $keyword = $request->k;

            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('slug', 'LIKE', "%{$keyword}%")
                    ->orWhere('description', 'LIKE', "%{$keyword}%")
                    ->orWhere('content', 'LIKE', "%{$keyword}%")
                    ->orWhere('location', 'LIKE', "%{$keyword}%")
                    ->orWhere('city', 'LIKE', "%{$keyword}%")
                    ->orWhere('locality', 'LIKE', "%{$keyword}%")
                    ->orWhere('sub_locality', 'LIKE', "%{$keyword}%")
                    ->orWhere('landmark', 'LIKE', "%{$keyword}%")
                    ->orWhereHas('categories', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'LIKE', "%{$keyword}%");
                    });
            });
            return $query->get();
        }

        return collect();
    }

    function ShortcutFilterProperties($query, $request)
    {
        // Keyword search
        if ($request->filled('k') && $request->k != '' && $request->k != 'null') {
            $query->where('name', 'LIKE', '%' . $request->k . '%')
                ->orWhere('content', 'LIKE', '%' . $request->k . '%');
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
                $query->whereIn('id', $categories);
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



        return $query;
    }
    function ShortcutFilterProjects($query, $request)
    {
        // Keyword search
        if ($request->filled('k') && $request->k != '' && $request->k != 'null') {
            $query->where('name', 'LIKE', '%' . $request->k . '%')
                ->orWhere('content', 'LIKE', '%' . $request->k . '%');
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
                $query->whereIn('id', $categories);
            });
        }


        // Budget filter
        // if (
        //     $request->filled('min_price') && $request->filled('max_price') &&
        //     is_numeric($request->min_price) && is_numeric($request->max_price)
        // ) {
        //     $query->whereBetween('price', [$request->min_price, $request->max_price]);
        // }



        return $query;
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
        // $existingConsult = Consult::where('ip_address', $request->ip())
        //     ->where(function ($query) use ($request) {
        //         $query->where('property_id', $request->property_id)
        //             ->orWhere('project_id', $request->project_id);
        //     })->first();

        // if ($existingConsult) {
        //     return response()->json([
        //         'error' => true,
        //         'message' => 'You have already submitted a consultation request for this property/project.',
        //     ]);
        // }

        // Save the consult record

        try {
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
                'message' => 'Your enquiry request has been submitted successfully!',
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
                'message' => 'Your enquiry request has been submitted successfully!',
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
