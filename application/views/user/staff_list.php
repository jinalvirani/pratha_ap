
<!DOCTYPE html>
<html>
<head>
	 <title> STAFF | PRATHA </title>
<link href="<?php echo base_url(); ?>css/admin/search.css" rel="stylesheet">
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
<title>STAFF | PRATHA</title>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function del()
 {
	 return confirm("Are you sure to delete staff?? ");
 }
</script>
</head>

<body>
    <div id="wrapper">
	<?php include('myunit_index.php'); ?>	

	<?php if($invalid = $this->session->flashdata('add_staff')) { ?>
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
          <?php if($invalid = $this->session->flashdata('update_staff')) { ?>
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
                  <?php if($invalid = $this->session->flashdata('delete_staff')) { ?>
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
                        <h5>Display All Staff Members </h5>
                       
                    </div>
		

					<div class="ibox-content">
					<div class="">
					<a href="<?php echo base_url(); ?>owner_controller/add_staff_cont" class="btn btn-add btn-primary pull-right col-sm-2" >+ Add New Staff</a>
					</div>
						
					
									
				  <table id="example" class="table table-striped table-bordered table-hover " id="example">
					<thead>
					<tr>
						<th>Fist Name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Last Name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Gender<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Address<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Mobile Number<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Vehicle Number<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Category<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Image</th>
						<th>Edit</th>
						<th>Delete</th>
						<th>Qrcode</th>
                    </tr>
                    </thead>
					
<tbody>			

						<?php
						if(isset($staff))
						{
							foreach($staff as $row)
							{


						?>
					
					<tr>
						<td><?php echo $row->firstname; ?></td>
						<td><?php echo $row->lastname; ?></td>
						<td><?php echo $row->gender; ?></td>
						<td><?php echo $row->address; ?></td>
						<td><?php echo $row->mobile_no; ?></td>
						<td><?php echo $row->vehicle_no; ?></td>
						<td><?php echo $row->category; ?></td>
						<td width="150px" height="150px"><img src="<?php echo base_url(); ?>img/owner/staff/<?php echo $row->pic; ?>" height="80%" width="100%"></td>
						<td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>owner_controller/update_staff_cont?id=<?php echo $row->staff_id; ?>"><img src="<?php echo base_url(); ?>img/edit.png" height="50%" width="50%">Edit</a></center></td>
						<td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>owner_controller/staff_list_cont?id=<?php echo $row->staff_id; ?>" onclick="return del()"><img src="<?php echo base_url(); ?>img/delete.png" height="50%" width="50%">Delete</a></center></td>


						<td><a href="<?php echo base_url(); ?>owner_controller/filedl?filename=<?php echo $row->qrcode; ?>"><span class="fa fa-arrow-circle-o-down" style="font-size: 24px;"></span></a> </td>
					</tr>
					<?php 
						}
					}
					?>
								
			   			</tbody>
					  </table>

					
				
<script src="<?php echo base_url(); ?>js/plugins/dataTables/datatables.min.js"></script>	
  <script>
  $(function(){
    $("#example").dataTable();
  })
  </script>
   <center><p> <a href="<?php echo base_url(); ?>owner_controller/myunitlist_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>       
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