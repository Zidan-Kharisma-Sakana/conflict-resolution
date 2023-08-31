<x-app-layout>
    <x-slot name="cssFile">
        @vite(['resources/css/pengaduan.css', 'resources/js/app.js'])
    </x-slot>

    <div class="py-8">
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        <a href="{{ route('dashboard') }}">
            <div
                class="max-w-full mx-auto px-4 sm:px-8 lg:px-16 flex items-center gap-x-4 font-semibold text-lg text-gray-800 leading-tight mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11.25 9l-3 3m0 0l3 3m-3-3h7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>Dashboard</span>
            </div>
        </a>
        <form class="max-w-full mx-auto px-4 sm:px-8 lg:px-16 space-y-6" action="{{ route('pengaduan.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4">
                    Form Pembuatan Pengaduan
                </h2>
                <div class="max-w-6xl  space-y-8">
                    @include('pengaduan.form.partials.account.index')
                    @include('pengaduan.form.partials.accused.index')
                    @include('pengaduan.form.partials.questions.index')
                    @include('pengaduan.form.partials.documents.index')
                    @include('pengaduan.form.partials.chronology.index')

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                    </div>
                </div>
            </div>

        </form>
    </div>
</x-app-layout>
