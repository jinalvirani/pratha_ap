
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
<?php 
	if(isset($pay_history))
	{
		foreach($pay_history as $row)
		{	
            $book_id=$row->book_id;
			$time_slot=$row->time_slot;
			$book_date=$row->book_date;
			$facility_name=$row->facility_name;
			$totalcharge=$row->total_charge;
			$firstname=$row->firstname;
			$email=$row->email;
			$mobile_no=$row->mobile_no;
		}
	}

?>

<?php 
    if(isset($myunit_pay_history))
    {
        foreach($myunit_pay_history as $row)
        {   
            $book_id=$row->book_id;
            $time_slot=$row->time_slot;
            $book_date=$row->book_date;
            $facility_name=$row->facility_name;
            $totalcharge=$row->total_charge;
            $firstname=$row->firstname;
            $email=$row->email;
            $mobile_no=$row->mobile_no;
        }
    }

?>

<?php 
    if(isset($pay_booking_penalty))
    {
        foreach($pay_booking_penalty as $row)
        {   
            $book_id=$row->book_id;
            $time_slot=$row->time_slot;
            $book_date=$row->book_date;
            $facility_name=$row->facility_name;
            $totalcharge=$row->penalty;
            $firstname=$row->firstname;
            $email=$row->email;
            $mobile_no=$row->mobile_no;
        }
    }

?>

<?php 
    if(isset($pay_maintenance))
    {
        foreach($pay_maintenance as $row1)
        {   
            $maintanance_id=$row1->maintanance_id;
            $m_date=$row1->maintanance_date;
            $amount=$row1->amount;
            $penalty=$row1->penalty;
            $totalcharge=$amount + $penalty;
            $firstname=$row1->firstname;
            $email=$row1->email;
            $mobile_no=$row1->mobile_no;
        }
    }

?>
<?php 
    if(isset($pay_revenue))
    {
        foreach($pay_revenue as $row1)
        {   
            $expense_revenue_id = $row1->expense_revenue_id;
            $expense_revenue_name = $row1->expense_revenue_name;
            $added_on = $row1->added_on;
            $totalcharge=$row1->amount;
            $firstname=$row1->firstname;
            $email=$row1->email;
            $mobile_no=$row1->mobile_no;
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
 <title> PAYMENT | PRATHA </title>
<style>
		form .error{
			font-weight: bold;
			color:#cc5965;
			border-color:blue;
		}
</style>
 
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
</head>

<body>
   <div id="wrapper">

   
   <?php if(isset($pay_history)) { 
        include('bookfacility_index.php');
    }
    else
    {
        include('myunit_index.php');
    }
   ?> 
   
		<!-- =======================================table================================= -->
		
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Check Info</h5>
                        
						
                    </div>
			<div class="ibox-content">
				    <?php if(isset($pay_history)) { ?>
                                <form action="<?php echo base_url(); ?>owner_controller/paynow_cont?book_id=<?php echo $book_id; ?>" method="post" enctype="multipart/form-data" id="f1">
                                    <input type="hidden" name="book_id" size="50" class="form-control" value="<?php if($book_id) { echo $book_id; }?>" hidden>
                                	<div class="form-group"><label>Facility_Name</label> 
                                	<input type="text" name="facility_name" size="50" class="form-control" value="<?php if($facility_name) { echo $facility_name; }?>" readonly></div>
                                	
                                    <div class="form-group"><label>Date</label> 
									<input type="date" name="book_date" size="50" class="form-control" value="<?php if($book_date) {  echo $book_date; }?>" readonly></div>
									 <div class="form-group"><label>Time_Slot</label> 
                                	<input type="text" name="time_slot" size="50" class="form-control" value="<?php if($time_slot) { echo $time_slot; }?>" readonly></div>
                                	
										<div class="form-group"><label>Total Charge</label> 
									<input type="number" name="total_charge" size="50" class="form-control" id="charge_perhour" value="<?php if($totalcharge) { echo $totalcharge; 	}?>" readonly></div>

									
                                	<input type="hidden" name="firstname" size="50" class="form-control" value="<?php if($firstname) { echo $firstname; }?>" hidden>
                                    
                                	<input type="hidden" name="email" size="50" class="form-control" value="<?php if($email) { echo $email; }?>" hidden>

                                	<input type="hidden" name="mobile_no" size="50" class="form-control" value="<?php if($mobile_no) { echo $mobile_no; }?>" hidden>
                                	
                                	
                                	<div>
										<button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>PayNow</strong></button>
			</div><br><br><br>
									</form>
                                    <center><p> <a href="<?php echo base_url(); ?>owner_controller/bookfacility_list_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
                                <?php } ?>


                                 <?php if(isset($myunit_pay_history)) { ?>
                                <form action="<?php echo base_url(); ?>owner_controller/paynow_cont?myunit_book_id=<?php echo $book_id; ?>" method="post" enctype="multipart/form-data" id="f1">
                                    <input type="hidden" name="book_id" size="50" class="form-control" value="<?php if($book_id) { echo $book_id; }?>" hidden>
                                    <div class="form-group"><label>Facility_Name</label> 
                                    <input type="text" name="facility_name" size="50" class="form-control" value="<?php if($facility_name) { echo $facility_name; }?>" readonly></div>
                                    
                                    <div class="form-group"><label>Date</label> 
                                    <input type="date" name="book_date" size="50" class="form-control" value="<?php if($book_date) {  echo $book_date; }?>" readonly></div>
                                     <div class="form-group"><label>Time_Slot</label> 
                                    <input type="text" name="time_slot" size="50" class="form-control" value="<?php if($time_slot) { echo $time_slot; }?>" readonly></div>
                                    
                                        <div class="form-group"><label>Total Charge</label> 
                                    <input type="number" name="total_charge" size="50" class="form-control" id="charge_perhour" value="<?php if($totalcharge) { echo $totalcharge;  }?>" readonly></div>

                                    
                                    <input type="hidden" name="firstname" size="50" class="form-control" value="<?php if($firstname) { echo $firstname; }?>" hidden>
                                    
                                    <input type="hidden" name="email" size="50" class="form-control" value="<?php if($email) { echo $email; }?>" hidden>

                                    <input type="hidden" name="mobile_no" size="50" class="form-control" value="<?php if($mobile_no) { echo $mobile_no; }?>" hidden>
                                    
                                    
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>PayNow</strong></button>
            </div><br><br><br>
                                    </form>
                                    <center><p> <a href="<?php echo base_url(); ?>owner_controller/myunitlist_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
                                <?php } ?>


 <?php if(isset($pay_booking_penalty)) { ?>
                                <form action="<?php echo base_url(); ?>owner_controller/paynow_cont?bookpenalty_id=<?php echo $book_id; ?>" method="post" enctype="multipart/form-data" id="f1">
                                    <input type="hidden" name="book_id" size="50" class="form-control" value="<?php if($book_id) { echo $book_id; }?>" hidden>
                                    <div class="form-group"><label>Facility_Name</label> 
                                    <input type="text" name="facility_name" size="50" class="form-control" value="<?php if($facility_name) { echo $facility_name; }?>" readonly></div>
                                    
                                    <div class="form-group"><label>Date</label> 
                                    <input type="date" name="book_date" size="50" class="form-control" value="<?php if($book_date) {  echo $book_date; }?>" readonly></div>
                                     <div class="form-group"><label>Time_Slot</label> 
                                    <input type="text" name="time_slot" size="50" class="form-control" value="<?php if($time_slot) { echo $time_slot; }?>" readonly></div>
                                    
                                        <div class="form-group"><label>Penalty</label> 
                                    <input type="number" name="total_charge" size="50" class="form-control" id="charge_perhour" value="<?php if($totalcharge) { echo $totalcharge;  }?>" readonly></div>

                                    
                                    <input type="hidden" name="firstname" size="50" class="form-control" value="<?php if($firstname) { echo $firstname; }?>" hidden>
                                    
                                    <input type="hidden" name="email" size="50" class="form-control" value="<?php if($email) { echo $email; }?>" hidden>

                                    <input type="hidden" name="mobile_no" size="50" class="form-control" value="<?php if($mobile_no) { echo $mobile_no; }?>" hidden>
                                    
                                    
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>PayNow</strong></button>
            </div><br><br><br>
                                    </form>
                                    <center><p> <a href="<?php echo base_url(); ?>owner_controller/myunitlist_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
                                <?php } ?>


        <?php if(isset($pay_maintenance)) { ?>
                                <form action="<?php echo base_url(); ?>owner_controller/paynow_cont?maintanance_id=<?php echo $maintanance_id; ?>" method="post" enctype="multipart/form-data" id="f1">
                                    <input type="hidden" name="maintanance_id" size="50" class="form-control" value="<?php if($maintanance_id) { echo $maintanance_id; }?>" hidden>
                                    <div class="form-group"><label>Maintenance_Date</label> 
                                    <input type="date" name="maintanance_date" size="50" class="form-control" value="<?php if($m_date) { echo $m_date; }?>" readonly></div>
                                    
                                    <div class="form-group"><label>Amount</label> 
                                    <input type="number" name="amount" size="50" class="form-control" value="<?php if($amount) {  echo $amount; }?>" readonly></div>
                                     
                                        <?php if($penalty > 0)
                                    { ?>
                                    <div class="form-group"><label>Penalty</label> 
                                    <input type="number" name="penalty" size="50" class="form-control" value="<?php if($penalty) { echo $penalty; }?>" readonly></div>
                               <?php } ?>
                                    
                                        <div class="form-group"><label>Total Charge</label> 
                                    <input type="number" name="total_charge" size="50" class="form-control" id="charge_perhour" value="<?php if($totalcharge) { echo $totalcharge;    }?>" readonly></div>

                                    
                                    <input type="hidden" name="firstname" size="50" class="form-control" value="<?php if($firstname) { echo $firstname; }?>" hidden>
                                    
                                    <input type="hidden" name="email" size="50" class="form-control" value="<?php if($email) { echo $email; }?>" hidden>

                                    <input type="hidden" name="mobile_no" size="50" class="form-control" value="<?php if($mobile_no) { echo $mobile_no; }?>" hidden>
                                    
                                    
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>PayNow</strong></button>
            </div><br><br><br>
                                    </form>
                                    <center><p> <a href="<?php echo base_url(); ?>owner_controller/myunitlist_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
                                <?php } ?>

 <?php if(isset($pay_revenue)) { ?>
                                <form action="<?php echo base_url(); ?>owner_controller/paynow_cont?expense_revenue_id=<?php echo $expense_revenue_id; ?>" method="post" enctype="multipart/form-data" id="f1">
                                    <input type="hidden" name="expense_revenue_id" size="50" class="form-control" value="<?php if($expense_revenue_id) { echo $expense_revenue_id; }?>" hidden>

                                    <div class="form-group"><label>Revenue_Name</label> 
                                    <input type="text" name="expense_revenue_name" size="50" class="form-control" value="<?php if($expense_revenue_name) { echo $expense_revenue_name; }?>" readonly></div>

                                    <div class="form-group"><label>Revenue_Date</label> 
                                    <input type="date" name="revenue_date" size="50" class="form-control" value="<?php if($added_on) { echo $added_on; }?>" readonly></div>
                                    
                                    <div class="form-group"><label>Amount</label> 
                                    <input type="number" name="amount" size="50" class="form-control" value="<?php if($totalcharge) {  echo $totalcharge; }?>" readonly></div>
                                   
                                    <input type="hidden" name="firstname" size="50" class="form-control" value="<?php if($firstname) { echo $firstname; }?>" hidden>
                                    
                                    <input type="hidden" name="email" size="50" class="form-control" value="<?php if($email) { echo $email; }?>" hidden>

                                    <input type="hidden" name="mobile_no" size="50" class="form-control" value="<?php if($mobile_no) { echo $mobile_no; }?>" hidden>
                                    
                                    
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit"><strong>PayNow</strong></button>
            </div><br><br><br>
                                    </form>
                                    <center><p> <a href="<?php echo base_url(); ?>owner_controller/myunitlist_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
                                <?php } ?>


					
                    </div>
                    </div>
                
            </div>
            </div>
			</div>
			 <!-- Custom and plugin javascript -->
    <script src="<?php echo base_url(); ?>js/inspinia.js"></script>
    <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js"></script>  
<?php include("footer.php");?>
</body>
</html>