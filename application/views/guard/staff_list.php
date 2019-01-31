<!DOCTYPE html>
<html>
<head>
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
<title>STAFF | PRATHA</title>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function out()
 {
	 return confirm("Are You Sure To Out Staff?");
 }
</script>
</head>

<body>
    <div id="wrapper">
	<?php include('staff_index.php'); ?>
		<?php if($invalid = $this->session->flashdata('in_staff')) { ?>
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
		<?php if($invalid = $this->session->flashdata('out_staff')) { ?>
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
                        <h5>Staffs</h5>
                       
                    </div>
		

					<div class="ibox-content">
					<div class="">
					
					</div>
				  <table id="example" class="table table-striped table-bordered table-hover " id="example">
					<thead>
					<tr>
						<th>Staff Firstname<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Staff Lastname<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Mobile_No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Vehicle_No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Picture</th>
						<th>In / Out</th>
                    </tr>
                    </thead>
                    <?php
                    	if(isset($staff_info))
                    	{
                    		foreach($staff_info as $staff)
                    		{
                    ?>
					<tr>
						<td><?php echo $staff->firstname; ?></td>
						<td><?php echo $staff->lastname; ?></td>
						<td><?php echo $staff->mobile_no?></td>
						<td><?php echo $staff->vehicle_no?></td>
						<td width="150px" height="150px"><img src="<?php echo base_url(); ?>img/owner/staff/<?php echo $staff->pic;?>" height="100%" width="100%"></td>
          <?php
          $staff_id = $staff->staff_id;
          $staff_in_status = $this->guard_model->check_staff_in($staff_id);
           if($staff_in_status > 0)
           { ?>
            
            <td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>guard_controller/staff_list?staff_out_id=<?php echo $staff->staff_id; ?>" class="btn btn-primary" onclick="return out()">OUT</a></center></td>
        <?php   }
           else
          { ?>
            <td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>guard_controller/staff_list?staff_in_id=<?php echo $staff->staff_id; ?>" class="btn btn-primary">IN</a></center></td>
        <?php  } ?>
         
					</tr>
					<?php } } ?>
						</tbody>
					  </table>	
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