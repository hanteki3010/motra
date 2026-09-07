<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    /**
     * Show form to edit estate contact details.
     */
    public function index()
    {
        $settings = ContactSetting::all()->keyBy('key');

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update estate contact details.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'trade_desk_email' => 'required|email|max:255',
            'retail_email' => 'required|email|max:255',
            'farm_visits' => 'required|string|max:255',
            'phone' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'headline' => 'nullable|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            ContactSetting::where('key', $key)->update(['value' => $value]);
        }

        return back()->with('success', 'Estate contact settings updated successfully and reflected on the live site.');
    }
}
