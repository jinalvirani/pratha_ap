<!DOCTYPE html>
<html>
<head>
<title> DOCUMENT|  PRATHA </title>
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

</head>

<body>
    <div id="wrapper">
    <?php include('dashboard_index.php'); ?>  
     <?php if($invalid = $this->session->flashdata('broadcastsuccess')) { ?> 
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
                        <h5>Expense/Revenue Monthly Reports</h5>
                       
                    </div>
        			

                    <div class="ibox-content">
                    <div class="">
                    	 <a href="<?php echo base_url(); ?>admin_controller/dashboard_create_document_cont" class="btn btn-add btn-primary pull-right col-sm-2" id="report">+ Create Monthly Report</a>
                    </div><br><br><br>
                   
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
                                    <td><a href="<?php echo base_url()?>admin_controller/documentdl_cont?filename=<?php echo $f; ?>"><span class="fa fa-arrow-circle-o-down" style="font-size:24px;"></span></a></td>
                                  </tr>
                                
                                    
                    <?php }
                      ?>    
</tbody>
</table>

                                    
                      


                               
                      <center><p><a href="<?php echo base_url(); ?>admin_controller/showadmin"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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