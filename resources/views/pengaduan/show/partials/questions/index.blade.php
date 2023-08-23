<section>
    <header>
        <h2 class="text-xl font-medium text-gray-900 mb-1">
            Pertanyaan dan Jawaban
        </h2>
    </header>
    <section class="grid grid-cols-1 gap-y-2">
        @foreach ($pengaduan->pertanyaanPengaduans as $item)
            <div>
                <h6>{{ ($loop->index + 1) . '.  ' . $item->pertanyaan }}</h6>
                <textarea name="kronologi[description]" disabled
                class="mt-1 w-full border-gray-300 rounded-md shadow-sm">{{ $item->jawaban }}</textarea>
            </div>
        @endforeach
    </section>
</section>
