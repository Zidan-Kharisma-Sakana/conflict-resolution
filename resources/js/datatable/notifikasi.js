document.addEventListener("DOMContentLoaded", function(event) {
    let table = new DataTable('#myTable', {
        "ordering": false,
        "columnDefs": [{
            "targets": [0, 1, 2, 3],
            "orderable": false
        }, {
            "targets": [1],
            "width": '20%'
        }, {
            "targets": [0],
            "width": '180px'
        }, {
            "targets": [3],
            "width": '100px'
        }]
    });
});
