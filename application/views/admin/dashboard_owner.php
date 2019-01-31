<!DOCTYPE html>
<html>
<head>
<title> OWNER |  PRATHA </title>
<link href="<?php echo base_url(); ?>css/admin/search.css" rel="stylesheet">
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
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function del()
 {
     return confirm("Are You Sure To Delete Owner?");
 }
</script>
</head>

<body>
    <div id="wrapper">
    <?php include('dashboard_index.php'); ?>  
        <!-- =======================================table================================= -->
        <?php if($invalid = $this->session->flashdata('owner_delete')) { ?> 
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Owners</h5>
                       
                    </div>
        

                    <div class="ibox-content">
                    <div class="">
                      <a href="<?php echo base_url(); ?>admin_controller/dashboard_old_owner_cont" class="btn btn-add btn-primary pull-right col-sm-2" >View_Old_Owners</a>
                    </div>   
                  <table id="example" class="table table-striped table-bordered table-hover " id="example">
                    <thead>
                    <tr>
                    	<th>Owner Firstame<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Owner Lastname<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Wing No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Home No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Mobile No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                         <th>Is_Resident<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Image</th>
                         <th>Delete</th>
                    </tr>
                    </thead>
                    
<tbody>         

                <?php      
                    if(isset($owners))
                    { 
                       
                     foreach($owners as $show)
                    {
                ?>
                    <tr>
                        <td><?php echo $show->firstname; ?></td>
                        <td><?php echo $show->lastname; ?></td>
                        <td><?php echo $show->wing_name; ?></td>
                     	 <td><?php echo $show->home_no; ?></td>
                        <td><?php echo $show->mobile_no; ?></td>
                      <td><?php echo $show->is_resident; ?></td>
                         <td width="150px" height="150px"><img src="<?php echo base_url(); ?>img/owner/<?php echo $show->pic; ?>" height="100%" width="100%"></td>
                        <td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>admin_controller/dashboard_owner_cont?owner_id=<?php echo $show->user_id; ?>" onclick="return del()"><img src="<?php echo base_url(); ?>img/delete.png" height="50%" width="50%">Delete</a></center></td>
                    </tr>
                <?php
                    } }
                ?>
                <?php      
                    if(isset($owners_not))
                    { 
                       
                     foreach($owners_not as $show1)
                    {
                ?>
                    <tr>
                        <td><?php echo $show1->firstname; ?></td>
                        <td><?php echo $show1->lastname; ?></td>
                        <td><?php echo $show1->wing_name; ?></td>
                       <td><?php echo $show1->home_no; ?></td>
                        <td><?php echo $show1->mobile_no; ?></td>
                       <td><?php echo "0"; ?></td>
                         <td width="150px" height="150px"><img src="<?php echo base_url(); ?>img/owner/<?php echo $show1->pic; ?>" height="100%" width="100%"></td>
                        <td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>admin_controller/dashboard_owner_cont?owner_id=<?php echo $show1->user_id; ?>" onclick="return del()"><img src="<?php echo base_url(); ?>img/delete.png" height="50%" width="50%">Delete</a></center></td>
                    </tr>
                <?php
                    } }
                ?>
                        </tbody>
                      </table>
                      <center><p> <a href="<?php echo base_url(); ?>admin_controller/showadmin"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
<script src="<?php echo base_url() ?>js/plugins/dataTables/datatables.min.js"></script> 
  <script>
  $(function(){
    $("#example").dataTable();
  })
  </script>
  </div>
</div>
  </div>
 </div>
 </div>
 
<script src="<?php echo base_url(); ?>js/plugins/dataTables/datatables.min.js"></script> 
 <script src="<?php echo base_url(); ?>js/admin/search.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>

 

<?php include("footer.php");?> 
 </body>
</html>