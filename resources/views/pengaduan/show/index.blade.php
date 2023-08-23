<x-app-layout>
    <x-slot name="cssFile">
        @vite(['resources/css/pengaduan.css', 'resources/js/app.js'])
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengaduan') }}
        </h2>
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
                    @include('pengaduan.show.partials.nasabah.index')
                    @include('pengaduan.show.partials.accused.index')
                    @include('pengaduan.show.partials.documents.index')
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

        @switch($user->role)
            @case('nasabah')
            @break

            @case('pialang')
                {{-- ahow form tambah musyawarah --}}
                @include('musyawarah.partials.add-musyawarah')
                @include('kesepakatan.partials.add-kesepakatan')
            @break

            @case('bursa')
                {{-- ahow form tambah mediasi --}}
                @include('mediasi.partials.add-mediasi')
                @include('kesepakatan.partials.add-kesepakatan')
            @break

            @case('bappebti')
                @if ($pengaduan->status == App\Models\Complaint\Pengaduan::STATUS_CREATED)
                    @include('pengaduan.form.partials.approval.index')
                @elseif ($pengaduan->status == App\Models\Complaint\Pengaduan::STATUS_FINISHED)
                    @include('kesepakatan.partials.cek-kesepakatan')
                @endif
            @break

        @endswitch

    </div>
</x-app-layout>
