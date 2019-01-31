<?php 
	if(isset($facility))
	{
		foreach($facility as $row)
		{
			$facility_name=$row->facility_name;
			$charge=$row->charge_per_hour;
			$facility_id=$row->facility_id;
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>FACILITY | PRATHA</title>
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
	
		
	$("#f1").validate({
		rules:{
			bookdate:{
				required:true,
			},
			time:
			{
				required:true,
			},
			
		},
		messages:{
			bookdate:{
				required:"Please select date for Booking",
				
			},
			time:
			{
				required:"please select time_slot for Bokking",
			},
			
		}
	});
});



</script>

</head>

<body>
   <div id="wrapper">
   <?php include('bookfacility_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Book <?php echo $facility_name; ?></h5>
                        
						
                    </div>
			<div class="ibox-content">
				
                                <form action="<?php echo base_url(); ?>owner_controller/bookfacility_record_cont" method="post" enctype="multipart/form-data" id="f1">
                                	<input type="hidden" name="facility_id" size="50" class="form-control" value="<?php if($facility_id) { echo $facility_id; }?>" hidden>
                                	<br>

                                	 <?php if($invalid1 = $this->session->flashdata('book_error')) { ?>
      			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid1; ?>
			                                </div>
			                            </div>
			                        </div>
			                        <?php } ?>
                                    <div class="form-group"><label>Date</label> 
									<input type="date" name="bookdate" size="50" class="form-control" ></div>
									 
									 	<div class="form-group"><label>Select Time</label> 
										<select name="time" class="form-control" id="time">
											<option hidden value="">--Select Time--</option>
											<option value="06:00:am-08:00:am">06:00:am-08:00:am</option>
											<option value="07:00:am-09:00:am">07:00:am-09:00:am</option>
											<option value="08:00:am-10:00:am">08:00:am-10:00:am</option>
											<option value="09:00:am-011:00:am">09:00:am-11:00:am</option>
											<option value="10:00:am-12:00:pm">10:00:am-12:00:pm</option>
											<option value="12:00:pm-02:00:pm">12:00:pm-02:00:pm</option>
											<option value="01:00:pm-03:00:pm">01:00:pm-03:00:pm</option>
											<option value="02:00:pm-04:00:pm">02:00:pm-04:00:pm</option>
											<option value="03:00:pm-05:00:pm">03:00:pm-05:00:pm</option>
											<option value="04:00:pm-06:00:pm">04:00:pm-06:00:pm</option>
											<option value="05:00:am-07:00:pm">05:00:am-07:00:pm</option>
											<option value="06:00:pm-08:00:pm">06:00:pm-08:00:pm</option>
											<option value="07:00:am-09:00:pm">07:00:am-09:00:pm</option>
											<option value="08:00:pm-10:00:pm">08:00:pm-10:00:pm</option>
											<option value="10:00:pm-12:00:am">10:00:pm-12:00:am</option>
											<option value="06:00:am-09:00:am">06:00:am-09:00:am</option>
											<option value="09:00:am-12:00:pm">09:00:am-12:00:pm</option>
											<option value="12:00:pm-03:00:pm">12:00:pm-03:00:pm</option>
											<option value="03:00:pm-06:00:pm">03:00:pm-06:00:pm</option>
											<option value="06:00:pm-09:00:pm">06:00:pm-09:00:pm</option>
											<option value="09:00:pm-12:00:pm">09:00:pm-12:00:pm</option>
										</select>
									</div>
									<div>
										<!--<button class="btn btn-sm btn-danger" type="submit" name="available"><strong>Check for Availability</strong></button>-->
										<div class="form-group"><label>Charge Per Hour</label> 
									<input type="text" name="charge_perhour" size="50" class="form-control" id="charge_perhour" value="<?php if($charge) { echo $charge; 	}?>" readonly></div>

										<div class="form-group"><label>Total Charge</label> 
									<input type="text" name="totalcharge" size="50" class="form-control" id="totalcharge" readonly></div>

										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Book</strong></button>
									</div><br><br><br>
									</form>
					<center><p> <a href="<?php echo base_url(); ?>owner_controller/bookfacility_list_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
                    </div>
                    </div>
                
            </div>
            </div>
			</div>
			 <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>

        <script type="text/javascript">


   $(document).ready(function(){
    $('#time').on('change',function(){
        var timeslot=$('#time').val();
        var charge = $('#charge_perhour').val();
       
             
             $.ajax({

                url:"<?php echo base_url() ?>owner_controller/bookfacility_cont",
                type:"POST",
               
                data:{
                    'timeslot' : timeslot, 
                    'charge' : charge,
                },
                 dataType:'json',
                success:function(data)
                {
                	$('#totalcharge').val(data);
                   //$('#totalcharge').html(data);

                },
                error:function()
                {
                    alert("error");
                }

             });
       
    });

   });
</script>
  
<?php include("footer.php");?>
</body>
</html>