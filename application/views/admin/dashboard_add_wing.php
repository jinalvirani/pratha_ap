<!DOCTYPE html>
<html>
<head>
<title> WING |  PRATHA </title>
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
        
            return this.optional(element) || /^[A-Z]+$/.test(value);
        }, "Enter only character");
    $("#f1").validate({
        rules:{
            wing_name:{
                required:true,
                n:true
            },
        },
        messages:{
            wing_name:{
                required:"Please enter Wing Name",
                n:"Enter valid Wing name"
            }
        }
    });
});
</script>

</head>

<body>
   <div id="wrapper">
   <?php include('dashboard_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Add Wing</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>admin_controller/addwing" method="post" enctype="multipart/form-data" id="f1">
                               	<?php if($invalid = $this->session->flashdata('wing_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
			                        <?php } ?>
                                    <div class="form-group"><label id="wing_label">Wing Name</label> 
                                    <input  type="text" name="wing_name"  id="wing_name" size="50" placeholder="Enter Wing Name" class="form-control" required=""></div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit" id="wing_insert_btn"><strong>Insert Record</strong></button>
                                    </div><br><br><br>
                                    </form>

					<center><p> <a href="<?php echo base_url(); ?>admin_controller/dashboard_wing_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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