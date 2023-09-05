<section id="grafikTahunan" class="">
    <div class="flex justify-between">
        <h4 class="font-bold text-xl">Grafik Pengaduan Tahunan</h4>
        <form action="" method="GET" class="">
            <label for="filterTahun">Filter Tahun</label>
            <input name="year" id="filterTahun" type="number" min="2020" max="2023"
                step="1" value="2023" />
            <x-primary-button>Cari</x-primary-button>
        </form>
    </div>
    <div class="grid grid-cols-2 gap-x-8">
        <div class="">
            <canvas id="statusChart"></canvas>
        </div>
        <div class="">
            <canvas id="lineChart"></canvas>
        </div>
    </div>
</section>
