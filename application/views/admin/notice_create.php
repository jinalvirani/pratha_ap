<!DOCTYPE html>
<html>
<head>
<title> NOTICE |  PRATHA </title>
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
    	
    	    return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
    	}, "Enter only character");
		$.validator.addMethod("d", function(value, element) {
    	
    	    return this.optional(element) || /^[a-zA-Z0-9 .,-=/]+$/.test(value);
    	}, "Enter Valid Description");
    	$.validator.addMethod("a", function(value, element) {
    	
    	    return this.optional(element) || /^[0-9]+$/.test(value);
    	}, "Enter Valid Amount");
	$("#f1").validate({
		rules:{
			title:{
				required:true,
				n:true
			},
			des:
			{
				required:true,
				d:true
			},
			noticetype:{
				required:true,
			},
			poll_on:{
				required:true,
			},
			wingno:{
				required:true,
			},
			due_date:{
				required:true,
			},
			amount:{
				required:true,
				a:true
			},
			amountf:{
				required:true,
				a:true
			},
			
		},
		messages:{
			title:{
				required:"Please Enter Title",
				n:"Enter valid Title"
			},
			des:
			{
				required:"Please enter Description",
				d:"Enter valid Description"
			},
			noticetype:{
				required:"Please select notice type",
			},
			poll_on:{
				required:"Please select Poll On",
			},
			wingno:{
				required:"Please select wing name",
			},
			due_date:{
				required:"Please select Due Date",
			},
			amount:{
				required:"Please Enter Amount",
				a:"Enter valid Amount"
			},
			amountf:{
				required:"Please Enter Amount",
				a:"Enter valid Amount"
			}
			
		}
	});
});
$(document).ready(function(){
	$("#maintanance").hide();
	$("#poll").hide();
	$("#festival").hide();
});

$(document).ready(function(){
    $('#noticetype').on('change', function() {
      if ( this.value == 'poll')
      {
        $("#maintanance").hide();
        $('#poll').show();
        $('#wingno').hide();
        $('#wing_label').hide();
        $("#festival").hide();
      }
      if ( this.value == 'maintanance')
      {
        $("#maintanance").show();
         $('#poll').hide();
         $("#festival").hide();
      }
      if(this.value == "festival")
      {
      	 $("#maintanance").hide();
         $('#poll').hide();
         $("#festival").show();
      }
      if ( this.value == 'other')
      {
         $("#maintanance").hide();
          $('#poll').hide();
          $("#festival").hide();
      }
    });
});

$(document).ready(function(){
    $('#poll_on').on('change', function() {
      if ( this.value == 'associative')
      {
        $('#wingno').show();
        $('#wing_label').show();
      }
      if ( this.value == 'admin')
      {
        $('#wingno').hide();
        $('#wing_label').hide();
      }
    });
});

</script>

</head>

<body>
   <div id="wrapper">
   <?php include('notice_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Create Notice</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>admin_controller/noticeinsert_cont" method="post" enctype="multipart/form-data" id="f1">
                                    <div class="form-group"><label>Title</label> 
									<input  type="text" name="title" size="50" placeholder="Enter Title" class="form-control" required=""></div>
									<div class="form-group"><label>Description</label> 
									<input  type="text" name="des"  placeholder="Description" class="form-control" required=""></div>
									
										<?php
										if(isset($pollcreated))
										{
											if($pollcreated=='yes')
											{ ?>

												<div class="form-group"><label>Notice Type</label> <br>
									<select name="noticetype" id="noticetype" style="background-color: #FFFFFF;
  background-image: none;
  border: 1px solid #e5e6e7;
  border-radius: 1px;
  color: inherit;
  display: block;
  padding: 6px 12px;
  transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
  width: 100%;
  font-size: 14px;">
										<option value="" hidden>--select--</option>
										
										<option value="maintanance">Maintenance</option>
										<option value="festival">festival</option>
										<option value="other">Other</option>
									</select>
								</div>

									<?php	}
											else
											{ ?>
												<div class="form-group"><label>Notice Type</label> <br>
									<select name="noticetype" id="noticetype" style="background-color: #FFFFFF;
  background-image: none;
  border: 1px solid #e5e6e7;
  border-radius: 1px;
  color: inherit;
  display: block;
  padding: 6px 12px;
  transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
  width: 100%;
  font-size: 14px;">
										<option value="" hidden>--select--</option>
										<option value="poll">Poll</option>
										<option value="maintanance">Maintenance</option>
										<option value="festival">festival</option>
										<option value="other">Other</option>
									</select>
								</div>
								<?php		}
										}
										?>
    							<div id="maintanance">
       								 <div class="form-group"><label>Due Date</label> 
									<input  type="date" name="due_date" size="50" placeholder="Enter Date" class="form-control" required=""></div>
									<div class="form-group"><label>Amount</label> 
									<input  type="number" name="amount"  placeholder="Enter Amount" class="form-control" required=""></div>
    							</div>
    							<div id="poll">
       								<div class="form-group"><label>Poll On</label> <br>
									<select name="poll_on" id="poll_on" style="background-color: #FFFFFF;
  background-image: none;
  border: 1px solid #e5e6e7;
  border-radius: 1px;
  color: inherit;
  display: block;
  padding: 6px 12px;
  transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
  width: 100%;
  font-size: 14px;">
										<option value="" hidden>--select--</option>
										<option value="admin">admin</option>
										<option value="associative">associative</option>
									</select>
								</div>
									<div class="form-group"><label id="wing_label">Wing Number</label> <br>
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
										<option value="" hidden>--select wing_No--</option>
                       					  <?php 
								            foreach($wing  as $row)
								            { 
								              echo '<option value="'.$row->wing_id.'">'.$row->wing_name.'</option>';
								                
								            }
								          ?>
									</select>
								</div>
    							</div>

    							<div id="festival">
    								<div class="form-group"><label>Amount</label> 
									<input  type="number" name="amountf"  placeholder="Enter Amount" class="form-control" required=""></div>
    							</div>


    							<div class="form-group">
								<input  type="checkbox" name="make_default" value="yes"><strong>&nbsp;&nbsp;Do You Want To Make This Notice As Default ?</strong>
 								</div>
									<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Create Notice</strong></button>
									</div><br><br><br>
									</form>
									<center><p> <a href="<?php echo base_url(); ?>admin_controller/notice_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>

					
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