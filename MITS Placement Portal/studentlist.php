<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
if (!isset( $_SESSION['admin_logged_in'] ) && !isset($_SESSION['faculty_logged_in']))
{
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");    
}
else {
    // Makes it easier to read
    $name = $_SESSION['name'];
    $usertype = $_SESSION['usertype'];
    $college_id = $_SESSION['college_id'];
    $branch = $_SESSION['branch'];


 if (isset($_POST['minimum_cgpa']))
        $minimum_cgpa = $_POST['minimum_cgpa'];
 else
      $minimum_cgpa=0;


 if (isset($_POST['backlogs']))
        $backlogs = $_POST['backlogs'];
 else
      $backlogs=0;
    

 if (isset($_POST['minimum_percent']))
        $minimum_percent= $_POST['minimum_percent'];
 else
      $minimum_percent=0;

   if (isset($_POST['minimum_10th']))
        $minimum_10th = $_POST['minimum_10th'];
 else
      $minimum_10th=0;

   if (isset($_POST['minimum_12th']))
        $minimum_12th = $_POST['minimum_12th'];
 else
      $minimum_12th=0;

   if (isset($_POST['placement_status']))
        $placement_status = $_POST['placement_status'];
 else
      $placement_status="Both";





    $result=$mysqli->query("SELECT * FROM users where usertype ='Student' or usertype='student'");
  }

?>

<!DOCTYPE html>
<html>
    

<head>
        <meta charset="UTF-8">
        <title>MITS | <?= $name?></title>   
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="description" content="">


        <!-- Base Css Files -->
        <link href="assets/libs/jqueryui/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
        <link href="assets/libs/fontello/css/fontello.css" rel="stylesheet" />
        <link href="assets/libs/animate-css/animate.min.css" rel="stylesheet" />
        <link href="assets/libs/nifty-modal/css/component.css" rel="stylesheet" />
        <link href="assets/libs/magnific-popup/magnific-popup.css" rel="stylesheet" /> 
        <link href="assets/libs/ios7-switch/ios7-switch.css" rel="stylesheet" /> 
        <link href="assets/libs/pace/pace.css" rel="stylesheet" />
        <link href="assets/libs/sortable/sortable-theme-bootstrap.css" rel="stylesheet" />
        <link href="assets/libs/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" />
        <link href="assets/libs/jquery-icheck/skins/all.css" rel="stylesheet" />
        <!-- Code Highlighter for Demo -->
        <link href="assets/libs/prettify/github.css" rel="stylesheet" />
        
                <!-- Extra CSS Libraries Start -->
                <link href="assets/libs/jquery-datatables/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
                <link href="assets/libs/jquery-datatables/extensions/TableTools/css/dataTables.tableTools.css" rel="stylesheet" type="text/css" />
                <link href="assets/css/style.css" rel="stylesheet" type="text/css" />
                <!-- Extra CSS Libraries End -->
        <link href="assets/css/style-responsive.css" rel="stylesheet" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <link rel="shortcut icon" href="assets/img/favicon.ico">
        <link rel="apple-touch-icon" href="assets/img/apple-touch-icon.png" />
        <link rel="apple-touch-icon" sizes="57x57" href="assets/img/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-touch-icon-76x76.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="120x120" href="assets/img/apple-touch-icon-120x120.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="assets/img/apple-touch-icon-152x152.png" />
    </head>
    <body class="fixed-left">



<?php
           require 'logout.php'; 

?>	
	<!-- Modal Logout -->
       <!-- Modal End -->	
	<!-- Begin page -->
	<div id="wrapper">
		
        <div class="topbar">
    <div class="topbar-left">
        <div class="logo">
            <h1><a href="#"><img src="assets/img/logo.png" alt="Logo"></a></h1>
        </div>
        <button class="button-menu-mobile open-left">
        <i class="fa fa-bars"></i>
        </button>
    </div>
</div>

        
        <?php require 'userheader.php'; ?>


        
        <?php if(isset($_SESSION['admin_logged_in']))
                    require 'admin_left.php'; 

                else if(isset($_SESSION['faculty_logged_in']))

                    require 'faculty_left.php'; ?>


        <div class="content-page">
			<!-- ============================================================== -->
			<!-- Start Content here -->
			<!-- ============================================================== -->
            <div class="content">
								<!-- Page Heading Start -->
				<div class="page-heading">
            		<h1><i class='fa fa-table'></i> Student List</h1>
            		<h3></h3>            	</div>
            	<!-- Page Heading End-->				<!-- Your awesome content goes here -->




				<div class="row">
                    <div class="form-group">
                        <label  class="col-md-11 ">Minimum criteria<br></label>
                       
                            <div class="col-sm-2">
                                <form method="POST">
                                <input type="number" id="minimum_cgpa" onchange="cgpaChange()" min=0 max=10 step=0.001 class="form-control" placeholder="Enter CGPA" name="minimum_cgpa" value="<?=$minimum_cgpa?>">
                                    <p class="help-block"> CGPA</p>
                             </div>
                            
                             <div class="col-sm-2">
                            
                                <input type="number" id="minimum_percent" onchange="percentChange()" min=0 max=100 step=0.01 class="form-control" placeholder="Enter Btech aggregate" name="minimum_percent" value="<?=$minimum_percent?>">
                                    <p class="help-block"> Btech %</p>
                            
                            </div>
                            
                            <div class="col-sm-2">
                              
                                <input type="number"  min=0 max=100 step=0.001 class="form-control" placeholder="Enter 10th %" name="minimum_10th" value="<?=$minimum_10th?>">
                                    <p class="help-block"> 10th %</p>
                            
                            </div>
                            
                            <div class="col-sm-2">
                          
                                <input type="number"  min=0 max=100 step=0.001 class="form-control" placeholder="Enter 12th %" name="minimum_12th" value="<?=$minimum_12th?>">
                                    <p class="help-block"> 12th %</p>
                                
                            </div>

                        <?php
                        /*
                             <div class="col-sm-2">
                          
                                <select class="form-control" placeholder="Enter Branch" name="branch" value="<?=$minimum_12th?>">
                                    <option>Computer Science & Engineering</option>
                                    <option>Civil Engineering</option>
                                    <option>Electrical & Electronics Engineering</option>
                                    <option>Electronics & Communication Engineering</option>
                                    <option>Mechanical Engineering</option>

                                    </select>
                                    <p class="help-block"> Branch</p>
                                
                            </div>
                */    ?>
                            <div class="col-sm-2">
                          
                                <input type="number"  min=0 max=10 step=1 class="form-control" placeholder="Enter maximum backlogs" name="backlogs" value="<?=$backlogs?>">
                                    <p class="help-block"> Backlogs </p>
                                
                            </div>


                            <div class="col-sm-2">
                          
                                <select class="form-control"  name="placement_status" value="<?=$placement_status?>" onchange="showUser(this.value)">
                                    <option value="Both">Both</option>
                                    <option value="Placed">Placed</option>
                                    <option value="Not placed">Not placed</option>

                                </select><p class="help-block">Placement status</p>
                                
                            </div>

                             <div class="col-sm-7">

                                <button name="search" type="submit" class="btn btn-primary" >Search</button>

                                <button name="export" id="export" type="submit" class="btn btn-primary" onclick="exportTableToExcel('datatables-4')"  >Export</button>

                            </div>


                             </form>
            </div>

   

					<div class="col-md-12">
                        <br>
						<div class="widget">
						
							<div class="widget-content">
				
								<div class="table-responsive" id="student_list">
                                    <br>
									<form class='form-horizontal' role='form'>

                                        

									<table id="datatables-4" class="table table-striped table-bordered" cellspacing="0" width="100%">
									    <thead>
									        <tr>
                                                <th>College ID</th>
									            <th>Student Name</th>
									            <th>Branch</th>
                                   
                                                <th>Email</th>
                                                <th>Phone No.</th>
                                                <th>Date Of Birth</th>
                                            
                                                <th>CGPA</th>
                                                <th>BTech aggregate</th>
                                                <th>Backlogs</th>
                                                <th>10th aggregate</th>
                                                <th>12th aggregate</th>
									     

									        </tr>
									    </thead>
									 

									 
									    <tbody>
                                        <?php

                                        
                                            if($placement_status=="Placed")
                                            {     
                                                
                                            $result=$mysqli->query("SELECT * FROM users where (usertype ='Student' or usertype='student') and college_id in (select college_id from placed)");
                                           
                                            }
                                            else if($placement_status=="Not placed")
                                            {     
                                                
                                            $result=$mysqli->query("SELECT * FROM users where (usertype ='Student' or usertype='student') and college_id  not in (select college_id from placed)");
                                           
                                            }
                                            else
                                                $result=$mysqli->query("SELECT * FROM users where usertype ='Student' or usertype='student'");
                                        
                            
                                            while($row=$result->fetch_array()) { 

                                            $id=$row['college_id'];

                                             $student = ($mysqli->query("SELECT * FROM users where college_id='$id'"))->fetch_assoc();
                                            $personal = ($mysqli->query("SELECT * FROM user_personal_details where college_id='$id'"))->fetch_assoc();
                                       
                                            $academics = ($mysqli->query("SELECT * FROM user_academics where college_id='$id'"))->fetch_assoc();

                                             if (isset($_POST['search'])) 
                                             { 
                                               
                                                      
                                                      if($academics['CGPA']>=$minimum_cgpa&&$academics['10th_mark']>=$minimum_10th&&$academics['12th_mark']>=$minimum_12th&&$academics['CGPA']*10-3.75>=$minimum_percent&&$academics['backlogs']<=$backlogs)    
                                                      {                        
                                                ?>
									        
                                            <tr>
                                                 
                                                <td> <?php echo $row['college_id'] ?> </td>                                              
                                                <td> <?php echo $row['name'] ?> </td>
                                                <td> <?php echo $row['branch'] ?> </td>
                                              
                                                <td> <?php echo $row['emailid'] ?> </td>
                                                <td> <?php echo $personal['phone'] ?> </td>
                                                <td> <?php echo $personal['dob'] ?> </td> 
                                                <td> <?php echo $academics['CGPA'] ?> </td>
                                                <td> <?php echo $academics['CGPA']*10-3.75 ?> </td>
                                                <td> <?php echo $academics['backlogs'] ?> </td>
                                                <td> <?php echo $academics['10th_mark'] ?> </td>
                                                <td> <?php echo $academics['12th_mark'] ?> </td>
                                      

									        </tr>
		
									       <?php
                                       }
                                       }
                                       else
                                       {
                                        ?>
                                             <tr>
                                                
                                                <td> <?php echo $row['college_id'] ?> </td>                                                 
                                                <td> <?php echo $row['name'] ?> </td>
                                                <td> <?php echo $row['branch'] ?> </td>
                                                <td> <?php echo $row['emailid'] ?> </td>
                                                <td> <?php echo $personal['phone'] ?> </td>
                                                <td> <?php echo $personal['dob'] ?> </td>
                                                <td> <?php echo $academics['CGPA'] ?> </td>
                                                <td> <?php echo $academics['CGPA']*10-3.75 ?> </td>
                                                <td> <?php echo $academics['backlogs'] ?> </td>
                                                <td> <?php echo $academics['10th_mark'] ?> </td>
                                                <td> <?php echo $academics['12th_mark'] ?> </td>
                                      

                                            </tr>

                                        <?php
                                       }
                                    }

                                ?>
									    </tbody>
									</table>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>




                 <script>  



function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'student_data.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}



function cgpaChange()
{


    document.getElementById("minimum_percent").value = document.getElementById("minimum_cgpa").value*10-3.75;
}


function percentChange()
{


    document.getElementById("minimum_cgpa").value = document.getElementById("minimum_percent").value/10+.375;
}


 </script>  
			


            	            <!-- Footer Start -->
       
             <footer style="text-align: center;">
                George Scaria &copy; 2018
                
            </footer>
       
            <!-- Footer End -->			
            </div>
			<!-- ============================================================== -->
			<!-- End content here -->
			<!-- ============================================================== -->

        </div>
		<!-- End right content -->

	</div>
	<!-- End of page -->
		<!-- the overlay modal element -->
	<div class="md-overlay"></div>
	<!-- End of eoverlay modal -->
	<script>
		var resizefunc = [];
	</script>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script src="assets/libs/jquery/jquery-1.11.1.min.js"></script>
	<script src="assets/libs/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/libs/jqueryui/jquery-ui-1.10.4.custom.min.js"></script>
	<script src="assets/libs/jquery-ui-touch/jquery.ui.touch-punch.min.js"></script>
	<script src="assets/libs/jquery-detectmobile/detect.js"></script>
	<script src="assets/libs/jquery-animate-numbers/jquery.animateNumbers.js"></script>
	<script src="assets/libs/ios7-switch/ios7.switch.js"></script>
	<script src="assets/libs/fastclick/fastclick.js"></script>
	<script src="assets/libs/jquery-blockui/jquery.blockUI.js"></script>
	<script src="assets/libs/bootstrap-bootbox/bootbox.min.js"></script>
	<script src="assets/libs/jquery-slimscroll/jquery.slimscroll.js"></script>
	<script src="assets/libs/jquery-sparkline/jquery-sparkline.js"></script>
	<script src="assets/libs/nifty-modal/js/classie.js"></script>
	<script src="assets/libs/nifty-modal/js/modalEffects.js"></script>
	<script src="assets/libs/sortable/sortable.min.js"></script>
	<script src="assets/libs/bootstrap-fileinput/bootstrap.file-input.js"></script>
	<script src="assets/libs/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="assets/libs/bootstrap-select2/select2.min.js"></script>
	<script src="assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script> 
	<script src="assets/libs/pace/pace.min.js"></script>
	<script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/libs/jquery-icheck/icheck.min.js"></script>

	<!-- Demo Specific JS Libraries -->
	<script src="assets/libs/prettify/prettify.js"></script>

	<script src="assets/js/init.js"></script>
	<!-- Page Specific JS Libraries -->
	<script src="assets/libs/jquery-datatables/js/jquery.dataTables.min.js"></script>
	<script src="assets/libs/jquery-datatables/js/dataTables.bootstrap.js"></script>
	<script src="assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
	<script src="assets/js/pages/datatables.js"></script>





	</body>

</html>