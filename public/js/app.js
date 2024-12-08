// ---------- Dashboard ---------- //

// === Use DataTables ===
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
// End DataTables

// === Use Select2 Tag on Article ===
$(document).ready(function () {
    $("#tags").select2({
        tags: true,
        tokenSeparators: [","],
        placeholder: "Select or type new tags",
    });
});
// End Select2

// === Slug Otomatis ===
$("#name, #title").on("input", function () {
    var text = $(this).val(); // Ambil nilai dari input field
    var slug = text
        .toLowerCase() // Ubah ke huruf kecil
        .replace(/[^a-z0-9 -]/g, "") // Hapus karakter non-alfanumerik
        .replace(/\s+/g, "-") // Ganti spasi dengan tanda hubung
        .replace(/-+/g, "-"); // Gabungkan beberapa tanda hubung menjadi satu

    $("#slug").val(slug); // Tampilkan slug di input dengan id slug
});
// End Slug
