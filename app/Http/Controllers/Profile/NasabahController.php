<?php

namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorenasabahRequest;
use App\Http\Requests\UpdatenasabahRequest;
use App\Models\Profile\Nasabah;
use Illuminate\Support\Facades\Redirect;

class NasabahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Nasabah $nasabah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nasabah $nasabah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatenasabahRequest $request)
    {
        $request->user()->nasabah()->update($request->validated());
        return Redirect::route('account.edit')->with('status', 'profile-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nasabah $nasabah)
    {
        //
    }
}
