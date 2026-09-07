<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactSetting;

class HomeController extends Controller
{
    /**
     * Show the application landing page.
     */
    public function index()
    {
        $settings = ContactSetting::pluck('value', 'key')->toArray();

        return view('index', compact('settings'));
    }
}
