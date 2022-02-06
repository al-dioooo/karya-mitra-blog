<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index(Request $request)
    {
        if (array_key_exists($request->lang, config()->get('app.locales'))) {

            session()->put('lang', $request->lang);
            return redirect()->back();

        } else {

            session()->flash('flash.banner', 'Language not supported');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect()->back();
        }
    }
}
