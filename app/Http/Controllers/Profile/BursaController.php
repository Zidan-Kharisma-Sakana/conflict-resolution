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
     * Update the specified resource in storage.
     */
    public function update(UpdatebursaRequest $request)
    {
        $request->user()->bursa()->update($request->validated());
        return Redirect::route('account.edit')->with('status', 'profile-updated');
    }
}
