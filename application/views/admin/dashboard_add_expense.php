
<!DOCTYPE html>
<html>
<head>
<title> EXPENSE |  PRATHA </title>
<style>
		form .error{
			font-weight: bold;
			color:#cc5965;
			border-color:blue;
		}
</style>
 
<script src="<?php echo base_url(); ?>js/lib/jquery.js"></script>
<script src="<?php echo base_url(); ?>js/dist/jquery.validate.js"></script>
<script>

$(document).ready(function(){
    $.validator.addMethod("n", function(value, element) {
    	
    	    return this.optional(element) || /^[a-zA-Z .-]+$/.test(value);
    	}, "Enter only character");
    $.validator.addMethod("nn", function(value, element) {
        
            return this.optional(element) || /^[0-9]+$/.test(value);
        }, "Enter only digits");
    $("#f1").validate({
        rules:{
            amount:{
                required:true,
                nn:true
            },
            expensename:{
                required:true,
                n:true
            },
            expdate:{
                required:true,
            },
           
        },
        messages:{
            amount:{
                required:"Please enter anount",
                nn:"Enter valid amount"
            },
            expensename:{
                required:"Please enter expensename",
                n:"Enter valid expensename"
            },
            expdate:{
                required:"plese select expense date",
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
                        <h3>Add Expense</h3>
                    </div>
			<div class="ibox-content">
				
                               <form action="<?php echo base_url(); ?>admin_controller/addexpense" method="post" enctype="multipart/form-data" id="f1">
                               		
                               	<div class="form-group"><label>Expense Name</label> 
									<input  type="text" name="expensename" size="50" placeholder="Enter Expense name" class="form-control" required=""></div>
                                    <div class="form-group"><label>Amount</label> 
                                    <input  type="number" name="amount" placeholder="Enter Expense Amount" class="form-control" required=""></div>
                                    <?php if($invalid = $this->session->flashdata('expdate_error')) { ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="alert alert-dismissable alert-danger">
                                                <strong>Sorry ! </strong> <?php echo $invalid; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                    <div class="form-group"><label>Expense Date</label> 
                                    <input  type="date" name="expdate" class="form-control" required=""></div>
                                    <div>
                                        <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="submit" id="wing_insert_btn"><strong>Insert Record</strong></button>
                                    </div><br><br><br>
                                    </form>

					<center><p> <a href="<?php echo base_url(); ?>admin_controller/dashboard_expense_cont"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;BACK</a> </p></center>
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