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
     * Update the specified resource in storage.
     */
    public function update(UpdatepialangRequest $request)
    {
        $request->user()->pialang()->update($request->validated());
        return Redirect::route('account.edit')->with('status', 'profile-updated');
    }
}
