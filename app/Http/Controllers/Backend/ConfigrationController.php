<?php

namespace App\Http\Controllers\Backend;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\RealEstate\Forms\ConfigrationFieldForm;
use Botble\RealEstate\Http\Requests\FacilityRequest;
use Botble\RealEstate\Models\Configration;
use Botble\RealEstate\Repositories\Interfaces\FacilityInterface;
use Botble\RealEstate\Tables\ConfigrationFieldTable;
use Exception;
use Illuminate\Http\Request;
use Botble\Media\Models\MediaFile;

class ConfigrationController extends BaseController
{
    public function __construct(protected FacilityInterface $facilityRepository)
    {
        parent::__construct();

        $this
            ->breadcrumb()
            ->add(trans('plugins/real-estate::configration.name'), route('configration.index'));
    }

    public function index(ConfigrationFieldTable $table)
    {
        $this->pageTitle(trans('plugins/real-estate::configration.name'));

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/real-estate::configration.create'));

        return ConfigrationFieldForm::create()->renderForm();
    }

    public function store(FacilityRequest $request)
    {
        $config = Configration::query()->create($request->input());


        // Check if an icon URL is provided
        if ($request->input('icon')) {
            // Get the media file ID based on the icon URL
            $iconId = MediaFile::query()
                ->where('url', $request->input('icon'))
                ->value('id');

            // Assign the icon ID to the facility
            $config->icon = $iconId;
        } else {
            // Set the icon attribute to null if no icon is provided
            $config->icon = null;
        }

        // Save the updated facility object
        $config->save();


        event(new CreatedContentEvent(FACILITY_MODULE_SCREEN_NAME, $request, $config));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('configration.index'))
            ->setNextUrl(route('configration.edit', $config->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(int|string $id, Request $request)
    {
        $config = Configration::query()->findOrFail($id);

        event(new BeforeEditContentEvent($request, $config));

        $this->pageTitle(trans('plugins/real-estate::configration.edit') . ' "' . $config->name . '"');

        return ConfigrationFieldForm::createFromModel($config)->renderForm();
    }

    public function update(int|string $id, FacilityRequest $request)
    {
        $config = Configration::query()->findOrFail($id);

        $config->fill($request->input());
        $config->save();


        if ($request->input('icon')) {
            // Get the media file ID based on the icon URL
            $iconId = MediaFile::query()
                ->where('url', $request->input('icon'))
                ->value('id');

            // Assign the icon ID to the facility
            $config->icon = $iconId;
        } else {
            // Set the icon attribute to null if no icon is provided
            $config->icon = null;
        }

        // Save the updated facility object
        $config->save();

        event(new UpdatedContentEvent(FACILITY_MODULE_SCREEN_NAME, $request, $config));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('configration.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(int|string $id, Request $request)
    {
        try {
            $config = Configration::query()->findOrFail($id);

            $config->delete();

            event(new DeletedContentEvent(FACILITY_MODULE_SCREEN_NAME, $request, $config));

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
