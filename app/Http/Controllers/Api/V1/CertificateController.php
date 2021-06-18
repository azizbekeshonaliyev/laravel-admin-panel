<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Domain\Certificate\Entities\Certificate;
use App\Domain\Certificate\Services\CertificateService;
use App\Domain\Certificate\Resources\CertificateResource;

class CertificateController extends Controller
{
    private $service;

    public function __construct(CertificateService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $collection = $this->service->retrieveList($request->all());

        return CertificateResource::collection($collection);
    }

    public function show(Certificate $certificate)
    {
        return new CertificateResource($certificate);
    }
}
