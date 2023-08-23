<section class="border-slate-400 border-t pt-8">
    <header>
        <h2 class="text-xl font-medium text-gray-900">
            {{ __('Pihak yang Dilaporkan') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Masukan Perusahaan dan Pihak yang dilaporkan') }}
        </p>
    </header>
    <div class="mt-4">
        <h3 class="text-lg font-medium text-gray-900">
            {{ __('A. Identitas Perusahaan Terlapor') }}
        </h3>
        <div class="grid grid-cols-3 items-center">
            <x-form.input-label for="terlapor[company][id]" :value="__('Nama Perusahaan')" />
            <div class="col-span-2">
                <select autofocus id="terlapor[company][id]" name="terlapor[company][id]"
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    <option value="" disabled selected>Not Selected</option>
                    @foreach ($companies as $company)
                        <option value="{{ $company->id }}"
                            {{ old('terlapor.company.id') == $company->id ? 'selected' : '' }}>
                            {{ $company->user->name }}</option>
                    @endforeach
                </select>
                @error('terlapor.company.id')
                    <x-form.input-error class="mt-2" messages="this field is required" />
                @enderror
            </div>
        </div>
    </div>


    <div class="mt-4">
        <h3 class="text-lg font-medium text-gray-900">
            {{ __('B. Identitas Orang Terlapor') }}
        </h3>
        <div class="w-full grid grid-cols-1 gap-4">
            <div class="grid grid-cols-3 items-center">
                <x-form.input-label for="terlapor[orang_1][nama]" :value="__('1. Nama/Jabatan')" />
                <div class="grid col-span-2 grid-cols-2 gap-x-4">
                    <div>
                        <x-form.input.text-input id="terlapor[orang_1][nama]" name="terlapor[orang_1][nama]"
                            type="text" class="mt-1 block w-full" :value="old('terlapor.orang_1.nama')" autofocus />
                        <x-form.input-error class="mt-2" :messages="$errors->get('terlapor[orang_1][nama]')" />
                    </div>
                    <div>
                        <x-form.input.text-input id="terlapor[orang_1][jabatan]"
                            name="terlapor[orang_1][jabatan]" type="text" class="mt-1 block w-full"
                            :value="old('terlapor.orang_1.jabatan')" autofocus />
                        <x-form.input-error class="mt-2" :messages="$errors->get('terlapor.orang_1.jabatan')" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-3 items-center">
                <x-form.input-label for="terlapor[orang_2][nama]" :value="__('2. Nama/Jabatan')" />
                <div class="grid col-span-2 grid-cols-2 gap-x-4">
                    <div>
                        <x-form.input.text-input id="terlapor[orang_2][nama]" name="terlapor[orang_2][nama]"
                            type="text" class="mt-1 block w-full" :value="old('terlapor.orang_2.nama')" autofocus />
                        <x-form.input-error class="mt-2" :messages="$errors->get('terlapor.orang_2.nama')" />
                    </div>
                    <div>
                        <x-form.input.text-input id="terlapor[orang_2][jabatan]"
                            name="terlapor[orang_2][jabatan]" type="text" class="mt-1 block w-full"
                            :value="old('terlapor.orang_2.jabatan')" autofocus />
                        <x-form.input-error class="mt-2" :messages="$errors->get('terlapor.orang_2.jabatan')" />
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-3 items-center">
                <x-form.input-label for="terlapor[orang_3][nama]" :value="__('3. Nama/Jabatan')" />
                <div class="grid col-span-2 grid-cols-2 gap-x-4">
                    <div>
                        <x-form.input.text-input id="terlapor[orang_3][nama]" name="terlapor[orang_3][nama]"
                            type="text" class="mt-1 block w-full" :value="old('terlapor.orang_3.nama')" autofocus />
                        <x-form.input-error class="mt-2" :messages="$errors->get('terlapor.orang_3.nama')" />
                    </div>
                    <div>
                        <x-form.input.text-input id="terlapor[orang_3][jabatan"
                            name="terlapor[orang_3][jabatan]" type="text" class="mt-1 block w-full"
                            :value="old('terlapor.orang_3.jabatan')" autofocus />
                        <x-form.input-error class="mt-2" :messages="$errors->get('terlapor.orang_3.jabatan')" />
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
