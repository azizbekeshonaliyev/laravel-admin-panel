<?php

namespace App\Http\Controllers\Backend\Topic;

use App\Domain\Topic\Requests\TopicStoreRequest;
use App\Domain\Topic\Requests\TopicUpdateRequest;
use App\Domain\Topic\Services\TopicService;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;
use Domain\Topic\Entities\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    private $service;

    private $view_location = 'backend.topics.';

    public function __construct(TopicService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $topics = $this->service->findAll($request->all());

        $topics = $topics->latest()->paginate();

        return view($this->view_location.'index', [
            'topics' => $topics,
        ]);
    }

    public function create()
    {
        return view($this->view_location.'create');
    }

    public function store(TopicStoreRequest $request)
    {
        $this->service->create($request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.topics.index'), ['flash_success' => __('alerts.backend.topics.created')]);
    }

    public function show($id)
    {
        //
    }

    public function edit(Topic $topic)
    {
        return view($this->view_location.'edit', [
            'topic' => $topic,
        ]);
    }

    public function update(TopicUpdateRequest $request, Topic $topic)
    {
        $this->service->update($topic, $request->except(['_token', '_method']));

        return new RedirectResponse(route('admin.topics.index'), ['flash_success' => __('alerts.backend.topics.updated')]);
    }

    public function destroy(Topic $topic)
    {
        $this->service->delete($topic);

        return new RedirectResponse(route('admin.topics.index'), ['flash_success' => __('alerts.backend.topics.deleted')]);
    }
}
