<!Doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?= base_url()?>assets/css/login/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url()?>assets/css/login/GMF.min.css">
  <link href="<?= base_url()?>assets/font-awesome/css/font-awesome.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="<?= base_url()?>assets/images/icon.png">
  <link href="<?= base_url()?>assets/sweetalert2.min.css" rel="stylesheet">
  <title>LOGIN </title>
</head>
<body>
 <section>
  <div class="container container-gmf">
    <div class="row row-gmf">
      <div class="col-md-8 col-sm-8 col-xs-8" >
        <a href="#" class="brand-logo"><img class="img img-responsive img-logo" style="margin-top: 25px; position: absolute;z-index:3;margin-left:45px;" src="<?= base_url()?>assets/img/login/logo_fix2.png" width="260px"></a>
        <div class="frontText" style="   z-index: 2; position: absolute;color:white;padding-top: 200px;padding-left:60px;">
          <h3 style="font-size : 23px; color:white !important; text-shadow: 1px 1px 7px rgba(0,0,0,0.6);">Hi, welcome to !</h3>
          <h2 style="color:white; text-shadow: 1px 1px 10px rgba(0,0,0,0.9);"><b>Reliability Dashboard</b></h2>
          <hr style="border:4px solid white;width:45px;margin-left:0px;margin-top:30px !important">
          <span class="textUnder">By : Reliability Management</span>   <br>
          <span><i>if you have any trouble, please contact to spoc-ict@gmf-aeroasia.co.id</i></span>   
        </div>
        <img src="<?= base_url()?>assets/img/login/bg.jpg" class="img img-responsive img-lf" >
      </div>
      <div class="col-md-4 col-sm-4 col-xs-4 col-xs-4-form">
       <form  class="custom-form" method="post">
            <h4 class="text-center">LOGIN TO YOUR ACCOUNT</h4>
            <div class="right-border">
            </div>
            <div class="left-border">
            </div>

            <div class="form-group" style="margin-top: 50px">
              <input type="text" class="form-control" name="uname"  id="user" autofocus required="" />
              <label for="user" class="animated-label">Employee Number</label>
            </div>
            <div class="form-group" style="margin-top: 40px">
              <input type="password" class="form-control" autocomplete="off" name="pass"  id="pass"  required=""/>
              <label for="pass" class="animated-label">Password</label>
            </div>
           
            
            <div class="submit" style="margin-top:20px;">
              <button class="btn btn-primary btn-block"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;LOGIN</button>
            </div>
          </form>
      </div>
    </div>
  </div>
</section>      
<script src="<?= base_url()?>assets/js/jquery-1.12.4.min.js"></script>
<script src="<?= base_url()?>assets/js/login/bootstrap.min.js"></script>
<script src="<?= base_url()?>assets/sweet.js"></script>


</body>
</html>




