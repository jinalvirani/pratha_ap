<!DOCTYPE html>
<html>
<head>
<title> DOCUMENT |  PRATHA </title>
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
<script>

$(document).ready(function(){
    $("#f2").validate({
        rules:{
            file:{
                required:true,
            },
        },
        messages:{
            file:{
                required:"Please select report",
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
                        <h5>Expense/Revenue Monthly Reports</h5>
                       
                    </div>
        			

                    <div class="ibox-content">
                    <div class="">
                    	
                    </div>
                    <form action="<?php echo base_url(); ?>admin_controller/down_pdf_cont" method="post" enctype="multipart/form-data" id="f1">
                            
                                    <div class="form-group"><label id="labeldate">Report Date</label> 
                                    <input  type="date" id="inputdate" name="reportdate" class="form-control" required=""></div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit" id="createdate"><strong>Create Mothly Report</strong></button>
                                    </div><br><br><br>
                                    </form>
                                    <div class="brodcast">
                                    <h3><center>Brodcast Monthly Report</center></h3>
                                    <form action="<?php echo base_url(); ?>admin_controller/boradcast_report_cont" method="post" enctype="multipart/form-data" id="f2">
                            
                                    <?php if($invalid = $this->session->flashdata('image_error')) { ?>                       
			                        <div class="row">
			                            <div class="col-sm-12">
			                                <div class="alert alert-dismissable alert-danger">
			                                    <strong>Sorry ! </strong> <?php echo $invalid; ?>
			                                </div>
			                            </div>
			                        </div>
		                        <?php } ?>
									<div class="form-group"><label>Select Report</label>
									<input type="file" name="file" size="50" placeholder="Select PDF" required=""></div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit" id="createdate"><strong>Broadcast</strong></button>
                                    </div><br><br><br>
                                    </form>
                                </div>
                  
                      <center><p><a href="<?php echo base_url(); ?>admin_controller/dashboard_document_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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