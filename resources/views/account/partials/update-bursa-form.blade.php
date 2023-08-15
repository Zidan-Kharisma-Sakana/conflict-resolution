<section class="w-full">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Nasabah Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your Nasabah informations.') }}
        </p>
    </header>

    <form method="post" action="{{ route('account.update') }}" class="mt-6 space-y-6 w-full">
        @csrf
        @method('patch')
        <div>
            <x-form.input-label for="alamat" :value="__('alamat')" />
            <x-form.input.text-input id="alamat" name="alamat" type="text" class="mt-1 block w-full"
                :value="old('alamat', $user->bursa->alamat)" required autofocus />
        </div>
        <textarea class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">

        </textarea>
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
