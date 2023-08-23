<x-app-layout>
    <x-slot name="cssFile">
        @vite(['resources/css/pengaduan.css', 'resources/js/app.js'])
    </x-slot>

    <div class="py-12">
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        <form class="max-w-7xl mx-auto sm:px-6 lg:px-8" action="{{ route('pengaduan.store') }}" method="post"
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
