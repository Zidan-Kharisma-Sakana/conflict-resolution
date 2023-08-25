<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengaduanRequest;
use App\Http\Requests\UpdatePengaduanRequest;
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

    public function __construct(PengaduanServiceInterface $pengaduanService)
    {
        $this->pengaduanService = $pengaduanService;
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
        $pengaduan = $this->pengaduanService->createPengaduan($request);
        return Redirect::route('pengaduan.show', $pengaduan->id)->with('status', 'pengaduan-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, int $id)
    {
        $pengaduan = Pengaduan::with(
            ['nasabah', 'pialang', 'bursa', 'berkasPengaduans', 'pertanyaanPengaduans', 'musyawarahs', 'mediasis', 'kesepakatan']
        )
            ->findOrFail($id);

        return view('pengaduan.show.index', [
            'user' => $request->user(),
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
    public function update(Request $request, $id)
    {
        //
        if ($request->subject == 'reject') {
            $request->validate([
                "alasan_penolakan" => ['required', 'string']
            ]);
            $pengaduan = $this->pengaduanService->rejectPengaduan($request, $id);
            return Redirect::route('pengaduan.show', $pengaduan->id)->with('status', 'pengaduan-rejected');
        }
        // do approve
        $pengaduan = $this->pengaduanService->approvePengaduan($request, $id);
        return Redirect::route('pengaduan.show', $pengaduan->id)->with('status', 'pengaduan-approved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengaduan $pengaduan)
    {
        //
    }
}
