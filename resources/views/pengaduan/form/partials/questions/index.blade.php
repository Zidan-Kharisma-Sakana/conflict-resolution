<div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
    <div class="max-w-7xl">
        <section>
            <header>
                <h2 class="text-xl font-medium text-gray-900">
                    {{ __('Pertanyaan') }}
                </h2>
                <div class="grid grid-cols-1 gap-y-4 mt-4">
                    <div>
                        <fieldset>
                            <h6>Apakah pengaduan ini dikuasakan?</h6>
                            <div class="flex gap-x-8 mt-1">
                                <div> <input type="radio" id="yes" name="pertanyaan.kuasa" value="yes" required
                                        {{ old('pertanyaan.kuasa') == 'yes' ? 'checked' : '' }} />
                                    <label for="yes">Yes</label>
                                </div>
                                <div>
                                    <input type="radio" id="no" name="pertanyaan.kuasa" value="no" required
                                        {{ old('pertanyaan.kuasa') == 'no' ? 'checked' : '' }} />
                                    <label for="no">No</label>
                                </div>
                            </div>
                        </fieldset>

                    </div>
                    <div>
                        <h6>Apakah Saudara telah berusaha menyelesaikan kasus Saudara dengan Manajemen Perusahaan -
                            Divisi Complience ? Jika Sudah, apa hasilnya? </h6>
                        <textarea  name="pertanyaan.compliance" class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('pertanyaan.compliance') }}</textarea>
                    </div>
                    <div>
                        <h6>Apakah Kasus ini pernah diselesaikan di Bursa? Jika sudah apa hasilnya </h6>
                        <textarea  name="pertanyaan.exchange" class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('pertanyaan.exchange') }}</textarea>
                    </div>
                    <div>
                        <h6>Apakah Saudara pernah mencoba melaporkan/menyelesaikan kasus ini melalui pihak Kepolisian
                            atau Pengadilan Perdata? Jika sudah kapan, dimana dan apa pelaporan/gugatannya?</h6>
                            <textarea  name="pertanyaan.police" class="mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('pertanyaan.police') }}</textarea>
                    </div>
                </div>
            </header>
        </section>
    </div>
</div>
