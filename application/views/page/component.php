<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<div class="wrapper wrapper-content">
  <div class="row">
    <div class="col-md-12">
      <div class="ibox float-e-margins" id="form_query">
        <div class="ibox-title">
          <h5><i class="fa fa-laptop"></i>&nbsp; Filter Componnent Removal Criteria </h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content inspinia-timeline">
          <div class="row">
            <div class="col-md-6">
              <label for="">A/C TYPE :</label>
              <select name=""  class="form-control" id="actype">
               <option value=""></option>
               <?php foreach ($actype as $key ) :?>
                 <option value="<?= $key['ACType'] ?>"><?= $key['ACType'] ?></option>
               <?php endforeach; ?>
             </select>
           </div>
           <div class="col-md-6">
            <div class="form-group">
              <label for="">A/C REG :</label>
              <input type="text" name="acreg" id="acreg" class="form-control">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="form-group">
                <label for="">PART NUMBER :</label>
                <input type="text" name="part" id="part" class="form-control">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Removal Code :</label>
            <div class="col-md-5 col-sm-5">
             <input type="checkbox" onclick="uy()"  id="u"> Unscheduled</label> <label class="checkbox-inline">
              &nbsp;
              <input type="checkbox"  onclick="cuy()" id="s">Scheduled </label> <label class="checkbox-inline">
              </div>
              <br>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">DATE FROM :</label>
                <input type="text" id="date_from" class="datepicker-here form-control" data-language='en' data-date-format="yyyy-mm-dd" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">DATE TO :</label>
                <input type="text" id="date_to" class="datepicker-here form-control" data-language='en' data-date-format="yyyy-mm-dd" />
              </div>
            </div>
            <div class="col-md-12">
              <br>
              <button type="button" id="component_view" class="btn btn-success"><i class="fa fa-print"></i>&nbsp;&nbsp;Display Report</button>
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
          <h5><i class="fa fa-laptop"></i>&nbsp; Grafik Component Removal</h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content inspinia-timeline table-responsive" id="sult">
         <div id="crut"></div>
       </div>
     </div>
   </div>
 </div>
 <div class="row">
  <div class="col-md-12">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <h5><i class="fa fa-bar-chart-o"></i>&nbsp; Result Table Component Removal</h5>
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
        </div>
      </div>
      <div class="ibox-content inspinia-timeline table-responsive" id="result">
       <div class="table-responsive">
         <table id="table_component_removal" class="table table-bordered table-striped table-hovered"></table>
       </div>
     </div>
   </div>
 </div>
</div>
</div>
</div>
<script>
  $('#component_view').on('click', function () {
   if ($.fn.dataTable.isDataTable('#table_component_removal')) {
    var table = $("#table_component_removal").DataTable();
    table.destroy();
    $('#table_component_removal').empty();
  }
  var actype = $('#actype').val();
  var acreg  = $('#acreg').val();
  var part_no = $('#part_no').val();
  var date_to = $('#date_to').val();
  var date_from = $('#date_from').val();
  var part = $('#part').val();
  var u = $('#u').val();
  var s = $('#s').val();
  if (date_to == '' || date_from == '') {
    alert('Please select Date From and Date To !');
    return false;
  } 
  if (actype == '') {
    alert('Please select A/C Type !');
    return false;
  }
  var pencarian_hasil = '<thead id ="head_cek">' +
  '<th class="text-center">No</th>' +
  '<th class="text-center">Notification</th>' +
  '<th class="text-center">ATA</th>' +
  '<th class="text-center">Equipment</th>' +
  '<th class="text-center">Part Number</th>' +
  '<th class="text-center">Serial Number</th>' +
  '<th class="text-center">Register</th>' +
  '<th class="text-center">A/C Type</th>' +
  '<th class="text-center">RemCode</th>' +
  '<th class="text-center">Real Reason</th>' +
  '<th class="text-center">Date Removal</th>' +
  '<th class="text-center">TSN</th>' +
  '<th class="text-center">TSI</th>' +
  '<th class="text-center">CSN</th>' +
  '<th class="text-center">CSI</th>' +
  '</tr></thead>' +
  '<tbody id="enakeun"></tbody>';
  $('#table_component_removal').append(pencarian_hasil);
  var table = $("#table_component_removal").DataTable({
   retrieve: true,
   pagin: false,
        //ajax with data to post
        dom: 'Bfrtip',
        buttons: [
        {extend: 'excel', title: 'REPORT COMPONENT REMOVAL'},
        {extend: 'pdf', title: 'REPORT COMPONENT REMOVAL', orientation: 'landscape',
        pageSize: 'LETTER'}
        ],
        ajax: {
          "url": "<?= base_url('Components/search') ?>",
          "type": "POST",
          "data": {
            "actype": actype,
            "acreg": acreg,
            "date_to": date_to,
            "date_from": date_from,
            "u": u,
            "s": s,
            "part": part
          },
          complete: function (res) {
            var b = res.responseJSON;
            var c = b.graph;
            var e = [];
            var f = [];
            for (var i = 0; i <  c.length; i++) {
              e.push(c[i].dates);
              var j = Number(c[i].number_of_rem);
              f.push(j);
              
            }
            var label_data = [];
            var jumlah_pirep = [];
            Highcharts.chart('crut', {
              chart: {
                type: 'spline'
              },
              title: {
                text: 'Component Removal'
              },

              xAxis: {
                categories: e
              },
              yAxis: {
                title: {
                  text: 'Number'
                },
                labels: {
                  formatter: function () {
                    return this.value;
                  }
                }
              },
              tooltip: {
                crosshairs: true,
                shared: true
              },
              plotOptions: {
                spline: {
                  marker: {
                    radius: 4,
                    lineColor: '#666666',
                    lineWidth: 1
                  }
                }
              },

              series: [{
                name: 'Number of Component Removal In A Month',
                marker: {
                  symbol: 'diamond'
                },
                data: f
              }]
            });  
          }
        },
        'columns': [{
          data: 'no'
        },
        {
          data: 'notification'
        },
        {
          data: 'ata'
        },
        {
          data: 'equipment'
        },
        {
          data: 'PartNo'
        },
        {
          data: 'SerialNo'
        },   
        {
          data: 'Reg'
        },
        {
          data: 'Aircraft'
        },
        {
          data: 'RemCode'
        },
        {
          data: 'real_reason'
        },
        {
          data: 'DateRem'
        },
        {
          data: 'TSN'
        },
        {
          data: 'TSI'
        },
        {
          data: 'CSN'
        },
        {
          data: 'CSI'
        }
        ]
      });
  $('body').addClass('mini-navbar');

});
function uy(){
  var u =  $('#u').val();
  if (u != 'U') {
   $('#u').val('U');
 } else {
  $('#u').val('');
}
}
function cuy(){
  var s =  $('#s').val();
  if (s != 'S') {
   $('#s').val('S');
 } else {
  $('#s').val('');
}
}
</script>



