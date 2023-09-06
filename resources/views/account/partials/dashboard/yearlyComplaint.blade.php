<section id="grafikTahunan" class="">
    <div class="flex justify-between">
        <h4 class="font-bold text-xl">Grafik Pengaduan Tahunan</h4>
        <form action="" method="GET" class="">
            <label for="selectYear">Filter Tahun</label>
            <select name="year" id="selectYear"  onchange="this.form.submit()">

            </select>
            {{-- <x-primary-button>Cari</x-primary-button> --}}
        </form>
    </div>
    <div class="grid grid-cols-2 gap-x-8">
        <div class="">
            <canvas id="yearlyByStatus"></canvas>
        </div>
        <div class="">
            <canvas id="yearlyByMonth"></canvas>
        </div>
    </div>
</section>
