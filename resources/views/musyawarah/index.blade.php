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
                    Daftar Musyawarah
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
                    <tbody class="capitalize">
                        @foreach ($musyawarahs as $musyawarah)
                            <tr>
                                <td>
                                    <ul class="list-inside list-disc">
                                        <li>{{ $musyawarah->pengaduan->nasabah->user->name . ' (Nasabah)' }}</li>
                                        <li>{{ $musyawarah->pengaduan->pialang->user->name . ' (Pialang)' }}</li>
                                    </ul>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($musyawarah->tanggal_waktu)->isoFormat('dddd, D MMMM Y HH:mm') }}
                                <td>{{ $musyawarah->tempat }}</td>
                                <td>{{ $musyawarah->getStatus() }}</td>
                                <td>{{ strtolower($musyawarah->hasil ?? '-') }}</td>
                                <td><a href="{{ route('musyawarah.show', $musyawarah->id) }}">
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
        @vite(['resources/js/datatable/musyawarah.js'])
    </x-slot>
</x-app-layout>
