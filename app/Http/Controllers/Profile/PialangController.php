<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorepialangRequest;
use App\Http\Requests\UpdatepialangRequest;
use App\Models\Profile\Pialang;
use Illuminate\Support\Facades\Redirect;

class PialangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepialangRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pialang $pialang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pialang $pialang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepialangRequest $request)
    {
        $request->user()->pialang()->update($request->validated());
        return Redirect::route('account.edit')->with('status', 'profile-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pialang $pialang)
    {
        //
    }
}