<?php

namespace App\Interfaces;

use App\Http\Requests\StoreMediasiRequest;
use App\Http\Requests\UpdateMediasiRequest;
use App\Models\Complaint\Mediasi;

interface MediasiServiceInterface
{
    public function createMediasi(StoreMediasiRequest $request, $id) : Mediasi;
    public function updateMediasi(UpdateMediasiRequest $request, $id) : Mediasi;
}
