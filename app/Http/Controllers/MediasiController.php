<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediasiRequest;
use App\Http\Requests\UpdateMediasiRequest;
use App\Interfaces\MediasiServiceInterface;
use App\Models\Complaint\Mediasi;
use App\Models\Complaint\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MediasiController extends Controller
{
    private MediasiServiceInterface $mediasiService;

    public function __construct(MediasiServiceInterface $mediasiService)
    {
        $this->mediasiService = $mediasiService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('mediasi.index', [
            'user' => $request->user(),
            'mediasis' => $request->user()->getRelatedMediasis()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediasiRequest $request, Pengaduan $pengaduan)
    {
        $this->authorize('addMediasi', [$pengaduan]);
        $mediasi = $this->mediasiService->createMediasi($request, $pengaduan->id);
        return Redirect::route('musyawarah.show', $mediasi->id)->with('status', 'mediasi-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Mediasi $mediasi)
    {
        return view('mediasi.show', [
            'user' => $request->user(),
            'mediasi' => $mediasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediasiRequest $request, Mediasi $mediasi)
    {
        $this->authorize('update', [$mediasi]);
        $mediasi = $this->mediasiService->updateMediasi($request, $mediasi->id);
        return Redirect::route('mediasi.show', $mediasi->id)->with('status', 'mediasi-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Mediasi $mediasi)
    {
        $this->authorize('delete', [$mediasi]);
        $mediasi = $this->mediasiService->cancelMediasi($request, $mediasi->id);
        return Redirect::route('mediasi.show', $mediasi->id)->with('status', 'mediasi-cancelled');
    }
}
