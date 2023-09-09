<?php

namespace App\Interfaces;

use App\Http\Requests\StoreKesepakatanRequest;
use App\Http\Requests\UpdateKesepakatanRequest;
use App\Models\Complaint\Kesepakatan;
use App\Models\Complaint\Pengaduan;
use Illuminate\Http\Request;

interface KesepakatanServiceInterface
{
    public function createKesepakatan(StoreKesepakatanRequest $request, $id) : Kesepakatan;
    public function confirmKesepakatan(Request $request, $id) : Pengaduan;
    public function destroyKesepakatan(Request $request, $id) : Pengaduan;
}
