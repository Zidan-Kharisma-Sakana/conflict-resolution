<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKesepakatanRequest;
use App\Http\Requests\UpdateKesepakatanRequest;
use App\Interfaces\KesepakatanServiceInterface;
use App\Models\Complaint\Kesepakatan;
use App\Models\Complaint\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class KesepakatanController extends Controller
{
    private KesepakatanServiceInterface $kesepakatanService;

    public function __construct(KesepakatanServiceInterface $kesepakatanService)
    {
        $this->kesepakatanService = $kesepakatanService;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKesepakatanRequest $request, Pengaduan $pengaduan)
    {
        $this->authorize('addKesepakatan', [$pengaduan]);
        $kesepakatan = $this->kesepakatanService->createKesepakatan($request, $pengaduan->id);
        return Redirect::route('pengaduan.show', $pengaduan->id)->with('status', 'kesepakatan-created');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kesepakatan $kesepakatan)
    {
        $this->authorize("update", [$kesepakatan]);
        $pengaduan = $this->kesepakatanService->confirmKesepakatan($request, $kesepakatan->id);
        return Redirect::route('pengaduan.show', $pengaduan->id)->with('status', 'kesepakatan-updated');
    }
}
