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
                    Daftar Semua Pengguna
                </h2>
                <table style="max-width: 95%" id="myTable" class="display table-fixed cell-border">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shownUsers as $shownUser)
                            <tr>
                                <td>
                                    {{ $shownUser->id }}
                                </td>
                                <td class="capitalize">{{ $shownUser->name }}</td>
                                <td>{{ $shownUser->email }}</td>
                                <td class="capitalize">{{ $shownUser->role }}</td>
                                <td><a href="{{ route('account.show', $shownUser->id) }}">
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
        @vite(['resources/js/datatable/users.js'])
    </x-slot>
</x-app-layout>
