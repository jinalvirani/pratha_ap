<?php
class Front_controller extends CI_Controller
{
	public function __construct()
	{
			parent::__construct();
			$this->load->database();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->helper('file');
			$this->load->model("front_model");
	}
	public function index()
	{
		$facility = $this->front_model->get_facility_mdl();
		if($facility)
		{
			$data['facility'] = $this->front_model->get_facility_mdl();
		}
		
		
		$this->load->view("front/index",$data);
	}
	public function contact_us()
	{
		$this->load->view('front/contacts');
	}
	public function about_us()
	{
		$this->load->view('front/about');
	}
	public function vision()
	{
		$this->load->view('front/vision');
	}
	public function contactus()
	{
		$name = $this->input->post('name');
		$emailadd = $this->input->post('email');	
		$phone = $this->input->post('mobileno');
		$message = $this->input->post('msg');
		
		
								require 'PHPMailer/PHPMailerAutoload.php';
								$emailadd = $this->input->post('emailadd');
								$parts = explode("@", $emailadd);
								$username = $parts[0];
								$email='jinalvirani79@gmail.com';

								$mail = new PHPMailer;

								$mail->isSMTP();                                   // Set mailer to use SMTP
								$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
								$mail->SMTPAuth = true;                            // Enable SMTP authentication
								$mail->Username = 'rahuldholariya001@gmail.com';          // SMTP username
								$mail->Password = 'Rsquare@3032'; // SMTP password
								$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
								$mail->Port = 587;                                  // TCP port to connect to

								$mail->setFrom('rahuldholariya001@gmail.com', $emailadd);
								$mail->addReplyTo($email, $emailadd);
								$mail->addAddress($email);   // Add a recipient
								//$mail->addCC('cc@example.com');
								//$mail->addBCC('bcc@example.com');
								$mail->isHTML(true);  // Set email format to HTML
								
								//$mail->AddEmbeddedImage("img/logo.jpeg", "my-attach", "img/logo.jpeg");
								$mail->Body    = '<html><head></head><body><div style="background-color:#DBDBDB;padding:50px;margin-left:200px; margin-right:200px;"><p style="color:black">Pratha Apartment Management System<br><br>
									Name : '.$name.'<br>
									Mobile_no : '.$phone.'<br>
									Message : <br><br>'.$message.'</p></div></body></html>';


									if(!$mail->send()) {
									    $mess="data not submitted successfully";
									$m="<div class='alert alert-success alert-dismissible fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$mess."</div>";
									   echo json_encode($m);
									} 
									else
									{	
									   $mess="data submitted successfully";
									$m="<div class='alert alert-success alert-dismissible fade in'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>".$mess."</div>";
									   echo json_encode($m);
									}
									
	}		
}
?>