
<!DOCTYPE html>
<html>
<head>
  <title> THANK YOU | PRATHA </title>
	<script src="https://unpkg.com/sweetalert2@7.8.2/dist/sweetalert2.all.js"></script>
    <script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
    <script>
 $(document).ready(function() {
swal({ 
  title: "THANK YOU",
   text: "Payment Succecful !!",
    type: "success" 
  }).then(function(){
  	window.location.href = "<?php echo base_url();?>owner_controller/myunitlist_cont";
  });
 });
</script>
	
</head>
<body>

</body>
</html>
 