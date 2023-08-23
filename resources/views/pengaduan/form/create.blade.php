<x-app-layout>
    <x-slot name="cssFile">
        @vite(['resources/css/pengaduan.css', 'resources/js/app.js'])
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        <form class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6" action="{{ route('pengaduan.store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @include('pengaduan.form.partials.account.index')
            @include('pengaduan.form.partials.accused.index')
            @include('pengaduan.form.partials.questions.index')
            @include('pengaduan.form.partials.documents.index')
            @include('pengaduan.form.partials.chronology.index')
            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
