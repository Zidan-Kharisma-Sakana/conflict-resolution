<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 mt-8">
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <header>
            <h2 class="text-xl font-medium text-gray-900">
                {{ __('Pengecekan Pengaduan') }}
            </h2>
        </header>
        <form method="post" action="{{ route('pengaduan.update', $pengaduan->id) }}">
            @csrf
            @method('patch')
            <div>
                <h6>Alasan Penolakan (Jika ditolak)</h6>
                <textarea name="alasan_penolakan" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ old('alasan_penolakan') }}</textarea>
                @error('alasan_penolakan')
                    <x-form.input-error messages="This field is required" />
                @enderror
            </div>
            <div class="flex items-center gap-4 mt-4">
                <x-primary-button name="subject" type="submit" value="approve">{{ __('Setujui') }}</x-primary-button>
                <x-danger-button name="subject" type="submit" value="reject" class="ml-1">
                    {{ __('Tolak') }}
                </x-danger-button>
            </div>
        </form>
    </div>
</div>
