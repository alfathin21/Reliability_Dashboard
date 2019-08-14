<div class="wrapper wrapper-content">
  <div class="row">
    <div class="col-md-12">
      <div class="ibox float-e-margins" id="form_query">
        <div class="ibox-title">
          <h5><i class="fa fa-laptop"></i>&nbsp; Filter Techlog / Delay Criteria </h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content inspinia-timeline">
          <div class="row">
            <div class="col-md-3">
              <label for="">A/C TYPE :</label>
              <select name=""  class="form-control" id="actype">
               <option value=""></option>
               <?php foreach ($actype as $key ) :?>
                 <option value="<?= $key['ACType'] ?>"><?= $key['ACType'] ?></option>
               <?php endforeach; ?>
             </select>
           </div>
           <div class="col-md-3">
            <div class="form-group">
              <label for="">PART NUMBER :</label>
              <input type="text" name="part" id="part" class="form-control">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">MONTH FROM :</label>
              <input type="text" id="month_from" class="datepicker-here form-control" data-language='en'data-min-view="months" data-view="months" data-date-format="yyyy/mm" />
              <!-- <input type="date" name="month_from" id="month_from" class="form-control"> -->
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">MONTH TO :</label>
           <input type="text" id="month_to" class="datepicker-here form-control" data-language='en'data-min-view="months" data-view="months" data-date-format="yyyy/mm" />
            </div>
          </div>
          <div class="col-md-12">
            <br>
            <button type="button" id="mtbur_view" class="btn btn-success"><i class="fa fa-print"></i>&nbsp;&nbsp;Display Report</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="ibox float-e-margins" id="form_query2">
      <div class="ibox-title">
        <h5><i class="fa fa-laptop"></i>&nbsp; Data MTBUR</h5>
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
        </div>
      </div>
      <div class="ibox-content inspinia-timeline table-responsive" id="sult">
       <div id="ui">
         <h3 id="fh"></h3>
         <hr>
         <h3 id="removal"></h3>
         <hr>
         <h3 id="mtbur"></h3>
      </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5><i class="fa fa-bar-chart-o"></i>&nbsp; Result Table MTBUR</h5>
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
        </div>
      </div>
      <div class="ibox-content inspinia-timeline table-responsive" id="result">
         <table id="table_mtbur" class="table table-bordered table-striped table-hovered"></table>
      </div>
    </div>
  </div>
</div>
</div>
</div>



<script>
  $('#mtbur_view').on('click', function () {
   if ($.fn.dataTable.isDataTable('#table_mtbur')) {
    var table = $("#table_mtbur").DataTable();
    table.destroy();
    $('#table_mtbur').empty();
  }
   var actype  = $('#actype').val();
   var part = $('#part').val();
   var month_from = $('#month_from').val();
   var month_to = $('#month_to').val();
   if (actype == '') {
    alert("Please select  A/Ctype !");
    return false;
  }
  if(month_from == "" || month_to == ""){
    alert("Field Month from and Month to must not empty");
    return false;
  }
   var pencarian_hasil = '<thead id ="head_cek">' +
  '<th class="text-center">No</th>' +
  '<th class="text-center">Date Removal</th>' +
  '<th class="text-center">Part Number</th>' +
  '<th class="text-center">Serial Number</th>' +
  '<th class="text-center">Part Name</th>' +
  '<th class="text-center">Reg</th>' +
  '</tr></thead>' +
  '<tbody id="enakeun"></tbody>';
  $('#table_mtbur').append(pencarian_hasil);
   var table = $("#table_mtbur").DataTable({
        retrieve: true,
        pagin: false,
        //ajax with data to post
        dom: 'Bfrtip',
        buttons: [
                {extend: 'excel', title: 'REPORT MTBUR'},
                {extend: 'pdf', title: 'REPORT MTBUR', orientation: 'landscape',
                pageSize: 'LETTER'}
        ],
        ajax: {
          "url": "<?= base_url('mtbur/search') ?>",
          "type": "POST",
          "data": {
            "actype": actype,
            "part": part,
            "month_to": month_to,
            "month_from": month_from,
         
          },
          complete: function (res) {
            var nilai_fh  =  res.responseJSON.fh;
            var nilai_mtbur = res.responseJSON.removal;
            var nilai_hasil_mtbur = res.responseJSON.hasil_mtbur;
            $('#fh').text('FH : '+nilai_fh);
            $('#mtbur').text('REMOVAL : '+nilai_mtbur);
            $('#removal').text('MTBUR : '+nilai_hasil_mtbur);


          }
        },
        'columns': [{
            data: 'no'
          },
          {
            data: 'DateRem'
          },
          {
            data: 'PartNo'
          },
          {
            data: 'SerialNo'
          },
          {
            data: 'PartName'
          },   
          {
            data: 'Reg'
          }
        ]
      },

      );

});
</script>
