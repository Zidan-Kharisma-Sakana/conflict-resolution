<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKesepakatanRequest;
use App\Http\Requests\UpdateKesepakatanRequest;
use App\Interfaces\KesepakatanServiceInterface;
use App\Models\Complaint\Kesepakatan;
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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKesepakatanRequest $request, $id)
    {
        //
        $kesepakatan = $this->kesepakatanService->createKesepakatan($request, $id);
        return Redirect::route('pengaduan.show', $id)->with('status', 'kesepakatan-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kesepakatan $kesepakatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kesepakatan $kesepakatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pengaduan = $this->kesepakatanService->confirmKesepakatan($request, $id);
        return Redirect::route('pengaduan.show', $pengaduan->id)->with('status', 'kesepakatan-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kesepakatan $kesepakatan)
    {
        //
    }
}
