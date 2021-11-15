<?php
session_start();
include_once '../assets/conn/dbconnect.php';
// include_once 'connection/server.php';
if(!isset($_SESSION['doctorSession']))
{
header("Location: ../index.php");
}
if (isset($_GET['appid'])) {
    $appid=$_GET['appid'];
    }
        
    if (isset($_GET['submit'])) {
        $ClinicalNotes=$_GET['clinicalNotes'];
        $diagnosis_Notes=$_GET['diagnosis_Notes'];

    $res2=mysqli_query($con,"UPDATE appoitment SET diagnosis_Notes =$diagnosis_Notes, clinicalNotes= $clinicalNotes , WHERE appId=".$appid);
    // $userRow3=mysqli_fetch_array($res,MYSQLI_ASSOC);
    
    // header("Location: invoce.php");
    }
    
    $res2=mysqli_query($con,"SELECT a.*, b.*,c.*
                        FROM patient a
                        JOIN appointment b
                        On a.patientId = b.patientId
                        JOIN doctorschedule c
                        On b.scheduleId=c.scheduleId
                        Order By appId desc");
                        $userRow2=mysqli_fetch_array($res2,MYSQLI_ASSOC);

$usersession = $_SESSION['doctorSession'];
$res=mysqli_query($con,"SELECT * FROM doctor WHERE doctorId=".$usersession);
$userRow=mysqli_fetch_array($res,MYSQLI_ASSOC);




?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Welcome Dr <?php echo $userRow['doctorFirstName'];?> <?php echo $userRow['doctorLastName'];?></title>
        <!-- Bootstrap Core CSS -->
        <!-- <link href="assets/css/bootstrap.css" rel="stylesheet"> -->
        <link href="assets/css/material.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="assets/css/sb-admin.css" rel="stylesheet">
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
        <!-- Custom Fonts -->
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="diagnosis.php">Welcome Dr <?php echo $userRow['doctorFirstName'];?> <?php echo $userRow['doctorLastName'];?></a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    
                    
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userRow['doctorFirstName']; ?> <?php echo $userRow['doctorLastName']; ?><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="doctorprofile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                            </li>
                           
                            <li class="divider"></li>
                            <li>
                                <a href="logout.php?logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
               
                    </div>
                <!-- </div>
                <div id="page-wrapper">
                <div class="container-fluid"> -->
             <!-- panel start -->
             <div id="page-wrapper">
                <div class="container-fluid">
                    
             <div class="panel panel-primary">

<!-- panel heading starat -->

<div class="panel-heading">
    
    <h3 class="panel-title fa fa-user-md" > Dr <?php echo $userRow['doctorFirstName']; ?> <?php echo $userRow['doctorLastName']; ?>Welcome To <?php echo $userRow2['patientFirstName']; ?>'s prescrible notebook </h3>
</div>
<!-- panel heading end -->

<div class="panel-body">
<!-- panel content start -->
  <div class="container">
<section style="padding-bottom: 01px; padding-top: 01px;">
<div class="row">
<!-- start -->
<!-- USER PROFILE ROW STARTS-->

<div class="col-md-9 col-sm-9  user-wrapper">
    <div class="description">
        
        <div class="panel panel-default">
            <div class="panel-body">
                
                
                <table class="table table-user-information" align="center">
                    <tbody>
                        
                        
                        <tr>
                            <td>FirstName</td>
                            <td><?php echo $userRow2['patientFirstName']; ?></td>
                        </tr>
                        <tr>
                            <td>LastName</td>
                            <td><?php echo $userRow2['patientLastName']; ?></td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td><?php echo $userRow2['gender']; ?></td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td><?php echo $userRow2['phone']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $userRow2['patientEmail']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td><?php echo $userRow2['status']; ?>
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Symptoms</td>
                            <td><?php echo $userRow2['appSymptom']; ?>
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Diagnosis</td>
                            <td><?php echo $userRow2['diagnosis_Notes']; ?>
                            </td>
                        </tr>
                        </tr>
                        <tr>
                            <td>Clinical notes</td>
                            <td><?php echo $userRow2['clinicalNotes']; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    
</div>
</div>
<!-- USER PROFILE ROW END-->
<div class="col-md-4">

<!-- Large modal -->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Upadte Diagnoseis History</h4>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form action="<?php $_PHP_SELF ?>" method="post" >
                    <table class="table table-user-information">
                        <tbody>
                        
                            <tr>
                                <td>First Name:</td>
                                <td><input type="text" class="form-control" name="patientFirstName" value="<?php echo $userRow2['patientFirstName']; ?>"  disabled/></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td><input type="text" class="form-control" name="patientLastName" value="<?php echo $userRow2['patientLastName']; ?>" disabled /></td>
                            </tr>
                        
                            <tr>
                                <td>Phone number</td>
                                <td><input type="text" class="form-control" name="phone" value="<?php echo $userRow2['phone']; ?>" disabled /></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="text" class="form-control" name="patientEmail" value="<?php echo $userRow2['patientEmail']; ?>" disabled /></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td><input type="text" class="form-control" name="status" value="<?php echo $userRow2['status']; ?>"  disabled/></td>
                            </tr>
                            <tr>
                                <td>Symptoms</td>
                                <td><input type="text" class="form-control" name="appSymptom" value="<?php echo $userRow2['appSymptom']; ?>" disabled/></td>
                            </tr>
                            <tr>
                                <td>Diagnosis Notes</td>
                                <td><textarea class="form-control" name="diagnosis_Notes"  ><?php echo $userRow2['diagnosis_Notes']; ?></textarea></td>
                            </tr>
                            <tr>
                                <td>Clinical Notes</td>
                                <td><textarea class="form-control" name="clinicalNotes"  ><?php echo $userRow2['clinicalNotes']; ?></textarea></td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" name="submit" class="btn btn-info" value="Update Info"></td>
                                </tr>
                            </tbody>
                            
                        </table>
                        
                        
                        
                    </form>
                    <!-- form end -->
                </div>
                
            </div>
        </div>
    </div>
    <br /><br/>
</div>

</div>
<div class="row">
<div class="col-md-3 col-sm-3">
    
    <div class="user-wrapper">
        <!-- <img s rc="assets/img/1.jpg" class="img-responsive" /> -->
        <div class="description">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Update Profile</button>
        </div>
    </div>
</div>

<!-- panel content end -->
<!-- panel end -->
</div>
</div>
<!-- panel start -->

</div>
</div>
                
    }
                            <?php 
                        



                            $res=mysqli_query($con,"SELECT a.*, b.*,c.*
                                                    FROM patient a
                                                    JOIN appointment b
                                                    On a.patientId = b.patientId
                                                    JOIN doctorschedule c
                                                    On b.scheduleId=c.scheduleId
                                                    Order By appId desc");
                                  if (!$res) {
                                    printf("Error: %s\n", mysqli_error($con));
                                    exit();
                                }
                            while ($appointment=mysqli_fetch_array($res)) {
                                
                                if ($appointment['status']=='notAttended') {
                                    $status="danger";
                                    $icon='circle';
                                    $checked='';

                                } else {
                                    $status="success";
                                    $icon='square';
                                    $checked = 'disabled';
                                }
                                
                              
                                
                             
                                

                                

                            //     echo "<tbody>";
                            //     echo "<tr class='$status'>";
                            //         echo "<td>" . $appointment['patientId'] . "</td>";
                            //         echo "<td>" . $appointment['patientLastName'] . "</td>";
                            //         // echo "<td>" . $appointment['patientPhone'] . "</td>";
                            //         // echo "<td>" . $appointment['patientEmail'] . "</td>";
                            //         echo "<td>" . $appointment['scheduleDay'] . "</td>";
                            //         echo "<td>" . $appointment['scheduleDate'] . "</td>";
                            //         echo "<td>" . $appointment['startTime'] . "</td>";
                            //         echo "<td>" . $appointment['endTime'] . "</td>";
                            //         echo "<td>" . $appointment['appSymptom'] . "</td>";
                            //         echo "<td>" . $appointment['appComment'] . "</td>";
                            //         echo "<td><span class='far fa-plus-".$icon."' aria-hidden='true'></span>".' '."". $appointment['status'] . "</td>";
                            //         echo "<form method='POST'>";
                            //         // echo "<td class='text-center'><input type='checkbox' name='enable' id='enable' value='".$appointment['appId']."' onclick='chkit(".$appointment['appId'].",this.checked);' ".$checked."></td>";
                            //         // echo "<td class='text-center'><a href='diagnosis.php'".$appointment['appId']."' target='_blank'><span class='fa fa-book' aria-hidden='true'></span></a></td>";  
                            // echo "<td class='text-center'><a href='diagnosis.php?appid=".$appointment['appId']."' target='_blank'><span class='fa fa-book' aria-hidden='true'></span></a></td>";
                            // echo "<td class='text-center'><a href='invoice.php?appid=".$appointment['appId']."' target='_blank'><span class='fa fa-print' aria-hidden='true'></span></a></td>";
                               
                            } 
                                echo "</tr>";
                           echo "</tbody>";
                       echo "</table>";
                       echo "<div class='panel panel-default'>";
                       echo "<div class='col-md-offset-3 pull-right'>";
                    //    echo "<button class='btn btn-primary' type='submit' value='Submit' name='submit'>Update</button>";
                        echo "</div>";
                        echo "</div>";
                        ?>
                    </div>
                </div>
                    <!-- panel end -->
 
<script type="text/javascript">
function chkit(uid, chk) {
   chk = (chk==true ? "1" : "0");
   var url = "checkdb.php?userid="+uid+"&chkYesNo="+chk;
   if(window.XMLHttpRequest) {
      req = new XMLHttpRequest();
   } else if(window.ActiveXObject) {
      req = new ActiveXObject("Microsoft.XMLHTTP");
   }
   // Use get instead of post.
   req.open("GET", url, true);
   req.send(null);
}
</script>


 
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->


       
        <!-- jQuery -->
        <script src="../patient/assets/js/jquery.js"></script>
        <script type="text/javascript">
$(function() {
$(".delete").click(function(){
var element = $(this);
var appid = element.attr("id");
var info = 'id=' + appid;
if(confirm("Are you sure you want to delete this?"))
{
 $.ajax({
   type: "POST",
   url: "deleteappointment.php",
   data: info,
   success: function(){
 }
});
  $(this).parent().parent().fadeOut(300, function(){ $(this).remove();});
 }
return false;
});
});
</script>
        <!-- Bootstrap Core JavaScript -->
        <script src="../patient/assets/js/bootstrap.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
         <!-- script for jquery datatable start-->
        <script type="text/javascript">
            /*
            Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
            */
            $(document).ready(function(){
                $('.filterable .btn-filter').click(function(){
                    var $panel = $(this).parents('.filterable'),
                    $filters = $panel.find('.filters input'),
                    $tbody = $panel.find('.table tbody');
                    if ($filters.prop('disabled') == true) {
                        $filters.prop('disabled', false);
                        $filters.first().focus();
                    } else {
                        $filters.val('').prop('disabled', true);
                        $tbody.find('.no-result').remove();
                        $tbody.find('tr').show();
                    }
                });

                $('.filterable .filters input').keyup(function(e){
                    /* Ignore tab key */
                    var code = e.keyCode || e.which;
                    if (code == '9') return;
                    /* Useful DOM data and selectors */
                    var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
                    /* Dirtiest filter function ever ;) */
                    var $filteredRows = $rows.filter(function(){
                        var value = $(this).find('td').eq(column).text().toLowerCase();
                        return value.indexOf(inputContent) === -1;
                    });
                    /* Clean previous no-result if exist */
                    $table.find('tbody .no-result').remove();
                    /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
                    $rows.show();
                    $filteredRows.hide();
                    /* Prepend no-result row if all rows are filtered */
                    if ($filteredRows.length === $rows.length) {
                        $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
                    }
                });
            });
        </script>
        <!-- script for jquery datatable end-->

    </body>
</html>