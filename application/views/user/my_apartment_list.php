<?php
if(isset($usertype))
{
    foreach($usertype as $ut)
    {
    	$utid = $ut->user_id; 
       	$uttype=$ut->user_type;
     	$ut_is_resident = $ut->is_resident;
     	$ut_wingid = $ut->wing_id;
    }
}
?>
<?php
if(isset($admin_info))
{
    foreach($admin_info as $admin)
    {
        $adminunm=$admin->username;
        $adminimg=$admin->pic;
    }
}
?>
<?php
if(isset($check_associative))
{
    foreach($check_associative as $check)
    {
       $wing = $check->wing_no;
    }
    if($wing==0)
    {
    	$wing="";
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
	 <title> MY APARTMENT | PRATHA </title>
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
<title>MY APARTMENT | PRATHA</title>
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
 <script>
function del()
 {
	 return confirm("Are you sure to delete staff?? ");
 }
</script>
</head>

<body>
    <div id="wrapper">
	<?php include('my_apartment_index.php'); ?>	
    
		<?php if($invalid = $this->session->flashdata('postupload')) { ?>
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
                      <ul class="nav nav-pills">
					    <li class="active"><a data-toggle="pill" href="#conversation">CONVERSATIONS</a></li>
					    <li><a data-toggle="pill" href="#poll">POLL</a></li>
					    <li><a data-toggle="pill" href="#notice">NOTICES</a></li>
					  </ul>

                    </div>
					<div class="ibox-content">
						
						<div class="">
					<a href="<?php echo  base_url(); ?>owner_controller/make_conversation_cont" class="btn btn-add btn-primary pull-right col-sm-2" >+Make Conversation</a>
					</div><br><br>
<!--tab start-->
<div class="tab-content">
    <div id="conversation" class="tab-pane fade in active">
    	
	<?php
    	 $f=1;
       if(isset($showpost))
        {
        	if($ut_is_resident=='yes')
        	{
        		foreach($showpost as $row)
                	{ ?>
                	
                		<div class="row" style="clear: both">
					<div class="col-sm-3"></div>
					<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
						<div class="row">
							<div class="col-sm-1"><div class="circular--square circular--landscape circular--portrait">
                            <img src="<?php echo base_url(); ?>img/owner/<?php echo $row->picc; ?>"></div>

							</div>
							<div class="col-sm-2"></div>
							<div class="col-sm-4"><h3><?php if($showpost) { echo $row->username; }?></h3><?php if($showpost){ echo $row->wing_name; }?> - <?php if($showpost){ echo $row->home_no; }?> <?php if($showpost){ echo $row->user_type; }?></div>
							<div class="col-sm-5" style="margin-top: 10px;"><?php if($showpost){ echo $row->added_on; } ?>&nbsp;&nbsp;&nbsp;<?php if($showpost){ echo $row->time;  } ?></div>
							
						</div>
						<hr>
						<b><h4><?php if(isset($row->caption)) { echo $row->caption; } ?></h4></b>
						<div>
                            <center><img src="<?php echo base_url(); ?>img/owner/conversation/<?php echo $row->pic; ?>" class="img-responsive" style="max-height: 200px;" width="430px"></center>
						</div>
						<hr>
						<?php 
							$already_like = $this->owner_model->check_like_mdl($utid,$row->post_id);
							
							if($already_like)
							{ ?>

								<span class="unlike fa fa-heart" style="color:red; font-size: 24px;" data-id="<?php echo $row->post_id; ?>"></span> 
						<span class="like hide fa fa-heart-o" style="color:black; font-size: 24px;" data-id="<?php echo $row->post_id; ?>"></span>
								

						<?php	}
						else
						{ ?>

							<span class="like fa fa-heart-o" style="color:black; font-size: 24px;" data-id="<?php echo $row->post_id; ?>"></span>
							
							<span class="unlike hide fa fa-heart" style="color:red; font-size: 24px;" data-id="<?php echo $row->post_id; ?>"></span> 
						
				<?php	}
						?>

						<span class="likes_count"><strong>&nbsp;&nbsp;<?php echo $row->likes;?><label>&nbsp;&nbsp;Likes</label></strong></span>
					</div>
					<div class="col-sm-4"></div>
				</div>

              <?php }
               			
            }
            else
           	{ 
                $f=0;	
            }
        }
        else
        { 
	        $f=0;
        }
        if($f==0)
        { ?>
                		<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
						<h3><center>No Post Found</center></h3>
					</div>
					<div class="col-sm-4"></div>
					</div>
        <?php	}
                	?>
     		
    </div>
    <div id="poll" class="tab-pane fade">
      	
      	<?php 
       $f=1;
       if(isset($poll))
        {
        	if($ut_is_resident=='yes')
        	{
        		if($ut_wingid==$wing)
      			{	
          			foreach($poll as $p)
                	{
                	if($p->open_close=='open')
                	{ ?>

                	<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
					<div class="row">
					<div class="col-sm-1"><div class="circular--square circular--landscape circular--portrait"><img src="<?php if($adminimg){ echo base_url(); ?>img/admin/<?php echo $adminimg; } ?>" class="img-circle img-responsive" ></div>
							</div>
							<div class="col-sm-2"></div>
							<div class="col-sm-4"><h3><?php if(isset($adminunm)){ echo $adminunm; } ?></h3></div>
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
											<img src="<?php  if($m) { echo base_url(); ?>/img/owner/<?php echo $m->pic; } ?>" class="img-rounded img-responsive" style="max-height: 30px;"><br>
											<?php
											if(isset($vote))
											{
												if($vote=='yes')
												{ ?>
													<a class="v_id btn btn-primary" id="<?php echo $m->user_id; ?>" disabled>Vote</a>
													<input type="text" id="uid" value="<?php echo $m->user_id?>" hidden>
													<input type="text" id="nid" value="<?php echo $m->notice_id?>" hidden>
										<?php	}
												else
												{ ?>
													<a class="v_id btn btn-primary" id="<?php echo $m->user_id; ?>">Vote</a>
													<input type="text" id="uid" value="<?php echo $m->user_id?>" hidden>
													<input type="text" id="nid" value="<?php echo $m->notice_id?>" hidden>
										<?php	}
											}
											else
											{
												?>
													<a class="v_id btn btn-primary" id="<?php echo $m->user_id; ?>">Vote</a>
													<input type="text" id="nid" value="<?php echo $m->notice_id?>" hidden>
									<?php		}
											?>
										</center>
										</div>

							<?php	}
								}
							?>
						</div>

						</div>
						<div class="col-sm-4"></div>
				</div>
               <?php 	}
               			else
               			{ 
               				$f=0;
               			}

               			}
               		}
               		else
               		{
               			if($wing=="")
               			{
               				foreach($poll as $p)
                		{
                	if($p->open_close=='open')
                	{ ?>

                	<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
					<div class="row">
					<div class="col-sm-1"><div class="circular--square circular--landscape circular--portrait"><img src="<?php if($adminimg){ echo base_url(); ?>img/admin/<?php echo $adminimg; } ?>" class="img-circle img-responsive" ></div>
							</div>
							<div class="col-sm-2"></div>
							<div class="col-sm-4"><h3><?php if(isset($adminunm)){ echo $adminunm; } ?></h3></div>
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
											<img src="<?php  if($m) { echo base_url(); ?>/img/owner/<?php echo $m->pic; } ?>" class="img-rounded img-responsive" style="max-height: 30px;"><br>
											<?php
											if(isset($vote))
											{
												if($vote=='yes')
												{ 
													?>
													
													<a class="v_id btn btn-primary" id="<?php echo $m->user_id; ?>" disabled>Vote</a>
													<input type="text" id="nid" value="<?php echo $m->notice_id?>" hidden>

										<?php	}
												else
												{ 
													?>
													
													<a class="v_id btn btn-primary" id="<?php echo $m->user_id; ?>">Vote</a>
													<input type="text" id="nid" value="<?php echo $m->notice_id?>" hidden>

										<?php	}
											}
											else
											{
												?>

													<a class="v_id btn btn-primary"  id="<?php echo $m->user_id; ?>">Vote</a>
													<input type="text" id="nid" value="<?php echo $m->notice_id?>" hidden>

									<?php		}
											?>
										</center>
										</div>

							<?php	}
								}
							?>
						</div>

						</div>
						<div class="col-sm-4"></div>
				</div>
               <?php 	}
               			else
               			{ 
               				$f=0;
               				
              			}

               			}
               			}
               			else
               			{
               				$f=0;
               			}
               		}
               			
               		}
               		else
               		{ 
               			$f=0;	
             	    }
                	}
                	else
                	{ 
	                	if($ut_is_resident=='yes')
	        			{ ?>
	       <div class="row">
			 <div class="col-sm-3"></div>
			 <div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px;margin-right:10px; height:auto;">
				<div class="row">
					<div class="row">
									<div class="col-sm-1"><div class="circular--square circular--landscape circular--portrait"><img src="<?php if($adminimg) { echo base_url(); ?>img/admin/<?php echo $adminimg; } ?>" class="img-circle img-responsive"></div>
							</div>
									<div class="col-sm-2"></div>
									<div class="col-sm-4"><h3><?php if($adminunm) { echo $adminunm; } ?></h3></div>
									<div class="col-sm-5" style="margin-top: 10px;"><?php if(isset($header)){ foreach($header as $h) { echo $h->modified_on; } } ?>&nbsp;&nbsp;&nbsp;<?php if(isset($header)){ foreach($header as $h) { echo $h->time; } } ?></div>
								</div>

							</div>
				<hr>
				<h3><?php if(isset($header)){ foreach($header as $h) { echo $h->title; } } ?></h3>
				<p><?php if(isset($header)){ foreach($header as $h) { echo $h->description; } } ?></h3></p><br>
				<h3 style="color:red;"><?php if(isset($pp)){ $max=0; 
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
							}
						}
					}
						if(isset($user_id))
						{
							$win=$this->owner_model->win_mdl($user_id);
						}
						
					      if(isset($win))
					      {
					      	foreach($win as $w)
					      	{
						        $data['win'] = $w->firstname;
						        $winname = $data['win'];
						    }
					      }
					
						} ?><?php if(isset($msg)) { echo $msg; } else { if(isset($winname)){ ?> Congratulations !! <?php echo $winname; } } ?></h3><br>
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
										$v2 =abs($v1)+1; 
									}
									
								?>	
									
									<div class="progress vertical">
							  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $v2; ?>%">
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
	             <?php  }
	                	else
	                	{
	                		$f=0;
	                	}
					}

                	if($f==0)
                	{ ?>
                		<div class="row">
					<div class="col-sm-3"></div>
					<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
						<h3><center>No Poll Result Found</center></h3>
					</div>
					<div class="col-sm-4"></div>
					</div>
                <?php	}

                	?>

				
      	 
    </div>


<!--===============================================  notice  =============================================-->
    <div id="notice" class="tab-pane fade">
      
     	 
    	<?php if(isset($shownotice))
      		{
      			if($ut_is_resident=='yes')
      			{
      			foreach($shownotice as $notice)
      			{
      				if($notice->notice_type=="maintanance")
      				{ ?>
      					
						<div class="row" style="clear: both">
							<div class="col-sm-3"></div>
							<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
								<div class="row">
									<div class="row">
									<div class="col-sm-1"><div class="circular--square circular--landscape circular--portrait"><img src="<?php if($adminimg) { echo base_url(); ?>img/admin/<?php echo $adminimg; } ?>" class="img-circle img-responsive"></div>
							</div>
									<div class="col-sm-2"></div>
									<div class="col-sm-4"><h3><?php if($adminunm) { echo $adminunm; } ?></h3></div>
									<div class="col-sm-5" style="margin-top: 10px;"><?php echo $notice->added_on;?>&nbsp;&nbsp;&nbsp;<?php echo $notice->time;  ?></div>
								</div>
								<hr>
								<h3><?php echo $notice->title; ?></h3>
								<p><?php echo $notice->description; ?></p>
							</div>
							<div class="col-sm-4"></div>
						</div>	
					</div>
      		<?php	}
      				elseif($notice->notice_type=="poll")
      				{ 
						if($ut_wingid==$wing)
      					{
      					?>
      					
      					<div class="row" style="clear: both">
							<div class="col-sm-3"></div>
							<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
								<div class="row">
									<div class="row">
									<div class="col-sm-1"><div class="circular--square circular--landscape circular--portrait"><img src="<?php if($adminimg) { echo base_url(); ?>img/admin/<?php echo $adminimg; } ?>" class="img-circle img-responsive"></div>
							</div>
									<div class="col-sm-2"></div>
									<div class="col-sm-4"><h3><?php if($adminunm) { echo $adminunm; } ?></h3></div>
									<div class="col-sm-5" style="margin-top: 10px;"><?php echo $notice->added_on;?>&nbsp;&nbsp;&nbsp;<?php echo $notice->time;  ?></div>
								</div>
								<hr>
								<h3><?php echo $notice->title; ?></h3>
								<p><?php echo $notice->description; ?></p>
								<br>
								<?php 
									if(isset($uttype))
									{
										if($uttype=='tenant')
										{

										}
										else
										{	if($notice->open_close=='open')
											{ 

											if(isset($regi_unregi))
												{
													 if($regi_unregi=='yes')
													 { ?>
													 	<span class="unregi btn btn-primary"  data-id="<?php echo $notice->notice_id; ?>" disabled>UNREGISTER</span>
														<span class="regi hide btn btn-primary" data-id="<?php echo $notice->notice_id; ?>" disabled>REGISTER</span>
											<?php 	 }
													 else
													 {
												 ?>

													<span class="regi btn btn-primary"  data-id="<?php echo $notice->notice_id; ?>" disabled>REGISTER</span>
													<span class="unregi hide btn btn-primary"  data-id="<?php echo $notice->notice_id; ?>" disabled>UNREGISTER</span> 

				
										  <?php 	}
									  		   }

									  		}
											else
											{
												if(isset($regi_unregi))
												{
													 if($regi_unregi=='yes')
													 { ?>

													 	<span class="unregi btn btn-primary"  data-id="<?php echo $notice->notice_id; ?>">UNREGISTER</span>
														<span class="regi hide btn btn-primary" data-id="<?php echo $notice->notice_id; ?>">REGISTER</span>
											<?php 	 }
													 else
													 {
												 ?>

													<span class="regi btn btn-primary"  data-id="<?php echo $notice->notice_id; ?>">REGISTER</span>
													<span class="unregi hide btn btn-primary"  data-id="<?php echo $notice->notice_id; ?>">UNREGISTER</span> 

										  <?php 	}
									  		   }
								  		}
								  	  }
									}
								?>
							</div>
							<div class="col-sm-4"></div>
						</div>	
					</div>
				<?php	}
					else
					{
// admin poll_id   
						
						if($wing=="")
						{ ?>
							<div class="row" style="clear: both">
							<div class="col-sm-3"></div>
							<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
								<div class="row">
									<div class="row">
									<div class="col-sm-1"><div class="circular--square circular--landscape circular--portrait"><img src="<?php if($adminimg) { echo base_url(); ?>img/admin/<?php echo $adminimg; } ?>" class="img-circle img-responsive"></div>
							</div>
									<div class="col-sm-2"></div>
									<div class="col-sm-4"><h3><?php if($adminunm) { echo $adminunm; } ?></h3></div>
									<div class="col-sm-5" style="margin-top: 10px;"><?php echo $notice->added_on;?>&nbsp;&nbsp;&nbsp;<?php echo $notice->time;  ?></div>
								</div>
								<hr>
								<h3><?php echo $notice->title; ?></h3>
								<p><?php echo $notice->description; ?></p>
								<br>
								<?php 
									if(isset($uttype))
									{
										if($uttype=='tenant')
										{

										}
										else
										{	if($notice->open_close=='open')
											{ 

											if(isset($regi_unregi))
												{
													 if($regi_unregi=='yes')
													 { ?>
													 	<span class="unregi btn btn-primary"  data-id="<?php echo $notice->notice_id; ?>" disabled>UNREGISTER</span>
														<span class="regi hide btn btn-primary" data-id="<?php echo $notice->notice_id; ?>" disabled>REGISTER</span>
											<?php 	 }
													 else
													 {
												 ?>

													<span class="regi btn btn-primary"  data-id="<?php echo $notice->notice_id; ?>" disabled>REGISTER</span>
													<span class="unregi hide btn btn-primary"  data-id="<?php echo $notice->notice_id; ?>" disabled>UNREGISTER</span> 

										  <?php 	}
									  		   }

									  		}
											else
											{
												if(isset($regi_unregi))
												{
													 if($regi_unregi=='yes')
													 { ?>
													 		<span class="unregi btn btn-primary"  data-id="<?php echo $notice->notice_id; ?>">UNREGISTER</span>
														<span class="regi hide btn btn-primary" data-id="<?php echo $notice->notice_id; ?>">REGISTER</span>
											<?php 	 }
													 else
													 {
												 ?>

													<span class="regi btn btn-primary"  data-id="<?php echo $notice->notice_id; ?>">REGISTER</span>
													<span class="unregi hide btn btn-primary"  data-id="<?php echo $notice->notice_id; ?>">UNREGISTER</span> 

										  <?php 	}
									  		   }
								  		}
								  	  }
									}
								?>
							</div>
							<div class="col-sm-4"></div>
						</div>	
					</div>
						<?php }
						else
						{

						}

					}
	      		 	}
      				else
      				{ ?>

      					<div class="row" style="clear: both">
							<div class="col-sm-3"></div>
							<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
								<div class="row">
									<div class="row">
									<div class="col-sm-1"><div class="circular--square circular--landscape circular--portrait"><img src="<?php if($adminimg) { echo base_url(); ?>img/admin/<?php echo $adminimg; } ?>" class="img-circle img-responsive"></div>
							</div>
									<div class="col-sm-2"></div>
									<div class="col-sm-4"><h3><?php if($adminunm) { echo $adminunm; } ?></h3></div>
									<div class="col-sm-5" style="margin-top: 10px;"><?php echo $notice->added_on;?>&nbsp;&nbsp;&nbsp;<?php echo $notice->time;  ?></div>
								</div>
								<hr>
								<h3><?php echo $notice->title; ?></h3>
								<p><?php echo $notice->description; ?></p>
							</div>
							<div class="col-sm-4"></div>
						</div>	
					</div>

      		<?php	}
      			}
      		}
      		else
      		{ ?>
      			<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
								<div class="row">
									<h3><center>No notice found from admin</center></h3>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>	
     <?php 		}
      		}
      		else
      		{ ?>
      					<div class="row">
							<div class="col-sm-3"></div>
							<div class="col-sm-5" style="margin-top:10px;border-radius: 25px;border: 2px solid #73AD21;padding: 20px; margin-left:10px; margin-right:10px; height:auto;">
								<div class="row">
									<h3><center>No notice found from admin</center></h3>
								</div>
							</div>
							<div class="col-sm-4"></div>
						</div>	

     <?php 		}
      ?>	

				
    </div>
</div>
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

 <script type="text/javascript">

$(document).ready(function(){
		// when the user clicks on like
		$('.like').on('click', function(){
			var postid = $(this).data('id');
			    $post = $(this);

			$.ajax({
				url: "<?php echo base_url() ?>owner_controller/post_like",
				type: 'post',
				data: {
					'liked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});

		$('.unlike').on('click', function(){
			var postid = $(this).data('id');
		    $post = $(this);

			$.ajax({
				url:"<?php echo base_url() ?>owner_controller/post_unlike",
				type: 'post',
				data: {
					'unliked': 1,
					'postid': postid
				},
				success: function(response){
					$post.parent().find('span.likes_count').text(response + " likes");
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});

		$('.regi').on('click', function(){
			var poll_id = $(this).data('id');
		    $post = $(this);

			$.ajax({
				url:"<?php echo base_url() ?>owner_controller/registration_for_poll_cont",
				type: 'post',
				data: {
					'poll_id': poll_id,
				
				},
				success: function(response){
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});
		$('.unregi').on('click', function(){
			var poll_id = $(this).data('id');
		    $post = $(this);

			$.ajax({
				url:"<?php echo base_url() ?>owner_controller/unregistration_for_poll_cont",
				type: 'post',
				data: {
					'poll_id': poll_id,
				
				},
				success: function(response){
					$post.addClass('hide');
					$post.siblings().removeClass('hide');
				}
			});
		});

		$('.v_id').on('click', function(){
			var user_id = $(this).attr("id")
			var notice_id = $('#nid').val();
			const $buttons = $("a[class*='v_id']");
 $post = $('#v');
			$.ajax({
				url:"<?php echo base_url() ?>owner_controller/vote_cont",
				type: 'post',
				data: {
					'user_id': user_id,
					'notice_id':notice_id
				
				},
				success: function(response){
					    $buttons.each(function(){
					         $buttons.addClass('disabled'); //enable
					})
					
				}
			});
		});

		

	});

</script>