<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengaduanRequest;
use App\Http\Requests\UpdatePengaduanRequest;
use App\Interfaces\NotifikasiServiceInterface;
use App\Interfaces\PengaduanServiceInterface;
use App\Models\Complaint\Pengaduan;
use App\Models\Profile\Pialang;
use Carbon\Carbon;
use DebugBar\DebugBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PengaduanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private PengaduanServiceInterface $pengaduanService;
    private NotifikasiServiceInterface $notifikasiService;

    public function __construct(PengaduanServiceInterface $pengaduanService, NotifikasiServiceInterface $notifikasiService)
    {
        $this->pengaduanService = $pengaduanService;
        $this->notifikasiService = $notifikasiService;
    }

    public function index(Request $request)
    {
        return view('pengaduan.index', [
            'user' => $request->user(),
            'pengaduans' => $request->user()->getRelatedPengaduans()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $this->authorize('create', Pengaduan::class);
        return view('pengaduan.form.create', [
            'user' => $request->user(),
            'companies' => Pialang::with("user")->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengaduanRequest $request)
    {
        $this->authorize('create', Pengaduan::class);
        $pengaduan = $this->pengaduanService->createPengaduan($request);
        $this->notifikasiService->pengaduanCreated($pengaduan);
        return Redirect::route('pengaduan.show', $pengaduan->id)->with('status', 'pengaduan-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengaduan $pengaduan)
    {
        $this->authorize('view', [$pengaduan]);
        return view('pengaduan.show.index', [
            'user' => auth()->user(),
            'pengaduan' => $pengaduan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengaduan $pengaduan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengaduan $pengaduan)
    {
        $this->authorize("update", [$pengaduan]);
        if ($request->subject == 'reject') {
            $request->validate([
                "alasan_penolakan" => ['required', 'string']
            ]);
            $pengaduan = $this->pengaduanService->rejectPengaduan($request, $pengaduan->id);
            $this->notifikasiService->pengaduanRejected($pengaduan);
            return Redirect::route('pengaduan.show', $pengaduan->id)->with('status', 'pengaduan-rejected');
        }
        // do approve
        $pengaduan = $this->pengaduanService->approvePengaduan($request, $pengaduan->id);
        $this->notifikasiService->pengaduanApproved($pengaduan);
        return Redirect::route('pengaduan.show', $pengaduan->id)->with('status', 'pengaduan-approved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Pengaduan $pengaduan)
    {
        $this->authorize("delete", [$pengaduan]);
        $pengaduan = $this->pengaduanService->forceClosePengaduan($request, $pengaduan->id);
        $this->notifikasiService->pengaduanCancelled($pengaduan);
        return Redirect::route('pengaduan.show', $pengaduan->id)->with('status', 'pengaduan-force-close');
    }
}
