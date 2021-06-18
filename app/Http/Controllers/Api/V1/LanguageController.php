<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Language\Resources\LanguageResource;
use App\Domain\Language\Service\LanguageService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{

    private $service;

    public function __construct(LanguageService $service)
    {
        $this->service = $service;
    }


    public function index(Request $request)
    {
        $collection = $this->service->retrieveList($request->all());

        return LanguageResource::collection($collection);

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
