
<div class="wrapper wrapper-content">
  <div class="row">
    <div class="col-md-12">
      <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5><i class="fa fa-users"></i>&nbsp;  Filter Component Removal Criteria</h5>
          <div class="ibox-tools">
            <a class="collapse-link">
              <i class="fa fa-chevron-up"></i>
            </a>
          </div>
        </div>
        <div class="ibox-content inspinia-timeline">
          <div class="row">
            <div class="col-md-6">
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
            <div class="col-md-6">
              <div class="form-group">
                <label for="">A/C REG :</label>
                <input type="text" name="acreg" id="acreg" class="form-control">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">PART NUMBER :</label>
                <input type="number" maxlength="2" name="ata" id="ata" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label">Inline checkboxes</label>
              <div class="col-md-5 col-sm-5">
                
               <input type="checkbox" value="option1" id="inlineCheckbox1"> Unscheduled</label> <label class="checkbox-inline">
                &nbsp;
                <input type="checkbox" value="option2" id="inlineCheckbox2">Scheduled </label> <label class="checkbox-inline">
                </div>
                
                <br>
              </div>

              

              
            </div>
            <div class="row">
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">DATE TO :</label>
                  <input type="date" name="date_to" id="date_to" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">DATE FROM :</label>
                  <input type="date" name="date_from" id="date_from" class="form-control">
                </div>
              </div>
              <div class="col-md-12">
                <br>
                <button class="btn btn-success"><i class="fa fa-print"></i>&nbsp;&nbsp;Display Report</button>
              </div>
              
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


