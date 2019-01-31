<?php
if(isset($usertype))
{
    foreach($usertype as $ut)
    {
        $utid=$ut->user_id;
        $utnm=$ut->username;
        $uttype=$ut->user_type;
        $utimg=$ut->pic;
        $wingno=$ut->wing_name;
        $homeno=$ut->home_no;
        $uid=$ut->user_id;
        $is_resident=$ut->is_resident;

        //jinal
        $home_id =$ut->home_id;
        $wing_id = $ut->home_id; 
    }
    
}

?>
<!DOCTYPE html>
<html>
<head>
 <title> MYUNIT| PRATHA </title>
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

<title>MY UNIT | PRATHA</title>
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
	<?php include('myunit_index.php'); ?>	
		<!-- =======================================table================================= -->
		
			
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>FLAT-NO : <?php echo $wingno."-".$homeno; ?></h5> 
                    </div>
	
					<div class="ibox-content">
						<div class="">
										</div>


				

				<div class="row">
				<a href="<?php echo base_url(); ?>owner_controller/display_memberlist_cont" style="color:gray">
					<div class="col-sm-3" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px;margin-left:10px; margin-right:10px; height:100px;" id="my">
						<center><i style="font-size:50px" class="fa fa-home"></i>
						<h3><?php echo $this->owner_model->count_total_member_mdl($uid);?>  MEMBERS</h3></center>
					</div>
				</a>
					<div class="col-sm-1"></div>
					<?php if($is_resident == "no")
					{

						?>
				<a style="color:gray">
					<div class="col-sm-3" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:100px;" id="my1">
						<center><i style="font-size:50px" class="fa fa-car"></i>
						<h3>0 VEHICLES</h3></center>
					</div>
				</a>
				<?php
					}
					else
					{
						?>
						<a href="<?php echo base_url(); ?>owner_controller/vehicle_list_cont" style="color:gray">
					<div class="col-sm-3" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:100px;" id="my1">
						<center><i style="font-size:50px" class="fa fa-car"></i>
						<h3><?php echo $this->owner_model->count_total_vehicle_mdl($uid); ?>  VEHICLES</h3></center>
					</div>
				</a>
						<?php 
					} ?>
					<div class="col-sm-1"></div>
					<?php if($is_resident == "no")
					{

						?>
					
				<a style="color:gray">
					<div class="col-sm-3"  style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:100px;">
						<center><i style="font-size:50px" class="fa fa-user	"></i>
						<h3>0 STAFFS</h3></center>
					</div>
				</a>
					<?php } 

					else
						{
							?>
					<a href="<?php echo base_url(); ?>owner_controller/staff_list_cont" style="color:gray">
					<div class="col-sm-3"  style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:100px;">
						<center><i style="font-size:50px" class="fa fa-user	"></i>
						<h3><?php echo $this->owner_model->count_total_staff_mdl($uid);  ?>  STAFFS</h3></center>
					</div>
				</a>
				<?php
				} ?>		

					
				<?php if($is_resident == "no")
					{

						?>
				<div class="row">
				<a style="color:gray">
					<div class="col-sm-2"></div>
					<div class="col-sm-3" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:100px;">
					<center><i style="font-size:50px" class="fa fa-user	"></i>
						<h3>0 VISITORS</h3></center>	
					</div>
				</a>
				<?php } 
				else
				{
					?>
				
				<a href="<?php echo base_url(); ?>owner_controller/myunit_visiter_cont" style="color:gray">
					<div class="col-sm-2"></div>
					<div class="col-sm-3" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:100px;">
					<center><i style="font-size:50px" class="fa fa-user	"></i>
						<h3><?php if(isset($visiter)){ $tolvisiter = count($visiter); if($tolvisiter > 0) { echo $tolvisiter; } } else { echo "0"; } ?>  VISITORS</h3></center>	
					</div>
				</a>
				<?php }
				?>
				<div class="col-sm-1"></div>
				<?php if($is_resident == "no")
					{

						?>
					
				<a style="color:gray">
					<div class="col-sm-3"  style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:100px;">
						<center><i style="font-size:50px" class="fa fa-exclamation-circle"></i>
						<h3>0 ISSUES</h3></center>
					</div>
				</a>
				<?php }
				else
				{
				?>
				<a href="<?php echo base_url(); ?>owner_controller/show_issue_cont" style="color:gray">
					<div class="col-sm-3"  style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:100px;">
						<center><i style="font-size:50px" class="fa fa-exclamation-circle"></i>
						<h3><?php echo $this->owner_model->count_total_issue_mdl($uid);  ?>  ISSUES</h3></center>
					</div>
				</a>
				<?php } ?>


					<div class="col-sm-3"></div>
				</div>

<hr>
<h3 class="btn btn-info" style="color:black"><strong>Unpaid Dues</strong></h3>
<hr>
				<div class="row">
					<?php
						if(isset($maintanance))
						{
							foreach($maintanance as $m)
							{ ?>

							<div class="col-sm-3">
								<div style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
								<center><h3>Maintanance</h3>
								<h1><strong>&#8377;<?php $tol_m=0;  $main=$m->amount; $penalty_m = $m->penalty; $tol_m = $main + $penalty_m; echo $tol_m; ?></strong></h1>
								<p><?php echo $m->due_date; ?></p>
								<a href="<?php echo base_url(); ?>owner_controller/payindex_cont?m_id=<?php echo $m->maintanance_id; ?>"><h3 class="btn btn-info">pay now</h3></center></a>
								
							</div>
							</div>

					<?php	}
						}
					?>
				<?php
						if(isset($maintanance))
						{
							foreach($maintanance as $m)
							{ if($m->penalty != 0) { ?>

							<div class="col-sm-3">
								<div style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
								<center><h3 class="btn btn-danger" disabled>Notice</h3>
								<center><h3>Maintanance Penalty</h3>
								<h1><strong>&#8377;<?php echo $m->penalty; ?></strong></h1>
								<p><?php echo $m->due_date; ?></p>
								
							</div>
							</div>

					<?php	}
						}
						}
					?>
				<?php 
				if(isset($booking_unpaid))
				{
					foreach($booking_unpaid as $b)
					{ 
						
						?>
						<div class="col-sm-3">
						<div style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
						<center><h3>Booking</h3>
						<cenetr><h1><strong>&#8377;<?php echo $b->total_charge; ?></strong></h1>
							<p><?php echo $b->facility_name; ?></p>
						<a href="<?php echo base_url(); ?>owner_controller/payindex_cont?bid=<?php echo $b->book_id; ?>"><h3 class="btn btn-info">pay now</h3></center></a>
						</div>
				</div>
				<?php 
				}
				}
				if(isset($booking_unpaid_penalty))
				{
					foreach($booking_unpaid_penalty as $bp)
					{ 
						if($bp->penalty!="0")
						{
						
						?>
						<div class="col-sm-3">
						<div style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
						<center><h3>Booking Penalty</h3>
						<cenetr><h1><strong>&#8377;<?php echo $bp->penalty; ?></strong></h1>
						<p><?php echo $bp->facility_name; ?></p>
						<a href="<?php echo base_url(); ?>owner_controller/payindex_cont?bpid=<?php echo $bp->book_id; ?>"><h3 class="btn btn-info">pay now</h3></center></a>
						</div>
				</div>
				<?php  }
				}
				}
				
				?>
				<?php
						if(isset($revenue_unpaid))
						{
							foreach($revenue_unpaid as $revenue)
							{ ?>

							<div class="col-sm-3">
								<div style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
								<center><h3><?php echo $revenue->expense_revenue_name ?></h3>
								<h1><strong>&#8377;<?php echo $revenue->amount; ?></strong></h1>
								<p><?php echo $revenue->added_on; ?></p>
								<a href="<?php echo base_url(); ?>owner_controller/payindex_cont?rid=<?php echo $revenue->expense_revenue_id; ?>"><h3 class="btn btn-info">pay now</h3></center></a>
							</div>
							</div>

					<?php	}
						}
					?>
				
				
			</div>
						
		
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