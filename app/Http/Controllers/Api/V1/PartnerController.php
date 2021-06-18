<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Domain\Partner\Entities\Partner;
use App\Domain\Partner\Services\PartnerService;
use App\Domain\Partner\Resources\PartnerResource;

class PartnerController extends Controller
{
    private $service;

    public function __construct(PartnerService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $collection = $this->service->retrieveList($request->all());

        return PartnerResource::collection($collection);
    }

    public function show(Partner $partner)
    {
        return new PartnerResource($partner);
    }
}
