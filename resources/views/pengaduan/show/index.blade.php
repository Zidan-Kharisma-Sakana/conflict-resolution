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


                <div class="max-w-6xl grid grid-cols-1 gap-y-6">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Detail Pengaduan
                    </h2>
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
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg grid grid-cols-1 md:grid-cols-2 gap-4">
                    @include('musyawarah.partials.list-musyawarah', ['items' => $pengaduan->musyawarahs])
                    @include('mediasi.partials.list-mediasi', ['items' => $pengaduan->mediasis])
                </div>
            </div>
        @endif

        @include('kesepakatan.partials.show-kesepakatan', ['kesepakatan' => $pengaduan->kesepakatan])

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

    </div>
</x-app-layout>
