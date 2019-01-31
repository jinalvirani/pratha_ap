
 
<?php 
	
		if(isset($wing_name))
		{
			foreach($wing_name as $row)
			{
				$wing_name=$row->wing_name;
				
			}
		}
		if(isset($get_oldslot))
		{
			foreach($get_oldslot as $row)
			{
				$vehicle_id=$row->vehicle_id;
				
				
			}
		}

		if(isset($get_oldslot1))
		{
			foreach($get_oldslot1 as $row)
			{
				$vehicle_id1=$row->vehicle_id;
				
				
			}
		}
		if($all_slot)
		{
			foreach($all_slot as $row)
			{
				$s=$row->slot_no;
				$slot=explode('-',$s);
				$w=$slot[0];
				if($w==$wing_name)
				{
					$same_wing=$row->slot_no;
					break;
				}
			}
		}
		if($all_all_slot)
		{
			//echo "h";
			$count=0;
			foreach($all_all_slot as $row)
			{
				$s1=$row->slot_no;
				$slot1=explode('-',$s1);
				$w1=$slot1[0];
				if($w1==$wing_name)
				{
					//$same_wing=$row->slot_no;
					$count++;
				}
				
			}
		}


			if($all_slot1)
		{
			foreach($all_slot1 as $row)
			{
				$s2=$row->slot_no;
				$slot2=explode('-',$s2);
				$w2=$slot2[0];
				if($w2==$wing_name.$wing_name)
				{
					$same_wing2=$row->slot_no;
					break;
				}
			}
		}
		if($all_all_slot1)
		{
			//echo "h";
			$count22=0;
			foreach($all_all_slot1 as $row)
			{
				$s22=$row->slot_no;
				$slot22=explode('-',$s22);
				$w22=$slot22[0];
				if($w22==$wing_name.$wing_name)
				{
					//$same_wing=$row->slot_no;
					$count22++;
				}
				
			}
		}
	
		
	
?>
<!DOCTYPE html>
<html>
<head>
<title>VEHICLE | PRATHA</title>
<style>
		form .error{
			font-weight: bold;
			color:#cc5965;
			border-color:blue;
		}
</style>
 
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
<script>

$(document).ready(function(){
	
	 $.validator.addMethod("vehicle_no", function(value, element) {
     
         return this.optional(element) || /^[A-Z]{2}[ -][0-9]{1,2}(?: [A-Z])?(?: [A-Z]*)? [0-9]{4}$/.test(value);
     }, "Enter valid vehicle no");
	$("#f1").validate({
		rules:{
			 vehicle_no:{
                required:true,
                vehicle_no:true 
           },

			vehicle_type:
			{
				required:true,
			},
			
		},
		messages:{
			 vehicle_no:{
                required:"please vehicle no",
                vehicle_no:"Eneter valid vehicle number "
           },
			vehicle_type:
			{
				required:"please select vehicle type",
			}
			
		}
	});
});


</script>

</head>

<body>
   <div id="wrapper">
   <?php include('myunit_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Add Vehicles</h3>
                    </div>
                    
			<div class="ibox-content">
				
                                <form action="<?php echo base_url(); ?>owner_controller/add_vehicle_cont" method="post" enctype="multipart/form-data" id="f1">
                                	<input  type="text" name="same_wing" value="<?php if(isset($same_wing)) { echo $same_wing; }?>" hidden>
                                	<input  type="text" name="wing_name" value="<?php if(isset($wing_name)) { echo $wing_name; }?>" hidden>
                                	<input  type="text" name="count" value="<?php if(isset($count)) { echo $count; }?>" hidden>
                                	<!-- 4 wheeler -->
                                	<input  type="text" name="same_wing2" value="<?php if(isset($same_wing2)) { echo $same_wing2; }?>" hidden>
                                	<input  type="text" name="count22" value="<?php if(isset($count22)) { echo $count22; }?>" hidden>
                                	<!--<input  type="text" name="vehicle_id1" value="<?php //if($vehicle_id1) { //echo $vehicle_id1; }?>">-->
                                	
                                
									
									<div class="form-group"><label>Vehicle Number</label> 
									<input  type="text" name="vehicle_no" placeholder="Enter Vehicle Number" class="form-control"></div>
									<div class="form-group"><label>Vehicle Type</label> <br>
									<select name="vehicle_type" style="background-color: #FFFFFF;
  background-image: none;
  border: 1px solid #e5e6e7;
  border-radius: 1px;
  color: inherit;
  display: block;
  padding: 6px 12px;
  transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
  width: 100%;
  font-size: 14px;">
										<option value="" hidden>--Select--</option>
										<option>2-wheeler</option>
										<option>4-wheeler</option>
									</select>
								</div>
							<?php if($invalid = $this->session->flashdata('add_vehicle')) { ?>
 							<div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-dismissable alert-danger">
                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>                    
                              
                               		<div>
									<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Insert Record</strong></button>
									</div><br><br><br>
									</form>
					<center><p> <a href="<?php echo base_url(); ?>owner_controller/vehicle_list_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
                    </div>
                    </div>
                
            </div>
            </div>
			</div>
			 <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>
  
<?php include("footer.php");?>
</body>
</html>