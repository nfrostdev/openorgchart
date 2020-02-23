<?php

namespace App\Http\Controllers;

use App\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        return view('site-settings');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            // This regex has a pipe in it, so the rule has to be an array.
            'color' => ['required', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
        ]);

        SiteSetting::where('name', 'SITE_TITLE')->update(['value' => $data['title']]);
        SiteSetting::where('name', 'SITE_COLOR')->update(['value' => $data['color']]);

        return redirect()->route('settings.index');
    }
}
