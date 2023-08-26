<?php

namespace App\Interfaces;

use App\Http\Requests\StorePengaduanRequest;
use App\Models\Complaint\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;

interface PengaduanServiceInterface
{
    public function createPengaduan(StorePengaduanRequest $request) : Pengaduan;
    public function approvePengaduan(Request $request, $id) : Pengaduan;
    public function rejectPengaduan(Request $request, $id) : Pengaduan;
    public function forceClosePengaduan(Request $request, $id): Pengaduan;
}
