<?php

	if(isset($guard_info))
	{
		foreach($guard_info as $guard)
		{
			$guard_id=$guard->user_id;
			$guard_shift=$guard->shift;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title> GUARD |  PRATHA </title>
<style>
		form .error{
			font-weight: bold;
			color:#cc5965;
			border-color:blue;
		}
</style>
 
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
</head>

<body>
   <div id="wrapper">
   <?php include('securityguard_index.php'); ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Edit Security Guard</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>admin_controller/editguard_cont" method="post" enctype="multipart/form-data" id="f1">
                               	<input type="text" value="<?php if(isset($guard_id)) { echo $guard_id; } ?>" name="updateid" hidden>
                                   
								<div class="form-group"><label>Shift</label> <br>
									<select name="shift" style="background-color: #FFFFFF;
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
										<option value="day" <?php if(isset($guard_shift)){ if($guard_shift == "day") { ?> selected <?php } } ?> >Day</option>
										<option value="night" <?php if(isset($guard_shift)){ if($guard_shift == "night") { ?> selected <?php } } ?>>Night</option>
									</select>
								</div>
								<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Edit</strong></button>
									</div><br><br><br>
									</form>

					<center><p> <a href="<?php echo  base_url(); ?>admin_controller/guard_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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