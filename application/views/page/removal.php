<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
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
            <div class="col-md-6">
              <label for="">A/C TYPE :</label>
              <select name=""  class="form-control" id="actype">
               <option value=""></option>
               <?php foreach ($actype as $key ) :?>
                 <option value="<?= $key['ACType'] ?>"><?= $key['ACType'] ?></option>
               <?php endforeach; ?>
             </select>
           </div>
           <div class="form-group">
            <label class="col-sm-4 control-label">Inline checkboxes</label>
            <div class="col-md-5 col-sm-5">
             <input type="checkbox" onclick="uy()"  id="u"> Unscheduled</label> <label class="checkbox-inline">
              &nbsp;
              <input type="checkbox" onclick="cuy()" id="s">Scheduled </label> <label class="checkbox-inline">
              </div>

            </div>    
          </div>
          <br>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="">DATE FROM :</label>

                <input type="text" id="date_from" class="datepicker-here form-control" data-language='en' data-date-format="yyyy-mm-dd" />
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">DATE TO :</label>
                <input type="text" id="date_to" class="datepicker-here form-control" data-language='en' data-date-format="yyyy-mm-dd" />
              </div>
            </div>
            <div class="col-md-6">
              <br>
              <button type="button" id="display_pareto" class="btn btn-success"><i class="fa fa-print"></i>&nbsp;&nbsp;Display Pareto</button>
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
          <h5><i class="fa fa-laptop"></i>&nbsp; TOP 10 COMPONENT REMOVAL</h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content inspinia-timeline table-responsive" id="sult">
         <div id="crot">

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
      <div class="table-responsive">
         <table id="table_pareto" class="table table-bordered table-striped table-hovered"></table>
      </div>
     </div>
   </div>
 </div>
</div>
</div>
</div>
<script>
  $('#display_pareto').on('click', function () {
   if ($.fn.dataTable.isDataTable('#table_pareto')) {
    var table = $("#table_pareto").DataTable();
    table.destroy();
    $('#table_pareto').empty();
  }


  var actype  =  $('#actype').val();
  var date_to =  $('#date_to').val();
  var date_from = $('#date_from').val();
  var u = $('#u').val();
  var s = $('#s').val();
  if (date_to == '' || date_from == '') {
    alert('Please select Date From and Date To !');
    return false;
  }

  var pencarian_hasil = '<thead id ="head_cek">' +
  '<th class="text-center">No</th>' +
  '<th class="text-center">Code</th>' +
  '<th class="text-center">Part Name</th>' +
  '</tr></thead>' +
  '<tbody id="enakeun"></tbody>';
  $('#table_pareto').append(pencarian_hasil);
  var table = $("#table_pareto").DataTable({
    retrieve: true,
    pagin: false,
        //ajax with data to post
        dom: 'Bfrtip',
        buttons: [
        {extend: 'excel', title: 'REPORT PARETO COMPONENT'},
        {extend: 'pdf', title: 'REPORT PARETO COMPONENT', orientation: 'landscape',
        pageSize: 'LETTER'}
        ],
        ajax: {
          "url": "<?= base_url('PComponent/search') ?>",
          "type": "POST",
          "data": {
            "actype": actype,
            "date_to": date_to,
            "date_from": date_from,
            "u" : u,
            "s" : s
          },
          complete: function (res) {
           var jml =  res.responseJSON.jumlah; 

            if (jml ==  10) {
                         var part_0 = res.responseJSON.data[0].PartNo;
           var part_1 = res.responseJSON.data[1].PartNo;
           var part_2 = res.responseJSON.data[2].PartNo;
           var part_3 = res.responseJSON.data[3].PartNo;
           var part_4 = res.responseJSON.data[4].PartNo;
           var part_5 = res.responseJSON.data[5].PartNo;
           var part_6 = res.responseJSON.data[6].PartNo;
           var part_7 = res.responseJSON.data[7].PartNo;
           var part_8 = res.responseJSON.data[8].PartNo;
           var part_9 = res.responseJSON.data[9].PartNo;
           var hasil_part_0 = Number(res.responseJSON.data[0].number_of_part);
           var hasil_part_1 = Number(res.responseJSON.data[1].number_of_part);
           var hasil_part_2 = Number(res.responseJSON.data[2].number_of_part);
           var hasil_part_3 = Number(res.responseJSON.data[3].number_of_part);
           var hasil_part_4 = Number(res.responseJSON.data[4].number_of_part);
           var hasil_part_5 = Number(res.responseJSON.data[5].number_of_part);
           var hasil_part_6 = Number(res.responseJSON.data[6].number_of_part);
           var hasil_part_7 = Number(res.responseJSON.data[7].number_of_part);
           var hasil_part_8 = Number(res.responseJSON.data[8].number_of_part);
           var hasil_part_9 = Number(res.responseJSON.data[9].number_of_part);

           Highcharts.chart('crot', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'TOP 10 COMPONENT REMOVAL'
            },
            xAxis: {
              type: 'category'
            },
            yAxis: {
              title: {
                text: 'Number'
              }

            },
            legend: {
              enabled: false
            },
            plotOptions: {
              series: {
                borderWidth: 0,
                dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}%'
                }
              }
            },

            tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
            {
              name: "PART NO",
              colorByPoint: true,
              data: [
              {
                name: part_0,
                y: hasil_part_0
                
              },
              {
                name: part_1,
                y: hasil_part_1
                
              },
              {
                name: part_2,
                y: hasil_part_2
              },
              {
                name: part_3,
                y: hasil_part_3
              },
              {
                name: part_4,
                y: hasil_part_4
              },
              {
                name: part_5,
                y: hasil_part_5
              },
              {
                name: part_6,
                y: hasil_part_6
              },
              {
                name: part_7,
                y: hasil_part_7
              },
              {
                name: part_8,
                y: hasil_part_8
              },
              {
                name: part_9,
                y: hasil_part_9
              }
              ]
            }
            ]
            


          });
         } else if (jml == 9) {
                     var part_0 = res.responseJSON.data[0].PartNo;
           var part_1 = res.responseJSON.data[1].PartNo;
           var part_2 = res.responseJSON.data[2].PartNo;
           var part_3 = res.responseJSON.data[3].PartNo;
           var part_4 = res.responseJSON.data[4].PartNo;
           var part_5 = res.responseJSON.data[5].PartNo;
           var part_6 = res.responseJSON.data[6].PartNo;
           var part_7 = res.responseJSON.data[7].PartNo;
           var part_8 = res.responseJSON.data[8].PartNo;
       
           var hasil_part_0 = Number(res.responseJSON.data[0].number_of_part);
           var hasil_part_1 = Number(res.responseJSON.data[1].number_of_part);
           var hasil_part_2 = Number(res.responseJSON.data[2].number_of_part);
           var hasil_part_3 = Number(res.responseJSON.data[3].number_of_part);
           var hasil_part_4 = Number(res.responseJSON.data[4].number_of_part);
           var hasil_part_5 = Number(res.responseJSON.data[5].number_of_part);
           var hasil_part_6 = Number(res.responseJSON.data[6].number_of_part);
           var hasil_part_7 = Number(res.responseJSON.data[7].number_of_part);
           var hasil_part_8 = Number(res.responseJSON.data[8].number_of_part);
      
           Highcharts.chart('crot', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'TOP 10 COMPONENT REMOVAL'
            },
            xAxis: {
              type: 'category'
            },
            yAxis: {
              title: {
                text: 'Number'
              }

            },
            legend: {
              enabled: false
            },
            plotOptions: {
              series: {
                borderWidth: 0,
                dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}%'
                }
              }
            },

            tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
            {
              name: "PART NO",
              colorByPoint: true,
              data: [
              {
                name: part_0,
                y: hasil_part_0
                
              },
              {
                name: part_1,
                y: hasil_part_1
                
              },
              {
                name: part_2,
                y: hasil_part_2
              },
              {
                name: part_3,
                y: hasil_part_3
              },
              {
                name: part_4,
                y: hasil_part_4
              },
              {
                name: part_5,
                y: hasil_part_5
              },
              {
                name: part_6,
                y: hasil_part_6
              },
              {
                name: part_7,
                y: hasil_part_7
              },
              {
                name: part_8,
                y: hasil_part_8
              }
              ]
            }
            ]
            


          });
         } else if (jml == 8) {
           var part_0 = res.responseJSON.data[0].PartNo;
           var part_1 = res.responseJSON.data[1].PartNo;
           var part_2 = res.responseJSON.data[2].PartNo;
           var part_3 = res.responseJSON.data[3].PartNo;
           var part_4 = res.responseJSON.data[4].PartNo;
           var part_5 = res.responseJSON.data[5].PartNo;
           var part_6 = res.responseJSON.data[6].PartNo;
           var part_7 = res.responseJSON.data[7].PartNo;
         
           var hasil_part_0 = Number(res.responseJSON.data[0].number_of_part);
           var hasil_part_1 = Number(res.responseJSON.data[1].number_of_part);
           var hasil_part_2 = Number(res.responseJSON.data[2].number_of_part);
           var hasil_part_3 = Number(res.responseJSON.data[3].number_of_part);
           var hasil_part_4 = Number(res.responseJSON.data[4].number_of_part);
           var hasil_part_5 = Number(res.responseJSON.data[5].number_of_part);
           var hasil_part_6 = Number(res.responseJSON.data[6].number_of_part);
           var hasil_part_7 = Number(res.responseJSON.data[7].number_of_part);
    
           Highcharts.chart('crot', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'TOP 10 COMPONENT REMOVAL'
            },
            xAxis: {
              type: 'category'
            },
            yAxis: {
              title: {
                text: 'Number'
              }

            },
            legend: {
              enabled: false
            },
            plotOptions: {
              series: {
                borderWidth: 0,
                dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}%'
                }
              }
            },

            tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
            {
              name: "PART NO",
              colorByPoint: true,
              data: [
              {
                name: part_0,
                y: hasil_part_0
                
              },
              {
                name: part_1,
                y: hasil_part_1
                
              },
              {
                name: part_2,
                y: hasil_part_2
              },
              {
                name: part_3,
                y: hasil_part_3
              },
              {
                name: part_4,
                y: hasil_part_4
              },
              {
                name: part_5,
                y: hasil_part_5
              },
              {
                name: part_6,
                y: hasil_part_6
              },
              {
                name: part_7,
                y: hasil_part_7
              }
              ]
            }
            ]
            


          });
         } else if (jml == 7) {
                     var part_0 = res.responseJSON.data[0].PartNo;
           var part_1 = res.responseJSON.data[1].PartNo;
           var part_2 = res.responseJSON.data[2].PartNo;
           var part_3 = res.responseJSON.data[3].PartNo;
           var part_4 = res.responseJSON.data[4].PartNo;
           var part_5 = res.responseJSON.data[5].PartNo;
           var part_6 = res.responseJSON.data[6].PartNo;
      
           var hasil_part_0 = Number(res.responseJSON.data[0].number_of_part);
           var hasil_part_1 = Number(res.responseJSON.data[1].number_of_part);
           var hasil_part_2 = Number(res.responseJSON.data[2].number_of_part);
           var hasil_part_3 = Number(res.responseJSON.data[3].number_of_part);
           var hasil_part_4 = Number(res.responseJSON.data[4].number_of_part);
           var hasil_part_5 = Number(res.responseJSON.data[5].number_of_part);
           var hasil_part_6 = Number(res.responseJSON.data[6].number_of_part);
      
           Highcharts.chart('crot', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'TOP 10 COMPONENT REMOVAL'
            },
            xAxis: {
              type: 'category'
            },
            yAxis: {
              title: {
                text: 'Number'
              }

            },
            legend: {
              enabled: false
            },
            plotOptions: {
              series: {
                borderWidth: 0,
                dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}%'
                }
              }
            },

            tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
            {
              name: "PART NO",
              colorByPoint: true,
              data: [
              {
                name: part_0,
                y: hasil_part_0
                
              },
              {
                name: part_1,
                y: hasil_part_1
                
              },
              {
                name: part_2,
                y: hasil_part_2
              },
              {
                name: part_3,
                y: hasil_part_3
              },
              {
                name: part_4,
                y: hasil_part_4
              },
              {
                name: part_5,
                y: hasil_part_5
              },
              {
                name: part_6,
                y: hasil_part_6
              }
              ]
            }
            ]
            
          });
         } else if (jml == 6) {
                     var part_0 = res.responseJSON.data[0].PartNo;
           var part_1 = res.responseJSON.data[1].PartNo;
           var part_2 = res.responseJSON.data[2].PartNo;
           var part_3 = res.responseJSON.data[3].PartNo;
           var part_4 = res.responseJSON.data[4].PartNo;
           var part_5 = res.responseJSON.data[5].PartNo;
     
           var hasil_part_0 = Number(res.responseJSON.data[0].number_of_part);
           var hasil_part_1 = Number(res.responseJSON.data[1].number_of_part);
           var hasil_part_2 = Number(res.responseJSON.data[2].number_of_part);
           var hasil_part_3 = Number(res.responseJSON.data[3].number_of_part);
           var hasil_part_4 = Number(res.responseJSON.data[4].number_of_part);
           var hasil_part_5 = Number(res.responseJSON.data[5].number_of_part);
      
           Highcharts.chart('crot', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'TOP 10 COMPONENT REMOVAL'
            },
            xAxis: {
              type: 'category'
            },
            yAxis: {
              title: {
                text: 'Number'
              }

            },
            legend: {
              enabled: false
            },
            plotOptions: {
              series: {
                borderWidth: 0,
                dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}%'
                }
              }
            },

            tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
            {
              name: "PART NO",
              colorByPoint: true,
              data: [
              {
                name: part_0,
                y: hasil_part_0
                
              },
              {
                name: part_1,
                y: hasil_part_1
                
              },
              {
                name: part_2,
                y: hasil_part_2
              },
              {
                name: part_3,
                y: hasil_part_3
              },
              {
                name: part_4,
                y: hasil_part_4
              },
              {
                name: part_5,
                y: hasil_part_5
              }
              ]
            }
            ]
            


          });
         } else if (jml == 5) {
                     var part_0 = res.responseJSON.data[0].PartNo;
           var part_1 = res.responseJSON.data[1].PartNo;
           var part_2 = res.responseJSON.data[2].PartNo;
           var part_3 = res.responseJSON.data[3].PartNo;
           var part_4 = res.responseJSON.data[4].PartNo;
         
           var hasil_part_0 = Number(res.responseJSON.data[0].number_of_part);
           var hasil_part_1 = Number(res.responseJSON.data[1].number_of_part);
           var hasil_part_2 = Number(res.responseJSON.data[2].number_of_part);
           var hasil_part_3 = Number(res.responseJSON.data[3].number_of_part);
           var hasil_part_4 = Number(res.responseJSON.data[4].number_of_part);
        

           Highcharts.chart('crot', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'TOP 10 COMPONENT REMOVAL'
            },
            xAxis: {
              type: 'category'
            },
            yAxis: {
              title: {
                text: 'Number'
              }

            },
            legend: {
              enabled: false
            },
            plotOptions: {
              series: {
                borderWidth: 0,
                dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}%'
                }
              }
            },

            tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
            {
              name: "PART NO",
              colorByPoint: true,
              data: [
              {
                name: part_0,
                y: hasil_part_0
                
              },
              {
                name: part_1,
                y: hasil_part_1
                
              },
              {
                name: part_2,
                y: hasil_part_2
              },
              {
                name: part_3,
                y: hasil_part_3
              },
              {
                name: part_4,
                y: hasil_part_4
              }
              ]
            }
            ]
          });
         } else if (jml ==  4) {
                     var part_0 = res.responseJSON.data[0].PartNo;
           var part_1 = res.responseJSON.data[1].PartNo;
           var part_2 = res.responseJSON.data[2].PartNo;
           var part_3 = res.responseJSON.data[3].PartNo;
        
           var hasil_part_0 = Number(res.responseJSON.data[0].number_of_part);
           var hasil_part_1 = Number(res.responseJSON.data[1].number_of_part);
           var hasil_part_2 = Number(res.responseJSON.data[2].number_of_part);
           var hasil_part_3 = Number(res.responseJSON.data[3].number_of_part);

           Highcharts.chart('crot', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'TOP 10 COMPONENT REMOVAL'
            },
            xAxis: {
              type: 'category'
            },
            yAxis: {
              title: {
                text: 'Number'
              }

            },
            legend: {
              enabled: false
            },
            plotOptions: {
              series: {
                borderWidth: 0,
                dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}%'
                }
              }
            },

            tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
            {
              name: "PART NO",
              colorByPoint: true,
              data: [
              {
                name: part_0,
                y: hasil_part_0
                
              },
              {
                name: part_1,
                y: hasil_part_1
                
              },
              {
                name: part_2,
                y: hasil_part_2
              },
              {
                name: part_3,
                y: hasil_part_3
              }
              ]
            }
            ]
          });
         } else if (jml ==  3) {
           var part_0 = res.responseJSON.data[0].PartNo;
           var part_1 = res.responseJSON.data[1].PartNo;
           var part_2 = res.responseJSON.data[2].PartNo;
        
           var hasil_part_0 = Number(res.responseJSON.data[0].number_of_part);
           var hasil_part_1 = Number(res.responseJSON.data[1].number_of_part);
           var hasil_part_2 = Number(res.responseJSON.data[2].number_of_part);
     
           Highcharts.chart('crot', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'TOP 10 COMPONENT REMOVAL'
            },
            xAxis: {
              type: 'category'
            },
            yAxis: {
              title: {
                text: 'Number'
              }

            },
            legend: {
              enabled: false
            },
            plotOptions: {
              series: {
                borderWidth: 0,
                dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}%'
                }
              }
            },

            tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
            {
              name: "PART NO",
              colorByPoint: true,
              data: [
              {
                name: part_0,
                y: hasil_part_0
                
              },
              {
                name: part_1,
                y: hasil_part_1
                
              },
              {
                name: part_2,
                y: hasil_part_2
              }
              ]
            }
            ]
          });
         } else if (jml == 2) {
          var part_0 = res.responseJSON.data[0].PartNo;
           var part_1 = res.responseJSON.data[1].PartNo;

           var hasil_part_0 = Number(res.responseJSON.data[0].number_of_part);
           var hasil_part_1 = Number(res.responseJSON.data[1].number_of_part);
       
           Highcharts.chart('crot', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'TOP 10 COMPONENT REMOVAL'
            },
            xAxis: {
              type: 'category'
            },
            yAxis: {
              title: {
                text: 'Number'
              }

            },
            legend: {
              enabled: false
            },
            plotOptions: {
              series: {
                borderWidth: 0,
                dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}%'
                }
              }
            },

            tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
            {
              name: "PART NO",
              colorByPoint: true,
              data: [
              {
                name: part_0,
                y: hasil_part_0
                
              },
              {
                name: part_1,
                y: hasil_part_1
                
              }
              ]
            }
            ]
          
          });
         } else if (jml == 1) {
           var part_0 = res.responseJSON.data[0].PartNo;
           var hasil_part_0 = Number(res.responseJSON.data[0].number_of_part);
   
           Highcharts.chart('crot', {
            chart: {
              type: 'column'
            },
            title: {
              text: 'TOP 10 COMPONENT REMOVAL'
            },
            xAxis: {
              type: 'category'
            },
            yAxis: {
              title: {
                text: 'Number'
              }

            },
            legend: {
              enabled: false
            },
            plotOptions: {
              series: {
                borderWidth: 0,
                dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}%'
                }
              }
            },

            tooltip: {
              headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
              pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },

            series: [
            {
              name: "PART NO",
              colorByPoint: true,
              data: [
              {
                name: part_0,
                y: hasil_part_0
                
              }
              ]
            }
            ]
            


          });
         }

         }

       },
       'columns': [{
        data: 'no'
      },
      {
        data: 'PartNo'
      },
      {
        data: 'PartName'
      }
      ]
    },

    );
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


