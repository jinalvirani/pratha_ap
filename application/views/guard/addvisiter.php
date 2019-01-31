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
#camera{
  width: 300px;
  height: 250px;
}
</style>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
<script>

$(document).ready(function(){
	
	$.validator.addMethod("n", function(value, element) {
    	
    	    return this.optional(element) || /^([a-zA-Z\s]?)+$/.test(value);
    	}, "Enter only character");
		$.validator.addMethod("number", function(value, element) {
    	
    	    return this.optional(element) || /^([0-9\s]?)+$/.test(value);
    	}, "Enter only digit");
	$("#f1").validate({
		rules:{
			name:{
				required:true,
				n:true
			},
			number:
			{
				required:true,
				number:true
			},
			
		},
		messages:{
			name:{
				required:"Please enter client name",
				n:"Enter valid client name"
			},
			number:
			{
				required:"Please enter phone number",
				number:"Enter valid phone number"
			}
			
		}
	});
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
                        <h3>IN VISITORS</h3>
                    </div>
			<div class="ibox-content">
				
                                <form action="<?php echo base_url(); ?>guard_controller/action_cont" method="post" enctype="multipart/form-data" id="f1">
                                   
									<div class="form-group">
										<center><div id="camera"></div><br>
    									<button id="take_snapshots" class="btn btn-success btn-sm">Take Picture</button></center>
									</div>
									<div>
										<!--<a href="<?php //echo base_url(); ?>guard_controller/addvisiter_nextpage_cont"><button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Next</strong></button>
									</div><br><br><br>-->
									</form>
					<center><p> <a href="<?php  echo  base_url(); ?>guard_controller/visiter_list"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>jpeg_camera/jpeg_camera_with_dependencies.min.js" type="text/javascript"></script>
<script>
    var options = {
      shutter_ogg_url: "<?php echo base_url(); ?>jpeg_camera/shutter.ogg",
      shutter_mp3_url: "<?php echo base_url(); ?>jpeg_camera/shutter.mp3",
      swf_url: "<?php echo base_url(); ?>jpeg_camera/jpeg_camera.swf",
    };
    var camera = new JpegCamera("#camera", options);
  
  $('#take_snapshots').click(function(){
    var snapshot = camera.capture();
    snapshot.show();
    
    snapshot.upload({api_url: "<?php echo base_url(); ?>guard_controller/action_cont"}).done(function(response) {
$('#imagelist').prepend("<tr><td><img src='"+response+"' width='100px' height='100px'></td><td>"+response+"</td></tr>");
}).fail(function(response) {

});
})

function done(){
    $('#snapshots').html("uploaded");
}
</script>
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

                url:"<?php echo base_url() ?>admin_controller/fillhome_cont",
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