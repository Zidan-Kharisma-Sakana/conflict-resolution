<?php

namespace App\Interfaces;

use App\Http\Requests\StoreMediasiRequest;
use App\Models\Complaint\Mediasi;

interface MediasiServiceInterface
{
    public function createMediasi(StoreMediasiRequest $request, $id) : Mediasi;
}
