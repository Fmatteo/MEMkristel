<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
if(empty($_SESSION['branch'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Creditor Application | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/sample1.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Pacifico|Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <style>

    .sidebar {  
    width: 250;
    height:100%;
    display: block;
    left: -240px;
    top: 0px;
    transition: left 0.3s linear;
    }

    .sidebar.visible {
    left:0px;
    transition: left 0.3s linear;
    }

    .nav-txt {
      color: white;
    }

    .subnav-txt:hover {
      color: #ff0000;
    }

    .nav-txt:hover {
      background-color: #7d0000;
      color: white;
      transition: all .2s;
    }

    .main-sidebar {
      background-image: linear-gradient(to left, rgba(232,76,61,1) , rgba(193,57,43,1));
      position: fixed;
      z-index: 5;
    }

    .main-sidebar * a {
      color: white;
    }

    .treeview-menu {
      background-color: #7d0000;
    }

    .reorder-count {
      font-size: 10px !important;
    }

    .box-header {
      background-image: linear-gradient(to right, rgba(232,76,61,1) , rgba(193,57,43,1));
    }

    .menu {
      list-style-type: none;
      margin: 0;
      padding: 10px 15px;
    }

    .box-title {
      color: white;
      text-align: center;
      display: block !important;
    }

    .btn:hover {
      transition: all .2s linear;
    }

    .input-group {
      margin-bottom: 10px;
    }

    .submit-btn {
      margin-bottom: 15px;
    }

      
    </style>
 </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body>
  <div class="wrapper">
      <?php include('../dist/includes/header.php');?>
      <!-- Full Width Column -->
      <div class="content-wrapper">
     
            <!-- Navbar Right Menu -->
            <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
             
            <li class="treeview">
              <a href="#" class="dropdown-toggle nav-txt" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-refresh text-white"></i> Reorder
                      <span class="label label-success">
                      <?php 
                      $query=mysqli_query($con,"select COUNT(*) as count from product where prod_qty<=reorder and branch_id='$branch'")or die(mysqli_error());
                      $row=mysqli_fetch_array($query);
                      echo $row['count'];
                      ?>  
                      </span>
                    </a>  
              
            <li class="treeview">
              <a href="#" class="dropdown-toggle nav-txt" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-wrench text-white"></i> Maintenance
                      
                    </a>
              <ul class="treeview-menu">
       <li>
                        
              <li><!-- start notification -->
                            <a href="category.php" class="subnav-txt">
                              <i class="glyphicon glyphicon-user text-white"></i> Company Name
                            </a>
                          </li><!-- end notification -->
                          <li class="nav-txt"><!-- start notification -->
                            <a href="customer.php" class="subnav-txt">
                              <i class="glyphicon glyphicon-user text-white"></i> Customer
                            </a>
                          </li><!-- end notification -->
                          <li class="nav-txt"><!-- start notification -->
                            <a href="creditor.php" class="subnav-txt">
                              <i class="glyphicon glyphicon-user text-white"></i> Credit Applicants
                            </a>
                          </li><!-- end notification -->
              <li class="nav-txt"><!-- start notification -->
                            <a href="product.php" class="subnav-txt">
                              <i class="glyphicon glyphicon-cutlery text-white"></i> Product
                            </a>
                          </li><!-- end notification -->
             
              <li class="nav-txt"><!-- start notification -->
                            <a href="supplier.php" class="subnav-txt">
                              <i class="glyphicon glyphicon-send text-white"></i> Distributor
                            </a>
                          </li><!-- end notification -->
                         
             <li><!-- start notification -->
                            <a href="expenses.php" class="subnav-txt">
                              <i class="glyphicon glyphicon-user text-white"></i> Expenses
                            </a>
                          </li><!-- end notification -->

                        </ul>
                      </li>
                     
                    
                  </li>
    <li class="treeview">
      <a href="stockin.php" class="dropdown-toggle nav-txt">
                      <i class="glyphicon glyphicon-list text-white"></i> Stock in/out
                      
                    </a>
                    <ul class="dropdown-menu">
                      <li>
                      </li>
                     
                    </ul>
                  </li>
    <li class="treeview">
      <a href="#" class="dropdown-toggle nav-txt" data-toggle="dropdown">
                      <i class="glyphicon glyphicon-stats text-white"></i> Report
                     
                    </a>
                   <ul class="treeview-menu">
                     
                          <li><!-- start notification -->
                            <a href="inventory.php" class="subnav-txt">
                              <i class="glyphicon glyphicon-ok text-white"></i>Inventory
                            </a>
                          </li><!-- end notification -->
                        <li><!-- start notification -->
                         <a href="sales.php" class="subnav-txt">
                              <i class="glyphicon glyphicon-usd text-white"></i>Sales
                            </a>
                          </li><!-- end notification -->
              <li><!-- start notification -->
                         <a href="receivables.php" class="subnav-txt" style="display:none;">
                              <i class="glyphicon glyphicon-th-list text-white"></i>Account Receivables
                            </a>
                          </li><!-- end notification -->
              <li><!-- start notification -->
                         <a href="income.php" class="subnav-txt" style="display:none;">
                              <i class="glyphicon glyphicon-th-list text-white"></i>Branch Income
                            </a>
                          </li><!-- end notification -->
                          <li><!-- start notification -->
                         <a href="purchase_request.php" class="subnav-txt" style="display:none;">
                              <i class="glyphicon glyphicon-usd text-white"></i>Purchase Request
                            </a>
                          </li><!-- end notification -->
                        </ul>
                      </li>
                    
    <li class="treeview">
      <a href="profile.php" class="dropdown-toggle nav-txt">
                      <i class="glyphicon glyphicon-cog text-white"></i>
                      <?php echo $_SESSION['name'];?>
                    </a>
                  </li>

    <li class="treeview">
       <a href="logout.php" class="dropdown-toggle nav-txt">
                      <i class="glyphicon glyphicon-off text-white"></i> Logout 
                      
                    </a>
                  </li>       
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>



          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <a class="btn btn-lg btn-danger" href="creditor.php">Back</a>
              
            </h1>
            <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Customer</li>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="row">
	           <div class="col-xs-12">
              <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Apply As New Creditor</h3>
                </div>
                <div class="box-body">
                  <!-- Date range -->
                  <form method="post" action="creditor_add.php" enctype="multipart/form-data" class="form-horizontal">
                  <div class="row">
                    <div class="col-md-4">
          					  <label for="date">Last Name</label>
                      <div class="input-group col-md-12">
            						<div class="input-group col-sm-12">
            						  <input type="text" class="form-control pull-right" id="date" name="last" placeholder="Last Name" required>
            						</div><!-- /.input group -->
          					  </div><!-- /.form group -->
                    </div>
                    
                    <div class="col-md-4">  
                      <label for="date">First Name</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="first" placeholder="First Name" required>
                      </div><!-- /.input group -->
                      
                    </div>
                    
                  </div><!--row-->
                  <div class="row">
                    <div class="col-md-4" style="display: none;">  
                      <label for="date">Birthday</label>
                      <div class="input-group col-md-12">
                          <input type="date" class="form-control pull-right" id="date" name="bday" placeholder="Customer First Name">
                      </div><!-- /.input group -->
                    </div>

                    <div class="col-md-4">
                      <label for="date">Nick Name</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="nickname" placeholder="Nickname" required>
                      </div>
                    </div>

                    <div class="col-md-4">  
                      <label for="date">Telephone No. & Cellphone No.</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="contact" placeholder="Customer Contact No." required>
                      </div><!-- /.input group -->
                    </div>
                    
                   </div>
                  <div class="row">
                    <div class="col-md-8">  
                      <label for="date">Present Home Address</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="address" placeholder="Customer Complete Address" required>
                      </div><!-- /.input group -->
                    </div>
                  
                  </div><!--row--> 
                  
                  </div><!-- /.form group --> <!-- BOX BODY -->

                  <div class="row" style="display: none;">
                    <div class="col-md-6">  
                      <label for="date">House Status</label>
                      <div class="input-group col-md-6">
                          <input type="radio" name="house_status" value="owned" checked="checked" >Owned
                          <input type="text" class="form-control pull-right" id="date" name="years" placeholder="# of years">
                      </div>

                    </div>
                    <div class="col-md-6">  
                      <label for="date"></label>
                      <div class="input-group col-md-6">
                          <input type="radio" name="house_status" value="rent">Rent
                          <input type="text" class="form-control pull-right" id="date" name="years" placeholder="# of years">
                      </div>

                    </div>


                    <div class="col-md-12">
                      <label for="date">If renting</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="rent" placeholder="Landlord Name, Address, Contact Number">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                      <label for="date">Name of Employer or Business</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="emp_name" placeholder="Employer Name or Business">
                        </div>  
                      </div>
                    <div class="col-md-6">
                      <label for="date">Employer/Business Contact #</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="emp_no" placeholder="Employer Name or Business Contact Number">
                        </div>  
                      </div>
                    <div class="col-md-6">
                      <label for="date">Employer or Business Address</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="emp_address" placeholder="Employer Name or Business Address">
                        </div>  
                      </div>
                    <div class="col-md-6">
                      <label for="date">Years Employed or in Business</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="emp_year" placeholder="Years of Employment/Business">
                        </div>  
                      </div>  
                    <div class="col-md-6">
                      <label for="date">Occupation</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="occupation" placeholder="Creditor's Occupation">
                        </div>  
                      </div>
                    <div class="col-md-6">
                      <label for="date">Monthly Salary/ Net Business Income</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="salary" placeholder="Employer Name or Business">
                        </div>  
                      </div>    
                    <div class="col-md-6">
                      <label for="date">Spouse Name</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="spouse" placeholder="Complete Name of Spouse">
                        </div>  
                      </div>
                    <div class="col-md-6">
                      <label for="date">Cellphone Number</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="spouse_no" placeholder="Spouse Contact Number">
                        </div>  
                      </div>    
                    <div class="col-md-6">
                      <label for="date">Spouse Employer or Business</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="spouse_emp" placeholder="Spouse Employer or Business">
                        </div>  
                      </div>
                    <div class="col-md-6">
                      <label for="date">Spouse Employer or Business Address & Telephone Number</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="spouse_details" placeholder="Spouse Employer or Business Address & Telephone Number">
                        </div>  
                      </div>  
                    <div class="col-md-12">
                      <label for="date">Spouse Monthly Income</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="spouse_income" placeholder="Spouse Monthly Income">
                        </div>  
                      </div>
                      <div class="col-md-6">
                      <label for="date">Name of Co-Maker (If required)</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="comaker" placeholder="Name of Co-Maker">
                        </div>  
                      </div>
                    <div class="col-md-6">
                      <label for="date">Present Home Address & Telephone # of Co-Maker</label>
                      <div class="input-group col-md-12">
                          <input type="text" class="form-control pull-right" id="date" name="comaker_details" placeholder="Present Home Address & Telephone # of Co-Maker">
                        </div>  
                      </div>    
                    
                  </div><!--row-->     
                      <div class="col-md-12">
                        <button class="btn btn-lg btn-primary submit-btn pull-left" id="daterange-btn" name="">Submit</button>	
                      </div>  
					
				  </form>	

                
        
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          
            
            

          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../plugins/select2/select2.full.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables/dataTables.bootstrap.min.js"></script>
    
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
     <script>
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
    </script>
  </body>
</html>
