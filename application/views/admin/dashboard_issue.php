<!DOCTYPE html>
<html>
<head>
<title> ISSUE |  PRATHA </title>
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
</head>

<body>
    <div id="wrapper">
    <?php include('dashboard_index.php'); ?>  
    <?php if($invalid = $this->session->flashdata('booking_approve')) { ?> 
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
    <?php if($invalid = $this->session->flashdata('booking_disapprove')) { ?> 
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
        <!-- =======================================table================================= -->
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Issues</h5>
                       
                    </div>
        

                    <div class="ibox-content">
                    <div class="">
                    </div>   
                  <table id="example" class="table table-striped table-bordered table-hover " id="example">
                    <thead>
                    <tr>
                    	<th>Issue Title<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Description<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Owner/Tenant Name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Image</th>
                        <th>Done</th>
                    </tr>
                    </thead>
                    
<tbody>         

                <?php      
                    if(isset($issues))
                    { 
                       
                     foreach($issues as $show)
                    {
                ?>
                    <tr>
                        <td><?php echo $show->title ?></td>
                        <td><?php echo $show->discription; ?></td>
                        <td><?php echo $show->firstname; ?></td>
                         <td width="150px" height="150px"><img src="<?php echo base_url(); ?>img/issue/<?php echo $show->pic; ?>" height="100%" width="100%"></td>
                         <td><a href="<?php echo base_url(); ?>/admin_controller/dashboard_issue_cont?issue_id=<?php echo $show->issue_id; ?>" class="btn btn-primary">Done</a></td>
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