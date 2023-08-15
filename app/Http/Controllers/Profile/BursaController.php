<?php

namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorebursaRequest;
use App\Http\Requests\UpdatebursaRequest;
use App\Models\Profile\Bursa;
use Illuminate\Support\Facades\Redirect;

class BursaController extends Controller
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
    public function store(StorebursaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Bursa $bursa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bursa $bursa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebursaRequest $request)
    {
        $request->user()->bursa()->update($request->validated());
        return Redirect::route('account.edit')->with('status', 'profile-updated');    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bursa $bursa)
    {
        //
    }
}
