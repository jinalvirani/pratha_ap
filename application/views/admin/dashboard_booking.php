<!DOCTYPE html>
<html>
<head>
<title> FACILITY |  PRATHA </title>  
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
</head>

<body>
    <div id="wrapper">
    <?php include('dashboard_index.php'); ?>  
    <?php if($invalid = $this->session->flashdata('booking_approve')) { ?> 
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
                        <h5>Approve / Disapprove Facility</h5>
                       
                    </div>
        

                    <div class="ibox-content">
                    <div class="">
                    	 <a href="<?php echo base_url();?>admin_controller/dashboard_view_booking_cont" class="btn btn-add btn-primary pull-right col-sm-2" >View All Booked Facilities</a>
                    </div>   
                  <table id="example" class="table table-striped table-bordered table-hover " id="example">
                    <thead>
                    <tr>
                    	<th>Owner/Tenant Firstname<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Facilityname<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Book-Date<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Time_Slot<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Image</th>
                        <th>Approve</th>
                        <th>Disapprove</th>
                    </tr>
                    </thead>
                    
<tbody>         

                <?php      
                    if(isset($bookings))
                    { 
                       
                     foreach($bookings as $show)
                    {
                ?>
                    <tr>
                        <td><?php echo $show->firstname ?></td>
                        <td><?php echo $show->facility_name; ?></td>
                        <td><?php echo $show->book_date; ?></td>
                     	 <td><?php echo $show->time_slot; ?></td>
                         <td width="150px" height="150px"><img src="<?php echo base_url(); ?>img/facility/<?php echo $show->pic; ?>" height="100%" width="100%"></td>
                         <td><a href="<?php echo base_url(); ?>/admin_controller/dashboard_booking_cont?booking_id=<?php echo $show->book_id; ?>" class="btn btn-primary">Approve</a></td>
                         <td><a href="#myModal_<?php echo $show->book_id; ?>" class="btn btn-primary" id="disapprove" data-toggle="modal" data-target="#myModal_<?php echo $show->book_id; ?>">Disapprove</a></td>
                    </tr>


                     <div id="myModal_<?php echo $show->book_id; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Disapprove Reason</h4>
      </div>
      <div class="modal-body">
        <?php
        	$book_id = $show->book_id;
        ?>
        <form method="post" action="<?php echo base_url(); ?>admin_controller/disapprove_cont">
        	<input type="text" name="book_id" value="<?php echo $book_id; ?>" hidden>
        	<div class="form-group"><label>Reason</label> 
			<input  type="text" name="reason" size="50" placeholder="Enter Reason to disapprove Facility" class="form-control" required=""></div>
        	<div>
			<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>Send</strong></button>
			</div>
        </form>
      </div>
      <div class="modal-footer">
       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


                <?php
                    } }
                ?>
                        </tbody>
                      </table>

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