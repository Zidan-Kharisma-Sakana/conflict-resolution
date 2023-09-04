<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotifikasiRequest;
use App\Http\Requests\UpdateNotifikasiRequest;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('notifikasi.index', [
            'user' => $request->user(),
            'notifikasis' => Notifikasi::where('user_id', $request->user()->id)
                ->orderBy('is_seen', "ASC")
                ->orderBy('created_at', "DESC")
                ->limit(50)
                ->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notifikasi $notifikasi)
    {
        $notifikasi->is_seen = true;
        $notifikasi->save();
        return redirect()->away($notifikasi->link);
    }
}
