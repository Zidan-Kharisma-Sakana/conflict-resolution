<x-app-layout>
    <div class="py-12">

        <div class="max-w-full mx-auto px-4 sm:px-8 lg:px-16 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    @include('account.partials.update-profile-information-form')
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    @switch($user->role)
                        @case('nasabah')
                            @include('account.partials.update-nasabah-form')
                        @break

                        @case('pialang')
                            @include('account.partials.update-pialang-form')
                        @break

                        @case('bursa')
                            @include('account.partials.update-bursa-form')
                        @break

                        @case('bappebti')
                            @include('account.partials.update-bappebti-form')
                        @break
                    @endswitch
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    @include('account.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-2xl">
                    @include('account.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
