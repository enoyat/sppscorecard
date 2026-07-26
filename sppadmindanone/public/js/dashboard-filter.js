$(function () {
    $(".select2").select2({
        width: "100%",
    });
});

function loadRegion(id) {
    $.get("/lokasi/getregion/" + id, function (res) {
        let html = '<option value="">Pilih Region</option>';

        $.each(res, function (i, v) {
            html += `<option value="${v.id}">${v.namasitename}</option>`;
        });

        $("#idregion").html(html).trigger("change");
    });
}

function loadSite(id) {
    $.get("/lokasi/getsitename/" + id, function (res) {
        let html = '<option value="">Pilih Site</option>';

        $.each(res, function (i, v) {
            html += `<option value="${v.id}">${v.namasitename}</option>`;
        });

        $("#idsitename").html(html);
    });
}

$(document).on("change", "#idcbu", function () {
    loadRegion($(this).val());
});

$(document).on("change", "#idregion", function () {
    loadSite($(this).val());
});

$(document).on("change", "#idsitename", function () {
    $.get(
        "/lokasi/setsitename",
        {
            id: $(this).val(),
        },
        function () {
            location.reload();
        },
    );
});
