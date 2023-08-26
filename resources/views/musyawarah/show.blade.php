<x-app-layout>
    <x-slot name="cssFile">
        @vite(['resources/css/pengaduan.css', 'resources/js/app.js'])
    </x-slot>

    <div class="py-8">
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        <a href="{{ route('pengaduan.show', $musyawarah->pengaduan->id) }}">
            <div
                class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex items-center gap-x-4 font-semibold text-lg text-gray-800 leading-tight mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.25 9l-3 3m0 0l3 3m-3-3h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Detail Pengaduan</span>
            </div>
        </a>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-between">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4">
                        Detail Musyawarah
                    </h2>
                    @if ($user->role == \App\Models\User::IS_PIALANG && empty($musyawarah->hasil))
                        <a>
                            <form action="{{route('musyawarah.destroy', $musyawarah->id)}}" method="POST" >
                                @csrf
                                @method('delete')
                                <x-danger-button>
                                    Batalkan Musyawarah
                                </x-danger-button>
                            </form>
                        </a>
                    @endif
                </div>
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
