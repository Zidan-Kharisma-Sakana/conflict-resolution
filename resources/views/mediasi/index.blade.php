<x-app-layout>
    <x-slot name="cssFile">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/css/datatable.css', 'resources/js/app.js'])
    </x-slot>
    <div class="py-8">
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        <div class="max-w-full mx-auto px-4 sm:px-8 lg:px-16 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4">
                    Daftar mediasi
                </h2>
                <table style="max-width: 95%" id="myTable" class="display table-fixed cell-border">
                    <thead>
                        <tr>
                            <th>Pihak</th>
                            <th>Tanggal & Waktu</th>
                            <th>Tempat</th>
                            <th>Status</th>
                            <th>Hasil</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mediasis as $mediasi)
                            <tr>
                                <td>
                                    <ul class="list-inside list-disc">
                                        <li>{{ $mediasi->pengaduan->nasabah->user->name . ' (Nasabah)' }}</li>
                                        <li>{{ $mediasi->pengaduan->pialang->user->name . ' (Pialang)' }}</li>
                                        <li>{{ $mediasi->pengaduan->bursa->user->name . ' (Bursa)' }}</li>
                                    </ul>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($mediasi->tanggal_waktu)->isoFormat('dddd, D MMMM Y HH:mm') }}
                                <td>{{ $mediasi->tempat }}</td>
                                <td>{{ $mediasi->getStatus() }}</td>
                                <td>{{ strtolower($mediasi->hasil ?? '-') }}</td>
                                <td><a target="_blank" rel="noopener noreferrer"
                                        href="{{ route('mediasi.show', $mediasi->id) }}">
                                        <x-primary-button>Lihat</x-primary-button>
                                    </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Filter:</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
    <x-slot name="script">
        <script type="module" src="{{ asset('/custom/datatable.js') }}"></script>
        @vite(['resources/js/datatable/mediasi.js'])
    </x-slot>
</x-app-layout>
