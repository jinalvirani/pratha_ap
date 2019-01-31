<?php 
class Guard_controller extends CI_controller
{

	public function __construct()
	{
			parent::__construct();
			$this->load->database();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->helper('file');
			$this->load->model("guard_model");
			 ini_set('upload_max_filesize', '5M');
	}
	public function index()
	{
		$this->load->view("guard/index");
	}

	/* login */
	public function guardlogin_cont()
	{
			$unm=$this->input->post("username");
			$pass=$this->input->post("password");
			$pass1=md5($pass);
			$loginid = $this->guard_model->loginguard_mdl($unm,$pass1);
			if($loginid)
			{
				$this->session->set_userdata('guard_id',$loginid);
				redirect(base_url().'guard_controller/showguard');
			}
			else
			{
				$this->session->set_flashdata('loginfailed','Username And Password Not Matched...'); 
				redirect(base_url().'guard_controller/index');
				
			}
		
	}

	public function showguard()
	{
		if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
		$id=$this->session->userdata('guard_id');
		if($this->guard_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->guard_model->getusertype_mdl($id);
		}
		$this->load->view('guard/guard',$data);
	}
	public function visiter_list()
	{
		if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
		$id=$this->session->userdata('guard_id');
		if($this->guard_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->guard_model->getusertype_mdl($id);
		}
		if($this->guard_model->display_visiter_mdl())
		{
			$data['visiter']=$this->guard_model->display_visiter_mdl();
		}
		if(isset($_GET['visiter_id']))
		{
			$visiter_id = $_GET['visiter_id'];
			date_default_timezone_set('Asia/Kolkata');
	     	$time=date('h:i A');
			$visiter = array(
			'out_time' =>$time,
			'out_date' => date('Y-m-d'),
			'in_out_status' => 0,
			);
			$out_visiter = $this->guard_model->out_visiter_mdl($visiter,$visiter_id);
			if($out_visiter)
			{
				$this->session->set_flashdata('out_visiter','Visiter Out Successfully...');
				redirect(base_url().'guard_controller/visiter_list');
			}
			else
			{
				$this->session->set_flashdata('out_visiter','Visiter Not Out Successfully...');
				redirect(base_url().'guard_controller/visiter_list');
			}
		}
		$this->load->view('guard/visiter_list',$data);
	}

	public function addvisiter_cont()
	{
		if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
		$id=$this->session->userdata('guard_id');
		if($this->guard_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->guard_model->getusertype_mdl($id);
		}
		if($this->guard_model->getwing_mdl())
		{
			$data['wing'] = $this->guard_model->getwing_mdl();
		}
		$this->load->view('guard/addvisiter',$data);
	}
public function addvisiter_nextpage_cont()
	{
		if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
		$id=$this->session->userdata('guard_id');
		if($this->guard_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->guard_model->getusertype_mdl($id);
		}
		if($this->guard_model->getwing_mdl())
		{
			$data['wing'] = $this->guard_model->getwing_mdl();
		}
		$this->load->view('guard/addvisiter_nextpage',$data);
	}

	public function fillhome_cont()
    {

    	if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
      	$wing_id=$this->input->post('wing_id');
      	if($this->guard_model->fillhome_mdl($wing_id))
      	{
      		$home=$this->guard_model->fillhome_mdl($wing_id);
      	}
      	if(count($home) > 0)
      	{
      		$home_select_box = '';
      		$home_select_box .= '<option value="">Select_Home_No</option>';

      		foreach ($home as $homeno) {
      			$home_select_box .= '<option value="'.$homeno->home_id.'">'.$homeno->home_no.'</option>';

      		}
      		echo json_encode($home_select_box);
      	}

    }

	public function staff_list()
	{
		if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
		$id=$this->session->userdata('guard_id');
		date_default_timezone_set('Asia/Kolkata');
	     	$time=date('h:i A');
		if($this->guard_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->guard_model->getusertype_mdl($id);
		}
		if($this->guard_model->display_staff_mdl())
		{
			$data['staff_info']=$this->guard_model->display_staff_mdl();
		}
		if(isset($_GET['staff_in_id']))
		{
			$staff_id = $_GET['staff_in_id'];
			$staff = array(
				'staff_id' => $staff_id,
				'in_time' => $time,
		    	'enter_by' => $id,
		    	'in_out_status' =>1,
		    	'added_on' =>date('Y-m-d'),
		    	'added_by' =>'guard',	
			);
			$staff_in = $this->guard_model->staff_in_mdl($staff);
			if($staff_in)
			{
				$this->session->set_flashdata('in_staff','Staff In Successfully...');
				redirect(base_url().'guard_controller/staff_list');
			}
			else
			{
				$this->session->set_flashdata('in_staff','Staff Not In Successfully...');
				redirect(base_url().'guard_controller/staff_list');
			}
		}
		if(isset($_GET['staff_out_id']))
		{
			$staff_id = $_GET['staff_out_id'];
			$staff = array(
				'out_time' =>$time,
				'out_date' => date('Y-m-d'),
				'in_out_status' => 0,
			);
			$staff_out = $this->guard_model->staff_out_mdl($staff,$staff_id);
			if($staff_out)
			{
				$this->session->set_flashdata('in_staff','Staff Out Successfully...');
				redirect(base_url().'guard_controller/staff_list');
			}
			else
			{
				$this->session->set_flashdata('in_staff','Staff Not Out Successfully...');
				redirect(base_url().'guard_controller/staff_list');
			}
		}

		$this->load->view('guard/staff_list',$data);
	}
	/* webcam */
	public function action_cont()
	{
			if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
			$id=$this->session->userdata('guard_id');
			date_default_timezone_set('Asia/Kolkata');
	     	$time=date('h:i A');
	        $name1 = date('YmdHis').".jpg";
	        $this->session->set_userdata('visiter_image',$name1);
	         $file = file_put_contents("img/guard/visiter/".$name1, file_get_contents('php://input') );
	        redirect(base_url().'guard_controller/addvisiter_nextpage_cont');
	}
	public function add_visiter_nextpage_cont()
	{
		if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
			$id=$this->session->userdata('guard_id');
			date_default_timezone_set('Asia/Kolkata');
	     	$time=date('h:i A');
	        $name1 = $this->session->userdata('visiter_image');
	        $visiter=array(
	        'firstname' => $this->input->post('firstname'),
	    	'lastname' => $this->input->post('lastname'),
	    	'address' => $this->input->post('address'),
	    	'wing_id' => $this->input->post('wingno'),
	    	'home_id' => $this->input->post('homeno'),
	    	'mobile_no' => $this->input->post('mobileno'),
	    	'vehicle_no' => $this->input->post('vehicleno'),
	    	'pic'=>$name1,
	    	'in_time' => $time,
	    	'enter_by' => $id,
	    	'in_out_status' =>1,
	    	'added_on' =>date('Y-m-d'),
	    	'added_by' =>'guard',
	        );
	        $cam=$this->guard_model->add_visiter_mdl($visiter);
	        if($cam)
	        {
	        	$this->session->set_flashdata('add_visiter','Visiter Entered Successfully...');
				redirect(base_url().'guard_controller/visiter_list');
	        }
	        else
	        { 
	        	$this->session->set_flashdata('add_visiter','Visiter Not Entered Successfully...');
				redirect(base_url().'guard_controller/visiter_list');
	        }	
	}
	/* change password */
    public function changepassword_cont()
    {
    	if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
    	$id=$this->session->userdata('guard_id');
		if($this->guard_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->guard_model->getusertype_mdl($id);
		}
    	$this->load->view('guard/change_password',$data);
    }


    public function guardprofile_cont()
    {
    	/*if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
    	$cur_pass=$this->input->post('curr_password');

    	$n_pass=$this->input->post('password');
    	$r_pass=$this->input->post('repassword');
    	if($n_pass != $r_pass)
    	{
    		$this->session->set_flashdata('repassword_error','retype password does not matched..');
            redirect(base_url().'guard_controller/changepassword_cont');
    	}
    	else
    	{
    		$n_pass1=md5($n_pass);
    		$profile = array(
    		'password' => $n_pass1,
    		);
    		$id=$this->session->userdata('guard_id');
    		$change_success=$this->guard_model->changeprofile_mdl($id,$profile,$cur_pass,$n_pass);
    		if($change_success)
    		{
    			$this->session->set_flashdata('changepass','Password Changed  Successfully...');
				redirect(base_url().'guard_controller/changepassword_cont');
    		}
    		else
    		{
    			$this->session->set_flashdata('changepass_error','Invalid Current Password...');
				redirect(base_url().'guard_controller/changepassword_cont');
    		}

    	}*/
    	if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
    	$cur_pass=$this->input->post('curr_password');

    	$n_pass=$this->input->post('password');
    	$r_pass=$this->input->post('repassword');
    	if($n_pass != $r_pass)
    	{
    		$this->session->set_flashdata('repassword_error','Retype Password Does Not Matched...');
            redirect(base_url().'guard_controller/changepassword_cont');
    	}
    	else
    	{
    		$n_pass1=md5($n_pass);
    		$profile = array(
    		'password' => $n_pass1,
    		);
    		$id=$this->session->userdata('guard_id');
    		$change_success=$this->guard_model->changeprofile_mdl($id,$profile,$cur_pass,$n_pass);
    		if($change_success)
    		{
    			$this->session->set_flashdata('changepass','Password Changed Successfully...');
				redirect(base_url().'guard_controller/changepassword_cont');
    		}
    		else
    		{
    			$new_pass_same=$this->guard_model->changeprofile_same_pass_mdl($id,$n_pass,$cur_pass);
    			if($new_pass_same)
    			{
    				$this->session->set_flashdata('changepass','Password Changed Successfully...');
					redirect(base_url().'guard_controller/changepassword_cont');
    			}
    			else
    			{
    				$this->session->set_flashdata('changepass_error','Invalid Current Password...');
					redirect(base_url().'guard_controller/changepassword_cont');
    			}

    		}

    	}
    }
/* change profile */
public function change_profile_cont()
{
	if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
	$id=$this->session->userdata('guard_id');
	if($this->guard_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->guard_model->getusertype_mdl($id);
	}
	$this->load->view('guard/change_profile',$data);	
}
public function guardedit_cont()
{
	if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');

		$id=$this->session->userdata('guard_id');
		$pic= $_FILES['file']['name'];
		if($pic == "")
		{
			
			$pic=$this->input->post("updatepic");
		}
		else
		{
			$pic=$_FILES['file']['name'];	
		}

    		$guard=array(
	    	'firstname' => $this->input->post('firstname'),
	    	'lastname' => $this->input->post('lastname'),
	    	'username' => $this->input->post('username'),
	    	'mobile_no' => $this->input->post('mobile_no'),
	    	'email' => $this->input->post('email'),
	    	'pic' => $pic,
	    	'modified_on' =>date('Y-m-d'),
	    	'modified_by' =>'guard',
	   		 );

     		$this->form_validation->set_rules('file', '', 'callback_file_check');

            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/guard/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);

                //upload file to directory
                if(file_exists('img/guard/'.$pic))
                {
                		$editguard_sql = $this->guard_model->editguard_mdl($guard,$id);
					    if($editguard_sql)
					    {
					    	$id=$this->session->userdata('guard_id');
							if($this->guard_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->guard_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editguard','Profile Changed Successfully...');
					    	redirect(base_url().'guard_controller/change_profile_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('guard_id');
							if($this->guard_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->guard_model->getusertype_mdl($id);
							}
					    	redirect(base_url().'guard_controller/change_profile_cont');
					    }
                }
                else
                {
	                if($this->upload->do_upload('file'))
	                {
		                    $uploadData = $this->upload->data();
		                    $uploadedFile = $uploadData['file_name'];

		                    $editguard_sql = $this->guard_model->editguard_mdl($guard,$id);
						    if($editguard_sql)
						    {
						    	$id=$this->session->userdata('guard_id');
								if($this->guard_model->getusertype_mdl($id))
								{
									$data['usertype']=$this->guard_model->getusertype_mdl($id);
								}
						    	$this->session->set_flashdata('editguard','Profile Changed Successfully...');
						    	redirect(base_url().'guard_controller/change_profile_cont');
						    }
						    else
						    {
						    	$id=$this->session->userdata('guard_id');
								if($this->guard_model->getusertype_mdl($id))
								{
									$data['usertype']=$this->guard_model->getusertype_mdl($id);
								}
						    	redirect(base_url().'guard_controller/change_profile_cont');
						    }
	                }
	            	 else
	             	{
	                	$data1 = $this->upload->display_errors();
	                	$this->session->set_flashdata('image_error',$data1);
	                	redirect(base_url().'guard_controller/change_profile_cont');
	             	 }
             	}

    		}	
    		else
    		{
    			$editguard_sql = $this->guard_model->editguard_mdl($guard,$id);
			    if($editguard_sql)
				{

			    	$id=$this->session->userdata('guard_id');
					if($this->guard_model->getusertype_mdl($id))
					{
						$data['usertype']=$this->guard_model->getusertype_mdl($id);
					}
			    	$this->session->set_flashdata('editguard','Profile Changed Successfully...');
					redirect(base_url().'guard_controller/change_profile_cont');
				}
			    else
			    {
					$id=$this->session->userdata('guard_id');
					if($this->guard_model->getusertype_mdl($id))
					{
						$data['usertype']=$this->guard_model->getusertype_mdl($id);
					}
			    	$this->session->set_flashdata('editguard','Profile Not Changed Successfully...');
					redirect(base_url().'guard_controller/change_profile_cont');
				}
    		}
}

public function file_check($str){
        $allowed_mime_type_arr = array('application/pdf','image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['file']['name']);
        if(isset($_FILES['file']['name']) && $_FILES['file']['name']!=""){
            if(in_array($mime, $allowed_mime_type_arr)){
                return true;
            }else{
                $this->form_validation->set_message('file_check', 'Please select only pdf/gif/jpg/png file.');
                return false;
            }
        }else{
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
/* panic alert */
public function sound_cont()
{
	if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
	$sel_q=$sound= $this->guard_model->sound_mdl();
	$output='';
	$count=count($sel_q);
	if($count > 0)
	{
	
		foreach($sel_q as $row)
		{
			$output.='
					<small>'.$row->wing_name."-".$row->home_no.'</small><br />
			';
		}
	}
	$data=array(
		'fnm' => $output,
		'c' =>$count
	);
	echo json_encode($data);
}

public function ok_cont()
{
	if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
	$ok= array(
		'emergency_notification' => 0,
	);
	$ok_sql=$this->guard_model->ok_mdl($ok);
	if($ok_sql)
	{
		redirect(base_url().'guard_controller/showguard');
	}
}

/* landline_no */
public function landline_no_list()
{
  if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
   if($this->session->userdata('guard_id'))
  {
    $id=$this->session->userdata('guard_id');
  }

    if($this->guard_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->guard_model->getusertype_mdl($id);
    } 
    if($this->guard_model->landline_no_mdl())
    {
    	$data['landlineno']=$this->guard_model->landline_no_mdl();
    }
     $this->load->view('guard/directory_list',$data);
}


/* forgot password */
public function forgotpassword_cont()
{
	if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
	$this->load->view('guard/forgot_password');
}
public function forgotpassword_index_cont()
{
	$this->load->view('guard/forgot_password');
}
public function reset_pass_link_cont()
{
	if(! $this->session->userdata('guard_id'))
			return redirect('guard_controller');
	require 'PHPMailer/PHPMailerAutoload.php';
$email = $this->input->post('email');
$parts = explode("@", $email);
$username = $parts[0];
//$email='jinalvirani79@gmail.com';

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'rahuldholariya001@gmail.com';          // SMTP username
$mail->Password = 'Rsquare@3032'; // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                  // TCP port to connect to

$mail->setFrom('rahuldholariya001@gmail.com', 'Pratha Apartment Management');
$mail->addReplyTo($email, 'Pratha Apartment Management');
$mail->addAddress($email);   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
$mail->isHTML(true);  // Set email format to HTML
$mail->Subject = 'Email from Pratha Apartment Management';
$mail->AddEmbeddedImage("img/logo.jpeg", "my-attach", "img/logo.jpeg");
$mail->Body    = '<html><head></head><body><div style="background-color:#DBDBDB;padding:50px;margin-left:200px; margin-right:200px;"><img src="cid:my-attach" height="150px" width="150px" /><hr><p style="color:black">Hello&nbsp;&nbsp;'.$username.',<br><br>We have received a request to reset password at pratha Apartment.<br><br>
In order to change your password, click the link below:<br><br>
<a href="'.base_url().'guard_controller/reset_password_page_cont">Reset My Password</a><br><br>If you have not made any password reset request, it is likely that another user entered your email address by mistake and you can simply disregard this email.<br><br><center><h2>Thank You</h2>Pratha Apartment Management Copyright © 2018<br>All Rights Reserved</p><center></div></body></html>';


	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} 
	else
	{	
	    $this->session->set_flashdata('resetmsg','Reset Password Link Sent Successfully...'); 
		redirect(base_url().'guard_controller/forgotpassword_cont');
	}
}

public function reset_pass_link_contt()
{
	
	require 'PHPMailer/PHPMailerAutoload.php';
$email = $this->input->post('email');
$parts = explode("@", $email);
$username = $parts[0];
//$email='jinalvirani79@gmail.com';

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'rahuldholariya001@gmail.com';          // SMTP username
$mail->Password = 'Rsquare@3032'; // SMTP password
$mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                  // TCP port to connect to

$mail->setFrom('rahuldholariya001@gmail.com', 'Pratha Apartment Management');
$mail->addReplyTo($email, 'Pratha Apartment Management');
$mail->addAddress($email);   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
$mail->isHTML(true);  // Set email format to HTML
$mail->Subject = 'Email from Pratha Apartment Management';
$mail->AddEmbeddedImage("img/logo.jpeg", "my-attach", "img/logo.jpeg");
$mail->Body    = '<html><head></head><body><div style="background-color:#DBDBDB;padding:50px;margin-left:200px; margin-right:200px;"><img src="cid:my-attach" height="150px" width="150px" /><hr><p style="color:black">Hello&nbsp;&nbsp;'.$username.',<br><br>We have received a request to reset password at pratha Apartment.<br><br>
In order to change your password, click the link below:<br><br>
<a href="'.base_url().'guard_controller/reset_password_page_cont">Reset My Password</a><br><br>If you have not made any password reset request, it is likely that another user entered your email address by mistake and you can simply disregard this email.<br><br><center><h2>Thank You</h2>Pratha Apartment Management Copyright © 2018<br>All Rights Reserved</p><center></div></body></html>';


	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} 
	else
	{	
	    $this->session->set_flashdata('resetmsg','Reset Password Link Sent Successfully...'); 
		redirect(base_url().'guard_controller/forgotpassword_cont');
	}
}

public function reset_password_page_cont()
{

	$this->load->view('guard/reset_password');
}

public function reset_password_cont()
{
	$username=$this->input->post('username');

    	$n_pass=$this->input->post('password');
    	$r_pass=$this->input->post('repassword');
    	if($n_pass != $r_pass)
    	{
    		$this->session->set_flashdata('repassword_error','Retype Password Does Not Matched...');
            redirect(base_url().'guard_controller/reset_password_page_cont');
    	}
    	else
    	{
    		$n_pass1=md5($n_pass);
    		$profile = array(
    		'password' => $n_pass1,
    		);
    		$id=$this->session->userdata('guard_id');
    		$reset_success=$this->guard_model->reset_password_mdl($profile,$username);
    		if($reset_success)
    		{
    			$this->session->set_flashdata('resetpass','Password Reseted Successfully...');
				redirect(base_url().'guard_controller/reset_password_page_cont');
    		}
    		else
    		{
    			$reset_samepass_success=$this->guard_model->reset_samepassword_mdl($n_pass,$username);
    			if($reset_samepass_success)
    			{
    				$this->session->set_flashdata('resetpass','Password Reseted Successfully...');
					redirect(base_url().'guard_controller/reset_password_page_cont');
    			}
    			else
    			{
	    			$this->session->set_flashdata('resetpass_error','Invalid Username...');
					redirect(base_url().'guard_controller/reset_password_page_cont');
				}
    		}

    	}
}
/* logout */
public function logout_cont()
{
	$this->session->unset_userdata('guard_id');
	$this->session->unset_userdata('visiter_image');
	//$this->session->sess_destroy();
	redirect(base_url().'guard_controller');
}

}

?>