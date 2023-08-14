<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Nasabah Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your Nasabah's profile informations.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-form.input-label for="name" :value="__('Name')" />
            <x-form.input.text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-form.input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-form.input-label for="email" :value="__('Email')" />
            <x-form.input.text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-form.input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
    </form>
</section>
