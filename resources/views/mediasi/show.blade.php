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
                    Detail Mediasi
                </h2>
                <table>
                    <tr>
                        <td>Status</td>
                        <td>{{ ': ' . $mediasi->getStatus() }}</td>
                    </tr>
                    <tr>
                        <td>Pihak</td>
                        <td>
                            <div class="flex gap-x-4">
                                <p>:</p>
                                <ul class="list-inside list-disc">
                                    <li>{{ $mediasi->pengaduan->nasabah->user->name . ' (Nasabah)' }}</li>
                                    <li>{{ $mediasi->pengaduan->pialang->user->name . ' (Pialang)' }}</li>
                                    <li>{{ $mediasi->pengaduan->bursa->user->name . ' (Pialang)' }}</li>
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
                        <td>{{ ': ' . \Carbon\Carbon::parse($mediasi->created_at)->isoFormat('dddd, D MMMM YYYY') }}
                        </td>
                    </tr>
                </table>

                <form class="" action="{{ route('mediasi.update', $mediasi->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    @include('mediasi.partials.edit-mediasi')
                </form>

            </div>
        </div>

    </div>
</x-app-layout>
