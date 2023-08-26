<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMusyawarahRequest;
use App\Http\Requests\UpdateMusyawarahRequest;
use App\Interfaces\MusyawarahServiceInterface;
use App\Models\Complaint\Musyawarah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MusyawarahController extends Controller
{
    private MusyawarahServiceInterface $musyawarahService;

    public function __construct(MusyawarahServiceInterface $musyawarahService)
    {
        $this->musyawarahService = $musyawarahService;
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMusyawarahRequest $request, $id)
    {
        $musyawarah = $this->musyawarahService->createMusyawarah($request, $id);
        return Redirect::route('musyawarah.show', $musyawarah->id)->with('status', 'musyawarah-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        return view('musyawarah.show', [
            'user' => $request->user(),
            'musyawarah' => Musyawarah::findOrFail((int) $id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Musyawarah $musyawarah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMusyawarahRequest $request, $id)
    {
        $musyawarah = $this->musyawarahService->updateMusyawarah($request, $id);
        return Redirect::route('musyawarah.show', $id)->with('status', 'musyawarah-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $musyawarah = $this->musyawarahService->cancelMusyawarah($request, $id);
        return Redirect::route('musyawarah.show', $id)->with('status', 'musyawarah-cancelled');
    }
}
