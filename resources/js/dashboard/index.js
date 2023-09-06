import "./active";
import "./yearly";
document.addEventListener("DOMContentLoaded", function (event) {
    const selectYear = document.getElementById("selectYear");
    const currentYear = new Date().getFullYear();
    const selectedYear = Number((new URL(document.location)).searchParams.get('year') ?? currentYear);
    Array(currentYear - 2019)
        .fill(0)
        .map((_, idx) => currentYear - idx)
        .forEach((year) => {
            const d = document.createElement("option");
            d.value = String(year);
            d.innerHTML = String(year);
            d.selected = year === selectedYear ? 'selected' : '';
            selectYear.appendChild(d);
        });
});
