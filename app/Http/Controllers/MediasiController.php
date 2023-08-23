<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMediasiRequest;
use App\Http\Requests\UpdateMediasiRequest;
use App\Interfaces\MediasiServiceInterface;
use App\Models\Complaint\Mediasi;
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
    public function store(StoreMediasiRequest $request, $id)
    {
        //
        $mediasi = $this->mediasiService->createMediasi($request, $id);
        return Redirect::route('pengaduan.show', $id)->with('status', 'mediasi-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        return view('mediasi.show', [
            'user' => $request->user(),
            'mediasi' => Mediasi::findOrFail((int) $id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mediasi $mediasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediasiRequest $request, Mediasi $mediasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mediasi $mediasi)
    {
        //
    }
}
