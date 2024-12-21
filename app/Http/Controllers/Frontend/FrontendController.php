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

use Illuminate\Routing\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $categories                 = Category::where('status', 'published')->get();
        $featured_properties        = Property::where('moderation_status', 'approved')->where('type', 'sell')->get();
        $featured_properties_rent   = Property::where('moderation_status', 'approved')->where('type', 'rent')->get();

        $featured_project           = Project::get();
        $recent_viwed_properties    = $this->recentlyViewedProperties();
        $latest_blogs               = BlogPost::orderBy('created_at','desc')->limit(3)->get();

        return view('front.index', compact('categories', 'featured_properties_rent', 'featured_properties', 'featured_project', 'recent_viwed_properties', 'latest_blogs'));
    }

    public function properties(Request $request)
    {
        $query = Property::query()->where('moderation_status', 'approved');
        if ($request->filled('type') && $request->type == 'plot') {
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
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }



        $builders = Investor::get();
        $cities = Property::groupBy('locality')->pluck('locality');
        $categories = Category::where('status', 'published')->get();

        return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders'));
    }




    public function PropertiesForSale(Request $request)
    {
        $query = Property::query()->where('type', 'sell')->where('moderation_status', 'approved');

        $property_query = $this->ShortcutFilterProperties($query, $request);

        $builders = Investor::get();
        $cities = Property::where('type', 'sell')->where('moderation_status', 'approved')->groupBy('locality')->pluck('locality');
        $categories = Category::where('status', 'published')->get();
        $type = 'sell';


        $properties = $property_query->get();

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }


        return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type'));
    }
    public function PropertiesForRent(Request $request)
    {
        $query = Property::query()->where('type', 'rent')->where('moderation_status', 'approved');
        $property_query = $this->ShortcutFilterProperties($query, $request);
        $builders = Investor::get();
        $cities = Property::where('type', 'rent')->where('moderation_status', 'approved')->groupBy('locality')->pluck('locality');
        $categories = Category::where('status', 'published')->get();
        $type = 'rent';


        $properties = $property_query->get();

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

        return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type'));
    }
    public function PropertiesForPlot(Request $request)
    {
        $category   = 'Plot and Land';
        $query      = Property::query()->whereHas('categories', function ($query) use ($category) {
            $query->where('name', $category);
        })->where('moderation_status', 'approved');
        $property_query = $this->ShortcutFilterProperties($query, $request);
        $builders   = Investor::get();
        $cities     = Property::query()->whereHas('categories', function ($query) use ($category) {
            $query->where('name', $category);
        })->where('moderation_status', 'approved')->groupBy('locality')->pluck('locality');
        $categories = Category::where('status', 'published')->get();
        $type = 'plot';


        $properties = $property_query->get();

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

        return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type'));
    }
    public function PropertiesForPg(Request $request)
    {
        $query = Property::query()->where('type', 'pg')->where('moderation_status', 'approved');
        $property_query = $this->ShortcutFilterProperties($query, $request);
        $builders = Investor::get();
        $cities = Property::where('type', 'pg')->groupBy('locality')->pluck('locality');
        $categories = Category::where('status', 'published')->get();
        $type = 'pg';


        $properties = $property_query->get();

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

        return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders', 'type'));
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

        return view('front.projects.index', compact('projects', 'categories', 'cities', 'builders'));
    }

    public function propertyDetails($uid, $slug)
    {
        $property = Property::where('slug', $slug)->where('unique_id', $uid)->first() ?? abort(404);
        $recent_properties = $this->recentlyViewedProperties();
        $rules = PgRules::get();

        $property->increment('views');



        if ($property->category && $property->category->name == 'Plot and Land') {
            return view('front.properties.plot-property', compact('property', 'recent_properties'));
        }

        return match ($property->type) {
            'sell', 'rent' => view('front.properties.single', compact('property', 'recent_properties')),
            'pg' => view('front.properties.pg-single', compact('property', 'recent_properties', 'rules')),
            default => abort(404),
        };
    }

    public function projectDetails($uid, $slug)
    {
        $project = Project::where('slug', $slug)->where('unique_id', $uid)->first() ?? abort(404);
        $project->increment('views');
        $configurations = Configration::get();
        $advertisement = Advertisement::inRandomOrder()->first();
        return view('front.projects.single', compact('project', 'configurations', 'advertisement'));
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function blogList()
    {
        $blogs = BlogPost::get();
        return view('front.news.index', compact('blogs'));
    }

    public function blogDetails($slug)
    {
        $blog = BlogPost::where('slug', $slug)->firstOrFail();
        $blogs = BlogPost::where('slug','!=',$slug)->get();

        return view('front.news.single', compact('blog', 'blogs'));
    }

    public function page($slug)
    {
        $page_id = Slug::where('key', $slug)->pluck('reference_id')->first() ?? abort(404);
        $page = Page::findOrFail($page_id);

        return view('front.page', compact('page'));
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
            $contact->phone = '1';
            $contact->subject = $request->subject;
            $contact->content = $request->content;
            $contact->status = 'unread';
            $contact->save();

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
