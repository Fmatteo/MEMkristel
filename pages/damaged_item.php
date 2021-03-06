<?php session_start();
if(empty($_SESSION['id'])):
header('Location:../index.php');
endif;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Company Name | <?php include('../dist/includes/title.php');?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/sample1.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster|Pacifico|Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">
    <style>
     @media print {
          .btn-print {
            display:none !important;
          }
      .main-footer  {
      display:none !important;
      }
      div.dataTables_length label {
        display: none !important;
      }
      div.dataTables_filter label{
        display: none !important;
      }
      div.dataTables_paginate ul.pagination{
        display: none !important;
      }
      div.dataTables_info{
        display: none !important;
      }
      table.table-bordered th:last-child{
        display:none;
      }
    }
    body {
      background-color: #ecf0f5;
    }

    ::-webkit-scrollbar{
      width: 12px;
    }

    ::-webkit-scrollbar-thumb{
      background:linear-gradient(darkred, white);
      border-radius: 6px;
    }

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
      color: #3498db;
    }

    .nav-txt:hover {
      background-color: #3a539b;
      color: white;
      transition: all .2s;
    }

    .main-sidebar {
      background-image: linear-gradient(to left, #22a7f0 , #3498db);
      position: fixed;
      z-index: 5;
    }

    .main-sidebar * a {
      color: white;
    }

    .treeview-menu {
      background-color: #3a539b;
    }

    .reorder-count {
      font-size: 10px !important;
    }

    .box-header {
      background-image: linear-gradient(to left, #22a7f0 , #3498db);
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

    .content-header {
      text-align: right;
      margin-right: 15px;
    }

    .input-group {
      text-align: center;
      width: 100%;
    }

    .save-btn {
      margin: 5px;
      background-color: #3a539b !important;
    }

    .save-btn:hover {
      background-color: #3a539b !important;
    }

    .clear-btn {
      margin: 5px;
    }

    .btn:hover {
      transition: all .2s linear;
    }

    .cat-list {
      background-color: #3a539b;
      padding: 20px 10px !important;
      border-bottom: 1px solid rgba(255, 255, 255, .1);
    }

    .cat-list h2 {
      margin: 0;
      padding: 0;
      font-size: 12px;
      letter-spacing: 2px;
      color: white;
      text-align: center;
      text-transform: uppercase;
      color: #fff;
    }

    .cat-btn {
      text-align: left;
      color: #fff !important;
      font-size: 11.5px;
      letter-spacing: 1px;
      padding-left: 25px !important;
    }

    .cat-btn:hover {
      background-color: #3a539b;
      color: #fff;
    }

    .form-group {
      text-align: center;
      color: #fff;
      margin: 15px auto 0 auto;
      width: 90% !important;
      font-size: 13px;
    }

    input[type="text"] {
      font-size: 13px;
    }

    .stock-btn {
      margin: 5px;
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
          <form method="post" action="damage_add.php" enctype="multipart/form-data">
            <div class="cat-list">
              <h2> Damaged item </h2>
            </div>
            <div class="form-group">
              <label for="date">Select item</label>
              <div class="input-group col-md-12">
                <select class="form-control select2" name="prod_id" id="prod_id" required>
                <?php include('../dist/includes/dbcon.php');
                $query2=mysqli_query($con,"select * from product where branch_id='$branch' order by prod_name")or die(mysqli_error());
                while($row=mysqli_fetch_array($query2)){
                  $id = $row['prod_id'];
                  if ($row['imei'] == ''){
                    if ($row['color'] == ''){?>
                    <option value="<?php echo $row['prod_id'];?>"><?php echo $row['prod_name'];?></option>
                <?php }else{ ?>
                  <?php
                      $sql = "SELECT * FROM furniture WHERE prod_id='$id' AND remarks=''";
                      $query3=mysqli_query($con, $sql)or die(mysqli_error());

                      while($row1 = mysqli_fetch_array($query3))
                      {
                    ?>
                      <option value="<?php echo $row['prod_id'];?>.<?php echo $row1['id']; ?>.furniture">
                        <?php echo $row['prod_name'] ?> | <?php echo $row1['color'] ?>
                      </option>
                    <?php }?>
                <?php }?>
                <?php } else{?>
                  <?php
                      $sql = "SELECT * FROM mobile WHERE prod_id='$id' AND remarks=''";
                      $query3=mysqli_query($con, $sql)or die(mysqli_error());

                      while($row1 = mysqli_fetch_array($query3))
                      {
                    ?>
                      <option value="<?php echo $row['prod_id'];?>.<?php echo $row1['id']; ?>.mobile">
                        <?php echo $row['prod_name'] ?> | <?php echo $row1['imei'] ?>
                      </option>
                    <?php }?>
                <?php }?>
                <?php 
                $prod_qty = $row['prod_qty'];
                }?>
                </select>
              </div><!-- /.input group -->
            </div><!-- /.form group -->
            <div class="form-group">
              <label for="date">Quantity</label>+
              <input type="hidden" name="prod_qty" value="<?php echo $prod_qty;?>">
              <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="qty" name="qty" placeholder="Input Quantity" required>
              </div><!-- /.input group -->
            </div><!-- /.form group -->
            <div class="form-group">
              <label for="remarks">Remarks</label>
              <div class="input-group col-md-12">
                <input type="text" class="form-control pull-right" id="remarks" name="remarks" placeholder="Remarks">
              </div><!-- /.input group -->
            </div><!-- /.form group -->
            <div class="form-group">
              <div class="input-group">                
                <button type="submit" class="btn btn-success stockoutButton stock-btn">Add Damaged</button>
              </div>
            </div><!-- /.form group -->
          </form>	
        </section>
        <!-- /.sidebar -->
      </aside>

          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              <a class="btn btn-md btn-primary" href="home.php">Back</a>
            </h1>
          </section>

          <!-- Main content -->
          <section class="content">
            <div class="col-sm-12">
              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Damaged item history</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <a class = "btn btn-success btn-print" href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Print</a>
                <table id="example1" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>Model</th>
                              <th>Company name</th>
                              <th>Category</th>
                              <th>Qty</th>  
                              <th>Date</th>                           
                              <th>Notification</th>  
                              <th>Remarks</th>                            
                              <th>Action</th> 
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                $branch=$_SESSION['branch'];
                                  $sql="
                                  SELECT * FROM damage a 
                                  LEFT JOIN product b ON a.prod_id = b.prod_id 
                                  LEFT JOIN supplier c ON b.supplier_id = c.supplier_id
                                  LEFT JOIN category d ON b.cat_id = d.cat_id
                                  WHERE a.branch_id='$branch'
                                  order by date desc
                                  ";
                                $query=mysqli_query($con,$sql)or die(mysqli_error());
                                while($row=mysqli_fetch_array($query)){?>
                            <tr>
                              <td><?php if (isset($row['prod_name'])) echo $row['prod_name'];?></td>                              
                              <td><?php if (isset($row['supplier_name']))echo $row['supplier_name'];?></td>
                              <td><?php if (isset($row['cat_name']))echo $row['cat_name'];?></td>
                              <td><?php if (isset($row['damage_qty'])) echo $row['damage_qty'];?></td>
                              <?php 
                              $diff = abs(strtotime(date("Y-m-d")) - strtotime($row['date']));                                            
                              $days = floor($diff/24/60/60);
                              $weeks = floor($days / 7);
                              if($weeks <= 2 ){
                                $color = '#3498db';
                                $text = 'All good';
                              }elseif(( $weeks > 2) && ( $weeks <= 8)){
                                $color = '#f1c40f';
                                $text = 'Its over ' . $weeks . ' weeks';
                              }else{
                                $color = '#c0392b';
                                $text = 'Its over a month now';
                              }
                              ?>                              
                              <td><?php if (isset($row['date'])) echo $row['date'];?></td>
                              <td style="background: <?php echo $color;?>;color:#fff;font-weight: 800;"><?php echo $text; ?></td>
                              <td><?php echo $row['remarks']; ?></td>
                              <td>
                                <a href="#updateitem<?php echo $row['damage_id'];?>" data-target="#updateitem<?php echo $row['damage_id'];?>" data-toggle="modal" style="color:#fff;" class="small-box-footer"><i class="glyphicon glyphicon-edit text-blue"></i></a>
                              </td>
                            </tr>

<div id="updateitem<?php echo $row['damage_id'];?>" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content" style="height:auto">
         <div class="modal-header box-header" style="color:white">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Return damaged <?php if (isset($row['prod_name'])) echo $row['prod_name'];?></h4>
         </div>
     <form class="form-horizontal" method="post" action="damage_update.php" enctype='multipart/form-data'>
         <div class="modal-body">
               <div class="form-group">
                  <label for='qty' class="control-label col-lg-3" style="color:#000;text-align: left">Quantity</label>
                  <div class="col-lg-12">
                     <input type="number" class="form-control" id="qty" name="qty" max="<?php echo $row['damage_qty'];?>" value="<?php echo $row['damage_qty'];?>" required>  
                  </div>
                      <input type="hidden" name='damage_qty' value="<?php echo $row['damage_qty'];?>" required>  
                      <input type="hidden" name='damage_id' value="<?php echo $row['damage_id'];?>" required>  
                      <input type="hidden" name='prod_id' value="<?php echo $row['prod_id'];?>" required>  
                      <input type="hidden" name='prod_qty' value="<?php echo $row['prod_qty'];?>" required>  
               </div>          
         </div>
         <div class="clearfix"></div>
         <hr>
         <div class="row modal-footer" style="padding-right:50px">
         <button type="submit" name = "furniture" class="btn btn-primary">Save changes</button>
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>        
         </div>
          </form>
      </div>
      <!-- END OF MODAL DIALOG -->
   </div>
   <!-- END OF MODAL CONTENT -->
</div>
<!-- END OF MODAL -->
                            <?php }?>					  
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>Model</th>
                              <th>Company name</th>
                              <th>Category</th>
                              <th>Qty</th>                              
                              <th>Date</th>
                              <th>Notification</th>
                              <th>Remarks</th>
                              <th>Actions</th>
                            </tr>					  
                          </tfoot>
                        </table>
                </div><!-- /.box-body -->
 
            </div><!-- /.col -->
			
			
	  
            
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <?php include('../dist/includes/footer.php');?>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
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
       <style>
	table tr td{
		border:1px solid #ddd;
		padding:8px;
		
	}
	table{
		margin-bottom:40px;
	}
	</style> 
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

        $(".deleteButton").click(function(e) {
            e.preventDefault();
			var confirmation = confirm("are you sure you want to remove the item?");

			if (confirmation) {
              $.ajax({
                  type: "POST",
                  url: "ajax.php",
                  data: { 
                      cat_name: $(this).val(), // < note use of 'this' here
                      process: 'categories'
                  },
                  success: function(result) {
                      if(result == ""){ 
                        if(alert(result)){}
                            else    window.location.reload(); 
                        
                      }else{
                        if(alert(result)){}
                            else    window.location.reload(); 
                      }                    
                      
                  },
                  error: function(result) {
                      alert('error');
                  }
              }); // ajax 
			}
		});
			

			$(".historyButton").click(function(e) {
              e.preventDefault();
              $.ajax({
                  type: "POST",
                  url: "ajax.php",
                  data: { 
                      cat_id: $(this).val(), // < note use of 'this' here
                      process: 'cat_history'
                  },
                  success: function(result) {
                      if(result == ""){ 
                          alert("bad")                        
                      }else{
                          $(".history").html(result);
                      }
                      
                  },
                  error: function(result) {
                      alert('error');
                  }
              });
        }); // ajax 		
			
		  $(".glyphicon-edit").click(function(){
			  $(".history").html("");
		  })

      });
    </script>
  </body>
</html>
