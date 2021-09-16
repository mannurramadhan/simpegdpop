<!-- auto fill -->
onkeyup="isi_otomatis()" 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
function isi_otomatis(){
    var id = $("#tahunsisacuti").val();
    $.ajax({
        url: 'cuti-pegawai/ajuan-cuti/',
        data:"id="+id ,
    }).success(function (data) {
        var json = data,
        obj = JSON.parse(json);
        $('#tahuncuti').val(obj.tahuncuti);
    });
}
</script>

$("#tahunsisacuti").change(function() {
    $.ajax({
      url: '/info/' + $(this).val(),
      type: 'get',
      data: {},
      success: function(data) {
        if (data.success == true) {
          $("#tahunsisacuti").value = data.info;
        } else {
          alert('Cannot find info');
        }
  
      },
      error: function(jqXHR, textStatus, errorThrown) {}
    });
  });

  $fill = DB::table('cuti_tahunans')->where('id', '=', $id)->pluck('tahuncuti');

  