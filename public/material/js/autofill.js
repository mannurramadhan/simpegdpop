$("#tahunsisacuti").on("change", function(){

    // ambil nilai
    var tahun = $("#tahunsisacuti option:selected").attr("tahun");

    // pindahkan nilai ke input
    $("#tahuncuti").val(tahun);
});