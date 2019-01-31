<!DOCTYPE html>
<html>
<head>
<title> REVENUE |  PRATHA </title>
<link href="<?php echo base_url(); ?>css/admin/search.css" rel="stylesheet">
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript"> 
      $(document).ready( function() {
        $('#abc').delay(8000).fadeOut();
      });
    </script>
<script>
function update_url(url){
    history.pushState(null,null,url);
}
</script>

 </script>
<style>
/*
 * Table wrapper
 */
.dataTables_wrapper 
{
    position: relative;
    clear: both;
    *zoom: 1;
}
/*
 * Filter
 */
.dataTables_filter 
{
    float: right;
    text-align: right;
}
</style>
<title>ADMIN | PRATHA</title>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function del()
 {
     return confirm("Are you sure to delete Wing?");
 }
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
                        <h5>Revenue Information</h5>
                       
                    </div>
        

                    <div class="ibox-content">
                    <div class="">
                
                    </div>   
                  <table id="example" class="table table-striped table-bordered table-hover " id="example">
                    <thead>
                    <tr>
                    	<th>Revenue_Name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Amount<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                      
                    </tr>
                    </thead>
                    
<tbody>         

                <?php      
                     if(isset($tolrevenue))
			        {
			           
			            foreach($tolrevenue as $tol)
			            {
			                $amount = $tol->amount;
			                $penalty = $tol->penalty;

			                @$tols = $tols + $amount + $penalty; 
			            }
			        
			    ?>
                    <tr>
                        <td><?php echo "maintanance"; ?></td>
                        <td><?php echo $tols; ?></td>
                    </tr>
                <?php
                    } 
               
                if(isset($bookingrevenue))
		        {
		          
		            foreach($bookingrevenue as $tol)
		            {
		                $amount = $tol->total_charge;
		                 //$penalty = $tol->penalty;

		                @$tolb = $tolb + $amount; 
		            }
		        			        
			    ?>
                    <tr>
                        <td><?php echo "Booking";?></td>
                        <td><?php echo $tolb; ?></td>
                    </tr>
                <?php
                    } 
                

                     if(isset($bookingrevenue_penalty))
            {
               
                foreach($bookingrevenue_penalty as $tol)
                {
                   
                    $penalty = $tol->penalty;

                    @$tolbp = $tolbp + $penalty; 
                }
                          
          ?>
                    <tr>
                        <td><?php echo "Booking Penalty";?></td>
                        <td><?php echo $tolbp; ?></td>
                    </tr>
                <?php
                    } 



                 if(isset($tolrevenuetbl))
		        {
		           
		            foreach($tolrevenuetbl as $tol)
		            {
		        ?>
                    <tr>
                        <td><?php echo $tol->expense_revenue_name; ?></td>
                        <td><?php echo $tol->amt; ?></td>
                    </tr>
                <?php
                    } } ?>

                        </tbody>
                      </table>
                    <!--  <a href="<?php // echo base_url();?>admin_controller/down_pdf_cont" class="btn btn-primary">Create PDF</a>-->
                      <center><p> <a href="<?php echo base_url(); ?>admin_controller/showadmin"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
<script src="<?php echo base_url() ?>js/plugins/dataTables/datatables.min.js"></script> 
  <script>
  $(function(){
    $("#example").dataTable();
  })
  </script>
  </div>
</div>
  </div>
 </div>
 </div>
 
<script src="<?php echo base_url(); ?>js/plugins/dataTables/datatables.min.js"></script> 
 <script src="<?php echo base_url(); ?>js/admin/search.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>

 

<?php include("footer.php");?> 
 </body>
</html>