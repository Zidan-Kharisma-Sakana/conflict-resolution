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
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4">
                    Daftar mediasi
                </h2>
                <table style="max-width: 95%" id="myTable" class="display table-fixed">
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
                                <td>{{ $mediasi->hasil ?? 'Belum Diisi' }}</td>
                                <td><a href="{{ route('mediasi.show', $mediasi->id) }}">
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
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                let table = new DataTable('#myTable', {
                    "columnDefs": [{
                        "targets": [0, 2, 3, 4, 5],
                        "orderable": false
                    }, {
                        "targets": [1, 2, 3, 4],
                        "width": '15%'
                    }, {
                        "targets": [5],
                        "width": '80px'
                    }],
                    initComplete: function() {
                        this.api()
                            .columns([3, 4, 5])
                            .every(function() {
                                let column = this;
                                // console.log(this)

                                // Create select element
                                let select = document.createElement('select');

                                select.add(new Option('Semua', ''));
                                console.log(column.footer())
                                column.footer().replaceChildren(select);

                                // Apply listener for user change in value
                                select.addEventListener('change', function() {
                                    var val = DataTable.util.escapeRegex(select.value);

                                    column
                                        .search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });

                                // Add list of options
                                column
                                    .data()
                                    .unique()
                                    .sort()
                                    .each(function(d, j) {
                                        select.add(new Option(d));
                                    });
                            });
                    }
                });
            });
        </script>
        {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
    </x-slot>
</x-app-layout>
