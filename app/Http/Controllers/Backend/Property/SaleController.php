<?php

namespace App\Http\Controllers\Property;

use App\Http\Controllers\Fronts\BaseController;;
use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\Base\Facades\Assets;
use Botble\Location\Models\Country;
use Botble\Location\Models\State;
use Botble\RealEstate\Facades\RealEstateHelper;
use Botble\RealEstate\Forms\Property\SaleForm as PropertyForm;
use Botble\RealEstate\Http\Requests\PropertyRequest;
use Botble\RealEstate\Models\Account;
use Botble\RealEstate\Models\CustomFieldValue;
use Botble\RealEstate\Models\Property;
use Botble\RealEstate\Services\SaveFacilitiesService;
use Botble\RealEstate\Services\StorePropertyCategoryService;
use Botble\RealEstate\Tables\Property\SaleTable as PropertyTable;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Botble\Media\Models\MediaFile;

class SaleController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

        $this
            ->breadcrumb()
            ->add(trans('plugins/real-estate::property.sale.name'), route('property.sale.index'));
    }

    public function index(PropertyTable $dataTable)
    {
        $this->pageTitle(trans('plugins/real-estate::property.sale.name'));

        return $dataTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/real-estate::property.sale.create'));

        return PropertyForm::create()->renderForm();
    }

    public function store(
        PropertyRequest $request,
        StorePropertyCategoryService $propertyCategoryService,
        SaveFacilitiesService $saveFacilitiesService
    ) {
        $request->merge([
            'expire_date' => Carbon::now()->addDays(RealEstateHelper::propertyExpiredDays()),
            'images' => array_filter($request->input('images', [])),
            'author_type' => Account::class,
        ]);

        $country = Country::query()->where('name','India')->pluck('id')->first();
        $state = State::query()->where('name','Karnataka')->pluck('id')->first();

        $request->merge(['country_id' => $country,'state_id' => $state]);

        $property = new Property();
        $property = $property->fill($request->input());
        $property->moderation_status = $request->input('moderation_status');
        $property->never_expired = $request->input('never_expired') ?? 1;
        $property->construction_status = $request->input('construction_status') ?? null;
        $property->type = 'sell';
        if ($request->input('video')) {
            $property->video = MediaFile::query()
                ->where('url', $request->input('video'))
                ->value('id');
        } else {
            $property->video = null;
        }
        
        $property->save();

        event(new CreatedContentEvent(PROPERTY_MODULE_SCREEN_NAME, $request, $property));

        if (RealEstateHelper::isEnabledCustomFields()) {
            $this->saveCustomFields($property, $request->input('custom_fields', []));
        }

        $property->features()->sync($request->input('features', []));

        $property->furnishing()->sync($request->input('furnishing', []));

        $saveFacilitiesService->execute($property, $request->input('facilities', []));

        $propertyCategoryService->execute($request, $property);

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('property.sale.index'))
            ->setNextUrl(route('property.sale.edit', $property->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(int|string $id, Request $request)
    {
        $property = Property::query()->with(['features', 'author'])->findOrFail($id);

        Assets::addScriptsDirectly(['vendor/core/plugins/real-estate/js/duplicate-property.js']);

        $this->pageTitle(trans('plugins/real-estate::property.sale.edit') . ' "' . $property->name . '"');

        event(new BeforeEditContentEvent($request, $property));

        return PropertyForm::createFromModel($property)->renderForm();
    }

    public function update(
        int|string $id,
        PropertyRequest $request,
        StorePropertyCategoryService $propertyCategoryService,
        SaveFacilitiesService $saveFacilitiesService
    ) {


        if(isset($request->videos)){
            $baseStoragePath = env('APP_URL') . '/storage/'; 
            $shortenedVideoPath = str_replace($baseStoragePath, '', $request->videos);
        }
        else{
            $shortenedVideoPath = '';
        }

        
        //   $request->merge(['city_id' => 6]);
        $property = Property::query()->findOrFail($id);
        $property->fill($request->except(['expire_date']));

        $property->author_type = Account::class;
        $property->images = array_filter($request->input('images', []));
        $property->moderation_status = $request->input('moderation_status');
        $property->never_expired = $request->input('never_expired') ?? 1;
        $property->construction_status = $request->input('construction_status');
        $property->type = 'sell';

        $country = Country::query()->where('name','India')->pluck('id')->first();
        $state = State::query()->where('name','Karnataka')->pluck('id')->first();

        $property->state_id = $state;
        $property->country_id = $country;

        if ($request->input('videos')) {
            $property->video = MediaFile::query()
                ->where('url', $shortenedVideoPath)
                ->value('id');
        } else {
            $property->video = null;
        }

        $property->save();

        event(new UpdatedContentEvent(PROPERTY_MODULE_SCREEN_NAME, $request, $property));

        if (RealEstateHelper::isEnabledCustomFields()) {
            $this->saveCustomFields($property, $request->input('custom_fields', []));
        }

        $property->features()->sync($request->input('features', []));

        $property->furnishing()->sync($request->input('furnishing', []));

        $saveFacilitiesService->execute($property, $request->input('facilities', []));

        $propertyCategoryService->execute($request, $property);

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('property.sale.index'))
            ->setNextUrl(route('property.sale.edit', $property->id))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(int|string $id, Request $request)
    {
        try {
            $property = Property::query()->findOrFail($id);
            $property->delete();

            event(new DeletedContentEvent(PROPERTY_MODULE_SCREEN_NAME, $request, $property));

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

    protected function saveCustomFields(Property $property, array $customFields = []): void
    {
        $customFields = CustomFieldValue::formatCustomFields($customFields);

        $property->customFields()
            ->whereNotIn('id', collect($customFields)->pluck('id')->all())
            ->delete();

        $property->customFields()->saveMany($customFields);
    }
}
