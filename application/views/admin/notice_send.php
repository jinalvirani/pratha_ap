<?php
if(isset($noticeid))
{
    $noticeid = $noticeid->notice_id;
   

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
                               
                               <?php if($this->session->userdata('title')) { $title= $this->session->userdata('title'); }?>
                                    <div class="form-group"><label>Title</label> 
									<input  type="text" name="title" size="50" placeholder="Enter Title" class="form-control" required="" value="<?php if(isset($title)) { echo $title; } ?>"></div>
									 
									 <?php if($this->session->userdata('description')) { $des = $this->session->userdata('description'); }?>
									<div class="form-group"><label>Description</label> 
									<input  type="text" name="des"  placeholder="Description" class="form-control" required="" value="<?php if(isset($des)) { echo $des; } ?>"></div>
									
									<?php if($this->session->userdata('type')) { $type= $this->session->userdata('type'); }?>
									<input type="text" name="type" value="<?php if(isset($type)) { echo $type; } ?>" hidden>
									
									<?php if($this->session->userdata('pass_default')) { $pass_default= $this->session->userdata('pass_default'); }?>
									<input type="text" name="pass_default" value="<?php if(isset($pass_default)) { echo $pass_default; } ?>" hidden>
									
									<?php if($this->session->userdata('wingno')) { $wingno= $this->session->userdata('wingno'); }?>
									<input type="text" name="wingno" value="<?php if(isset($wingno)) { echo $wingno; } ?>" hidden>

									<?php if($this->session->userdata('due_date')) { $due_date= $this->session->userdata('due_date'); }?>
									<input type="text" name="due_date" value="<?php if(isset($due_date)) { echo $due_date; } ?>" hidden>

									<?php if($this->session->userdata('amount')) { $amount= $this->session->userdata('amount'); }?>
									<input type="text" name="amount" value="<?php if(isset($amount)) { echo $amount; } ?>" hidden>

									<?php if($this->session->userdata('a')) { $a= $this->session->userdata('a'); }?>
									<input type="text" name="amountf" value="<?php if(isset($a)) { echo $a; } ?>" hidden>
									<?php 
									if($type == "maintanance")
									{
									 foreach($m as $m1)
									 { ?>
									 	<input type="text" name="n[]" value="<?php echo $m1->user_id; ?>" hidden>
									 <?php }
									}

									if($type == "festival")
									{
									 foreach($f as $f1)
									 { ?>
									 	<input type="text" name="m[]" value="<?php echo $f1->user_id; ?>" hidden>
									 <?php }
									}

									?>
									
									<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Send Notice</strong></button>
									</div><br><br><br>
									</form>
									

					
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