<?php

namespace App\Http\Controllers\Backend\Setting;

use Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Responses\RedirectResponse;

class SettingController extends Controller
{
    private $view_location = 'backend.settings.';

    public function index()
    {
        return view($this->view_location.'edit');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::table('settings')->delete();

        if (isset($request['settings'])) {
            foreach ($request['settings'] as $setting) {
                setting()->set($setting['key'],$setting['value']);
            }
        }
        
        setting()->save();

        return new RedirectResponse(route('admin.settings.index'), ['flash_success' => __('alerts.backend.settings.created')]);
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
