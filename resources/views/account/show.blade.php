<x-app-layout>
    <x-slot name="cssFile">
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
            @vite(['resources/css/app.css', 'resources/css/datatable.css', 'resources/js/app.js'])
            @vite(['resources/css/pengaduan.css'])
    </x-slot>
    <div class="py-8">
        {{-- @dd($data) --}}
        <a href="{{ route('account.index') }}">
            <div
                class="max-w-full mx-auto px-4 sm:px-8 lg:px-16 flex items-center gap-x-4 font-semibold text-lg text-gray-800 leading-tight mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.25 9l-3 3m0 0l3 3m-3-3h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Daftar Semua Pengguna</span>
            </div>
        </a>
        <div class="max-w-full mx-auto px-4 sm:px-8 lg:px-16 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-8 grid grid-cols-1 gap-y-4">
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
