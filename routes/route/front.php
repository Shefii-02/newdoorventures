<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = \App\Models\Category::where('status', 'published')->get();
    $featured_properties = \App\Models\Property::where('moderation_status', 'approved')->get();

    $featured_project = \App\Models\Project::get();

    $recent_viwed_properties = recentlyViewedProperties();
    $latest_blogs = \App\Models\Blogs\Post::Limit(4)->get();

    return view('front.index', compact('categories', 'featured_properties', 'featured_project', 'recent_viwed_properties', 'latest_blogs'));
})->name('public.index');

Route::get('front', function () {
    $categories = \App\Models\Category::where('status', 'published')->get();
    $featured_properties = \App\Models\Property::where('moderation_status', 'approved')->get();

    $featured_project = \App\Models\Project::get();

    $recent_viwed_properties = recentlyViewedProperties();
    $latest_blogs = \App\Models\Blogs\Post::Limit(4)->get();

    return view('front.index', compact('categories', 'featured_properties', 'featured_project', 'recent_viwed_properties', 'latest_blogs'));
})->name('public.index');


function recentlyViewedProperties()
{
    $cookieName = 'recently_viewed_properties';
    $jsonRecentlyViewedProperties = $_COOKIE[$cookieName] ?? null;

    if (!$jsonRecentlyViewedProperties) {
        return collect(); // Return empty collection
    }

    $propertyIds = collect(json_decode($jsonRecentlyViewedProperties))->pluck('id');

    // if (!$propertyIds) {
    return collect(); // Return empty collection
    // }


    // return $properties ?: collect(); // Ensure collection is returned
}

Route::get('properties', function (Request $request) {

    $query = \App\Models\Property::query();

    // Keyword search
    if ($request->filled('k')) {
        $query->where('name', 'LIKE', '%' . $request->k . '%')
            ->orWhere('content', 'LIKE', '%' . $request->k . '%');
    }

    // // City filter
    if ($request->filled('city') && $request->city !== 'null') {
        $query->where('locality', $request->city);
    }

    // // Category filter
    if ($request->filled('categories')) {
        $categories = explode(',', $request->categories);
        $query->whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('id', $categories);
        });
    }

    // // Budget filter
    if (($request->filled('min_price') && $request->filled('max_price')) &&
        is_numeric($request->min_price) && is_numeric($request->max_price) &&
        $request->min_price > 0 && $request->max_price > 0
    ) {
        $query->whereBetween('price', [$request->min_price, $request->max_price]);
    }

    if ($request->filled('type') && $request->type !== 'null') {
        if ($request->type == 'plot') {

            $query->whereHas('categories', function ($query) {
                $query->where('name', 'Plot and Land');
            });
        } else {
            $query->where('type', $request->type);
        }
    }



    // // Bedrooms filter
    if ($request->filled('bedrooms')) {
        $bedrooms = explode(',', $request->bedrooms);
        $query->whereIn('number_bedroom', $bedrooms);
    }

    // // Ownership filter
    if ($request->filled('ownership')) {
        $ownership = explode(',', $request->ownership);
        $query->whereIn('ownership', $ownership);
    }

    // // Furnishing filter
    if ($request->filled('furnishing')) {
        $furnishing = explode(',', $request->furnishing);
        $query->whereIn('furnishing_status', $furnishing);
    }

    // // Builders filter
    // if ($request->filled('builder')) {

    //     $builders = explode(',', $request->builders); 

    //     $query->whereHas('builder', function ($q) use ($builders) {
    //         $q->whereIn('name', $builders);
    //     });
    // }

    if ($request->filled('purpose')) {

        $purpose = explode(',', $request->purpose);
        $query->whereIn('mode', $purpose);
    }


    // Execute query and get results
    $properties = $query->get();

    // Additional data for filters




    if ($request->ajax()) {
        $html = view('front.shortcuts.properties.items', compact('properties'))->render();
        return response()->json(['html' => $html]);
    }

    $builders = \App\Models\Investor::get();

    $cities = \App\Models\Property::groupBy('locality')->pluck('locality');

    $categories = \App\Models\Category::where('status', 'published')->get();

    return view('front.properties.index',  compact('properties', 'categories', 'cities', 'builders'));
})->name('public.properties');

Route::get('projects', function (Request $request) {
    $categories = \App\Models\Category::where('status', 'published')->get();
    $query = \App\Models\Project::query();

    // Keyword search
    if ($request->filled('k')) {
        $query->where('name', 'LIKE', '%' . $request->k . '%')
            ->orWhere('city', 'LIKE', '%' . $request->k . '%')
            ->orWhere('locality', 'LIKE', '%' . $request->k . '%')
            ->orWhere('content', 'LIKE', '%' . $request->k . '%');
    }

    // // City filter
    if ($request->filled('city') && $request->city !== 'null') {
        $query->where('locality', $request->city);
    }

    // // Category filter
    if ($request->filled('categories')) {
        $categories = explode(',', $request->categories);
        $query->whereHas('categories', function ($query) use ($categories) {
            $query->whereIn('id', $categories);
        });
    }

    // // Budget filter
    if (($request->filled('min_price') && $request->filled('max_price')) &&
        is_numeric($request->min_price) && is_numeric($request->max_price) &&
        $request->min_price > 0 && $request->max_price > 0
    ) {
        $query->whereBetween('price', [$request->min_price, $request->max_price]);
    }


    // // Ownership filter
    if ($request->filled('ownership')) {
        $ownership = explode(',', $request->ownership);
        $query->whereIn('ownership', $ownership);
    }

    // // Builders filter
    if ($request->filled('builder')) {

        $builders = explode(',', $request->builders);

        $query->whereHas('builder', function ($q) use ($builders) {
            $q->whereIn('name', $builders);
        });
    }

    if ($request->filled('rera')) {

        $rera = explode(',', $request->rera);
        $query->whereIn('rera_status', $rera);
    }


    // Execute query and get results
    $projects = $query->get();

    // Additional data for filters

    if ($request->ajax()) {
        $html = view('front.shortcuts.projects.items', compact('projects'))->render();
        return response()->json(['html' => $html]);
    }


    $cities     = \App\Models\Project::groupby('locality')->pluck('locality');
    $builders   = \App\Models\Investor::get();

    return view('front.projects.index', compact('projects', 'categories', 'cities', 'builders'));
})->name('public.projects');

Route::get('projects/{uid}/{slug}', function ($uid, $slug) {
    $project = App\Models\Project::where('slug', $slug)->where('unique_id', $uid)->first() ?? abort(404);
    $configrations = App\Models\Configration::get();
    $advertisement = App\Models\Advertisement::where('status', 1)->Limit(1)->inRandomOrder()->first();
    return view('front.projects.single', compact('project', 'configrations', 'advertisement'));
})->name('public.project_single');


Route::get('properties/{uid}/{slug}', function ($uid, $slug) {
    $property = App\Models\Property::where('slug', $slug)->where('unique_id', $uid)->first() ?? abort(404);
    $recent_properties = recentlyViewedProperties();


    $rules = App\Models\PgRules::get();

    if ($property->category && $property->category->name == 'Plot and Land') {

        return view('front.properties.plot-property', compact('property', 'recent_properties',));
    } else {
        if ($property->type == 'sell' || $property->type == 'rent') {
            return view('front.properties.single', compact('property', 'recent_properties'));
        } elseif ($property->type == 'pg') {
            return view('front.properties.pg-single', compact('property', 'recent_properties', 'rules'));
        }
    }
})->name('public.property_single');



Route::post('newsletter/subscribe', function () {
    return view('front.index', compact('property'));
})->name('newsletter.subscribe');




Route::get('news', function () {
    $blogs = App\Models\Blogs\Post::get();
    return view('front.news.index', compact('blogs'));
})->name('public.news');

Route::get('news/{slug}', function ($slug) {
    $blogs = App\Models\Blogs\Post::get();
    $blog = App\Models\Blogs\Post::first();
    return view('front.news.single', compact('blog', 'blogs'));
})->name('public.blog_single');



Route::get('contact', function () {
    return view('front.contact');
})->name('public.contact');



Route::post('send/consult', function () {
    return view('front.news', compact('page'));
})->name('public.send.consult');




Route::get('{slug}', function ($slug) {

    $page_id = App\Models\Slug::where('key', $slug)->pluck('reference_id')->first() ?? abort(404);
    $page = App\Models\Page::where('id', $page_id)->first();

    return view('front.page', compact('page'));
})->name('public.page');
