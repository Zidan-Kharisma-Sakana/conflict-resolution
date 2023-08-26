<?php

namespace App\Interfaces;

use App\Http\Requests\StoreMusyawarahRequest;
use App\Http\Requests\UpdateMusyawarahRequest;
use App\Models\Complaint\Musyawarah;
use Illuminate\Http\Request;

interface MusyawarahServiceInterface
{
    public function createMusyawarah(StoreMusyawarahRequest $request, $id) : Musyawarah;
    public function updateMusyawarah(UpdateMusyawarahRequest $request, $id) : Musyawarah;
    public function cancelMusyawarah(Request $request, $id) : Musyawarah;
}
