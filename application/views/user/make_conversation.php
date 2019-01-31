<!DOCTYPE html>
<html>
<head>
<title> MAKECONVERSATION | PRATHA </title>
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
            file:{
                required:true,
                
            },
           
        },
        messages:{
            file:{
                required:"Please select pic",
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
   <?php include('my_apartment_index.php'); ?> 	
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Make Conversation</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>owner_controller/post_conversation_cont" method="post" enctype="multipart/form-data" id="f1">
                                    <div class="form-group">
                                    <textarea name="caption" class="form-control" rows="3" cols="50" placeholder="Cool !! share what's going on"></textarea></div>
                                    <?php if($invalid = $this->session->flashdata('image_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
		                        <?php } ?>
                                  <div class="form-group"><label>Picture</label>
                                     <input type="file"  name="file" onchange="readURL(this);">    
                                    </div>
                                    <div id="imgdiv">
                                    <img src="" name="display_pic" class="img-responsive" height="100" width="100" id="user_image">
                                    </div>

                                        <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Post</strong></button>
                                    </div><br><br><br>
                                    </form>
					<center><p> <a href="<?php echo base_url(); ?>owner_controller/my_apartment_list_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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