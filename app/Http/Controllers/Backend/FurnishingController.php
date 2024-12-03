<?php

namespace App\Http\Controllers\Backend;

use Botble\Base\Events\BeforeEditContentEvent;
use Botble\Base\Events\CreatedContentEvent;
use Botble\Base\Events\DeletedContentEvent;
use Botble\Base\Events\UpdatedContentEvent;
use Botble\RealEstate\Forms\FurnishingForm;
use Botble\RealEstate\Http\Requests\FurnishingRequest;
use Botble\RealEstate\Models\Furnishing;
use Botble\RealEstate\Repositories\Interfaces\FurnishingInterface;
use Botble\RealEstate\Tables\FurnishingTable;
use Botble\Media\Models\MediaFile;
use Exception;
use Illuminate\Http\Request;

class FurnishingController extends BaseController
{
    public function __construct(protected FurnishingInterface $furnishingRepository)
    {
        parent::__construct();

        $this
            ->breadcrumb()
            ->add(trans('plugins/real-estate::furnishing.name'), route('furnishing.index'));
    }

    public function index(FurnishingTable $dataTable)
    {
        $this->pageTitle(trans('plugins/real-estate::furnishing.name'));

        return $dataTable->renderTable();
    }

    public function create()
    {
        $this->pageTitle(trans('plugins/real-estate::furnishing.create'));

        return FurnishingForm::create()->renderForm();
    }

    public function store(FurnishingRequest $request)
    {
        $furnishing = $this->furnishingRepository->create($request->all());

        if ($request->input('icon')) {
            $furnishing->icon = MediaFile::query()
                ->where('url', $request->input('icon'))
                ->value('id');
        } else {
            $furnishing->icon = null;
        }
        $furnishing->save();
        
        event(new CreatedContentEvent(FEATURE_MODULE_SCREEN_NAME, $request, $furnishing));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('furnishing.index'))
            ->setNextUrl(route('furnishing.edit', $furnishing->id))
            ->setMessage(trans('core/base::notices.create_success_message'));
    }

    public function edit(int|string $id, Request $request)
    {
        $furnishing = Furnishing::query()->findOrFail($id);
        $this->pageTitle(trans('plugins/real-estate::furnishing.edit') . ' "' . $furnishing->name . '"');

        event(new BeforeEditContentEvent($request, $furnishing));

        return FurnishingForm::createFromModel($furnishing)->renderForm();
    }

    public function update(int|string $id, FurnishingRequest $request)
    {
        $furnishing = Furnishing::query()->findOrFail($id);

        $furnishing->fill($request->input());
        $furnishing->save();

        if ($request->input('icon')) {
            $furnishing->icon = MediaFile::query()
                ->where('url', $request->input('icon'))
                ->value('id');
        } else {
            $furnishing->icon = null;
        }
        $furnishing->save();
        event(new UpdatedContentEvent(FEATURE_MODULE_SCREEN_NAME, $request, $furnishing));

        return $this
            ->httpResponse()
            ->setPreviousUrl(route('furnishing.index'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }

    public function destroy(int|string $id, Request $request)
    {
        try {
            $furnishing = Furnishing::query()->findOrFail($id);
            $furnishing->delete();

            event(new DeletedContentEvent(FEATURE_MODULE_SCREEN_NAME, $request, $furnishing));

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
