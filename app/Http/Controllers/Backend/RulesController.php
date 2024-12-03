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
use Botble\RealEstate\Forms\RulesForm;
use Botble\RealEstate\Models\PgRules;
use Botble\RealEstate\Tables\RulesTable;

class RulesController extends BaseController
{
    public function __construct(protected FacilityInterface $facilityRepository)
    {
        parent::__construct();

        $this
            ->breadcrumb()
            ->add('Rules', route('rules.index'));
    }

    public function index(RulesTable $table)
    {
        $this->pageTitle('Rules');

        return $table->renderTable();
    }

    public function create()
    {
        $this->pageTitle('Rule Create');

        return RulesForm::create()->renderForm();
    }

    public function store(FacilityRequest $request)
    {
        $rule = PgRules::query()->create($request->input());


        // Check if an icon URL is provided
        if ($request->input('icon')) {
            // Get the media file ID based on the icon URL
            $iconId = MediaFile::query()
                ->where('url', $request->input('icon'))
                ->value('id');

            // Assign the icon ID to the facility
            $rule->icon = $iconId;
        } else {
            // Set the icon attribute to null if no icon is provided
            $rule->icon = null;
        }

        // Save the updated facility object
        $rule->save();


        // event(new CreatedContentEvent(FACILITY_MODULE_SCREEN_NAME, $request, $facility));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('rules.index'))
            ->setNextUrl(route('rules.edit', $rule->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(int|string $id, Request $request)
    {
        $rule = PgRules::query()->findOrFail($id);

        event(new BeforeEditContentEvent($request, $rule));

        $this->pageTitle('Rule Edit' . ' "' . $rule->name . '"');

        return RulesForm::createFromModel($rule)->renderForm();
    }

    public function update(int|string $id, FacilityRequest $request)
    {
        $rule = PgRules::query()->findOrFail($id);

        $rule->fill($request->input());
        $rule->save();


        if ($request->input('icon')) {
            // Get the media file ID based on the icon URL
            $iconId = MediaFile::query()
                ->where('url', $request->input('icon'))
                ->value('id');

            // Assign the icon ID to the facility
            $rule->icon = $iconId;
        } else {
            // Set the icon attribute to null if no icon is provided
            $rule->icon = null;
        }

        // Save the updated facility object
        $rule->save();

        event(new UpdatedContentEvent(FACILITY_MODULE_SCREEN_NAME, $request, $rule));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('facility.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(int|string $id, Request $request)
    {
        try {
            $rule = PgRules::query()->findOrFail($id);

            $rule->delete();

            event(new DeletedContentEvent(FACILITY_MODULE_SCREEN_NAME, $request, $rule));

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
