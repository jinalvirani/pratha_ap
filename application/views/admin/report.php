<?php
        $totalreve1=0;
        $totalreve2=0;
        $totalreve3=0;
        if(isset($tolrevenuetbl))
        {
            foreach($tolrevenuetbl as $tol)
            {
             $totalreve1=$totalreve1+$tol->amt;
            } 
        }
        if(isset($tolrevenue))
        {
          
            foreach($tolrevenue as $tol)
            {

                $amount = $tol->amount;
                $penalty = $tol->penalty;

                @$tols = $tols + $amount + $penalty; 
            }
            $totalreve1=$totalreve1+$tols;
        }
        if(isset($bookingrevenue))
        {
          
            foreach($bookingrevenue as $tol)
            {
                $amount = $tol->total_charge;
                 //$penalty = $tol->penalty;

                @$book = $book + $amount; 
            } $totalreve1=$totalreve1+$book;

        }
         if(isset($bookingrevenue_penalty))
        {
          
            foreach($bookingrevenue_penalty as $tol)
            {
               // $amount = $tol->total_charge;
                 $penalty = $tol->penalty;

                @$bookp = $bookp + $penalty; 
            } $totalreve1=$totalreve1+$bookp;

        }
        $totalreve =$totalreve1+$totalreve2+$totalreve3;

        $totalexp =0;
        if(isset($tolexpense))
        {
           
            foreach($tolexpense as $tol)
            {
                $totalexp=$totalexp+$tol->amount; 
            } 
        }

        if($totalreve > $totalexp)
        {
            $profite_loss = $totalreve - $totalexp;
            $profite_msg=" TOTAL PROFITE : ";
        }
        else
        {
            $profite_loss = abs($totalreve - $totalexp);
            $profite_msg=" TOTAL LOSS : ";
        }
?>
<?php
	
	// Include autoloader
require_once 'dompdf/autoload.inc.php';

// Reference the Dompdf namespace
use Dompdf\Dompdf;

// Instantiate and use the dompdf class
$dompdf = new Dompdf();

// Load HTML content
$msg="";
$msg.='<html>';
$msg.='<head>
<title>ADMIN | PRATHA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
		$msg.='<body style="border:1px solid black">';
        $msg.='<br><br><center><img src="img/logo2.jpeg" height="200px"></center><br><center><h1><u>EXPENSE/REVENUE MONTHLY REPORT</u></h1></center><br><br><h3>DATE : ';
        $msg.=$date_disp;
        $msg.='</h3><br><br><center><div class="well well-sm"><h2>TOTAL REVENUE : ';
        $msg.=$totalreve;
        $msg.='<br> TOTAL EXPENSE : ';
        $msg.=$totalexp;
        $msg.='<br></h2><h2 style="color:red">';
        $msg.=$profite_msg;
        $msg.=$profite_loss;
        $msg.='</h2></div></center><br><br>';
		$msg.='<table id="example" class="table table-striped table-bordered table-hover ">';
        $msg.='<thead><tr><th>';
		$msg.='<h3>REVENUES</h3>';
		$msg.='</th>';
		$msg.='<th>';
		$msg.='<h3>AMOUNT</h3>';
		$msg.='</th></tr></thead><tbody>';
        $totalreve1=0;
         $totalreve2=0;
         $totalreve3=0;
         $tols=0;
         $book=0; 
         $bookp=0;
if(isset($tolrevenuetbl))
{
    
	foreach($tolrevenuetbl as $tol)
	{
		
        
		$msg.='<tr>';
		$msg.='<td>';
		$msg.='<h4>';
        $msg.=$tol->expense_revenue_name;
        $msg.='</h4>';
        $msg.='</td>';
        $msg.='<td>';
        $msg.='<h4>';
        $msg.=$tol->amt;
        $msg.='</h4>';
        $msg.='</td>';
        $msg.='</tr>';
        $totalreve1=$totalreve1+$tol->amt;
       
     } 
 }

  if(isset($tolrevenue))
        {
          
            foreach($tolrevenue as $tol)
            {

                $amount = $tol->amount;
                $penalty = $tol->penalty;

                @$tols = $tols + $amount + $penalty; 
            }
            $msg.='<tr>';
        $msg.='<td>';
        $msg.='<h4>';
        $msg.='Manintenance';
        $msg.='</h4>';
        $msg.='</td>';
        $msg.='<td>';
        $msg.='<h4>';
        $msg.=$tols;
        $msg.='</h4>';
        $msg.='</td>';
        $msg.='</tr>';
        $totalreve1=$totalreve1+$tols;

        }
         if(isset($bookingrevenue))
        {
          
            foreach($bookingrevenue as $tol)
            {
                $amount = $tol->total_charge;
                // $penalty = $tol->penalty;

                @$book = $book + $amount; 
            }
             $msg.='<tr>';
        $msg.='<td>';
        $msg.='<h4>';
        $msg.='Booking';
        $msg.='</h4>';
        $msg.='</td>';
        $msg.='<td>';
        $msg.='<h4>';
        $msg.=$book;
        $msg.='</h4>';
        $msg.='</td>';
        $msg.='</tr>';
        $totalreve1=$totalreve1+$book;

        }

         if(isset($bookingrevenue_penalty))
        {
          
            foreach($bookingrevenue_penalty as $toll)
            {
                //$amount = $tol->total_charge;
                 $penalty = $toll->penalty;

                @$bookp = $bookp + $penalty; 
            }
             $msg.='<tr>';
        $msg.='<td>';
        $msg.='<h4>';
        $msg.='Booking Penalty';
        $msg.='</h4>';
        $msg.='</td>';
        $msg.='<td>';
        $msg.='<h4>';
        $msg.=$bookp;
        $msg.='</h4>';
        $msg.='</td>';
        $msg.='</tr>';
        $totalreve1=$totalreve1+$bookp;

        }

        $totalreve =$totalreve1+$totalreve2+$totalreve3;
$msg.='<tr><td><h2>Total Revenue</h2>';
$msg.='</td>';
$msg.='<td><h2>';
$msg.=$totalreve;
$msg.='</h2></td></tr>';
$msg.='</tbody></table>';




$msg.='<table id="example" class="table table-striped table-bordered table-hover " id="example">';
        $msg.='<thead><tr><th>';
        $msg.='<h3>EXPENSES</h3>';
        $msg.='</th>';
        $msg.='<th>';
        $msg.='<h3>AMOUNT</h3>';
        $msg.='</th></tr></thead><tbody>';
        $totalexp =0;
         if(isset($tolexpense))
        {
           
            foreach($tolexpense as $tol)
            {
        $msg.='<tr>';
        $msg.='<td>';
        $msg.='<h4>';
        $msg.=$tol->expense_revenue_name;
        $msg.='</h4>';
        $msg.='</td>';
        $msg.='<td>';
        $msg.='<h4>';
        $msg.=$tol->amount;
        $msg.='</h4>';
        $msg.='</td>';
        $msg.='</tr>';
        $totalexp=$totalexp+$tol->amount;
       
     } 
 }
 $msg.='<tr><td><h2>Total Expense</h2>';
$msg.='</td>';
$msg.='<td><h2>';
$msg.=$totalexp;
$msg.='</h2></td></tr>';
$msg.='</tbody></table><br><br><br>';

$msg.="</body>";
$msg.='</html>';
$dompdf->loadHtml($msg);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$name = "Expense_revenue".$date_disp;
$dompdf->stream($name,array("Attachment"=>1));
?>