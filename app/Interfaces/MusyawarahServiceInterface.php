<?php

namespace App\Interfaces;

use App\Http\Requests\StoreMusyawarahRequest;
use App\Models\Complaint\Musyawarah;

interface MusyawarahServiceInterface
{
    public function createMusyawarah(StoreMusyawarahRequest $request, $id) : Musyawarah;
}
