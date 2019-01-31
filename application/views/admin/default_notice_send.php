<?php
if(isset($notice_info))
{
    foreach($notice_info as $notice)
    {
    	$noticeid=$notice->notice_id;
    	$title=$notice->title;
    	$des=$notice->description;
    	$type=$notice->notice_type;
    	$is_default= $notice->is_default;
    	$wingno = $notice->wing_no;
    }
}
?>
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
			due_date:{
				required:true,
			},
			amount:{
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
			due_date:{
				required:"Please select Due Date",
			},
			amount:{
				required:"Please Enter Amount",
				a:"Enter valid Amount"
			}
			
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
                        <h3>Send Notice</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>admin_controller/sendnotice_resident_cont" method="post" enctype="multipart/form-data" id="f1">
                               	<input type="text" name="noticeid" value="<?php if(isset($noticeid)) { echo $noticeid; } ?>" hidden>
                                    <div class="form-group"><label>Title</label> 
									<input  type="text" name="title" size="50" placeholder="Enter Title" class="form-control" required="" value="<?php if(isset($title)) { echo $title; } ?>"></div>
									<div class="form-group"><label>Description</label> 
									<input  type="text" name="des"  placeholder="Description" class="form-control" required="" value="<?php if(isset($des)) { echo $des; } ?>"></div>
									<input type="text" name="type" value="<?php if(isset($type)) { echo $type; } ?>" hidden>
									<?php 
									if(isset($type))
									{
										if($type=="maintanance")
										{ ?>
											<div class="form-group"><label>Due Date</label> 
									<input  type="date" name="due_date" size="50" placeholder="Enter Date" class="form-control" required=""></div>
									<div class="form-group"><label>Amount</label> 
									<input  type="number" name="amount"  placeholder="Enter Amount" class="form-control" required=""></div>
									<?php 
									 foreach($m as $m1)
									 { ?>
									 	<input type="text" name="n[]" value="<?php echo $m1->user_id; ?>" hidden>
									 <?php }

									?>
								<?php }
									}
									?>

									<?php if(isset($type))
									{
										if($type=="festival")
										{ ?>
									<div class="form-group"><label>Amount</label> 
									<input  type="number" name="amountf"  placeholder="Enter Amount" class="form-control" required=""></div>
									<?php 
									 foreach($f as $f1)
									 { ?>
									 	<input type="text" name="m[]" value="<?php echo $f1->user_id; ?>" hidden>
									 <?php }

									?>
								<?php }
									}
									?>

									<input type="text" name="pass_default" value="<?php if(isset($is_default)) { echo $is_default; } ?>" hidden>
									<?php if(isset($type))
									{
										if($type=="poll")
										{ 
											?>
											<input type="text" name="wingno" value="<?php if(isset($wingno)) { echo $wingno; } ?>" hidden>
								 <?php
								 		}
								 	}
								  ?>
									<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Send Notice</strong></button>
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