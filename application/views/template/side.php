<body>
  <div id="wrapper">
     <nav class="navbar-default navbar-static-side" role="navigation" style="position:fixed" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <!-- menu nama admin -->
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="img/profile_small.jpg" width="65px" />
                        </span>
                        <a class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                            </span><span class="text-xs block">TER-1</b></span> </span> </a>

                        </div>
                        <div class="logo-element">
                        </div>
                    </li>
                    <!-- akhir -->

                    <!-- Menu kanan -->
                    <li >
                        <a  href="<?= base_url() ?>techlog"><i class="fa fa-database"></i> <span class="nav-label">Techlog / Delay</span> <span class="fa arrow"></span></a>
                    </li>
                     
                     <li>
                        <a  href="<?= base_url() ?>pareto"><i class="fa fa-laptop"></i> <span class="nav-label"> Pareto Techlog / Delay</span> <span class="fa arrow"></span></a>
                    </li>
                     
                     <li>
                        <a href="<?= base_url() ?>components" ><i class="fa fa-cogs"></i> <span class="nav-label">Components Removal</span> <span class="fa arrow"></span></a>
                    </li>
                    
                     <li>
                        <a  href="<?= base_url() ?>pcomponent" ><i class="fa fa-laptop"></i> <span class="nav-label"> Pareto  Removal</span> <span class="fa arrow"></span></a>
                    </li>    

                     <li>
                        <a href="<?= base_url() ?>mtbur"><i class="fa fa-laptop"></i> <span class="nav-label"> MTBUR</span> <span class="fa arrow"></span></a>
                    </li>
                    
                  


                <!-- Akhir Menu -->





            </ul>
        </div>
    </nav>


    <div id="page-wrapper" class="gray-bg dashbard-1">
      <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
          </div>
          <ul class="nav navbar-top-links navbar-right">
            <!-- Notif E-mail -->
            <li class="dropdown">
              <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope"></i>  <span class="label label-warning">6
                </span>
              </a>
              <ul class="dropdown-menu dropdown-messages">
               <li class="divider"></li>

             </ul>
           </li>
           <!-- notif message -->
           <li>
            <a href="<?= base_url('auth/logout') ?>">
              <i class="fa fa-sign-out"></i> Log out
            </a>
          </li>


        </ul>
        <!-- Akhir notif -->
      </nav>
    </div>

    <div class="row">
      <div class="col-lg-12">