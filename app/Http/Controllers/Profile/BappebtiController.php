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
     * Update the specified resource in storage.
     */
    public function update(UpdateBappebtiRequest $request)
    {
        $request->user()->bappebti()->update($request->validated());
        return Redirect::route('account.edit')->with('status', 'profile-updated');
    }
}
