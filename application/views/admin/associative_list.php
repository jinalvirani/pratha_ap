<!DOCTYPE html>
<html>
<head>
<title> ASSOCIATIVE |  PRATHA </title>
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
function del()
 {
     return confirm("Are You Sure To Delete Associative Member ?");
 }
</script>
</head>

<body>
    <div id="wrapper">
    <?php include('associative_index.php'); ?>  
        <!-- =======================================table================================= -->
         <?php if($invalid = $this->session->flashdata('addassociative')) { ?>
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
          <?php if($invalid = $this->session->flashdata('editassociative')) { ?>
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
                  <?php if($invalid = $this->session->flashdata('deleteassociative')) { ?>
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
                        <h5>Display All Associative Members</h5>
                       
                    </div>
        

                    <div class="ibox-content">
                    <div class="">
                    <a href="<?php echo base_url();?>admin_controller/addassociativefill_cont" class="btn btn-add btn-primary pull-right col-sm-2" >+ Add Associative Member</a>
                    </div>
                  <table id="example" class="table table-striped table-bordered table-hover " id="example">
                    <thead>
                    <tr>
                        <th>Associative Firstame<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Associative Lastname<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Wing No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Mobile No<div class="previous round" style="float:right;cursor:pointer;font-size:16px;">&#8595;&#8593;</div></th>
                        <th>Image</th>
                        <th>Edit</th>
                         <th>Delete</th>
                    </tr>
                    </thead>
                    
                    <tbody>  
                     <?php
                     if(isset($showassociative))
                     {
                     foreach($showassociative as $show)
                     {
                    ?>       
                    <tr>
                        <td><?php echo $show->firstname; ?></td>
                        <td><?php echo $show->lastname; ?></td>
                        <td><?php echo $show->wing_name; ?></td>
                        <td><?php echo $show->mobile_no; ?></td>
                         <td width="150px" height="150px"><img src="<?php echo base_url(); ?>img/admin/<?php echo $show->pic; ?>" height="100%" width="100%"></td>
                         <td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>admin_controller/editassociativefill_cont?id=<?php echo $show->user_id; ?>" ><img src="<?php echo base_url(); ?>img/edit.png" height="50%" width="50%">Edit</a></center></td>
                        <td width="50px" height="50px"><center><a href="<?php echo base_url(); ?>admin_controller/associative_cont?id=<?php echo $show->user_id; ?>" onclick="return del()"><img src="<?php echo base_url(); ?>img/delete.png" height="50%" width="50%">Delete</a></center></td>

                        <?php } }  ?>
                    </tr>
                        </tbody>
                      </table>
                      <center><p> <a href="<?php echo  base_url(); ?>admin_controller/showadmin"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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