<!DOCTYPE html>
<html>
<head>
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
<title>VISITOR | PRATHA</title>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function out()
 {
	 return confirm("Are you sure to out visiter?");
 }
</script>
</head>

<body>
    <div id="wrapper">
	<?php include('visiter_index.php'); ?>	
		<?php if($invalid = $this->session->flashdata('out_visiter')) { ?>
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
                        <?php if($invalid = $this->session->flashdata('add_visiter')) { ?>
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
                        <h5>Visitors</h5>
                       
                    </div>
		

					<div class="ibox-content">
					<div class="">
					<a href="<?php echo base_url(); ?>guard_controller/addvisiter_cont" class="btn btn-add btn-primary pull-right col-sm-2" >Visitor In</a>
					</div>
				  <table id="example" class="table table-striped table-bordered table-hover " id="example">
					<thead>
					<tr>
						<th>Visitor Name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Visitor Lastname<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Address<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Wing Number<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Home Number<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Mobile_Number<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Vehicle_Number<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>In_Time<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Picture</th>
						<th>Out</th>
                    </tr>
                    </thead>
					
<tbody>				
					<?php
						if(isset($visiter))
						{
							foreach($visiter as $row)
							{ ?>

							<tr>
								<td><?php echo $row->firstname; ?></td>
								<td><?php echo $row->lastname; ?></td>
								<td><?php echo $row->address;?></td>
								<td><?php echo $row->wing_name;?></td>
								<td><?php echo $row->home_no;?></td>
								<td><?php echo $row->mobile_no;?></td>
								<td><?php echo $row->vehicle_no;?></td>
								<td><?php echo $row->in_time; ?></td>
								<td width="150px" height="150px"><img src="<?php echo base_url(); ?>img/guard/visiter/<?php echo $row->pic; ?>" height="100%" width="100%"></td>
								 <td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>guard_controller/visiter_list?visiter_id=<?php echo $row->visiter_id; ?>" class="btn btn-primary" onclick="return out()">OUT</a></center></td>
							</tr>

							<?php }
						}

					?>				
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