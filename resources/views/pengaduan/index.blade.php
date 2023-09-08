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
                <div class="flex justify-between my-4">
                    <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4">
                        Daftar Pengaduan {{ $judul }}
                    </h2>
                    @can('create', \App\Models\Complaint\Pengaduan::class)
                        <a href="{{ route('pengaduan.create') }}">
                            <x-primary-button>Tambah Pengaduan</x-primary-button>
                        </a>
                    @endcan
                    @if ($user->role == \App\Models\User::IS_BAPPEBTI)
                        <a href="{{ route('excel') }}">
                            <x-primary-button>Eksport Data</x-primary-button>
                        </a>
                    @endif
                </div>

                <table style="max-width: 95%" id="myTable" class="display table-fixed cell-border">
                    <thead>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <th>Nasabah</th>
                            <th>Pialang</th>
                            <th>Bursa</th>
                            <th>Status</th>
                            <th>Deadline</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php
                        $sortedPengaduans = $pengaduans->sortByDesc(function ($pengaduan, $index) use ($user) {
                            return $pengaduan->checkIfImportant($user);
                        });
                    @endphp
                    <tbody>
                        @foreach ($sortedPengaduans as $pengaduan)
                            @php
                                $is_important = $pengaduan->checkIfImportant($user);
                            @endphp
                            <tr class="{{ $is_important ? 'font-bold text-red-500' : '' }}">
                                <td>{{ \Carbon\Carbon::parse($pengaduan->waktu_dibuat)->isoFormat('dddd, D MMMM Y') }}
                                <td>{{ $pengaduan->nasabah->user->name }}</td>
                                <td>{{ $pengaduan->pialang->user->name }}</td>
                                {{-- <td></td> --}}
                                <td>{{ $pengaduan->bursa->user->name }}</td>
                                <td>{{ $pengaduan->getStatusMeaning() }}</td>
                                <td>{{ $pengaduan->getDeadlineDate() }}</td>
                                <td><a href="{{ route('pengaduan.show', $pengaduan->id) }}">
                                        @if ($is_important)
                                            <x-danger-button>Lihat</x-danger-button>
                                        @else
                                            <x-primary-button>Lihat</x-primary-button>
                                        @endif
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
        @vite(['resources/js/datatable/pengaduan.js'])
    </x-slot>
</x-app-layout>
