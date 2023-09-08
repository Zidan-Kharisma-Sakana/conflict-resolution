document.addEventListener("DOMContentLoaded", function (event) {
    let table = new DataTable("#myTable", {
        ordering: false,
        columnDefs: [
            {
                targets: [1, 2, 3, 4, 5, 6],
                orderable: false,
            },
            {
                targets: [0, 5],
                width: "20%",
            },
            {
                targets: [6],
                width: "80px",
            },
        ],
        initComplete: function () {
            this.api()
                .columns([2, 3, 4])
                .every(function () {
                    let column = this;
                    // console.log(this)

                    // Create select element
                    let select = document.createElement("select");

                    select.add(new Option("Semua", ""));
                    console.log(column.footer());
                    column.footer().replaceChildren(select);

                    // Apply listener for user change in value
                    select.addEventListener("change", function () {
                        var val = DataTable.util.escapeRegex(select.value);

                        column
                            .search(val ? "^" + val + "$" : "", true, false)
                            .draw();
                    });

                    // Add list of options
                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.add(new Option(d));
                        });
                });
        },
    });
});
