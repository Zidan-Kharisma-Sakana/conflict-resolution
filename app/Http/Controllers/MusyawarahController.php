<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMusyawarahRequest;
use App\Http\Requests\UpdateMusyawarahRequest;
use App\Interfaces\MusyawarahServiceInterface;
use App\Interfaces\NotifikasiServiceInterface;
use App\Models\Complaint\Musyawarah;
use App\Models\Complaint\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MusyawarahController extends Controller
{
    private MusyawarahServiceInterface $musyawarahService;
    private NotifikasiServiceInterface $notifikasiService;

    public function __construct(MusyawarahServiceInterface $musyawarahService, NotifikasiServiceInterface $notifikasiService)
    {
        $this->musyawarahService = $musyawarahService;
        $this->notifikasiService = $notifikasiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('musyawarah.index', [
            'user' => $request->user(),
            'musyawarahs' => $request->user()->getRelatedMusyawarahs()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMusyawarahRequest $request, Pengaduan $pengaduan)
    {
        $this->authorize("addMusyawarah", [$pengaduan]);
        $musyawarah = $this->musyawarahService->createMusyawarah($request, $pengaduan->id);
        $this->notifikasiService->musyawarahCreated($musyawarah);
        return Redirect::route('musyawarah.show', $musyawarah->id)->with('status', 'musyawarah-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Musyawarah $musyawarah)
    {
        $this->authorize("view", [$musyawarah]);
        return view('musyawarah.show', [
            'user' => $request->user(),
            'musyawarah' => $musyawarah
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMusyawarahRequest $request, Musyawarah $musyawarah)
    {
        $this->authorize('update', [$musyawarah]);
        $musyawarah = $this->musyawarahService->updateMusyawarah($request, $musyawarah->id);
        return Redirect::route('musyawarah.show', $musyawarah->id)->with('status', 'musyawarah-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Musyawarah $musyawarah)
    {
        $this->authorize('delete', [$musyawarah]);
        $musyawarah = $this->musyawarahService->cancelMusyawarah($request, $musyawarah->id);
        return Redirect::route('musyawarah.show', $musyawarah->id)->with('status', 'musyawarah-cancelled');
    }
}
