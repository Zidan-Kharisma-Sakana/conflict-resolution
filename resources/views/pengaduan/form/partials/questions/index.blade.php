<section class="border-slate-400 border-t pt-8">
    <header>
        <h2 class="text-xl font-medium text-gray-900">
            {{ __('Pertanyaan') }}
        </h2>
        <div class="grid grid-cols-1 gap-y-4 mt-4">
            <div>
                <fieldset>
                    <h6>Apakah pengaduan ini dikuasakan?</h6>
                    <input name="pertanyaan[kuasa][question]" style="display: none;" value="Apakah pengaduan ini dikuasakan?">
                    <div class="flex gap-x-8 mt-1">
                        <div> <input type="radio" id="yes" name="pertanyaan[kuasa][answer]" value="yes"
                                {{ old('pertanyaan.kuasa.answer') == 'yes' ? 'checked' : '' }} />
                            <label for="yes">Yes</label>
                        </div>
                        <div>
                            <input type="radio" id="no" name="pertanyaan[kuasa][answer]" value="no"
                                {{ old('pertanyaan.kuasa.answer') == 'no' ? 'checked' : '' }} />
                            <label for="no">No</label>
                        </div>
                    </div>
                    @error('pertanyaan.kuasa.answer')
                        <x-form.input-error class="mt-2" messages="this field is required" />
                    @enderror
                </fieldset>
            </div>
            <div>
                <h6>Apakah Saudara telah berusaha menyelesaikan kasus Saudara dengan Manajemen Perusahaan -
                    Divisi Complience ? Jika Sudah, apa hasilnya? </h6>
                <input name="pertanyaan[broker][question]" style="display: none;" value="Apakah Saudara telah berusaha menyelesaikan kasus Saudara dengan Manajemen Perusahaan Divisi Complience ? Jika Sudah, apa hasilnya " />
                <textarea name="pertanyaan[broker][answer]"
                    class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('pertanyaan.broker.answer') }}</textarea>
                @error('pertanyaan.broker.answer')
                    <x-form.input-error class="mt-2" messages="this field is required" />
                @enderror
            </div>
            <div>
                <h6>Apakah Kasus ini pernah diselesaikan di Bursa? Jika sudah apa hasilnya </h6>
                <input name="pertanyaan[exchange][question]" style="display: none;" value="Apakah Kasus ini pernah diselesaikan di Bursa? Jika sudah apa hasilnya " />
                <textarea name="pertanyaan[exchange][answer]"
                    class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('pertanyaan.exchange.answer') }}</textarea>
                @error('pertanyaan.exchange.answer')
                    <x-form.input-error class="mt-2" messages="this field is required" />
                @enderror
            </div>
            <div>
                <h6>Apakah Saudara pernah mencoba melaporkan/menyelesaikan kasus ini melalui pihak Kepolisian
                    atau Pengadilan Perdata? Jika sudah kapan, dimana dan apa pelaporan/gugatannya?</h6>
                <input name="pertanyaan[legal][question]" style="display: none;" value="Apakah Saudara pernah mencoba melaporkan/menyelesaikan kasus ini melalui pihak Kepolisian atau Pengadilan Perdata? Jika sudah kapan, dimana dan apa pelaporan/gugatannya?" />
                <textarea name="pertanyaan[legal][answer]"
                    class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('pertanyaan.legal.answer') }}</textarea>
                @error('pertanyaan.legal.answer')
                    <x-form.input-error class="mt-2" messages="this field is required" />
                @enderror
            </div>
        </div>
    </header>
</section>
