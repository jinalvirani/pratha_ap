
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
<title>VEHICLE | PRATHA</title>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function del()
 {
	 return confirm("Are You Sure To Delete Vehicle??");
 }
</script>
</head>

<body>
    <div id="wrapper">
	<?php include('myunit_index.php'); ?>	
		<?php if($invalid = $this->session->flashdata('add_vehicle')) { ?>
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                <?php } ?>
         
                  <?php if($invalid = $this->session->flashdata('delete_vehicle')) { ?>
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
                        <h5>My Vehicles </h5>
                       
                    </div>
		

					<div class="ibox-content">
					<div class="">
					<a href="<?php echo base_url(); ?>owner_controller/addvehicle_cont" class="btn btn-add btn-primary pull-right col-sm-2" >+ Add New Vehicle</a>
					</div>
						
		<?php		  
					?>
				  <table id="example" class="table table-striped table-bordered table-hover " id="example">
					<thead>
					<tr>
						<th>Vehicle_No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Vehicle_Type<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Slot_No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Sticker_No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Delete</th>

                    </tr>
                    </thead>
					
<tbody>			
<?php 
						if(isset($vehicle))
						{
						foreach($vehicle as $row)

						{ 
			?>
					
					<tr>
						<td><?php echo $row->vehicle_no; ?></td>
						<td><?php echo $row->vehicle_type; ?></td>
						<td><?php echo $row->slot_no; ?></td>
						<td><?php echo  $row->sticker_no; ?></td>
						<td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>owner_controller/vehicle_list_cont?id=<?php echo $row->vehicle_id; ?>" onclick="return del()"><img src="<?php echo base_url(); ?>img/Delete.png" height="50%" width="50%">Delete</a></center></td>
						
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