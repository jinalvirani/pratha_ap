
<?php
if(isset($usertype))
{
    foreach($usertype as $ut)
    {
        $utid=$ut->user_id;
        $utnm=$ut->username;
        $uttype=$ut->user_type;
        $utimg=$ut->pic;
    }
    //$this->session->set_userdata('getloginid',$utid);
}


?>
<!DOCTYPE html>
<html>
<head>
<title> DOCUMENT | PRATHA </title>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript"> 
      $(document).ready( function() {
        $('#abc').delay(8000).fadeOut();
      });
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

<title>DOCUMENT</title>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function del()
 {
	 return confirm("Are you sure to delete  this data...?");
 }
</script>
</head>
<body>
<div id="wrapper">
	<?php include('document_index.php'); ?>	
		<!-- =======================================table================================= -->
		
			
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Document</h5>
                    </div>

	
	<div class="ibox-content">
        <table class="table">
                    <thead>
                    <tr>
                      <th style="font-size:18px">Expense/Revenue Report<div></th>
                        <th style="font-size:18px">View</th>
                         <th style="font-size:18px">Download</th>
                    </tr>
                    </thead>
                    
<tbody>     
<?php foreach($files as $f)
                      {
                        
                        ?>
                                    <tr>
                                      
                                        <td><?php echo $f; ?></td>
                        <td><a href="<?php echo base_url('document/'.$f); ?>"><span class="fa fa-eye" style="font-size:24px;"></span></a></td>
                                    <td><a href="<?php echo base_url()?>owner_controller/documentdl_cont?filename=<?php echo $f; ?>"><span class="fa fa-arrow-circle-o-down" style="font-size:24px;"></span></a></td>
                                  </tr>
                                
                                    
                    <?php }
                      ?>
                  </tbody>
              </table>
    </div>
	      
            </div>
        </div>
    </div>
</div>
  

    <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>

<?php include('footer.php'); ?>  
</body>
</html>