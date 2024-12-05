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
use App\Models\PgRules;

use Illuminate\Routing\Controller;

class FrontendController extends Controller
{
    public function index()
    {
        $categories                 = Category::where('status', 'published')->get();
        $featured_properties        = Property::where('moderation_status', 'approved')->where('type','sale')->get();
        $featured_properties_rent   = Property::where('moderation_status', 'approved')->where('type','rent')->get();

        $featured_project           = Project::get();
        $recent_viwed_properties    = $this->recentlyViewedProperties();
        $latest_blogs               = Post::limit(4)->get();

        return view('front.index', compact('categories','featured_properties_rent', 'featured_properties', 'featured_project', 'recent_viwed_properties', 'latest_blogs'));
    }

    public function properties(Request $request)
    {
        $query = Property::query();
        if($request->filled('type') && $request->type == 'plot'){
            $plot  = 'Plot and Land';
            $query->whereHas('categories', function ($query) use ($plot) {
                $query->where('name', $plot);
            });
        }
        else if($request->filled('type')) {
            $query->where('type',  $request->type);
        }

        // Keyword search
        if ($request->filled('k')) {
            $query->where('name', 'LIKE', '%' . $request->k . '%')
                ->orWhere('content', 'LIKE', '%' . $request->k . '%');
        }

        // City filter
        if ($request->filled('city') && $request->city !== 'null') {
            $query->where('locality', $request->city);
        }

        // Category filter
        if ($request->filled('categories')) {
            if(is_array($request->categories)){
                $categories = $request->categories;
            }
            else{
                $categories = explode(',', $request->categories);
            }
            $query->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('id', $categories);
            });
        }

        // Bedrooms filter
        if ($request->filled('bedrooms')) {
            if(is_array($request->bedrooms)){
                $bedrooms = $request->bedrooms;
            }
            else{
                $bedrooms = explode(',', $request->bedrooms);
            }
            $query->whereIn('number_bedroom', $bedrooms);
        }

        // Ownership filter
        if ($request->filled('ownership')) {
            if(is_array($request->ownership)){
                $ownership = $request->ownership;
            }
            else{
                $ownership = explode(',', $request->ownership);
            }
            $query->whereIn('ownership', $ownership);
        }

        // Furnishing filter
        if ($request->filled('furnishing')) {
            $query->whereIn('furnishing', $request->furnishing);
        }

        // Budget filter
        if (
            $request->filled('min_price') && $request->filled('max_price') &&
            is_numeric($request->min_price) && is_numeric($request->max_price)
        ) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }

        // Other filters...

        $properties = $query->get();

        if ($request->ajax()) {
            $html = view('front.shortcuts.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }

        $builders = Investor::get();
        $cities = Property::groupBy('locality')->pluck('locality');
        $categories = Category::where('status', 'published')->get();

        return view('front.properties.index', compact('properties', 'categories', 'cities', 'builders'));
    }

    public function projects(Request $request)
    {
        $query = Project::query();

        // Filters for projects...

        $projects = $query->get();

        if ($request->ajax()) {
            $html = view('front.shortcuts.projects.items', compact('projects'))->render();
            return response()->json(['html' => $html]);
        }

        $cities = Project::groupBy('locality')->pluck('locality');
        $categories = Category::where('status', 'published')->get();
        $builders = Investor::get();

        return view('front.projects.index', compact('projects', 'categories', 'cities', 'builders'));
    }

    public function propertyDetails($uid, $slug)
    {
        $property = Property::where('slug', $slug)->where('unique_id', $uid)->firstOrFail();
        $recent_properties = $this->recentlyViewedProperties();
        $rules = PgRules::get();

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
        $project = Project::where('slug', $slug)->where('unique_id', $uid)->firstOrFail();
        $configurations = Configration::get();
        $advertisement = Advertisement::where('status', 1)->limit(1)->inRandomOrder()->first();

        return view('front.projects.single', compact('project', 'configurations', 'advertisement'));
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function blogList()
    {
        $blogs = Post::get();
        return view('front.news.index', compact('blogs'));
    }

    public function blogDetails($slug)
    {
        $blog = Post::where('slug', $slug)->firstOrFail();
        $blogs = Post::get();

        return view('front.news.single', compact('blog', 'blogs'));
    }

    public function page($slug)
    {
        $page_id = Slug::where('key', $slug)->pluck('reference_id')->firstOrFail();
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
        } else {
            // Fetch filtered properties
            $items = $this->searchProperties($request);
        }

        // Render the view with the items
        return view('front.shortcuts.filters.search-suggestion', compact('items'))->render();
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
}
