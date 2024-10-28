// ---------- Dashboard ---------- //

// Use DataTables
$(document).ready(function () {
    $("#data-table").DataTable({
        language: {
            paginate: {
                previous: '<i class="fas fa-chevron-left"></i>',
                next: '<i class="fas fa-chevron-right"></i>',
            },
        },
    });
});
