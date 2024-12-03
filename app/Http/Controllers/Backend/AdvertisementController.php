<?php

namespace App\Http\Controllers\Backend;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\RealEstate\Forms\FacilityForm;
use Botble\RealEstate\Http\Requests\FacilityRequest;
use Botble\RealEstate\Models\Facility;
use Botble\RealEstate\Repositories\Interfaces\FacilityInterface;
use Botble\RealEstate\Tables\FacilityTable;
use Exception;
use Illuminate\Http\Request;
use Botble\Media\Models\MediaFile;

class AdvertisementController extends BaseController
{
    public function __construct(protected FacilityInterface $facilityRepository)
    {
        parent::__construct();

        $this
            ->breadcrumb()
            ->add(trans('plugins/real-estate::landmarks.name'), route('facility.index'));
    }

    public function index(FacilityTable $table)
    {
        $this->pageTitle(trans('plugins/real-estate::landmarks.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/real-estate::landmarks.create'));

        return FacilityForm::create()->renderForm();
    }

    public function store(FacilityRequest $request)
    {
        $facility = Facility::query()->create($request->input());


        // Check if an icon URL is provided
        if ($request->input('icon')) {
            // Get the media file ID based on the icon URL
            $iconId = MediaFile::query()
                ->where('url', $request->input('icon'))
                ->value('id');

            // Assign the icon ID to the facility
            $facility->icon = $iconId;
        } else {
            // Set the icon attribute to null if no icon is provided
            $facility->icon = null;
        }

        // Save the updated facility object
        $facility->save();


        event(new CreatedContentEvent(FACILITY_MODULE_SCREEN_NAME, $request, $facility));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('facility.index'))
            ->setNextUrl(route('facility.edit', $facility->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(int|string $id, Request $request)
    {
        $facility = Facility::query()->findOrFail($id);

        event(new BeforeEditContentEvent($request, $facility));

        $this->pageTitle(trans('plugins/real-estate::landmarks.edit') . ' "' . $facility->name . '"');

        return FacilityForm::createFromModel($facility)->renderForm();
    }

    public function update(int|string $id, FacilityRequest $request)
    {
        $facility = Facility::query()->findOrFail($id);

        $facility->fill($request->input());
        $facility->save();


        if ($request->input('icon')) {
            // Get the media file ID based on the icon URL
            $iconId = MediaFile::query()
                ->where('url', $request->input('icon'))
                ->value('id');

            // Assign the icon ID to the facility
            $facility->icon = $iconId;
        } else {
            // Set the icon attribute to null if no icon is provided
            $facility->icon = null;
        }

        // Save the updated facility object
        $facility->save();

        event(new UpdatedContentEvent(FACILITY_MODULE_SCREEN_NAME, $request, $facility));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('facility.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(int|string $id, Request $request)
    {
        try {
            $facility = Facility::query()->findOrFail($id);

            $facility->delete();

            event(new DeletedContentEvent(FACILITY_MODULE_SCREEN_NAME, $request, $facility));

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
}
