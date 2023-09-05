import { months as getMonths } from "./utils";

document.addEventListener("DOMContentLoaded", function (event) {
    console.log(data);
    createBarChartStatusYearly(data.yearly.byStatus);
    createLineChartYearly(data.yearly.byMonth);
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
                    backgroundColor: "rgb(75, 192, 192)",
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
function createLineChartYearly(byMonth) {
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
                    data: byMonth.total,
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: "Pialang Terlambat",
                    data: byMonth.pialang_late,
                    fill: false,
                    tension: 0.1,
                },
                {
                    label: "Bursa Terlambat",
                    data: byMonth.bursa_late,
                    fill: false,
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
