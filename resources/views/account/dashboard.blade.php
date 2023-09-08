<x-app-layout>
    <x-slot name="cssFile">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/css/datatable.css', 'resources/js/app.js', 'resources/js/datatable.js'])
        @vite(['resources/css/pengaduan.css'])
    </x-slot>
    <div class="py-8">
        {{-- @dd($data) --}}
        <div class="max-w-full mx-auto px-4 sm:px-8 lg:px-16 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-8 grid grid-cols-1 gap-y-4">
                <h4 class="text-2xl font-bold">Selamat Datang di Sistem Pengaduan Online BAPPEBTI</h4>
                @can('create', \App\Models\Complaint\Pengaduan::class)
                    <div class="w-full flex justify-end">
                        <a href="{{ route('pengaduan.create') }}">
                            <x-primary-button>Tambah Pengaduan</x-primary-button>
                        </a>
                    </div>
                @endcan
                @if ($user->role == \App\Models\User::IS_BAPPEBTI)
                    <div class="w-full flex justify-end">
                        <a href="{{ route('excel') }}">
                            <x-primary-button>Eksport Data</x-primary-button>
                        </a>
                    </div>
                @endif
                <section id="identity" class="grid grid-cols-2 gap-8">
                    @include('account.partials.dashboard.identity')
                    @include('account.partials.dashboard.period')
                </section>
                <div class="border-t w-full"></div>
                @include('account.partials.dashboard.activeComplaint')
                <div class="border-t w-full"></div>
                @include('account.partials.dashboard.yearlyComplaint')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = @json($data);
    </script>
    @vite(['resources/js/dashboard/index.js'])
</x-app-layout>
