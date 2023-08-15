<section class="w-full">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Bappebti Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your Bappebti informations.') }}
        </p>
    </header>

    <form method="post" action="{{ route('bappebti.update') }}" class="mt-6 space-y-6 w-full">
        @csrf
        @method('patch')
        <div>
            <x-form.input-label for="nip" :value="__('nip')" />
            <x-form.input.text-input id="nip" name="nip" type="text" class="mt-1 block w-full"
                :value="old('nip', $user->bappebti->nip)" required autofocus />
            <x-form.input-error class="mt-2" :messages="$errors->get('nip')" />
        </div>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
