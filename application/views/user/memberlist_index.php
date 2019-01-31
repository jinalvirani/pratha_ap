<?php
if(isset($usertype))
{
    foreach($usertype as $ut)
    {
        $uttype=$ut->user_type;  
        $is_resident = $ut->is_resident;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>MEMBER | PRATHA </title>
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
<title>MEMBER | PRATHA </title>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function del()
 {
	 return confirm("Are You Sure To Delete Member??");
 }

</script>
</head>

<body>
    <div id="wrapper">
	<?php include('myunit_index.php'); ?>	
		<!-- =======================================table================================= -->

		<?php if($invalid = $this->session->flashdata('add_member')) { ?>
                <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
          <?php if($invalid = $this->session->flashdata('update_member')) { ?>
                <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
                  <?php if($invalid = $this->session->flashdata('delete_member')) { ?>
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>

                 <?php if($invalid = $this->session->flashdata('delete_tenant')) { ?>
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
                        <h5>Display All Family Members </h5>
                       
                    </div>
					<div class="ibox-content">
					<div class="">
            <?php if($is_resident== "no")
            {
              ?>
					<a class="btn btn-add btn-primary pull-right col-sm-2" >+ Add a new member</a>
          <?php }
          else
            {
              ?>
              <a href="<?php echo base_url(); ?>owner_controller/addmember_cont " class="btn btn-add btn-primary pull-right col-sm-2" >+ Add New Member</a>
              <?php 
            } ?>
          <?php if($uttype=='owner' && $is_resident=='yes') { ?>
          <a href="<?php echo base_url(); ?>owner_controller/add_tenant_cont" class="btn btn-add btn-primary" >+ Add Tenant</a>
          <a href="<?php echo base_url(); ?>owner_controller/view_old_tenant_cont" class="btn btn-add btn-primary" >View Old Tenants</a>
          <?php } ?>
         </div>
         <div clas="">
          <?php if($is_resident == 'no')
          {
            ?>
          <a href="<?php echo base_url(); ?>owner_controller/view_tenant_cont" class="btn btn-add btn-primary" >View Tenant</a>
           <a href="<?php echo base_url(); ?>owner_controller/view_old_tenant_cont" class="btn btn-add btn-primary" >View Old Tenants</a>
          <?php } ?>
					</div>
					
				  <table id="example" class="table table-striped table-bordered table-hover " id="example">
					<thead>
					<tr>
						<th>First Name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Last Name<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Gender<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Mobile_No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Member_Type<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
						<th>Image</th>
						<th>Edit</th>
						<th>Delete</th>
						
                    </tr>
                    </thead>
					
<tbody>		
					<?php 
					if(isset($members))
					{
						foreach($members as $row)
						{

							?>
							<tr>
						<td><?php echo $row->firstname; ?></td>
						<td><?php echo $row->lastname; ?></td>
						<td><?php echo $row->gender; ?></td>
						<td><?php echo $row->mobile_no; ?></td>
						<td><?php echo $row->member_type; ?></td>
						<td width="150px" height="150px"><img src="<?php echo base_url(); ?>img/owner/member/<?php echo $row->pic; ?>" height="80%" width="100%"></td>
						<td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>owner_controller/update_member_cont?id=<?php echo $row->member_id; ?>"><img src="<?php echo base_url(); ?>img/edit.png" height="50%" width="50%">Edit</a></center></td>
						<td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>owner_controller/display_memberlist_cont?id=<?php echo $row->member_id; ?>" onclick="return del()"><img src="<?php echo base_url(); ?>img/Delete.png" height="50%" width="50%">Delete</a></center></td>
						
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
   <center><p> <a href="<?php echo base_url(); ?>owner_controller/myunitlist_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>   
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