import { months as getMonths } from "./utils";

document.addEventListener("DOMContentLoaded", function (event) {
    console.log(data);
    createBarChartStatusYearly(data.pengaduanStats);
    createLineChartYearly(data.pengaduanTrend);
});
function createBarChartStatusYearly({
    created,
    closed,
    disposisi_bursa,
    disposisi_bursa_expired,
    disposisi_pialang,
    finished,
    rejected,
}) {
    const ctx = document.getElementById("statusChart");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: [
                "Menunggu Bappebti",
                "Berkas Ditolak",
                "Diproses Pialang",
                "Diproses Bursa",
                "Bursa Terlambat",
                "Kesepakatan Dibuat",
                "Pengaduan Ditutup",
            ],
            datasets: [
                {
                    label: "Jumlah Pengaduan",
                    data: [
                        created,
                        rejected,
                        disposisi_pialang,
                        disposisi_bursa,
                        disposisi_bursa_expired,
                        finished,
                        closed,
                    ],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
            plugins: {
                title: {
                    display: true,
                    text: "Pengaduan Berdasarkan Status",
                },
            },
        },
    });
}
function createLineChartYearly(pengaduanTrend) {
    const months = getMonths({ count: 12 });
    console.log(months);
    const ctx = document.getElementById("lineChart");
    new Chart(ctx, {
        type: "line",
        data: {
            labels: months,
            datasets: [
                {
                    label: "Jumlah Pengaduan",
                    data: pengaduanTrend,
                    fill: false,
                    borderColor: "rgb(75, 192, 192)",
                    tension: 0.1,
                },
            ],
        },
        options: {
            plugins: {
                title: {
                  display: true,
                  text: 'Trend Pengaduan Tahun Ini',
                }
              }
        },
    });
}