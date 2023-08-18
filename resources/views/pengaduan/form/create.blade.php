<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Pengaduan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @include('pengaduan.form.partials.account.index')
            @include('pengaduan.form.partials.accused.index')
            @include('pengaduan.form.partials.questions.index')
            @include('pengaduan.form.partials.documents.index')
            @include('pengaduan.form.partials.chronology.index')
        </div>
    </div>
</x-app-layout>
