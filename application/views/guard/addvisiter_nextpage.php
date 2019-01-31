<!DOCTYPE html>
<html>
<head>
<title>ADD VISITOR | PRATHA</title>
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
	
	$.validator.addMethod("n", function(value, element) {
    	
    	    return this.optional(element) || /^[a-zA-Z]+$/.test(value);
    	}, "Enter only character");
	$.validator.addMethod("add", function(value, element) {
    	
    	    return this.optional(element) || /^[a-zA-Z0-9 .,_-]+$/.test(value);
    	}, "enter valid Address");
		$.validator.addMethod("number", function(value, element) {
    	
    	    return this.optional(element) || /^[789][0-9]{9}$/.test(value);
    	}, "Enter only digit");
    	$.validator.addMethod("vehicle_no", function(value, element) {
    	
    	    return this.optional(element) || /^[A-Z]{2}[ -][0-9]{1,2}(?: [A-Z])?(?: [A-Z]*)? [0-9]{4}$/.test(value);
    	}, "Enter valid vehicle no");
    	
	$("#f1").validate({
		rules:{
			firstname:{
				required:true,
				n:true
			},
			lastname:{
				required:true,
				n:true
			},
			mobileno:{
				required:true,
				number:true
			},
			wingno:{
				required:true,
			},
			homeno:{
				required:true,
			},
			address:
			{
				required:true,
				add:true
			},
			vehicleno:{
				required:true,
				vehicle_no:true	
			},

			
		},
		messages:{
			firstname:{
				required:"Please enter Firstname",
				n:"Enter valid admin firstname"
			},
			lastname:{
				required:"Please enter Lastname",
				n:"Enter valid admin lastname"
			},
			mobileno:{
				required:"Please enter mobileno",
				number:"Enter exectly 10 digit"
			},
			wingno:{
				required:"Please select wingno",
			},
			homeno:{
				required:"Please select homeno",
			},
			address:{
				required:"please enter address",
				add:"Eneter valid address"
			},
			vehicleno:{
				required:"please vehicle no",
				vehicle_no:"Eneter valid vehicle number "
			}
			
			
		}
	});
});

$(document).ready(function(){
	$('#imgdiv').hide();
});

</script>

</head>

<body>
   <div id="wrapper">
   <?php include('visiter_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>IN VISITOR</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>guard_controller/add_visiter_nextpage_cont" method="post" enctype="multipart/form-data" id="f1">
                                   <div class="form-group"><label>Visitor Name</label> 
									<input  type="text" name="firstname" size="50" placeholder="Enter Visitor Name" class="form-control" required=""></div>
									<div class="form-group"><label>Visitor Lastname</label> 
									<input  type="text" name="lastname" size="50" placeholder="Enter Visitor Lastname" class="form-control" required=""></div>
									<div class="form-group"><label>Address</label> 
									<input  type="text" name="address" placeholder="Enter Address" class="form-control" required=""></div>
									<div class="form-group"><label>Wing Number</label> <br>
									<select name="wingno" id="wingno" style="background-color: #FFFFFF;
  background-image: none;
  border: 1px solid #e5e6e7;
  border-radius: 1px;
  color: inherit;
  display: block;
  padding: 6px 12px;
  transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
  width: 100%;
  font-size: 14px;">
										<option value="" hidden>--Select wing_No--</option>
                       					  <?php 
								            foreach($wing  as $row)
								            { 
								              echo '<option value="'.$row->wing_id.'">'.$row->wing_name.'</option>';
								                
								            }
								          ?>
									</select>
								</div>
								<div class="form-group"><label>Home No</label> <br>
									<select name="homeno" id="homeno" style="background-color: #FFFFFF;
  background-image: none;
  border: 1px solid #e5e6e7;
  border-radius: 1px;
  color: inherit;
  display: block;
  padding: 6px 12px;
  transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
  width: 100%;
  font-size: 14px;">
										
									</select>
								</div>
									<div class="form-group"><label>Mobile Number</label> 
									<input  type="number" name="mobileno" size="50" placeholder="Enter Visitor Mobile Number" class="form-control" required=""></div>
									<div class="form-group"><label>Vehicle Number</label> 
									<input  type="text" name="vehicleno" size="50" placeholder="Enter Visitor Vehicle Number" class="form-control" required=""></div>
									
									<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>In</strong>
									</div><br><br><br>
									</form>
									</form>

					<center><p> <a href="<?php echo  base_url(); ?>guard_controller/visiter_list"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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
<script type="text/javascript">


   $(document).ready(function(){
    $('#wingno').on('change',function(){
        var wing_id=$(this).val(); 
        if(wing_id == '')
        {
            $('#homeno').prop('disabled',true);
        }
        else
        {
             $('#homeno').prop('disabled',false);
             $.ajax({

                url:"<?php echo base_url() ?>guard_controller/fillhome_cont",
                type:"POST",
               
                data:{
                    'wing_id' : wing_id, 
                },
                 dataType:'json',
                success:function(data)
                {
                   $('#homeno').html(data);

                },
                error:function()
                {
                    $('#homeno').html();
                }

             });
        }
       
    });

   });
</script>