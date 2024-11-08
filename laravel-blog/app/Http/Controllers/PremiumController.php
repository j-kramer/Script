<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PremiumController extends Controller
{
    /**
     * Show the form for editing the resource.
     */
    public function edit(Request $request)
    {
        return view('premium-form', ['user' => $request->user()]);
    }

    /**
     * Update the resource in storage.
     */
    public function update(Request $request)
    {
        $request->user()->has_premium = $request->boolean('has_premium');
        $request->user()->save();

        return redirect()->route('home');
    }
}
