<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBappebtiRequest;
use App\Http\Requests\UpdateBappebtiRequest;
use App\Models\Profile\Bappebti;
use Illuminate\Support\Facades\Redirect;

class BappebtiController extends Controller
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
    public function store(StoreBappebtiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bappebti $bappebti)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bappebti $bappebti)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBappebtiRequest $request)
    {
        $request->user()->bappebti()->update($request->validated());
        return Redirect::route('account.edit')->with('status', 'profile-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bappebti $bappebti)
    {
        //
    }
}