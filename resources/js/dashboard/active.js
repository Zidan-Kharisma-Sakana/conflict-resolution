document.addEventListener("DOMContentLoaded", function (event) {
    console.log(data);
    createActiveByYear(data.active.byYear);
    createActiveByPialang(data.active.byPialang);
});
function createActiveByYear(data) {
    const ctx = document.getElementById("activeByYear");
    const labels = [];
    const numbers = [];
    for (const [key, value] of Object.entries(data)) {
        labels.push(key);
        numbers.push(value);
    }
    const config = {
        type: "doughnut",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Jumlah Pengaduan",
                    data: numbers,
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Pengaduan Aktif Berdasarkan Tahun",
                },
            },
        },
    };
    new Chart(ctx, config);
}
function createActiveByPialang(data) {
    const ctx = document.getElementById("activeByPialang");
    const labels = [];
    const numbers = [];
    for (const [key, value] of Object.entries(data)) {
        labels.push(key);
        numbers.push(value);
    }
    const config = {
        type: "pie",
        data: {
            labels: labels,
            datasets: [
                {
                    label: "Jumlah Pengaduan",
                    data: numbers,
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                title: {
                    display: true,
                    text: "Pengaduan Aktif Berdasarkan Pialang",
                },
            },
        },
    };
    new Chart(ctx, config);
}
