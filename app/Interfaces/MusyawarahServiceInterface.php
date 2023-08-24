<?php

namespace App\Interfaces;

use App\Http\Requests\StoreMusyawarahRequest;
use App\Http\Requests\UpdateMusyawarahRequest;
use App\Models\Complaint\Musyawarah;

interface MusyawarahServiceInterface
{
    public function createMusyawarah(StoreMusyawarahRequest $request, $id) : Musyawarah;
    public function updateMusyawarah(UpdateMusyawarahRequest $request, $id) : Musyawarah;
}
