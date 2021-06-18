<?php

namespace App\Http\Controllers\Backend\Certificate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use Domain\Certificate\Entities\Certificate;
use App\Domain\Certificate\Services\CertificateService;
use App\Domain\Certificate\Requests\CertificateStoreRequest;
use App\Domain\Certificate\Requests\CertificateUpdateRequest;

class CertificateController extends Controller
{
    private $service;

    private $view_location = 'backend.certificates.';

    public function __construct(CertificateService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $certificates = $this->service->findAll($request->all());

        $certificates = $certificates->paginate();

        return view($this->view_location.'index', [
            'certificates' => $certificates,
        ]);
    }

    public function create()
    {
        return view($this->view_location.'create');
    }

    public function store(CertificateStoreRequest $request)
    {
        $this->service->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.certificates.index'), ['flash_success' => __('alerts.backend.certificates.created')]);
    }

    public function show($id)
    {
        //
    }

    public function edit(Certificate $certificate)
    {
        return view($this->view_location.'edit', [
            'certificate' => $certificate,
        ]);
    }

    public function update(CertificateUpdateRequest $request, Certificate $certificate)
    {
        $this->service->update($certificate, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.certificates.index'), ['flash_success' => __('alerts.backend.certificates.updated')]);
    }

    public function destroy(Certificate $certificate)
    {
        $this->service->delete($certificate);

        return new RedirectResponse(route('admin.certificates.index'), ['flash_success' => __('alerts.backend.certificates.deleted')]);
    }
}
