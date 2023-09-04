<x-app-layout>
    <x-slot name="cssFile">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/css/datatable.css', 'resources/js/app.js', 'resources/js/datatable.js'])
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
                        Semua Notifikasi
                    </h2>
                </div>

                <table style="max-width: 95%" id="myTable" class="display table-fixed cell-border">
                    <thead>
                        <tr>
                            <th>Waktu</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @php
                        $sortedNotifikasi = $notifikasis->sortBy('is_seen');
                    @endphp
                    <tbody>
                        @foreach ($sortedNotifikasi as $notifikasi)
                            @php
                                $is_seen = $notifikasi->is_seen;
                            @endphp
                            <tr class="{{ $is_seen ? '' : 'font-bold text-red-500' }}">
                                <td>{{ $notifikasi->created_at }}</td>
                                <td>{{ $notifikasi->subject }}</td>
                                <td>{{ $notifikasi->content }}</td>
                                <td>
                                    @if ($is_seen)
                                        <a target="_blank" rel="noopener noreferrer" href="{{ $notifikasi->link }}">
                                            <x-primary-button>Lihat</x-primary-button>
                                        </a>
                                    @else
                                        <form method="post" action="{{ route('notifikasi.update', $notifikasi->id) }}">
                                            @csrf
                                            @method('patch')
                                            <x-danger-button>Lihat</x-danger-button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <x-slot name="script">
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                let table = new DataTable('#myTable', {
                    "ordering": false,
                    "columnDefs": [{
                        "targets": [0, 1, 2, 3],
                        "orderable": false
                    }, {
                        "targets": [1],
                        "width": '20%'
                    }, {
                        "targets": [0],
                        "width": '180px'
                    }, {
                        "targets": [3],
                        "width": '100px'
                    }]
                });
            });
        </script>
    </x-slot>
</x-app-layout>
