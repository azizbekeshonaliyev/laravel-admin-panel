<?php

namespace App\Http\Controllers\Backend\Partner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Domain\Partner\Entities\Partner;
use App\Http\Responses\RedirectResponse;
use App\Domain\Partner\Services\PartnerService;
use App\Domain\Partner\Requests\PartnerStoreRequest;
use App\Domain\Partner\Requests\PartnerUpdateRequest;

class PartnerController extends Controller
{
    private $service;

    private $view_location = 'backend.partners.';

    public function __construct(PartnerService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $partners = $this->service->findAll($request->all());

        $partners = $partners->paginate();

        return view($this->view_location.'index', [
            'partners' => $partners,
        ]);
    }

    public function create()
    {
        return view($this->view_location.'create');
    }

    public function store(PartnerStoreRequest $request)
    {
        $this->service->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.partners.index'), ['flash_success' => __('alerts.backend.partners.created')]);
    }

    public function show($id)
    {
        //
    }

    public function edit(Partner $partner)
    {
        return view($this->view_location.'edit', [
            'partner' => $partner,
        ]);
    }

    public function update(PartnerUpdateRequest $request, Partner $partner)
    {
        $this->service->update($partner, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.partners.index'), ['flash_success' => __('alerts.backend.partners.updated')]);
    }

    public function destroy(Partner $partner)
    {
        $this->service->delete($partner);

        return new RedirectResponse(route('admin.partners.index'), ['flash_success' => __('alerts.backend.partners.deleted')]);
    }
}
