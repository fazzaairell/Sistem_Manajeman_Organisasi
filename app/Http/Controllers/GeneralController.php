<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class GeneralController extends Controller
{
    public function organization()
    {
        $organization = Organization::first();
        return view('general.edit', compact('organization'));
    }

    public function updateOrganization(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'short_name' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'address' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'website' => 'nullable|url',
            'founded_year' => 'nullable|digits:4',
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Organization::updateOrCreate(['id' => 1], $data);

        return redirect()
            ->route('general.edit')
            ->with('success', 'Profil organisasi berhasil diperbarui');
    }
}

