<x-app-layout>
    <x-slot name="cssFile">
        @vite(['resources/css/pengaduan.css', 'resources/js/app.js'])
    </x-slot>

    <div class="py-12">
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4">
                    Form Pembuatan Pengaduan
                </h2>
                <table>
                    <tr>
                        <td>Status</td>
                        <td>{{ ': ' . $musyawarah->getStatus() }}</td>
                    </tr>
                    <tr>
                        <td>Pihak</td>
                        <td>
                            <div class="flex gap-x-4">
                                <p>:</p>
                                <ul class="list-inside list-disc">
                                    <li>{{ $musyawarah->pengaduan->nasabah->user->name . ' (Nasabah)' }}</li>
                                    <li>{{ $musyawarah->pengaduan->pialang->user->name . ' (Pialang)' }}</li>
                                    <li>{{ $musyawarah->pengaduan->bursa->user->name . ' (Bursa)' }}</li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>{{ ': ' . \Carbon\Carbon::parse($mediasi->tanggal_waktu)->isoFormat('dddd, D MMMM Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td>{{ ': ' . \Carbon\Carbon::parse($mediasi->tanggal_waktu)->isoFormat('HH:mm') . '  WIB' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>{{ ': ' . $mediasi->tempat }}</td>
                    </tr>
                    <tr>
                        <td>Link Pertemuan</td>
                        <td>
                            @if (!empty($mediasi->link_pertemuan))
                                <a target="_blank" rel="noopener noreferrer" href="{{ $mediasi->link_pertemuan }}">
                                    : [Link Pertemuan]
                                </a>
                            @else
                                <p>: -</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>File Undangan</td>
                        <td><span>: </span>
                            @if (!empty($mediasi->file_undangan))
                                <a target="_blank" rel="noopener noreferrer"
                                    href="{{ '/storage/' . $mediasi->file_undangan }}">
                                    [File Undangan]
                                </a>
                            @else
                                <span> -</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Dibuat Pada</td>
                        <td>{{ ': ' . \Carbon\Carbon::parse($mediasi->created_at)->isoFormat('dddd, D MM YYYY') }}</td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Hasil *</h4>
                        </td>
                        <td>:
                            @if (!empty($musyawarah->file_hasil))
                                <a href="{{ '/storage/' . $musyawarah->file_hasil }}">[Berkas Hasil]</a>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                </table>
                @include('mediasi.partials.edit-mediasi')
            </div>
        </div>

    </div>
</x-app-layout>
