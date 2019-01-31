<!DOCTYPE html>
<html>
<head>
<title> MAINTENANCE |  PRATHA </title>
<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript"> 
      $(document).ready( function() {
        $('#abc').delay(8000).fadeOut();
      });
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
 <?php if($invalid = $this->session->flashdata('maintenance_penalty')){  ?>
    <script>
        $(document).ready(function () {
    swal({
        title: "Maintenance_Penalty",
        text:"Maintenance Penalty success",
        type: "success",
        closeOnConfirm: false,
        closeOnCancel: false
        }
        );

});
    </script>
<?php } ?>
<title>ADMIN | PRAHTA</title>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function del()
 {
	 return confirm("Are you sure to delete  this data...?");
 }
</script>
</head>
<body>
<div id="wrapper">
	<?php include('dashboard_index.php'); ?>	
		<!-- =======================================table================================= -->
		
			
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Unpaid Maintenances</h5>
                    </div>
	
	<div class="ibox-content">
	 <div class="">
         
                    </div>   
                  <table id="example" class="table table-striped table-bordered table-hover " id="example">
                    <thead>
                    <tr>
                    	<th>Owner/Tenant Firstname<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Amount<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Due Date<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                         <th>Penalty<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Wing_Name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Home_No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Panelty</th>
                    </tr>
                    </thead>
                    
<tbody>         

                <?php      
                    if(isset($maintanances))
                    { 
                       
                     foreach($maintanances as $m)
                    {
                ?>
                    <tr>
                        <td><?php echo $m->firstname ?></td>
                        <td><?php echo $m->amount; ?></td>
                        <td><?php echo $m->due_date; ?></td>
                        <td><?php echo $m->penalty; ?></td>
                        <td><?php echo $m->wing_name; ?></td>
                     	 <td><?php echo $m->home_no; ?></td>
                         <td><a href="#myModal_<?php echo $m->maintanance_id; ?>" class="btn btn-primary" id="panelty" data-toggle="modal" data-target="#myModal_<?php echo $m->maintanance_id; ?>">Panelty</a></td>
                    </tr>
<div id="myModal_<?php echo $m->maintanance_id; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Maintenance Penalty</h4>
      </div>
      <div class="modal-body">
        <?php
        	$maintanance_id = $m->maintanance_id;
        ?>
        <form method="post" action="<?php echo base_url(); ?>admin_controller/penalty_cont">
        	<input type="text" name="maintenance_id" value="<?php echo $m->maintanance_id; ?>" hidden>
        	
        	
        	<?php
			$date = $m->due_date;
$cur_date = date('Y-m-d');
$date1 = date_create($cur_date);
$date2 = date_create($date);

//difference between two dates
$diff = date_diff($date2,$date1);

//count days
$days = $diff->format("%a");


        	 ?>
        	 <div class="form-group"><label>Panelty Amount</label> 
			<input  type="number" name="penalty" size="50" placeholder="Enter panelty amount" class="form-control" required=""></div>
        	 <div class="form-group"><label>No Of Days</label> 
			<input  type="number" name="days" size="50" class="form-control" required="" value="<?php echo $days; ?>" readonly></div>
        	<div>
			<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Send</strong></button>
			</div>
        </form>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



                <?php
                    } }
                ?>
                        </tbody>
                      </table>




<center><p> <a href="<?php echo base_url(); ?>admin_controller/showadmin"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
               		 </div>
            </div>
        </div>
    </div>
</div>
  <script src="<?php echo base_url() ?>js/plugins/dataTables/datatables.min.js"></script> 
  <script>
  $(function(){
    $("#example").dataTable();
  })
  </script>
<script src="<?php echo base_url(); ?>js/plugins/dataTables/datatables.min.js"></script> 
 <script src="<?php echo base_url(); ?>js/admin/search.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>

<?php include('footer.php'); ?>  
</body>
</html>