<?php
if(isset($usertype))
{
    foreach($usertype as $ut)
    {
        $uttype=$ut->user_type;  
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	 <title> TENANT | PRATHA </title>
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
<title>OWNER | PRATHA </title>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function del()
 {
	 return confirm("Are You Sure To Delete Tenant??");
 }

</script>
</head>

<body>
    <div id="wrapper">
	<?php include('myunit_index.php'); ?>	
		<!-- =======================================table================================= -->

		<?php if($invalid = $this->session->flashdata('add_tenant')) { ?>
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                <?php } ?>
                        
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Display Tenant </h5>
                       
                    </div>
					<div class="ibox-content">
					 

				  <table id="example" class="table table-striped table-bordered table-hover " id="example">
					<thead>
					<tr>
						<th>First Name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Last Name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Gender<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Mobile_No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Email<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Image</th>
						<th>To<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>From<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Delete</th>
						
                    </tr>
                    </thead>
					
<tbody>		
					<?php 
					if(isset($tenant))
					{
						foreach($tenant as $row)
						{

							?>
							<tr>
						<td><?php echo $row->firstname; ?></td>
						<td><?php echo $row->lastname; ?></td>
						<td><?php echo $row->gender; ?></td>
						<td><?php echo $row->mobile_no; ?></td>
						<td><?php echo $row->email; ?></td>
						<td width="150px" height="150px"><img src="<?php echo base_url(); ?>img/owner/<?php echo $row->pic; ?>" height="80%" width="100%"></td>
						<td><?php echo $row->added_on; ?></td>
						<td><?php echo $row->modified_on; ?></td>
						<td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>owner_controller/view_tenant_cont?id=<?php echo $row->user_id; ?>" onclick="return del()"><img src="<?php echo base_url(); ?>img/Delete.png" height="50%" width="50%">Delete</a></center></td>
						
					</tr>


					<?php 	}  }

					?>
					

						</tbody>
					  </table>

<script src="<?php echo base_url(); ?>js/plugins/dataTables/datatables.min.js"></script>	
  <script>
  $(function(){
    $("#example").dataTable();
  })
  </script>    
   <center><p> <a href="<?php echo base_url(); ?>owner_controller/display_memberlist_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>   
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