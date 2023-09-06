<section id="grafikAktif" class="">
    <h4 class="font-bold text-xl">Grafik Pengaduan Aktif</h4>
    @if (count($data['active']['byYear']))
    <div class="grid grid-cols-2 gap-x-8">
        <div class="w-full md:w-3/4 mx-auto">
            <canvas class="" id="activeByYear"></canvas>
        </div>
        <div class="w-full md:w-3/4 mx-auto">
            <canvas id="activeByPialang"></canvas>
        </div>
    </div>
    @else
    <h4 class="font-bold text-xl text-center">Tidak Ada Pengaduan Aktif</h4>
    @endif
</section>
