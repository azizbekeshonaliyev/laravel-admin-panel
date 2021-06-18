<?php

namespace App\Http\Controllers\Backend\Language;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domain\Language\Service\TranslationService;
use App\Domain\Language\Requests\TranslationStoreRequest;

class TranslationController extends Controller
{
    private $service;

    public function __construct(TranslationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(TranslationStoreRequest $request)
    {
        $this->service->create($request->except(['_token', '_method']));


        return redirect()->back()->with([
            'flash_success' => __('alerts.backend.translations.created'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
