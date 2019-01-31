
<!DOCTYPE html>
<html>
<head>
 <title> ISSUE | PRATHA </title>
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

function del()
 {
   return confirm("Are you sure to delete staff?? ");
 }

</script>

</head>

<body>
   <div id="wrapper">
   <?php include('myunit_index.php'); ?> 
   <?php if($invalid = $this->session->flashdata('add_issue')) { ?>
                <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h3>Show Issue</h3>
                    </div>
                    <div class="ibox-content">

					<div class="">
					<a href="<?php echo base_url(); ?>owner_controller/issue_cont" class="btn btn-add btn-primary pull-right col-sm-2" >+ Send New Issue</a>
					</div>
					<br><br>
                    
			
				<?php if(isset($issue))
				{
					foreach($issue as $row)
					{


					?>
				<div class="row">
     <div class="col-sm-3"></div>
     <div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
      <div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-5"></div>
        <div class="col-sm-2"><a href="<?php echo base_url(); ?>owner_controller/show_issue_cont?id=<?php echo $row->issue_id; ?>" onclick="return del()"><img src="<?php echo base_url(); ?>img/close.jpg" class="img-responsive" width="20px"></div></a>
      
       <div class="col-sm-5"><h3><?php if($row->title) { echo $row->title; } ?></h3></div>
       <div class="col-sm-4">
       	<?php 
       	
       	if(isset($row->issue_progress_status))
       	{
       		$issue_status=$row->issue_progress_status;
       		if($issue_status == 0)
       		{
       			?>

       				<a href="<?php echo base_url(); ?>owner_controller/issue_cont" class="btn btn-primary" >NEW</a>
   	    <?php		
   			}
   			if($issue_status == 1)

   			{
       			?>

       				<a href="<?php echo base_url(); ?>owner_controller/issue_cont" class="btn btn-danger" >INPROGRESS</a>
   	    <?php		
   			}
   			if($issue_status == 2)

   				{
       			?>

       				<a href="<?php echo base_url(); ?>owner_controller/issue_cont" class="btn btn-info" >DONE</a>
   	    <?php		
   			}
   		}
       	?>
       </div>
       <div class="col-sm-3" style="margin-top: 10px;"><?php echo $row->added_on; ?></div>
      </div>
      <hr>
      
      <p><?php echo $row->discription; ?></p>
     <center><img src="<?php echo base_url(); ?>img/issue/<?php echo $row->pic; ?>" class="img-responsive" style="max-height:200px;" width="340px"></center>
      <hr>
     
     </div>
     <div class="col-sm-4"></div>
    </div>
    <?php } 
}
else
    {
        ?>
            <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8"><h3><center>No issue found</center></h3></div>
                            <div class="col-sm-2"></div>
            </div>
                        
        <?php
    }
               
?>
                                
				<br><br>	<center><p> <a href="<?php echo base_url(); ?>owner_controller/myunitlist_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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