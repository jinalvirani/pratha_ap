<?php
session_start();
if(!isset($_SESSION['uname']))
{
    header("location:admin_login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title> FACILITY | PRATHA</title>
<link href="css/admin/search.css" rel="stylesheet">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript"> 
      $(document).ready( function() {
        $('#abc').delay(8000).fadeOut();
      });
    </script>
<script>
function update_url(url){
    history.pushState(null,null,url);
}
 </script>
<style>
/*
 * Table wrapper
 */
.dataTables_wrapper 
{
    position: relative;
    clear: both;
    *zoom: 1;
}
/*
 * Filter
 */
.dataTables_filter 
{
    float: right;
    text-align: right;
}
</style>
<title>ADMIN | PRATHA</title>
<script src="js/lib/jquery.js"></script>
<script src="js/dist/jquery.validate.js"></script>
 <script>
function del()
 {
     return confirm("Are you sure to delete  this data...Your Client and Client Releted Data Client_registration,Testimonial and Project Data are Delete?");
 }
</script>
</head>

<body>
    <div id="wrapper">
    <?php include('facility_index.php'); ?>  
        <!-- =======================================table================================= -->
        
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Display Booked Facilities</h5>
                       
                    </div>
        

                    <div class="ibox-content">
                    <div class="">
                    	
                    </div>
                   
                        
        <?php         
                    if(isset($_SESSION['uname']))
                    {
                        include("connection.php");
                        $str="select * from clients";
                        $res=mysql_query($str);
                        if(mysql_num_rows($res)>0)
                        {?>
                  <table id="example" class="table table-striped table-bordered table-hover " id="example">
                    <thead>
                    <tr>
                        <th>facility name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>owner name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>from date<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>to date<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>from time <div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>to time<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Description<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Amount<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Image</th>
                    </tr>
                    </thead>
                    
<tbody>         
<?php
                        while($row=mysql_fetch_array($res))
                        { 
            ?>
                    
                    <tr>
                        <td><?php echo $row['client_name']; ?></td>
                        <td><?php echo $row['client_name']; ?></td>
                        <td><?php echo $row['client_name']; ?></td>
                        <td><?php echo $row['client_name']; ?></td>
                        <td><?php echo $row['client_name']; ?></td>
                        <td><?php echo $row['client_name']; ?></td>
                        <td><?php echo $row['client_name']; ?></td>
                        <td><?php echo $row['client_name']; ?></td>
                        <td width="150px" height="150px"><img src="img/clients/<?php echo $row['client_image']; ?>" height="100%" width="100%"></td>
                    </tr>
                <?php
                        }   
                        ?>
                        </tbody>
                      </table>
<?php
                    }
                }
                else
                {
                    header("location:admin_login.php");
                }
?>  
<script src="js/plugins/dataTables/datatables.min.js"></script> 
  <script>
  $(function(){
    $("#example").dataTable();
  })
  </script>
  <center><p> <a href="facility_list.php"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
                    
  </div>
</div>
  </div>
 </div>
 </div>
 
<script src="js/plugins/dataTables/datatables.min.js"></script> 
 <script src="js/admin/search.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

 

<?php include("footer.php");?> 
 </body>
</html>