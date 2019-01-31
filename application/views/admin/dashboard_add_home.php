<!DOCTYPE html>
<html>
<head>
<title> HOME |  PRATHA </title>
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
        
            return this.optional(element) || /^[0-9]{1,2}$/.test(value);
        }, "Enter only character");
    $("#f1").validate({
        rules:{
            home_no:{
                required:true,
                n:true
            },
            wingno:{
            	required:true,
            },
        },
        messages:{
            home_no:{
                required:"Please enter home no",
                n:"Enter valid home no"
            },
            wingno:{
            	required:"please select wing name",
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
                        <h3>Add Home</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>admin_controller/addhome" method="post" enctype="multipart/form-data" id="f1">
                               		<?php if($invalid = $this->session->flashdata('home_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
			                        <?php } ?>
                              <?php if($invalid = $this->session->flashdata('home_no_error')) { ?>                       
                              <div class="row">
                                  <div class="col-sm-12">
                                      <div class="alert alert-dismissable alert-danger">
                                          <strong>Sorry ! </strong> <?php echo $invalid; ?>
                                      </div>
                                  </div>
                              </div>
                              <?php } ?>
                               	<div class="form-group"><label>Wing Name</label> <br>
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
                                    <div class="form-group"><label id="wing_label">Home No</label> 
                                    <input  type="text" name="home_no"  id="home_no" size="50" placeholder="Enter Home No" class="form-control" required=""></div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit" id="wing_insert_btn"><strong>Insert Record</strong></button>
                                    </div><br><br><br>
                                    </form>

					<center><p> <a href="<?php echo base_url(); ?>admin_controller/dashboard_home_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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