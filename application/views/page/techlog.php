
<div class="wrapper wrapper-content">
  <div class="row">
    <div class="col-md-12">
      <div class="ibox float-e-margins" id="form_query" >
        <div class="ibox-title">
          <h5><i class="fa fa-database"></i>&nbsp; Filter Techlog / Delay Criteria</h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content inspinia-timeline" >
          <div class="row" >
            <div class="col-md-3">
              <div class="form-group">
                <label for="">A/C TYPE :</label>
               <select name=""  class="form-control" id="actype">
                 <option value=""></option>
                 <?php foreach ($actype as $key ) :?>
                 <option value="<?= $key['ACType'] ?>"><?= $key['ACType'] ?></option>
               <?php endforeach; ?>
               </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">A/C REG :</label>
                <input type="text" name="acreg" id="acreg" class="form-control">
              </div>
            </div>
             <div class="col-md-3">
              <div class="form-group">
                <label for="">DATE FROM :</label>
                <input type="date" name="date_from" id="date_from" class="form-control">
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="">DATE TO :</label>
                <input type="date" name="date_to" id="date_to" class="form-control">
              </div>
            </div>
           
            <div class="col-md-2">
              <div class="form-group">
                <label for="">ATA :</label>
                <input type="number" maxlength="2" name="ata" id="ata" class="form-control">
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label for="">SUB ATA :</label>
                <input type="number" maxlength="2" name="subata" id="subata" class="form-control">
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label for="">KEYWORD :</label>
                <input type="text" name="keyword" id="keyword" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
           <div class="col-md-10">
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Delay / Pirep</label>
              <div class="col-sm-12">
                <div class="radio">
                  <label>
                    <input type="radio" name="depir" value="delay" id="radio_delay" onclick="check(this.value)"> Delay <br>
                    <label class="checkbox-inline">
                      <input type="checkbox" id="cl_delay"> Delay
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" id="cl_cancel"> Cancel
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" id="cl_x"> Non Technical Delay
                    </label><br>
                    <label class="checkbox-inline">
                      <input type="checkbox"  id="cl_rta"> RTA
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox"  id="cl_rtb"> RTB
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox"  id="cl_rto"> RTO
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox"  id="cl_rtg"> RTG
                      </label>
                    </label>
                  </div>
                  <div class="radio">
                    <label>
                    <input type="radio" name="depir" value="pirep" id="radio_pirep" onclick="check(this.value)"> Techlog<br>
                    <label class="checkbox-inline">
                      <input type="checkbox" name="pima[]" value="pirep" id="cl_pirep"> Pirep
                    </label>
                    <label class="checkbox-inline">
                      <input type="checkbox" name="pima[]" value="marep" id="cl_marep"> Marep
                    </label>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <button type="button" id="display" class="btn btn-success"><i class="fa fa-print"></i>&nbsp;&nbsp;Display Report</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


  <div class="row">
    <div class="col-md-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5><i class="fa fa-bar-chart"></i>&nbsp; Result Table Delay</h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content inspinia-timeline">
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hovered" id="table_delay"></table>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript"> 
  $('#cl_delay').on('click', function () {
    $('#cl_delay').val('d');
  });
  $('#cl_cancel').on('click', function () {
    $('#cl_cancel').val('c');
  });    
  $('#cl_x').on('click', function () {
    $('#cl_x').val('x');
  });
   $('#cl_rta').on('click', function () {
    $('#cl_rta').val('rta');
  });
   $('#cl_rto').on('click', function () {
    $('#cl_rto').val('rto');
  }); 
   $('#cl_rtb').on('click', function () {
    $('#cl_rtb').val('rtb');
  });  
   $('#cl_rtg').on('click', function () {
    $('#cl_rtg').val('rtg');
  });

   $('#display').on('click', function () {
  $("#table_delay").html();

  var actype = $('#actype').val();
  var acreg  = $('#acreg').val();
  var date_to = $('#date_to').val();
  var date_from = $('#date_from').val();
  var ata = $('#ata').val();
  var sub_ata = $('#subata').val();
  var keyword = $('#keyword').val();
  var cl_delay = $('#cl_delay').val();
  var cl_x = $('#cl_x').val();
  var cl_rta = $('#cl_rta').val();
  var cl_rtb = $('#cl_rtb').val();
  var cl_rto = $('#cl_rto').val();
  var cl_rtg = $('#cl_rtg').val();
  var cl_cancel = $('#cl_cancel').val();
  var radio_delay = $('#radio_delay').val();
  var radio_pirep = $('#radio_pirep').val();

  var cl_dcp =document.getElementById("cl_delay").checked || document.getElementById("cl_cancel").checked || document.getElementById("cl_x").checked || document.getElementById("cl_rta").checked || document.getElementById("cl_rtb").checked || document.getElementById("cl_rtg").checked ;
  if (actype == '') {
    alert("Please select  A/Ctype !");
    return false;
    
  }
  if(document.getElementById("radio_delay").checked){
     if(date_from == "" || date_to == ""){
        alert("Field Datefrom and Dateto must not empty");
        return false;
      }
   else if(cl_dcp == false){
    alert("Checklist Delay, Cancel or All must not empty");
    return false;
  }
}

  var pencarian_hasil = '<thead id ="head_cek">' +
  '<th class="text-center">No</th>' +
  '<th class="text-center">Date</th>' +
  '<th class="text-center">A/C Type</th>' +
  '<th class="text-center">A/C Reg</th>' +
  '<th class="text-center">Sta Dep</th>' +
  '<th class="text-center">Sta Arr</th>' +
  '<th class="text-center">Flight No</th>' +
  '<th class="text-center">Techical Delay Length</th>' +
  '<th class="text-center">ATA' +
  '<th class="text-center">Sub ATA' +
  '<th class="text-center">Problem' +
  '<th class="text-center">Rectification' +
  '<th class="text-center">DCP' +
  '<th class="text-center">RTB/RTA/RTO' +
  '</tr></thead>' +
  '<tbody id="enakeun"></tbody>';
  var pencarian_kedua = '<thead id ="head_cek">' +
  '<th class="text-center">No</th>' +
  '<th class="text-center">Date</th>' +
  '<th class="text-center">Sequence</th>' +
  '<th class="text-center">Notification Number</th>' +
  '<th class="text-center">A/C Type</th>' +
  '<th class="text-center">A/C Reg</th>' +
  '<th class="text-center">Sta Dep</th>' +
  '<th class="text-center">Sta Arr</th>' +
  '<th class="text-center">Flight No' +
  '<th class="text-center">ATA' +
  '<th class="text-center">Sub ATA' +
  '<th class="text-center">Problem' +
  '<th class="text-center">Rectification' +
  '<th class="text-center">Coding' +
  '</tr></thead>' +
  '<tbody id="enakeun"></tbody>';



if (document.getElementById("radio_delay").checked) {
  $('#table_delay').append(pencarian_hasil);
    var table = $("#table_delay").DataTable({
      retrieve: true,
      pagin: false,
       dom: 'Bfrtip',
         buttons: [
                {extend: 'excel', title: 'Delay'},
                {extend: 'pdf', title: 'Delay', orientation: 'landscape',
               pageSize: 'A3'},
        ],
      ajax: {
        "url": "<?= base_url('Techlog/search') ?>",
        "type": "POST",
        "data": {
          "actype": actype,
          "acreg": acreg,
          "dateto": date_to,
          "datefrom": date_from,
          "ata": ata,
          "sub_ata": sub_ata,
          "keyword": keyword,
          "radio_delay" : radio_delay,
          "radio_pirep" : radio_pirep,
          "cl_delay": cl_delay,
          "cl_x": cl_x,
          "cl_rta": cl_rta,
          "cl_rtb": cl_rtb,
          "cl_rto": cl_rto,
          "cl_rtg": cl_rtg,
          "cl_cancel": cl_cancel,

        },
      },
      'columns': [{
        data: 'no'
      },
      {
        data: 'DateEvent'
      },
      {
        data: 'ACtype'
      },
      {
        data: 'Reg'
      },
      {
        data: 'DepSta'
      },   
      {
        data: 'ArivSta'
      },
      {
        data: 'FlightNo'
      },
      {
        data: 'MinTot'
      },
       {
        data: 'ATAtdm'
      },
       {
        data: 'SubATAtdm'
      },
       {
        data: 'Problem'
      },
       {
        data: 'Rectification'
      },
      {
        data: 'DCP'
      }, 
      {
        data: 'RtABO'
      }
      ]
    });
  } else if (document.getElementById("radio_pirep").checked) {
      $('#table_delay').append(pencarian_kedua);
    var table = $("#table_delay").DataTable({
      retrieve: true,
      pagin: false,
       dom: 'Bfrtip',
         buttons: [
                {extend: 'excel', title: 'Delay'},
                {extend: 'pdf', title: 'Delay', orientation: 'landscape',
               pageSize: 'A3'},
        ],
      ajax: {
        "url": "<?= base_url('Techlog/search2') ?>",
        "type": "POST",
        "data": {
          "actype": actype,
          "acreg": acreg,
          "dateto": date_to,
          "datefrom": date_from,
          "ata": ata,
          "sub_ata": sub_ata,
          "keyword": keyword,
          "radio_delay" : radio_delay,
          "radio_pirep" : radio_pirep,
          "cl_delay": cl_delay,
          "cl_x": cl_x,
          "cl_rta": cl_rta,
          "cl_rtb": cl_rtb,
          "cl_rto": cl_rto,
          "cl_rtg": cl_rtg,
          "cl_cancel": cl_cancel,

        },
      },
      'columns': [{
        data: 'no'
      },
      {
        data: 'DateEvent'
      },
      {
        data: 'ACtype'
      },
      {
        data: 'Reg'
      },
      {
        data: 'DepSta'
      },   
      {
        data: 'ArivSta'
      },
      {
        data: 'FlightNo'
      },
      {
        data: 'MinTot'
      },
       {
        data: 'ATAtdm'
      },
       {
        data: 'SubATAtdm'
      },
       {
        data: 'Problem'
      },
       {
        data: 'Rectification'
      },
      {
        data: 'DCP'
      }, 
      {
        data: 'RtABO'
      }
      ]
    });
  }

});
  document.getElementById("radio_delay").checked = true;
  
  check(document.getElementById("radio_delay").value);
  function check(depir) {
    if(depir == "pirep"){
      document.getElementById("cl_delay").disabled = true;
      document.getElementById("cl_cancel").disabled = true;
      document.getElementById("cl_x").disabled = true;
      document.getElementById("cl_rta").disabled = true;
      document.getElementById("cl_rtb").disabled = true;
      document.getElementById("cl_rto").disabled = true;
      document.getElementById("cl_rtg").disabled = true;

      document.getElementById("cl_pirep").disabled = false;
      document.getElementById("cl_marep").disabled = false;
    }
    else{
      document.getElementById("cl_pirep").disabled = true;
      document.getElementById("cl_marep").disabled = true;

      document.getElementById("cl_delay").disabled = false;
      document.getElementById("cl_cancel").disabled = false;
      document.getElementById("cl_x").disabled = false;
      document.getElementById("cl_rta").disabled = false;
      document.getElementById("cl_rtb").disabled = false;
      document.getElementById("cl_rto").disabled = false;
      document.getElementById("cl_rtg").disabled = false;
    }
  
  }

  //confirm input form, if there is null in subject which must not null
</script>

