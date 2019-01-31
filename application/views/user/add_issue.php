
<!DOCTYPE html>
<html>
<head>
	<title>ISSUE | PRATHA</title>

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
	
		$.validator.addMethod("issue", function(value, element) {
    	
    	    return this.optional(element) ||  /^[a-zA-Z\s.,_-]+$/.test(value);
    	}, "Enter only aplpha");

		$.validator.addMethod("issue_d", function(value, element) {
    	
    	    return this.optional(element) ||  /^[a-zA-Z0-9\s.,-_/]+$/.test(value);
    	}, "Enter only aplpha");
	$("#ff1").validate({
		rules:{
			issue_title:{
				required:true,
				issue:true
			},
			issue_discription:
			{
				required:true,
				issue_d:true
			},
			issue_date:
			{
				required:true,
			},
			file:
			{
				required:true,
			},
			
		},
		messages:{
			issue_title:{
				required:"Please enter issue title",
				issue:"enter valid issue title"
			},
			issue_discription:
			{
				required:"Please enter issue discription",
				issue_d:"enter valid issue discription"
			},
			issue_date:
			{
				required:"please select Date for Issue",
			},
			file:
			{
				required:"please select pic",
			}

			
		}
	});
});
$(document).ready(function(){
    $('#imgdiv').hide();
});


        function readURL(input) {
            if (input.files && input.files[0]) {
                $('#imgdiv').show();
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#user_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


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
                        <h3>Send Issue</h3>
                    </div>

                   
									
									

                    
			<div class="ibox-content">

				
                                <form action="<?php echo base_url(); ?>owner_controller/add_issue_cont" method="post" enctype="multipart/form-data" id="ff1">
                                	
									
									<div class="form-group"><label>Issue Title</label> 
									<input  type="text" name="issue_title" size="50" placeholder="Enter Issue Title" class="form-control"></div>
									<?php if($invalid = $this->session->flashdata('date')) { ?>

									 <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
			                        <?php } ?>
												<div class="form-group"><label>Issue Date</label> <br>
									<input  type="date" name="issue_date" size="50" placeholder="Enter Issue Date" class="form-control" ></div>
									<div class="form-group"><label>Issue Discription</label> <br>
									<textarea name="issue_discription" size="50" placeholder="Enter Issue Discription" class="form-control" required=""></textarea></div>
									 <?php if($invalid = $this->session->flashdata('image_error')) { ?>

									 <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-dismissable alert-danger">
                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?><div class="form-group"><label>Issue Pic</label>
                                     <input type="file" name="file" onchange="readURL(this);">    
                                    </div>
                                    <div id="imgdiv">
                                    <img src="" name="display_pic" class="img-responsive" height="100" width="100" id="user_image">

                                    </div>

			

                               		<div>
									<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Insert Record</strong></button>
									</div><br><br><br>

									</form>
					<center><p> <a href="<?php echo base_url(); ?>owner_controller/show_issue_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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