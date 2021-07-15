<div class="box box-default">

    <div class="box-header with-border">
        <h3 class="box-title">Search Criteria</h3>
    </div>

    <div class="box-body table-responsive">
      <form action="<?php echo e(url('/fetch-result')); ?>" method="get">
        <div class="row">
          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">User ID (s) or Range of ID</label>
              <input type="text" class="form-control" name="user_id" value="<?php echo e(old('user_id')); ?>" placeholder="Leave blank for all" >
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">First Name</label>
              <input type="text" class="form-control" name="cus_fname" value="<?php echo e(old('cus_fname')); ?>" placeholder="By First Name" >
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">Middle Name</label>
              <input type="text" class="form-control" name="cus_mname" value="<?php echo e(old('cus_mname')); ?>" placeholder="By Middle Name" >
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">Last Name</label>
              <input type="text" class="form-control" name="cus_lname" value="<?php echo e(old('cus_lname')); ?>" placeholder="By Last Name" >
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">Date From</label>
              <input type="date" class="form-control" name="date_from" value="<?php echo e(old('date_from')); ?>" placeholder="<?= date('Y-m-d'); ?>" >
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">Date To</label>
              <input type="date" class="form-control" name="date_to" value="<?php echo e(old('date_to')); ?>" placeholder="<?= date('Y-m-d'); ?>" >
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">Account Type</label>
              <select name="cus_accttype" id="input" class="form-control" >
                <option value="<?php echo e(old('cus_accttype')); ?>">None</option>
                <option value="main">Main Account</option>
                <option value="subaccount">Sub Account</option>
              </select>
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">Stage</label>
              <select name="cus_stage" class="form-control" >
                <option value="">-Select-Stage-</option>
                <?php
                  $stageCount = 1;
                  while($stageCount <= 5){
                    echo '<option value="'.$stageCount.'">Stage '.$stageCount.'</option>';

                    $stageCount++;
                  }
                ?>
              </select>

              
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">Bank Name</label>
              <input type="text" class="form-control" value="<?php echo e(old('cus_bankname')); ?>" name="cus_bankname" placeholder="Bank Name" >
            </div>
          </div>
          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">Gender</label>
              <select name="cus_gender" id="input" class="form-control" >
                <option value="<?php echo e(old('cus_gender')); ?>">None</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>
          </div>

          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">Select Country</label>
              <select name="cus_country" value="<?php echo e(old('country')); ?>" id="inputGroupCountry" onchange="loadState()" class="form-control"></select>
            </div>
          </div>          


          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">State</label>
              <select id="inputGroupState" value="<?php echo e(old('state')); ?>" name="cus_state" class="form-control cs-states"></select>
            </div>
          </div>

          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="">Result Type</label>
              <select name="result_mg" id="input" class="form-control" >
                <option value="0">Personal</option>
                <option value="1">Business</option>
                <option value="2">Financial</option>
              </select>
            </div>
          </div>
          
          <div class="col-md-3 col-lg-3">
            <div class="form-group">
              <label for="userid">&nbsp;</label>
              <input type="submit" value="Search" class="form-control btn btn-success" >
            </div>
          </div>
        </div>      
      </form>
   
    </div>
</div>