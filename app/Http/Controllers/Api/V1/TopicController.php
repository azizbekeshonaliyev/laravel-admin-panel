<?php

namespace App\Http\Controllers\Api\V1;

use App\Domain\Topic\Resources\TopicResource;
use App\Domain\Topic\Services\TopicService;
use App\Http\Controllers\Controller;
use Domain\Topic\Entities\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    private $service;

    public function __construct(TopicService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $collection = $this->service->retrieveList($request->all());

        return TopicResource::collection($collection);
    }

    public function show(Topic $topic)
    {
        return new TopicResource($topic);
    }

}
