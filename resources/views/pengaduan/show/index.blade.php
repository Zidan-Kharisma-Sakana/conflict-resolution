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
        <a href="{{ route('pengaduan.index') }}">
            <div
                class="max-w-full mx-auto px-4 sm:px-8 lg:px-16 flex items-center gap-x-4 font-semibold text-lg text-gray-800 leading-tight mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.25 9l-3 3m0 0l3 3m-3-3h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Daftar Pengaduan</span>
            </div>
        </a>
        <div class="max-w-full mx-auto px-4 sm:px-8 lg:px-16 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="grid grid-cols-1 gap-y-6">
                    <div class="flex justify-between">
                        <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4">
                            Detail Pengaduan
                        </h2>
                        @if ($user->role == \App\Models\User::IS_BAPPEBTI && $pengaduan->isOpen())
                            <a>
                                <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <x-danger-button>
                                        Batalkan Pengaduan
                                    </x-danger-button>
                                </form>
                            </a>
                        @endif
                    </div>
                    <div>
                        <table>
                            <tr>
                                <td>ID Pengaduan</td>
                                <td>{{ ': ' . $pengaduan->id }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{ ': ' . $pengaduan->getStatusMeaning() }}</td>
                            </tr>
                            <tr>
                                <td>Dibuat Pada</td>
                                <td>{{ ': ' . \Carbon\Carbon::parse($pengaduan->waktu_dibuat)->isoFormat('dddd, D MMMM Y HH:mm') }}
                                </td>
                            </tr>
                            <tr>
                                <td>Tenggat Waktu</td>
                                <td>{{ ': ' . $pengaduan->getDeadline() }}</td>
                            </tr>
                            <tr>
                                <td>Pihak</td>
                                <td>
                                    <div class="flex gap-x-4">
                                        <p>:</p>
                                        <ul class="list-inside list-disc">
                                            <li>{{ $pengaduan->nasabah->user->name . ' (Nasabah)' }}</li>
                                            <li>{{ $pengaduan->pialang->user->name . ' (Pialang)' }}</li>
                                            <li>{{ $pengaduan->bursa->user->name . ' (Bursa)' }}</li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @if ($pengaduan->status == \App\Models\Complaint\Pengaduan::STATUS_REJECTED)
                                <tr>
                                    <td>File Alasan Penolakan</td>
                                    <td>
                                        @if (!empty($pengaduan->alasan_penolakan_file))
                                            <a target="_blank" rel="noopener noreferrer"
                                                href="/storage/{{ $pengaduan->alasan_penolakan_file }}">
                                                : [File]
                                            </a>
                                        @else
                                            <p>: -</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Alasan Penolakan</td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <textarea disabled class="border-gray-300 rounded-md shadow-sm w-full">{{ $pengaduan->alasan_penolakan }}</textarea>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @include('pengaduan.show.partials.nasabah.index')
                        <div class="grid gap-y-6">
                            @include('pengaduan.show.partials.accused.index')
                            @include('pengaduan.show.partials.documents.index')
                        </div>
                    </div>
                    @include('pengaduan.show.partials.chronology.index')
                    @include('pengaduan.show.partials.questions.index')
                </div>
            </div>
        </div>

        {{-- Show tabel jadwal mediasi dan musyawarah --}}
        @if ($pengaduan->status != App\Models\Complaint\Pengaduan::STATUS_CREATED)
            {{-- <div>show table mediasi & musyawarah</div> --}}
            <div class="max-w-full mx-auto px-4 sm:px-8 lg:px-16 space-y-6 mt-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg grid grid-cols-1 gap-4">
                    @include('musyawarah.partials.list-musyawarah', ['items' => $pengaduan->musyawarahs])
                    @include('mediasi.partials.list-mediasi', ['items' => $pengaduan->mediasis])
                </div>
            </div>
            @include('kesepakatan.partials.show-kesepakatan', ['kesepakatan' => $pengaduan->kesepakatan])
        @endif


        @if ($pengaduan->isOpen())
            @switch($user->role)
                @case('nasabah')
                @break

                @case('pialang')
                    {{-- ahow form tambah musyawarah --}}
                    @if ($pengaduan->status == App\Models\Complaint\Pengaduan::STATUS_DISPOSISI_PIALANG)
                        @include('musyawarah.partials.add-musyawarah')
                        @include('kesepakatan.partials.add-kesepakatan')
                    @endif
                @break

                @case('bursa')
                    {{-- ahow form tambah mediasi --}}
                    @if (in_array($pengaduan->status, [
                            App\Models\Complaint\Pengaduan::STATUS_DISPOSISI_BURSA,
                            App\Models\Complaint\Pengaduan::STATUS_DISPOSISI_BURSA_EXPIRED,
                        ]))
                        @include('mediasi.partials.add-mediasi')
                        @include('kesepakatan.partials.add-kesepakatan')
                    @endif
                @break

                @case('bappebti')
                    @if ($pengaduan->status == App\Models\Complaint\Pengaduan::STATUS_CREATED)
                        @include('pengaduan.form.partials.approval.index')
                    @endif
                @break
            @endswitch
        @endif

    </div>
</x-app-layout>
