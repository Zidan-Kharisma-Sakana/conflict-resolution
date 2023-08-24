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
                    Detail Musyawarah
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
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>{{ ': ' . \Carbon\Carbon::parse($musyawarah->tanggal_waktu)->isoFormat('dddd, D MMMM Y') }}
                        </td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td>{{ ': ' . \Carbon\Carbon::parse($musyawarah->tanggal_waktu)->isoFormat('HH:mm') . '  WIB' }}
                        </td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>{{ ': ' . $musyawarah->tempat }}</td>
                    </tr>
                    <tr>
                        <td>Link Pertemuan</td>
                        <td>
                            @if (!empty($musyawarah->link_pertemuan))
                                <a target="_blank" rel="noopener noreferrer" href="{{ $musyawarah->link_pertemuan }}">
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
                            @if (!empty($musyawarah->file_undangan))
                                <a target="_blank" rel="noopener noreferrer"
                                    href="{{ '/storage/' . $musyawarah->file_undangan }}">
                                    [File Undangan]
                                </a>
                            @else
                                <span> -</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Dibuat Pada</td>
                        <td>{{ ': ' . \Carbon\Carbon::parse($musyawarah->created_at)->isoFormat('dddd, D MMMM YYYY') }}
                        </td>
                    </tr>
                </table>

                <form class="" action="{{ route('musyawarah.update', $musyawarah->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    @include('musyawarah.partials.edit-musyawarah')
                </form>

            </div>
        </div>

    </div>
</x-app-layout>
