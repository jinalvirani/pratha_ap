<?php
if(isset($usertype))
{
    foreach($usertype as $ut)
    {
        $utnm=$ut->username;
        $uttype=$ut->user_type;
        $utimg=$ut->pic;
    }
}
?>
<?php
	if(isset($total_vote))
	{
		 foreach($total_vote as $tv)
	    {
	        $count_total_vote=$tv->counttotalvotes;
	       
	    }
	}
?>
<!DOCTYPE html>
<html>
<head>
<title> POLL |  PRATHA </title>
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
.progress {
    text-align:center;
}
.progress-value {
    position:absolute;
    right:0;
    left:0;
}
</style>
<title>ADMIN | PRATHA</title>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function del()
 {
     return confirm("Are you sure to delete security guard?");
 }
</script>
</head>

<body>
    <div id="wrapper">
    <?php include('poll_index.php'); ?>  
    <?php if($invalid = $this->session->flashdata('pollopen')) { ?>
                       <div class="ibox float-e-margins" id="abc">
                <div class="ibox-title" style="background-color:#b9b624">
                <a class="close-link pull-right"><i class="fa fa-times" style="color:black"></i></a>
                <?php echo $invalid; ?>
                </div>
                </div>
                        <?php } ?>
       <?php if($invalid = $this->session->flashdata('pollclose')) { ?>
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
                        <h5>Open Poll</h5>
                       
                    </div>
        

                    <div class="ibox-content">
                    <div class="">
                   		
                    </div>
                   
                    <?php if(isset($poll))
                	{
                		foreach($poll as $p)
                		{ ?>

                			<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
						<div class="row">
						
							<div class="col-sm-1"><div class="circular--square circular--landscape circular--portrait"><img src="<?php if($utimg) { echo base_url(); ?>img/admin/<?php echo $utimg; } ?>" class="img-circle img-responsive"></div>
							</div>
							<div class="col-sm-2"></div>
							<div class="col-sm-4"><h3><?php if(isset($utnm)){ echo $utnm; } ?></h3></div>
							<div class="col-sm-5" style="margin-top: 10px;"><?php echo $p->added_on;?>&nbsp;&nbsp;&nbsp;<?php echo $p->time;  ?></div>
						</div>
						<hr>
						<h3><?php echo $p->title; ?></h3>
						<p><?php echo $p->description; ?></h3></p><br>

						<div class="row">
							<?php 
								if(isset($poll_member))
								{
									foreach($poll_member as $m)
									{ ?>

										<div class="col-sm-3">
											<center><h3><?php if($m){ echo $m->firstname; } ?></h3>
											
											<div class="col-sm-1"><div class="circular--square circular--landscape circular--portrait"><img src="<?php if($m) { echo base_url(); ?>img/owner/<?php echo $m->pic; } ?>" class="img-circle img-responsive"></div>
							</div>

											<br>
										</center>
										</div>

							<?php	}
								}
							?>
						</div>

						</div>
						<div class="col-sm-4"></div>
				</div>
				<br><br>
				<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-5">
					<?php 
					if(isset($o_c))
					{
						if(isset($poll_member))
						{
							if(count($poll_member) >=2 )
							{
								if($o_c=='yes')
								{ ?>

									<center><a href="<?php echo base_url(); ?>admin_controller/close_poll_cont?nid=<?php echo $m->notice_id; ?>" class="btn btn-danger">CLOSE</a></center>

						<?php	}
								else
								{ ?>

									<center><a href="<?php echo base_url(); ?>admin_controller/open_poll_cont?nid=<?php echo $m->notice_id; ?>" name="open" class="btn btn-danger">OPEN</a></center>

						<?php    }
							}
							else
							{ ?>
								<center><a href="<?php echo base_url(); ?>admin_controller/open_poll_cont" name="open" class="btn btn-danger" disabled>OPEN</a></center>
				<?php			}
						}
						else
						{ ?>
							<center><a href="<?php echo base_url(); ?>admin_controller/open_poll_cont" name="open" class="btn btn-danger" disabled>OPEN</a></center>
						<?php }	
					}
					?>
				</div>
				<div class="col-sm-4"></div>
				</div>
		

               <?php 	}
                	}
                	else
                	{ ?>
                	<div class="row">
						<div class="col-sm-3"></div>
						<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px;margin-right:10px; height:auto;">
							<div class="row">
								<div class="row">
									<div class="col-sm-1"><div class="circular--square circular--landscape circular--portrait"><img src="<?php if($utimg) { echo base_url(); ?>img/admin/<?php echo $utimg; } ?>" class="img-circle img-responsive"></div>
									</div>
									<div class="col-sm-2"></div>
									<div class="col-sm-4"><h3><?php if($utnm) { echo $utnm; } ?></h3></div>
									<div class="col-sm-5" style="margin-top: 10px;"><?php if(isset($header)){ foreach($header as $h) { echo $h->modified_on; } } ?>&nbsp;&nbsp;&nbsp;<?php if(isset($header)){ foreach($header as $h) { echo $h->time; } } ?></div>
								</div>

							</div>
				<hr>
				<h3><?php if(isset($header)){ foreach($header as $h) { echo $h->title; } } ?></h3>
				<p><?php if(isset($header)){ foreach($header as $h) { echo $h->description; } } ?></h3></p><br>
				<h3 style="color:red;"><?php if(isset($pp)){ $max=0; $count =0; 
					if(isset($votes))
					{
						foreach($votes as $v)
						{ 
							$vv = $v->countvotes;
							if(isset($count_total_vote))
							{
								$v1 = ($vv*100)/$count_total_vote;
								$v2 =abs($v1)+1; 
							}
							if($v1==50)
							{
								$msg ="It's a Tie";
							}
							
							if($v1 > $max)
							{
								$max = $v1;
								$user_id = $v->given_vote;
								$count++;
							}
							
							
						}

					}
						if(isset($user_id))
						{
							$win=$this->admin_model->win_mdl($user_id);
						}
						
					      if(isset($win))
					      {
					      	foreach($win as $w)
					      	{
						        $data['win'] = $w->firstname;
						        $winname = $data['win'];
						    }
					      }
					
						} ?> <?php if(isset($msg)){ echo $msg;  } else{ if(isset($winname)){ ?> Congratulations !! <?php echo $winname; } }  ?></h3><br>
						<div class="row">
						<?php
							if(isset($votes))
							{ ?>

						<div class="col-sm-2">
							<?php if(isset($pp)) 
							{
								foreach($pp as $q)
								{ ?>
									
									<div>	

								<?php echo $q->firstname; ?>

							</div>
							<br>


								
						<?php	} } ?>
					</div>
					<div class="col-sm-10">
						<?php	if(isset($votes))
							{
								foreach($votes as $v)
								{ 
									$vv = $v->countvotes;
									if(isset($count_total_vote))
									{
										$v1 = ($vv*100)/$count_total_vote;
										$v2 =abs($v1);
									}
									

								?>	
									
									<div class="progress vertical">
							  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $v2; ?>%;">
							  </div><span class="progress-value"><?php echo $v1; ?>%</span>
							</div>

						<?php	} } 
							}
							else
							{?>
								<div class="col-sm-2">
							<?php if(isset($pp)) 
							{
								foreach($pp as $q)
								{ ?>
									
									<div>	

								<?php echo $q->firstname; ?>

							</div>
							<br>


								
						<?php	} } ?>
					</div>
					<div class="col-sm-10">
						<?php		if(isset($pp)) 
							{
								foreach($pp as $q)
								{ ?>
									
									<div class="progress vertical">
							  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
							  </div><span class="progress-value"><?php echo "0"; ?>%</span>
							</div>

						<?php	} } 
							}
						?>
					</div>
							
				</div>
				<br>
				
				
			</div>
			<div class="col-sm-4"></div>
		</div>
	      
                	<?php }

                	?><br><br>
        <center><p> <a href="<?php echo  base_url(); ?>admin_controller/showadmin"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>           
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