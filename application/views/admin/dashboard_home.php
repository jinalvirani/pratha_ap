<!DOCTYPE html>
<html>
<head>
<title> HOME |  PRATHA </title>
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
     return confirm("Are you sure to delete Home?");
 }
</script>
</head>

<body>
    <div id="wrapper">
    <?php include('dashboard_index.php'); ?>  
        <!-- =======================================table================================= -->
        <?php if($invalid = $this->session->flashdata('home_insert')) { ?>
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
        <?php if($invalid = $this->session->flashdata('home_delete')) { ?> 
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
                        <h5>Home Information</h5>
                       
                    </div>
        

                    <div class="ibox-content">
                    <div class="">
                   <a href="<?php echo base_url();?>admin_controller/add_home_cont" class="btn btn-add btn-primary pull-right col-sm-2" >+ Add Home</a>
                    </div>   
                  <table id="example" class="table table-striped table-bordered table-hover " id="example">
                    <thead>
                    <tr>
                    	<th>Home_No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Wing_Name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                         <th>Delete</th>
                    </tr>
                    </thead>
                    
<tbody>         

                <?php      
                    if(isset($homes))
                    { 
                       
                     foreach($homes as $w)
                    {
                ?>
                    <tr>
                        <td><?php echo $w->home_no; ?></td>
                        <td><?php echo $w->wing_name; ?></td>
                        <td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>/admin_controller/dashboard_home_cont?home_id=<?php echo $w->home_id; ?>"><img src="<?php echo base_url(); ?>img/delete.png" height="50%" width="50%" onclick="return del()">Delete</a></center></td>
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