<?php

namespace App\Http\Controllers\Frontend;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\EmailHandler;
use App\Http\Controllers\Frontend\BaseController;
use Botble\Base\Supports\RepositoryHelper;
use Botble\Location\Models\City;
use Botble\Location\Models\State;
use Botble\Media\Facades\RvMedia;
use Botble\Page\Models\Page;
use Botble\RealEstate\Facades\RealEstateHelper;
use Botble\RealEstate\Http\Requests\SendConsultRequest;
use Botble\RealEstate\Models\Account;
use Botble\RealEstate\Models\Advertisement;
use Botble\RealEstate\Models\Category;
use Botble\RealEstate\Models\Configration;
use Botble\RealEstate\Models\Consult;
use Botble\RealEstate\Models\Currency;
use Botble\RealEstate\Models\Investor;
use Botble\RealEstate\Models\PgRules;
use Botble\RealEstate\Models\Project;
use Botble\RealEstate\Models\Property;
use Botble\RealEstate\Repositories\Interfaces\ProjectInterface;
use Botble\RealEstate\Repositories\Interfaces\PropertyInterface;
use Botble\RssFeed\Facades\RssFeed;
use Botble\RssFeed\FeedItem;
use Botble\SeoHelper\Facades\SeoHelper;
use Botble\Slug\Facades\SlugHelper;
use Botble\Theme\Facades\Theme;
use Exception;
use Botble\Theme\Events\RenderingSingleEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Mimey\MimeTypes;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Botble\Base\Http\Responses\BaseHttpResponse;

class PublicController extends BaseController
{
    public function postSendConsult(
        SendConsultRequest $request,
        PropertyInterface $propertyRepository,
        ProjectInterface $projectRepository
    ) {
        try {
            $sendTo = null;
            $link = null;
            $subject = null;

            if ($request->input('type') == 'project') {
                $request->merge(['project_id' => $request->input('data_id')]);
                $project = $projectRepository->findById($request->input('data_id'));
                if ($project) {
                    $link = $project->url;
                    $subject = $project->name;
                }
            } else {
                $request->merge(['property_id' => $request->input('data_id')]);
                $property = $propertyRepository->findById($request->input('data_id'), ['author']);
                if ($property) {
                    $link = $property->url;
                    $subject = $property->name;

                    if ($property->author->email) {
                        $sendTo = $property->author->email;
                    }
                }
            }

            $ipAddress = $request->ip();

            $consult = Consult::query()->create(array_merge($request->input(), ['ip_address' => $ipAddress]));

            EmailHandler::setModule(REAL_ESTATE_MODULE_SCREEN_NAME)
                ->setVariableValues([
                    'consult_name' => $consult->name,
                    'consult_email' => $consult->email,
                    'consult_phone' => $consult->phone,
                    'consult_content' => $consult->content,
                    'consult_link' => $link,
                    'consult_subject' => $subject,
                    'consult_ip_address' => $consult->ip_address,
                ])
                ->sendUsingTemplate('notice', $sendTo);

            return $this
                ->httpResponse()
                ->setMessage(trans('plugins/real-estate::consult.email.success'));
        } catch (Exception $exception) {
            info($exception->getMessage());

            return $this
                ->httpResponse()
                ->setError()
                ->setMessage(trans('plugins/real-estate::consult.email.failed'));
        }
    }

    public function getProjects(Request $request)
    {
        SeoHelper::setTitle(__('Projects'));

        $projects = RealEstateHelper::getProjectsFilter((int)theme_option('number_of_projects_per_page') ?: 12, RealEstateHelper::getReviewExtraData());

        if ($request->ajax()) {
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $projects]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('real-estate.projects.items', compact('projects')));
        }

        return Theme::scope('real-estate.projects', compact('projects'))->render();
    }

    public function getProperties(Request $request)
    {

        SeoHelper::setTitle(__('Properties'));

        $properties = RealEstateHelper::getPropertiesFilter((int)theme_option('number_of_properties_per_page') ?: 12, RealEstateHelper::getReviewExtraData());

        if ($request->ajax()) {
            if ($request->query('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $properties]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('real-estate.properties.items', compact('properties')));
        }

        return Theme::scope('real-estate.properties', compact('properties'))->render();
    }


    public function plotSingle($slug)
    {

        $property = Property::where('id', 1)->first();


        return view(Theme::getThemeNamespace('views.real-estate.plot-property'), ['property' => $property,]);
    }



    public function properties(Request $request)
    {
        $query = Property::query();

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
            $request->min_price > 0 && $request->max_price > 0) {
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
            $html = view('theme.hously::partials.real-estate.properties.items', compact('properties'))->render();
            return response()->json(['html' => $html]);
        }
    
        $builders = Investor::get();
        $categories = Category::get();
        $cities = Property::groupBy('locality')->pluck('locality');

        return view('plugins/real-estate::themes.frontend.properties.index', compact('properties', 'categories', 'cities', 'builders'));
    }



    public function projects(Request $request)
    {
       
        $query = Project::query();

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
            $request->min_price > 0 && $request->max_price > 0) {
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
            $query->whereIn('rera', $rera);
        }
        

        // Execute query and get results
        $projects = $query->get();

        // Additional data for filters
       
        if ($request->ajax()) {
            $html = view('theme.hously::partials.real-estate.projects.items', compact('projects'))->render();
            return response()->json(['html' => $html]);
        }


        $categories = Category::get();
        $cities     = Project::groupby('locality')->pluck('locality');
        $builders   = Investor::get();
        return view('plugins/real-estate::themes.frontend.projects.index', compact('projects', 'categories', 'cities', 'builders'));
    }


    public function property_single(Request $request, $uid, $slug)
    {
        $property = Property::where('slug', $slug)->where('unique_id', $uid)->first() ?? abort(404);
        $recent_properties = $this->recentlyViewedProperties();
        $relatedProperties  = app(PropertyInterface::class)->getRelatedProperties(
            $property->id,
            (int) theme_option('number_of_related_properties', 6),
            RealEstateHelper::getPropertyRelationsQuery(),
            RealEstateHelper::getReviewExtraData(),
        );

        $rules = PgRules::get();

        if ($property->category && $property->category->name == 'Plot and Land') {

            return view('plugins/real-estate::themes.frontend.properties.plot-property', compact('property', 'recent_properties', 'relatedProperties'));
        } else {
            if ($property->type == 'sell' || $property->type == 'rent') {
                return view('plugins/real-estate::themes.frontend.properties.single', compact('property', 'recent_properties', 'relatedProperties'));
            } elseif ($property->type == 'pg') {
                return view('plugins/real-estate::themes.frontend.properties.pg-single', compact('property', 'recent_properties', 'relatedProperties', 'rules'));
            }
        }
    }

    public function project_single(Request $request, $uid, $slug)
    {
        $project = Project::where('slug', $slug)->where('unique_id', $uid)->first() ?? abort(404);
        $configrations = Configration::get();
        $advertisement = Advertisement::where('status', 1)->Limit(1)->inRandomOrder()->first();

        return view('plugins/real-estate::themes.frontend.projects.single', compact('project', 'configrations', 'advertisement'));
    }

    protected function recentlyViewedProperties()
    {
        $cookieName = 'recently_viewed_properties';
        $jsonRecentlyViewedProperties = $_COOKIE[$cookieName] ?? null;

        if (!$jsonRecentlyViewedProperties) {
            return collect(); // Return empty collection
        }

        $propertyIds = collect(json_decode($jsonRecentlyViewedProperties))->pluck('id');

        if (!$propertyIds) {
            return collect(); // Return empty collection
        }

        $properties = app(PropertyInterface::class)->advancedGet(array_merge([
            'condition' => [
                ['id', 'IN', $propertyIds],
            ],
        ], RealEstateHelper::getReviewExtraData()));

        return $properties ?: collect(); // Ensure collection is returned
    }

    public function pages(Request $request, $slug_val)
    {
        $slug = SlugHelper::getSlug($slug_val);

        $result = apply_filters(BASE_FILTER_PUBLIC_SINGLE_DATA, $slug);

        $extension = SlugHelper::getPublicSingleEndingURL();

        if ($extension) {
            $key = Str::replaceLast($extension, '', $slug_val);
        }

        if ($result instanceof BaseHttpResponse) {
            return $result;
        }

        if (isset($result['slug']) && $result['slug'] !== $slug_val) {
            $prefix = SlugHelper::getPrefix(get_class(Arr::first($result['data'])));

            return redirect()->route('public.single', empty($prefix) ? $result['slug'] : "$prefix/{$result['slug']}");
        }
        event(new RenderingSingleEvent($slug));

        if (! empty($result) && is_array($result)) {

            if (isset($result['view'])) {

                return Theme::scope($result['view'], $result['data'], Arr::get($result, 'default_view'))->render();
            }

            return $result;
        }
        abort(404);
    }


    public function changeCurrency(Request $request, $title = null)
    {
        if (empty($title)) {
            $title = $request->input('currency');
        }

        if (! $title) {
            return $this->httpResponse();
        }

        $currency = Currency::query()
            ->where('title', $title)
            ->first();

        if ($currency) {
            cms_currency()->setApplicationCurrency($currency);
        }

        return $this->httpResponse();
    }

    public function getPropertyFeeds(PropertyInterface $propertyRepository)
    {
        if (! is_plugin_active('rss-feed')) {
            abort(404);
        }

        $data = $propertyRepository->getProperties([], [
            'take' => 20,
            'with' => ['slugable', 'categories', 'author'],
        ]);

        $feedItems = collect();

        foreach ($data as $item) {
            $imageURL = RvMedia::getImageUrl($item->image, null, false, RvMedia::getDefaultImage());

            $feedItem = FeedItem::create()
                ->id($item->id)
                ->title(BaseHelper::clean($item->name))
                ->summary(BaseHelper::clean($item->description))
                ->updated($item->updated_at)
                ->enclosure($imageURL)
                ->enclosureType((new MimeTypes())->getMimeType(File::extension($imageURL)))
                ->enclosureLength(RssFeed::remoteFilesize($imageURL))
                ->category((string)$item->category->name)
                ->link((string)$item->url);

            if (method_exists($feedItem, 'author')) {
                $feedItem = $feedItem->author($item->author_id && $item->author->name ? $item->author->name : '');
            } else {
                $feedItem = $feedItem
                    ->authorName($item->author_id && $item->author->name ? $item->author->name : '')
                    ->authorEmail($item->author_id && $item->author->email ? $item->author->email : '');
            }

            $feedItems[] = $feedItem;
        }

        return RssFeed::renderFeedItems(
            $feedItems,
            'Properties feed',
            'Latest properties from ' . theme_option('site_title')
        );
    }

    public function getProjectFeeds(ProjectInterface $projectRepository)
    {
        if (! is_plugin_active('rss-feed')) {
            abort(404);
        }

        $data = $projectRepository->getProjects(
            [],
            [
                'take' => 20,
                'width' => ['categories'],
            ]
        );

        $feedItems = collect();

        foreach ($data as $item) {
            $imageURL = RvMedia::getImageUrl($item->image, null, false, RvMedia::getDefaultImage());

            $feedItem = FeedItem::create()
                ->id($item->id)
                ->title(BaseHelper::clean($item->name))
                ->summary(BaseHelper::clean($item->description))
                ->updated($item->updated_at)
                ->enclosure($imageURL)
                ->enclosureType((new MimeTypes())->getMimeType(File::extension($imageURL)))
                ->enclosureLength(RssFeed::remoteFilesize($imageURL))
                ->category((string) $item->category->name)
                ->link((string) $item->url);

            if (method_exists($feedItem, 'author')) {
                $feedItem = $feedItem->author($item->author_id && $item->author->name ? $item->author->name : '');
            } else {
                $feedItem = $feedItem
                    ->authorName($item->author_id && $item->author->name ? $item->author->name : '')
                    ->authorEmail($item->author_id && $item->author->email ? $item->author->email : '');
            }

            $feedItems[] = $feedItem;
        }

        return RssFeed::renderFeedItems(
            $feedItems,
            'Projects feed',
            'Latest projects from ' . theme_option('site_title')
        );
    }

    public function getProjectsByCity(string $slug, Request $request)
    {
        $city = City::query()->wherePublished()->where('slug', $slug)->firstOrFail();

        SeoHelper::setTitle(__('Projects in :city', ['city' => $city->name]));

        Theme::breadcrumb()
            ->add(SeoHelper::getTitle(), route('public.projects-by-city', $city->slug));

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, CITY_MODULE_SCREEN_NAME, $city);

        $perPage = $request->integer('per_page') ?: (int)theme_option('number_of_projects_per_page', 12);

        $request->merge(['city' => $slug]);

        $projects = RealEstateHelper::getProjectsFilter($perPage, RealEstateHelper::getReviewExtraData());

        if ($request->ajax()) {
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $projects]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('real-estate.projects.items', ['projects' => $projects]));
        }

        return Theme::scope('real-estate.projects', [
            'projects' => $projects,
            'ajaxUrl' => route('public.projects-by-city', $city->slug),
            'actionUrl' => route('public.projects-by-city', $city->slug),
        ])
            ->render();
    }

    public function getPropertiesByCity(string $slug, Request $request)
    {
        $city = City::query()->wherePublished()->where('slug', $slug)->firstOrFail();

        SeoHelper::setTitle(__('Properties in :city', ['city' => $city->name]));

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, CITY_MODULE_SCREEN_NAME, $city);

        Theme::breadcrumb()
            ->add(SeoHelper::getTitle(), route('public.properties-by-city', $city->slug));

        $perPage = $request->integer('per_page') ?: (int)theme_option('number_of_properties_per_page', 12);

        $request->merge(['city' => $slug]);

        $properties = RealEstateHelper::getPropertiesFilter($perPage, RealEstateHelper::getReviewExtraData());

        if ($request->ajax()) {
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $properties]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('real-estate.properties.items', ['properties' => $properties]));
        }

        return Theme::scope('real-estate.properties', [
            'properties' => $properties,
            'ajaxUrl' => route('public.properties-by-city', $city->slug),
            'actionUrl' => route('public.properties-by-city', $city->slug),
        ])
            ->render();
    }

    public function getProjectsByState(string $slug, Request $request)
    {
        $state = State::query()
            ->wherePublished()
            ->where('slug', $slug)
            ->firstOrFail();

        SeoHelper::setTitle(__('Projects in :state', ['state' => $state->name]));

        Theme::breadcrumb()
            ->add(SeoHelper::getTitle(), route('public.projects-by-city', $state->slug));

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, STATE_MODULE_SCREEN_NAME, $state);

        $perPage = $request->integer('per_page') ?: (int)theme_option('number_of_projects_per_page', 12);

        $request->merge(['state' => $slug]);

        $projects = RealEstateHelper::getProjectsFilter($perPage, RealEstateHelper::getReviewExtraData());

        if ($request->ajax()) {
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $projects]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('real-estate.projects.items', ['projects' => $projects]));
        }

        return Theme::scope('real-estate.projects', [
            'projects' => $projects,
            'ajaxUrl' => route('public.projects-by-state', $state->slug),
            'actionUrl' => route('public.projects-by-state', $state->slug),
        ])
            ->render();
    }

    public function getPropertiesByState(
        string $slug,
        Request $request
    ) {
        $state = State::query()
            ->wherePublished()
            ->where('slug', $slug)
            ->firstOrFail();

        SeoHelper::setTitle(__('Properties in :state', ['state' => $state->name]));

        do_action(BASE_ACTION_PUBLIC_RENDER_SINGLE, STATE_MODULE_SCREEN_NAME, $state);

        Theme::breadcrumb()
            ->add(SeoHelper::getTitle(), route('public.properties-by-state', $state->slug));

        $perPage = $request->integer('per_page') ?: (int)theme_option('number_of_properties_per_page', 12);

        $request->merge(['state' => $slug]);

        $properties = RealEstateHelper::getPropertiesFilter($perPage, RealEstateHelper::getReviewExtraData());

        if ($request->ajax()) {
            if ($request->input('minimal')) {
                return $this
                    ->httpResponse()
                    ->setData(Theme::partial('search-suggestion', ['items' => $properties]));
            }

            return $this
                ->httpResponse()
                ->setData(Theme::partial('real-estate.properties.items', ['properties' => $properties]));
        }

        return Theme::scope('real-estate.properties', [
            'properties' => $properties,
            'ajaxUrl' => route('public.properties-by-state', $state->slug),
            'actionUrl' => route('public.properties-by-state', $state->slug),
        ])
            ->render();
    }

    public function getAgents()
    {
        if (RealEstateHelper::isDisabledPublicProfile()) {
            abort(404);
        }

        $accounts = Account::query()
            ->where('is_public_profile', true)
            ->orderByDesc('id')
            ->withCount([
                'properties' => function ($query) {
                    return RepositoryHelper::applyBeforeExecuteQuery($query, $query->getModel());
                },
            ])
            ->with(['avatar'])
            ->paginate(12);

        SeoHelper::setTitle(__('Agents'));

        Theme::breadcrumb()->add(__('Agents'), route('public.agents'));

        return Theme::scope('real-estate.agents', compact('accounts'))->render();
    }
}
