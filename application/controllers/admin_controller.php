<?php
class Admin_controller extends CI_Controller
{

	public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->helper('url');
			$this->load->library('form_validation');
			$this->load->helper('file');
			$this->load->helper('download');
			$this->load->helper('url');
			$this->load->helper('directory');
			$this->load->model("admin_model");
			 ini_set('upload_max_filesize', '5M');
		}
	public function index()
	{
		$this->load->view("admin/index");
	}

	/* login */
	public function adminlogin_cont()
	{
			$unm=$this->input->post("username");
			$pass=$this->input->post("password");
			$pass1=md5($pass);
			$loginid = $this->admin_model->loginadmin_mdl($unm,$pass1);
			if($loginid)
			{
				$this->session->set_userdata('admin_id',$loginid);
				redirect(base_url().'admin_controller/showadmin');
			}
			else
			{
				$this->session->set_flashdata('loginfailed','Username And Password Not Matched...'); 
				redirect(base_url().'admin_controller/index');
				
			}
		
	}

	/* set profile */
	public function showadmin()
	{
		if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if($this->admin_model->wings_mdl())
		{
			$data['wings']=$this->admin_model->wings_mdl();
		}
		if($this->admin_model->homes_mdl())
		{
			$data['homes']=$this->admin_model->homes_mdl();
		}
		if($this->admin_model->owners_mdl())
		{
			$data['owners']=$this->admin_model->owners_mdl();
		}
		if($this->admin_model->tenants_mdl())
		{
			$data['tenants']=$this->admin_model->tenants_mdl();
		}
		if($this->admin_model->dashboard_booking_count())
		{
			$data['bookings']=$this->admin_model->dashboard_booking_count();
		}
		if($this->admin_model->dashboard_directory_mdl())
   		{
    		$data['directorys']=$this->admin_model->dashboard_directory_mdl();
 		}
 		if($this->admin_model->dashboard_maintanance_mdl())
	    {
	    	$data['maintanances']=$this->admin_model->dashboard_maintanance_mdl();
	    }
	    $month = date('m');
	    $year = date('Y');
	    if($this->admin_model->dashboard_tol_expense_mdl($month,$year))
	    {
	    	$data['tolexpense']=$this->admin_model->dashboard_tol_expense_mdl($month,$year);	
	    }
	    if($this->admin_model->dashboard_tol_revenue_mdl($month,$year))
	    {
	    	$data['tolrevenue']=$this->admin_model->dashboard_tol_revenue_mdl($month,$year);	
	    }
	    if($this->admin_model->dashboard_tol_revenue_tbl_mdl($month,$year))
	    {
	    	$data['tolrevenuetbl']=$this->admin_model->dashboard_tol_revenue_tbl_mdl($month,$year);	
	    }
	    if($this->admin_model->dashboard_tol_revenue_booking_mdl($month,$year))
	    {
	    	$data['bookingrevenue']=$this->admin_model->dashboard_tol_revenue_booking_mdl($month,$year);	
	    }
	     if($this->admin_model->dashboard_tol_revenue_booking_penalty_mdl($month,$year))
	    {
	    	$data['bookingrevenue_penalty']=$this->admin_model->dashboard_tol_revenue_booking_penalty_mdl($month,$year);	
	    }
	    if($this->admin_model->issue_mdl())
		{
			$data['issues']=$this->admin_model->issue_mdl();
		}
		if($this->admin_model->dashboard_new_reques_mdl())
	    {
	    	$data['requests']=$this->admin_model->dashboard_new_reques_mdl();
	    }
		$this->load->view('admin/admin',$data);

	}

	
	/*  new admin display */
	public function newadmin_cont()
	{
		if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if($this->admin_model->showadmin_mdl($id))
		{
			$data['showadmin']=$this->admin_model->showadmin_mdl($id);
		}
		$this->load->view('admin/admin_show',$data);

	}

/* admin fill wing  */
	public function addnewadmin_cont()
	{
		if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getwing_mdl())
		{
			$data['wing'] = $this->admin_model->getwing_mdl();
		}
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		$this->load->view('admin/new_admin',$data);
	}

	/* admin  fill home */
	public function fillhome_cont()
    {

    	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
      	$wing_id=$this->input->post('wing_id');
      	if($this->admin_model->fillhome_mdl($wing_id))
      	{
      		$home=$this->admin_model->fillhome_mdl($wing_id);
      	}
      	if(count($home) > 0)
      	{
      		$home_select_box = '';
      		$home_select_box .= '<option value="" http_persistent_handles_ident()>Select_Home_No</option>';

      		foreach ($home as $homeno) {
      			$home_select_box .= '<option value="'.$homeno->home_id.'">'.$homeno->home_no.'</option>';

      		}
      		echo json_encode($home_select_box);
      	}

    }
 /* new admin */
    public function changeadmin_cont()
    {
    	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		$wingno=$this->input->post('wingno');
    	 $existwing= $this->admin_model->checkwingedit_mdl($wingno,$id);
     	$f=0;
    	if($existwing)
    	{
    		$this->session->set_flashdata('wing_error','Associative Is Alredy Assigned For This Wing...');
    		$f=1;
    	}
		$username=$this->input->post('username');
     	$existusername= $this->admin_model->checkusername_mdl($username);
    	if($existusername )
    	{
    		$this->session->set_flashdata('username_error','Username Is Alredy Exist...');
    		$f=1;

    	}
    	if($f==1)
    	{
    		redirect(base_url().'admin_controller/addnewadmin_cont');
    	}
    	else
    	{
    		$pass=$this->input->post('password');
    		$pass1=md5($pass);
    		$admin=array(
	    	'firstname' => $this->input->post('firstname'),
	    	'lastname' => $this->input->post('lastname'),
	    	'username' => $this->input->post('username'),
	    	'password' => $pass1,
	    	'email' => $this->input->post('email'),
	    	'wing_id' => $this->input->post('wingno'),
	    	'mobile_no' => $this->input->post('mobileno'),
	    	'pic' => $_FILES['file']['name'],
	    	'modified_on' =>date('Y-m-d'),
	    	'modified_by' =>'admin',
	    	'status' => 1,
	    	);

	     	 date_default_timezone_set('Asia/Kolkata');
	     	$time=date('h:i:s');
	    	$admin_type=array(
	    	'user_type' => 'admin',
	    	'modified_on' =>date('Y-m-d'),
	    	'modified_by' =>'admin',
	    );


   			$this->form_validation->set_rules('file', '', 'callback_file_check');
            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/admin/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);

                //upload file to directory
                if(file_exists('img/admin/'.$_FILES['file']['name']))
                {
                	 $changeadmin_sql = $this->admin_model->changeadmin_mdl($admin,$admin_type,$id);
					    if($changeadmin_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('changeadmin','Admin Changed Successfully...');
					    	redirect(base_url().'admin_controller/newadmin_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							$data['usertype']=$this->admin_model->getusertype_mdl($id);
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('changeadmin','Admin Not Changed Successfully...');
					    	redirect(base_url().'admin_controller/newadmin_cont');
					    }	
                }
                if($this->upload->do_upload('file'))
                {
	                    $uploadData = $this->upload->data();
	                    $uploadedFile = $uploadData['file_name'];

	                    $changeadmin_sql = $this->admin_model->changeadmin_mdl($admin,$admin_type,$id);
					    if($changeadmin_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('changeadmin','Admin Changed Successfully...');
					    	redirect(base_url().'admin_controller/newadmin_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('changeadmin','Admin Not Changed Successfully...');
					    	redirect(base_url().'admin_controller/newadmin_cont');
					    }
                }
            	 else
             	{
                	$data1 = $this->upload->display_errors();
                	$this->session->set_flashdata('image_error',$data1);
                	redirect(base_url().'admin_controller/addnewadmin_cont');
             	 }

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

/* admin edit fill */
public function admineditfill_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	$id=$this->session->userdata('admin_id');
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->admin_model->getusertype_mdl($id);
	}
	$this->load->view('admin/change_profile',$data);	
}

/* admin edit */
public function adminedit_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');

		$id=$this->session->userdata('admin_id');
		$pic= $_FILES['file']['name'];
		if($pic == "")
		{
			
			$pic=$this->input->post("updatepic");
		}
		else
		{
			$pic=$_FILES['file']['name'];	
		}

    		$admin=array(
	    	'firstname' => $this->input->post('firstname'),
	    	'lastname' => $this->input->post('lastname'),
	    	'username' => $this->input->post('username'),
	    	'mobile_no' => $this->input->post('mobile_no'),
	    	'email' => $this->input->post('email'),
	    	'pic' => $pic,
	    	'modified_on' =>date('Y-m-d'),
	    	'modified_by' =>'admin',
	   		 );

     		$this->form_validation->set_rules('file', '', 'callback_file_check');

            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/admin/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);

                //upload file to directory
                if(file_exists('img/admin/'.$_FILES['file']['name']))
                {
                		$editadmin_sql = $this->admin_model->editadmin_mdl($admin,$id);
					    if($editadmin_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editadmin','Profile Changed Successfully...');
					    	redirect(base_url().'admin_controller/admineditfill_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	redirect(base_url().'admin_controller/admineditfill_cont');
					    }
                }
                else
                {
	                if($this->upload->do_upload('file'))
	                {
		                    $uploadData = $this->upload->data();
		                    $uploadedFile = $uploadData['file_name'];

		                    $editadmin_sql = $this->admin_model->editadmin_mdl($admin,$id);
						    if($editadmin_sql)
						    {
						    	$id=$this->session->userdata('admin_id');
								if($this->admin_model->getusertype_mdl($id))
								{
									$data['usertype']=$this->admin_model->getusertype_mdl($id);
								}
						    	$this->session->set_flashdata('editadmin','Profile Changed Successfully...');
						    	redirect(base_url().'admin_controller/admineditfill_cont');
						    }
						    else
						    {
						    	$id=$this->session->userdata('admin_id');
								if($this->admin_model->getusertype_mdl($id))
								{
									$data['usertype']=$this->admin_model->getusertype_mdl($id);
								}
						    	redirect(base_url().'admin_controller/admineditfill_cont');
						    }
	                }
	            	 else
	             	{
	                	$data1 = $this->upload->display_errors();
	                	$this->session->set_flashdata('image_error',$data1);
	                	redirect(base_url().'admin_controller/admineditfill_cont');
	             	 }
             	}

    		}	
    		else
    		{
    			$editadmin_sql = $this->admin_model->editadmin_mdl($admin,$id);
			    if($editadmin_sql)
				{
			    	$id=$this->session->userdata('admin_id');
					if($this->admin_model->getusertype_mdl($id))
					{
						$data['usertype']=$this->admin_model->getusertype_mdl($id);
					}
			    	$this->session->set_flashdata('editadmin','Profile Changed Successfully...');
					redirect(base_url().'admin_controller/admineditfill_cont');
				}
			    else
			    {
					$id=$this->session->userdata('admin_id');
					if($this->admin_model->getusertype_mdl($id))
					{
						$data['usertype']=$this->admin_model->getusertype_mdl($id);
					}
			    	$this->session->set_flashdata('editadmin','Profile Not Changed Successfully...');
					redirect(base_url().'admin_controller/admineditfill_cont');
				}
    		}
}



/* change password */
    public function changepassword_cont()
    {
    	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
    	$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
    	$this->load->view('admin/change_password',$data);
    }


    public function adminprofile_cont()
    {
    	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
    	$cur_pass=$this->input->post('curr_password');

    	$n_pass=$this->input->post('password');
    	$r_pass=$this->input->post('repassword');
    	if($n_pass != $r_pass)
    	{
    		$this->session->set_flashdata('repassword_error','Retype Password Does Not Matched...');
            redirect(base_url().'admin_controller/changepassword_cont');
    	}
    	else
    	{
    		$n_pass1=md5($n_pass);
    		$profile = array(
    		'password' => $n_pass1,
    		);
    		$id=$this->session->userdata('admin_id');
    		$change_success=$this->admin_model->changeprofile_mdl($id,$profile,$cur_pass,$n_pass);
    		if($change_success)
    		{
    			$this->session->set_flashdata('changepass','Password Changed Successfully...');
				redirect(base_url().'admin_controller/changepassword_cont');
    		}
    		else
    		{
    			$new_pass_same=$this->admin_model->changeprofile_same_pass_mdl($id,$n_pass,$cur_pass);
    			if($new_pass_same)
    			{
    				$this->session->set_flashdata('changepass','Password Changed Successfully...');
					redirect(base_url().'admin_controller/changepassword_cont');
    			}
    			else
    			{
    				$this->session->set_flashdata('changepass_error','Invalid Current Password...');
					redirect(base_url().'admin_controller/changepassword_cont');
    			}

    		}

    	}
    }

    /*  associative  */

    public function associative_cont()
    {
    	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if(isset($_GET['id']))
		{
			$asso_delete_id = $_GET['id'];
			$asso = array(
			'status' => 0,
			);
			 $deleteassociative_sql = $this->admin_model->deleteassociative_mdl($asso,$asso_delete_id);
			if($deleteassociative_sql)
			{
				$this->session->set_flashdata('deleteassociative','Associative Deleteted Successfully...');
				redirect(base_url().'admin_controller/associative_cont');
			}
			else
			{
				$this->session->set_flashdata('deleteassociative','Associative Not Deleteted Successfully...');
				redirect(base_url().'admin_controller/associative_cont');
			}

		}
		if($this->admin_model->showassociative_mdl())
		{
			$data['showassociative']=$this->admin_model->showassociative_mdl();
		}
		$this->load->view('admin/associative_list',$data);
    }

    public function addassociativefill_cont()
    {
    	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getwing_mdl())
		{
			$data['wing'] = $this->admin_model->getwing_mdl();
		}
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		$this->load->view('admin/add_associative',$data);
    }

    public function addassociative_cont()
    {
    	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');

		$wingno=$this->input->post('wingno');
        $existwing= $this->admin_model->checkwing_mdl($wingno);
        $f=0;
    	if($existwing)
    	{
    		$this->session->set_flashdata('wing_error','Associative Is Alredy Assigned For This Wing...');
    		$f=1;
    		//redirect(base_url().'admin_controller/addassociativefill_cont');
    	}
    	else
    	{
    		$associative=array(
	    	'firstname' => $this->input->post('firstname'),
	    	'lastname' => $this->input->post('lastname'),
	    	'wing_id' => $this->input->post('wingno'),
	    	'mobile_no' => $this->input->post('mobileno'),
	    	'pic' => $_FILES['file']['name'],
	    	'added_on' =>date('Y-m-d'),
	    	'added_by' =>'admin',
	    	'status' => 1,
		    );
		    date_default_timezone_set('Asia/Kolkata');
		    $time=date('h:i:s');
		    $associative_type=array(
		    'user_type' => 'associative',
		   	'added_on' =>date('Y-m-d'),
		   	'added_by' =>'admin',
	    	);


   			$this->form_validation->set_rules('file', '', 'callback_file_check');
   			if(file_exists('img/admin/'.$_FILES['file']['name']))
            {
                	 $changeadmin_sql = $this->admin_model->addassociative_mdl($associative,$associative_type);
					    if($changeadmin_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addassociative','Associative Added Successfully...');
					    	redirect(base_url().'admin_controller/associative_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addassociative','Associative Not Added Successfully...');
					    	redirect(base_url().'admin_controller/associative_cont');
					    }
            }
            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/admin/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);

                //upload file to directory
               
                if($this->upload->do_upload('file'))
                {
	                    $uploadData = $this->upload->data();
	                    $uploadedFile = $uploadData['file_name'];

	                    $changeadmin_sql = $this->admin_model->addassociative_mdl($associative,$associative_type);
					    if($changeadmin_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addassociative','Associative Added Successfully...');
					    	redirect(base_url().'admin_controller/associative_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addassociative','Associative Not Added Successfully...');
					    	redirect(base_url().'admin_controller/associative_cont');
					    }
                }
            	 else
             	{
                	$data1 = $this->upload->display_errors();
                	$this->session->set_flashdata('image_error',$data1);
                	//redirect(base_url().'admin_controller/addassociativefill_cont');
                	$f=1;
             	 }
             	
    		}
    	}
    		if($f==1)
    		{
    			redirect(base_url().'admin_controller/addassociativefill_cont');
    		}

}


/* edit associative */
public function editassociativefill_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	if($_GET['id'])
	{
		$asso_id=$_GET['id'];
	}
	$id=$this->session->userdata('admin_id');
	/*if($this->admin_model->getwing_mdl())
	{
		$data['wing'] = $this->admin_model->getwing_mdl();
	}*/
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->admin_model->getusertype_mdl($id);
	}
	if($this->admin_model->getassociativeinfo_mdl($asso_id))
	{
		$data['associative_info']=$this->admin_model->getassociativeinfo_mdl($asso_id);
	}
	$this->load->view('admin/associative_edit',$data);
}   


public function editassociative_cont()
{

	if(! $this->session->userdata('admin_id'))
		return redirect('admin_controller');

		$asso_id=$this->input->post('updateid');
		$id=$this->session->userdata('admin_id');
		$pic= $_FILES['file']['name'];
		if($pic == "")
		{
			
			$pic=$this->input->post("updatepic");
		}
		else
		{
			$pic=$_FILES['file']['name'];
			$unlink_pic = $this->input->post("updatepic");
		}

        $this->form_validation->set_rules('file', '', 'callback_file_check');
     	$wingno=$this->input->post('wingno');
     	$existwing= $this->admin_model->checkwingedit_mdl($wingno,$asso_id);

     	$f=0;

   	 	if($existwing)
    	{
    		$this->session->set_flashdata('wing_error','Associative Is Alredy Assigned For This Wing...');
    		$f=1;
    	}

    	if($f==1)
    	{
    		redirect(base_url().'admin_controller/editassociativefill_cont?id='.$asso_id);
    			
    	}
    	else
    	{

    		$associative=array(
	    	'firstname' => $this->input->post('firstname'),
	    	'lastname' => $this->input->post('lastname'),
	    	'mobile_no' => $this->input->post('mobileno'),
	    	'pic' => $pic,
	    	'modified_on' =>date('Y-m-d'),
	    	'modified_by' =>'admin',
	    	);

	    	 date_default_timezone_set('Asia/Kolkata');
		     $time=date('h:i:s');
		     $associative_type=array(
		    	'user_type' => 'associative',
		    	'modified_on' =>date('Y-m-d'),
		    	'modified_by' =>'admin',
		    );

	    	 if(file_exists('img/admin/'.$pic))
                {
                	$editassociative_sql = $this->admin_model->editassociative_mdl($associative,$asso_id,$associative_type);
					    if($editassociative_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editassociative',' Associative Updated Successfully...');
					    	redirect(base_url().'admin_controller/associative_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editassociative',' Associative Not Updated Successfully...');
					    	redirect(base_url().'admin_controller/associative_cont');
					    }
                }
                else
                {
                	 if($this->form_validation->run() == true)
           			 {
		                //upload configuration
		                $config['upload_path']   = 'img/admin/';
		                $config['allowed_types'] = 'png|jpg|jpeg';
		                $config['max_size']      = 1024;
		                $this->load->library('upload', $config);

                //upload file to directory
	                if($this->upload->do_upload('file'))

	                {
		                    $uploadData = $this->upload->data();
		                    $uploadedFile = $uploadData['file_name'];

		                    $editassociative_sql = $this->admin_model->editassociative_mdl($associative,$asso_id,$associative_type);
						    if($editassociative_sql)
						    {
						    	$id=$this->session->userdata('admin_id');
								if($this->admin_model->getusertype_mdl($id))
								{
									$data['usertype']=$this->admin_model->getusertype_mdl($id);
								}
						    	$this->session->set_flashdata('editassociative',' Associative Updated Successfully...');
						    	redirect(base_url().'admin_controller/associative_cont');
						    }
						    else
						    {
						    	$id=$this->session->userdata('admin_id');
								if($this->admin_model->getusertype_mdl($id))
								{
									$data['usertype']=$this->admin_model->getusertype_mdl($id);
								}
						    	$this->session->set_flashdata('editassociative',' Associative Not Updated Successfully...');
						    	redirect(base_url().'admin_controller/associative_cont');
						    }
	                }
	            	 else
	             	{
	                	$data1 = $this->upload->display_errors();
	                	$this->session->set_flashdata('image_error',$data1);
	                	redirect(base_url().'admin_controller/editassociativefill_cont?id='.$asso_id);
	             	 }
             	}
             	else
             	{
             		$editassociative_sql = $this->admin_model->editassociative_mdl($associative,$asso_id,$associative_type);
					    if($editassociative_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editassociative',' Associative Updated Successfully...');
					    	redirect(base_url().'admin_controller/associative_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editassociative',' Associative Not Updated Successfully...');
					    	redirect(base_url().'admin_controller/associative_cont');
					    }
             	}

    		}	
    	}
    		
}


/* security guard */
public function guard_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	$id=$this->session->userdata('admin_id');
	$data['usertype']=$this->admin_model->getusertype_mdl($id);
	if(isset($_GET['id']))
		{
			$guard_delete_id = $_GET['id'];
			$guard =array(
			'status' =>0,
			);
			 $deleteguard_sql = $this->admin_model->deleteguard_mdl($guard,$guard_delete_id);
			if($deleteguard_sql)
			{
				$this->session->set_flashdata('deleteguard','Security Guard Deleteted Successfully...');
				redirect(base_url().'admin_controller/guard_cont');
			}
			else
			{
				$this->session->set_flashdata('deleteguard','Security Guard Not Deleteted Successfully...');
				redirect(base_url().'admin_controller/guard_cont');
			}

		}
	if($this->admin_model->showguard_mdl())
	{
		$data['showguard']=$this->admin_model->showguard_mdl();
	}
	$this->load->view('admin/securityguard_list',$data);
}

/* guard fill */
public function guardfill_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	$id=$this->session->userdata('admin_id');
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->admin_model->getusertype_mdl($id);
	}
	$this->load->view('admin/add_securityguard',$data);
}

/* guard insert */
public function guardinsert_cont()
{

	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	$pass=$this->input->post('password');
	$pass1=md5($pass);
	$username=$this->input->post('username');
    $existusername= $this->admin_model->checkusername_mdl($username);
	if($existusername )
    	{
    		
    		$this->session->set_flashdata('username_error','Username Is Alredy Exist...');
    		redirect(base_url().'admin_controller/guardfill_cont');

    	}
    	else
    	{
    		$username_guard = $this->input->post('username');
    		$password = $this->input->post('password');
    		$guard=array(
	    	'firstname' => $this->input->post('firstname'),
	    	'lastname' => $this->input->post('lastname'),
	    	'username' => $this->input->post('username'),
	    	'password' => $pass1,
	    	'email' => $this->input->post('email'),
	    	'gender' => $this->input->post('gender'),
	    	'qualification' => $this->input->post('qualification'),
	    	'address' => $this->input->post('address'),
	    	'mobile_no' => $this->input->post('mobileno'),
	    	'shift' => $this->input->post('shift'),
	    	'pic' => $_FILES['file']['name'],
	    	'added_on' =>date('Y-m-d'),
	    	'added_by' =>'admin',
	    	'status' =>1,
	    	);
		    $guard_type=array(
		    	'user_type' => 'securityguard',
		    	'added_on' =>date('Y-m-d'),
		    	'added_by' =>'admin',
		    );
     		$this->form_validation->set_rules('file', '', 'callback_file_check');
            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/admin/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);

                //upload file to directory
                if(file_exists('img/admin/'.$_FILES['file']['name']))
                {
                	copy('img/admin/'.$_FILES['file']['name'],'img/guard/'.$_FILES['file']['name']);
                	 $addguard_sql = $this->admin_model->addguard_mdl($guard,$guard_type);
					    if($addguard_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
							//mail
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
								$mail->Body    = '<html><head></head><body><div style="background-color:#DBDBDB;padding:50px;margin-left:200px; margin-right:200px;"><img src="cid:my-attach" height="150px" width="150px" /><hr><p style="color:black">Dear&nbsp;&nbsp;'.$username.',<br><br>Welcome to Pratha Apartment Management System.<br><br>Your Username and Password is below!<br><br>
									Username : '.$username_guard.'<br>
									Password : '.$password.'<br><br>Login with this username and password and change it.<br><br><a href="'.base_url().'guard_controller/index">Pratha Apartment</a><br><br>
									<br><center><h2>Thank You</h2>Pratha Apartment Management Copyright © 2018<br>All Rights Reserved</center></p></div></body></html>';


									if(!$mail->send()) {
									    echo 'Message could not be sent.';
									    echo 'Mailer Error: ' . $mail->ErrorInfo;
									} 
									else
									{	
									    $this->session->set_flashdata('addguard','Security Guard Added Successfully...');
					    				redirect(base_url().'admin_controller/guard_cont');
									}
							//end mail
					    	
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addguard','Security Guard Not Added Successfully...');
					    	redirect(base_url().'admin_controller/guard_cont');
					    }
                }
            	else
            	{
	                if($this->upload->do_upload('file'))
	                {
		                    $uploadData = $this->upload->data();
		                    $uploadedFile = $uploadData['file_name'];
		                    copy('img/admin/'.$_FILES['file']['name'],'img/guard/'.$_FILES['file']['name']);
		                     $addguard_sql = $this->admin_model->addguard_mdl($guard,$guard_type);
						    if($addguard_sql)
						    {
						    	$id=$this->session->userdata('admin_id');
								if($this->admin_model->getusertype_mdl($id))
								{
									$data['usertype']=$this->admin_model->getusertype_mdl($id);
								}
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
								$mail->Body    = '<html><head></head><body><div style="background-color:#DBDBDB;padding:50px;margin-left:200px; margin-right:200px;"><img src="cid:my-attach" height="150px" width="150px" /><hr><p style="color:black">Dear&nbsp;&nbsp;'.$username.',<br><br>Welcome to Pratha Apartment Management System.<br><br>Your Username and Password is below!<br><br>
									Username : '.$username_guard.'<br>
									Password : '.$password.'<br><br>Login with this username and password and change it.<br><br><a href="'.base_url().'guard_controller/index">Pratha Apartment</a><br><br>
									<br><center><h2>Thank You</h2>Pratha Apartment Management Copyright © 2018<br>All Rights Reserved</center></p></div></body></html>';


									if(!$mail->send()) {
									    echo 'Message could not be sent.';
									    echo 'Mailer Error: ' . $mail->ErrorInfo;
									} 
									else
									{	
									    $this->session->set_flashdata('addguard','Security Guard Added Successfully...');
					    				redirect(base_url().'admin_controller/guard_cont');
									}
						    }
						    else
						    {
						    	$id=$this->session->userdata('admin_id');
								if($this->admin_model->getusertype_mdl($id))
								{
									$data['usertype']=$this->admin_model->getusertype_mdl($id);
								}
						    	$this->session->set_flashdata('addguard','Security Guard Not Added Successfully...');
						    	redirect(base_url().'admin_controller/guard_cont');
						    }
	                }
	            	 else
	             	{
	                	$data1 = $this->upload->display_errors();
	                	$this->session->set_flashdata('image_error',$data1);
	                	redirect(base_url().'admin_controller/guardfill_cont');
	             	 }
             	}
    		}
    	}
    	  
}


/* guard edit fill */
public function editguardfill_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	$guard_id=$_GET['id'];
	$id=$this->session->userdata('admin_id');
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->admin_model->getusertype_mdl($id);
	}
	if($this->admin_model->getguardinfo_mdl($guard_id))
	{
		$data['guard_info']=$this->admin_model->getguardinfo_mdl($guard_id);
	}
	$this->load->view('admin/guard_edit',$data);
}   

/* edit guard */
public function editguard_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	$guard_id=$this->input->post('updateid');
	$guard=array(
	'shift' =>$this->input->post('shift'),
	'modified_on' =>date('Y-m-d'),
	'modified_by' =>'admin',
	);
	date_default_timezone_set('Asia/Kolkata');
	$time=date('h:i:s');
	$guard_type=array(
	'user_type' => 'securityguard',
	'modified_on' =>date('Y-m-d'),
	'modified_by' =>'admin',
	);	
	$editguard_sql = $this->admin_model->editguard_mdl($guard,$guard_id,$guard_type);
	if($editguard_sql)
	{
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		$this->session->set_flashdata('editguard','Securityguard Updated Successfully...');
		redirect(base_url().'admin_controller/guard_cont');
	}
	else
    {
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		$this->session->set_flashdata('editguard','Securityguard Not Updated Successfully...');
		redirect(base_url().'admin_controller/guard_cont');
	}

}

/* vender load and delete display*/
public function vender_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		$data['usertype']=$this->admin_model->getusertype_mdl($id);
		if(isset($_GET['id']))
		{
			$vender_delete_id = $_GET['id'];
			echo $vender_delete_id;
			$vender = array(
				'status' => 0,
			);
			$deletevender_sql = $this->admin_model->deletevender_mdl($vender,$vender_delete_id);
			if($deletevender_sql)
			{
				$this->session->set_flashdata('deletevender','Vender Deleteted Successfully...');
				redirect(base_url().'admin_controller/vender_cont');
			}
			else
			{
				$this->session->set_flashdata('deletevender','Vender Not Deleteted Successfully...');
				redirect(base_url().'admin_controller/vender_cont');	
			}

		}
		if($this->admin_model->showvender_mdl())
		{
			$data['showvender']=$this->admin_model->showvender_mdl();
		}
	$this->load->view('admin/vender_list',$data);
}

/* add vender form */
public function addvender_cont()
{
	if(! $this->session->userdata('admin_id'))
	return redirect('admin_controller');
	$id=$this->session->userdata('admin_id');
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->admin_model->getusertype_mdl($id);
	}
	$this->load->view('admin/add_vender',$data);

}
 
/* insert vender */

public function venderinsert_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
    		$vender=array(
	    	'service_name' => $this->input->post('servicename'),
	    	'vender_name' => $this->input->post('vendername'),
	    	'mobile_no' => $this->input->post('mobileno'),
	    	'address' => $this->input->post('address'),
	    	'pic' => $_FILES['file']['name'],
	    	'added_on' =>date('Y-m-d'),
	    	'added_by' =>'admin',
	    	'status' =>1,
	    );

     $this->form_validation->set_rules('file', '', 'callback_file_check');

            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/vender_services/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);

                //upload file to directory
                if(file_exists('img/vender_services/'.$_FILES['file']['name']))
                {
                	 $addvender_sql = $this->admin_model->addvender_mdl($vender);
					    if($addvender_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addvender','Vender Added Successfully...');
					    	redirect(base_url().'admin_controller/vender_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addvender','vender Not Added Successfully...');
					    	redirect(base_url().'admin_controller/vender_cont');
					    }
                }
            	else
            	{
	                if($this->upload->do_upload('file'))
	                {
		                    $uploadData = $this->upload->data();
		                    $uploadedFile = $uploadData['file_name'];
		                     $addvender_sql = $this->admin_model->addvender_mdl($vender);
					    if($addvender_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addvender','Vender Added Successfully...');
					    	redirect(base_url().'admin_controller/vender_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addvender','Vender Not Added Successfully...');
					    	redirect(base_url().'admin_controller/vender_cont');
					    }
	                }
	            	 else
	             	{
	                	$data1 = $this->upload->display_errors();
	                	$this->session->set_flashdata('image_error',$data1);
	                	redirect(base_url().'admin_controller/addvender_cont');
	             	 }
             	}
    		}
    	
}


/* vender edit fill feilds */

public function vendereditfill_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	if(isset($_GET['id']))
	{
		$vender_id=$_GET['id'];
	}
	$id=$this->session->userdata('admin_id');
	$data['usertype']=$this->admin_model->getusertype_mdl($id);
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['vender_info']=$this->admin_model->getvenderinfo_mdl($vender_id);
	}
	$this->load->view('admin/edit_vender',$data);

}

/* vender update */
public function venderedit_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');

		$vender_id=$this->input->post('updateid');
		$id=$this->session->userdata('admin_id');
		$pic= $_FILES['file']['name'];
		if($pic == "")
		{
			
			$pic=$this->input->post("updatepic");
		}
		else
		{
			$pic=$_FILES['file']['name'];
		}

    	 $this->form_validation->set_rules('file', '', 'callback_file_check');
     	
    		$vender=array(
	    	'service_name' => $this->input->post('servicename'),
	    	'vender_name' => $this->input->post('vendername'),
	    	'mobile_no' => $this->input->post('mobileno'),
	    	'address' => $this->input->post('address'),
	    	'pic' => $pic,
	    	'added_on' =>date('Y-m-d'),
	    	'added_by' =>'admin',
	    	'status' =>1,
	    	'modified_on' =>date('Y-m-d'),
	    	'modified_by' => 'admin',
	    	);

	    	 if(file_exists('img/vender_services/'.$pic))
                {
                	$editvender_sql = $this->admin_model->editvender_mdl($vender,$vender_id);
					    if($editvender_sql)
					    {
					    	$id=$this->session->userdata('smin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editvender','Vender Updated Successfully...');
					    	redirect(base_url().'admin_controller/vender_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editvender','Vender Not Updated Successfully...');
					    	redirect(base_url().'admin_controller/vender_cont');
					    }
                }
                else
                {
                	 if($this->form_validation->run() == true)
           			 {
		                //upload configuration
		                $config['upload_path']   = 'img/vender_services/';
		                $config['allowed_types'] = 'png|jpg|jpeg';
		                $config['max_size']      = 1024;
		                $this->load->library('upload', $config);

                //upload file to directory
	                if($this->upload->do_upload('file'))
	                {
		                    $uploadData = $this->upload->data();
		                    $uploadedFile = $uploadData['file_name'];

		                   $editvender_sql = $this->admin_model->editvender_mdl($vender,$vender_id);
					    if($editvender_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editvender','Vender Updated Successfully...');
					    	redirect(base_url().'admin_controller/vender_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editvender','Vender Not Updated Successfully...');
					    	redirect(base_url().'admin_controller/vender_cont');
					    }
	                }
	            	 else
	             	{
	                	$data1 = $this->upload->display_errors();
	                	$this->session->set_flashdata('image_error',$data1);
	                	redirect(base_url().'admin_controller/vendereditfill_cont?id='.$vender_id);
	             	 }
             	}

    		}	
}

/* facility display delete */
public function facility_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	$id=$this->session->userdata('admin_id');
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->admin_model->getusertype_mdl($id);

	}
	if(isset($_GET['id']))
		{
			$facility_delete_id = $_GET['id'];
			echo $facility_delete_id;
			$facility = array(
				'status' => 0,
			);
			$deletefacility_sql = $this->admin_model->deletefacility_mdl($facility,$facility_delete_id);
			if($deletefacility_sql)
			{
				$this->session->set_flashdata('deletefacility','Facility Deleteted Successfully...');
				redirect(base_url().'admin_controller/facility_cont');
			}
			else
			{
				$this->session->set_flashdata('deletefacility','Facility Not Deleteted Successfully...');
				redirect(base_url().'admin_controller/facility_cont');	
			}

		}
	if($this->admin_model->showfacility_mdl())
	{
		$data['showfacility']=$this->admin_model->showfacility_mdl();
	}
	$this->load->view('admin/facility_list',$data);
}

/* add facility page */
public function addfacility_cont()
{
	if(! $this->session->userdata('admin_id'))
	return redirect('admin_controller');
	$id=$this->session->userdata('admin_id');
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->admin_model->getusertype_mdl($id);
	}
	$this->load->view('admin/add_facility',$data);
}

/* insert facility */
public function facilityinsert_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
    		$facility=array(
	    	'facility_name' => $this->input->post('facilityname'),
	    	'charge_per_hour' => $this->input->post('charge'),
	    	'pic' => $_FILES['file']['name'],
	    	'status' =>1,
	    	'added_on' =>date('Y-m-d'),
	    	'added_by' =>'admin',
	    );

     $this->form_validation->set_rules('file', '', 'callback_file_check');

            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/facility/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);

                //upload file to directory
                if(file_exists('img/facility/'.$_FILES['file']['name']))
                {
                	 $addfacility_sql = $this->admin_model->addfacility_mdl($facility);
					    if($addfacility_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addfacility','Facility Added Successfully...');
					    	redirect(base_url().'admin_controller/facility_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addfacility','Facility Not Added Successfully...');
					    	redirect(base_url().'admin_controller/facility_cont');
					    }
                }
            	else
            	{
	                if($this->upload->do_upload('file'))
	                {
		                    $uploadData = $this->upload->data();
		                    $uploadedFile = $uploadData['file_name'];

		                $addfacility_sql = $this->admin_model->addfacility_mdl($facility);
					    if($addfacility_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addfacility','Facility Added Successfully...');
					    	redirect(base_url().'admin_controller/facility_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('addfacility','Facility Not Added Successfully...');
					    	redirect(base_url().'admin_controller/facility_cont');
					    }
	                }
	            	 else
	             	{
	                	$data1 = $this->upload->display_errors();
	                	$this->session->set_flashdata('image_error',$data1);
	                	redirect(base_url().'admin_controller/addfacility_cont');
	             	 }
             	}
    		}	
}

/* vender edit fill feilds */

public function facilityeditfill_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	if(isset($_GET['id']))
	{
		$facility_id=$_GET['id'];
	}
	$id=$this->session->userdata('admin_id');
	$data['usertype']=$this->admin_model->getusertype_mdl($id);
	if($this->admin_model->getfacilityinfo_mdl($facility_id))
		{
			$data['facility_info']=$this->admin_model->getfacilityinfo_mdl($facility_id);
		}
	$this->load->view('admin/edit_facility',$data);

}

/* facility edit */
public function facilityedit_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');

		$facility_id=$this->input->post('updateid');
		$id=$this->session->userdata('admin_id');
		$pic= $_FILES['file']['name'];
		if($pic == "")
		{
			
			$pic=$this->input->post("updatepic");
		}
		else
		{
			$pic=$_FILES['file']['name'];
		}

    	 $this->form_validation->set_rules('file', '', 'callback_file_check');
     	
    		$facility=array(
	    	'facility_name' => $this->input->post('facilityname'),
	    	'charge_per_hour' => $this->input->post('charge'),
	    	'pic' => $pic,
	    	'status' =>1,
	    	'modified_on' =>date('Y-m-d'),
	    	'modified_by' => 'admin',
	    	);

	    	 if(file_exists('img/facility/'.$pic))
                {
                	$editfacility_sql = $this->admin_model->editfacility_mdl($facility,$facility_id);
					    if($editfacility_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editfacility','Facility Updated Successfully...');
					    	redirect(base_url().'admin_controller/facility_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editfacility','Facility Not Updated Successfully...');
					    	redirect(base_url().'admin_controller/facility_cont');
					    }
                }
                else
                {
                	 if($this->form_validation->run() == true)
           			 {
		                //upload configuration
		                $config['upload_path']   = 'img/facility/';
		                $config['allowed_types'] = 'png|jpg|jpeg';
		                $config['max_size']      = 1024;
		                $this->load->library('upload', $config);

                //upload file to directory
	                if($this->upload->do_upload('file'))
	                {
		                    $uploadData = $this->upload->data();
		                    $uploadedFile = $uploadData['file_name'];

		                  $editfacility_sql = $this->admin_model->editfacility_mdl($facility,$facility_id);
					    if($editfacility_sql)
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editfacility','Facility Updated Successfully...');
					    	redirect(base_url().'admin_controller/facility_cont');
					    }
					    else
					    {
					    	$id=$this->session->userdata('admin_id');
							if($this->admin_model->getusertype_mdl($id))
							{
								$data['usertype']=$this->admin_model->getusertype_mdl($id);
							}
					    	$this->session->set_flashdata('editfacility','Facility Not Updated Successfully...');
					    	redirect(base_url().'admin_controller/facility_cont');
					    }
	                }
	            	 else
	             	{
	                	$data1 = $this->upload->display_errors();
	                	$this->session->set_flashdata('image_error',$data1);
	                	redirect(base_url().'admin_controller/facilityeditfill_cont?id='.$facility_id);
	             	 }
             	}

    	}
}


/* notice load delete display */
public function notice_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	$id=$this->session->userdata('admin_id');
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->admin_model->getusertype_mdl($id);

	}
	if(isset($_GET['id']))
		{
			$notice_delete_id = $_GET['id'];
			echo $notice_delete_id;
			$notice = array(
				'status' => 0,
			);
			$deletenotice_sql = $this->admin_model->deletenotice_mdl($notice,$notice_delete_id);
			if($deletenotice_sql)
			{
				$this->session->set_flashdata('deletenotice','Notice Deleteted Successfully...');
				redirect(base_url().'admin_controller/notice_cont');
			}
			else
			{
				$this->session->set_flashdata('deletenotice','Notice Not Deleteted Successfully...');
				redirect(base_url().'admin_controller/notice_cont');	
			}

		}
	if($this->admin_model->shownotice_mdl())
	{
		$data['shownotice']=$this->admin_model->shownotice_mdl();
	}
	if($this->admin_model->getpoll_mdl())
	{
		$data['pollcreated']='yes';
	}
	else
	{
		$data['pollcreated']='no';
	}
	$this->load->view('admin/notice_list',$data);
}

/* add notice */
public function addnotice_cont()
{
	if(! $this->session->userdata('admin_id'))
	return redirect('admin_controller');
	$id=$this->session->userdata('admin_id');
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->admin_model->getusertype_mdl($id);
	}
	if($this->admin_model->getwing_mdl())
	{
			$data['wing'] = $this->admin_model->getwing_mdl();
	}
	if($this->admin_model->getpoll_mdl())
	{
		$data['pollcreated']='yes';
	}
	else
	{
		$data['pollcreated']='no';
	}
	$this->load->view('admin/notice_create',$data);
}

/* notice insert */

public function noticeinsert_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	date_default_timezone_set('Asia/Kolkata');
	$time=date('H:i A');
	$type = $this->input->post('noticetype');
	$due_date = $this->input->post('due_date');
	$amount = $this->input->post('amount');
	$a = $this->input->post('amountf');
 
	$make_default = $this->input->post('make_default');
	if($make_default=="")
	{
		if($type=="other")
		{
		    $notice=array(
		    'title' => $this->input->post('title'),
			'description' => $this->input->post('des'),
			'notice_type' => $this->input->post('noticetype'),
			'is_default' => 'no',
			'is_sent' => 'no',
			'status' =>1,
			'time' => $time,
			'added_on' =>date('Y-m-d'),
			'added_by' =>'admin',
			);
			$pass_default='no';
		}
		if($type=="poll")
		{
		    $notice=array(
		    'title' => $this->input->post('title'),
			'description' => $this->input->post('des'),
			'notice_type' => $this->input->post('noticetype'),
			'is_default' => 'no',
			'is_sent' => 'no',
			'wing_no' => $this->input->post('wingno'),
			'status' =>1,
			'time' => $time,
			'added_on' =>date('Y-m-d'),
			'added_by' =>'admin',
			);
			$pass_default='no';
		}
		if($type=="maintanance")
		{
			$notice=array(
		    'title' => $this->input->post('title'),
			'description' => $this->input->post('des'),
			'notice_type' => $this->input->post('noticetype'),
			'is_default' => 'no',
			'is_sent' => 'no',
			'status' =>1,
			'time' => $time,
			'added_on' =>date('Y-m-d'),
			'added_by' =>'admin',
			);
			$pass_default='no';
		}
		if($type=="festival")
		{
			$notice=array(
		    'title' => $this->input->post('title'),
			'description' => $this->input->post('des'),
			'notice_type' => $this->input->post('noticetype'),
			'is_default' => 'no',
			'is_sent' => 'no',
			'status' =>1,
			'time' => $time,
			'added_on' =>date('Y-m-d'),
			'added_by' =>'admin',
			);
			$pass_default='no';
		}
		
	}
	else
	{
		if($type=="other")
		{
			echo "othet";
		    $notice=array(
		    'title' => $this->input->post('title'),
			'description' => $this->input->post('des'),
			'notice_type' => $this->input->post('noticetype'),
			'is_default' => 'yes',
			'is_sent' => 'no',
			'status' =>1,
			'time' => $time,
			'added_on' =>date('Y-m-d'),
			'added_by' =>'admin',
			);
			$pass_default='yes';
		}
		if($type=="maintanance")
		{
			$notice=array(
		    'title' => $this->input->post('title'),
			'description' => $this->input->post('des'),
			'notice_type' => $this->input->post('noticetype'),
			'is_default' => 'yes',
			'is_sent' => 'no',
			'status' =>1,
			'time' => $time,
			'added_on' =>date('Y-m-d'),
			'added_by' =>'admin',
			);
			$pass_default='yes';
		}
		if($type=="poll")
		{
			$notice=array(
		    'title' => $this->input->post('title'),
			'description' => $this->input->post('des'),
			'notice_type' => $this->input->post('noticetype'),
			'is_default' => 'yes',
			'is_sent' => 'no',
			'wing_no' => $this->input->post('wingno'),
			'status' =>1,
			'time' => $time,
			'added_on' =>date('Y-m-d'),
			'added_by' =>'admin',
			);
			$pass_default='yes';
		}
		if($type=="festival")
		{

			$notice=array(
		    'title' => $this->input->post('title'),
			'description' => $this->input->post('des'),
			'notice_type' => $this->input->post('noticetype'),
			'is_default' => 'yes',
			'is_sent' => 'no',
			'status' =>1,
			'time' => $time,
			'added_on' =>date('Y-m-d'),
			'added_by' =>'admin',
			);
			$pass_default='yes';
		}

	}
	$title=$this->input->post('title');
	$des=$this->input->post('des');
	$poll_on=$this->input->post('poll_on');
	$wingno=$this->input->post('wingno');
    $addnotice_sql = $this->admin_model->addnotice_mdl($notice);
	if($addnotice_sql)
	{
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
			$this->session->set_userdata('title',$title);
			$this->session->set_userdata('description',$des);
			$this->session->set_userdata('type',$type);
			$this->session->set_userdata('pass_default',$pass_default);
			$this->session->set_userdata('due_date',$due_date);
			$this->session->set_userdata('amount',$amount);
			$this->session->set_userdata('a',$a);
			$this->session->set_userdata('poll_on',$poll_on);
			$this->session->set_userdata('wingno',$wingno);
		}
		redirect(base_url().'admin_controller/sendnotice_cont');
	}
	else
	{
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		$this->session->set_flashdata('notice_fail','Notice Not Created Successfully..');
		redirect(base_url().'admin_controller/addnotice_cont');
	}
}

public function sendnotice_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	$id=$this->session->userdata('admin_id');
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->admin_model->getusertype_mdl($id);

	}
	if($this->admin_model->getnoticeid())
	{
		$data['noticeid']=$this->admin_model->getnoticeid();
	}
	if($this->admin_model->getuser_ids_mdl())
	{
		$data['m']=$this->admin_model->getuser_ids_mdl();

	}

	if($this->admin_model->getuser_ids_fest_mdl())
	{
		$data['f']=$this->admin_model->getuser_ids_fest_mdl();

	}
	$this->load->view('admin/notice_send',$data);
}

/* notice send to residents */
public function sendnotice_resident_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		
	date_default_timezone_set('Asia/Kolkata');
	$time=date('h:i A');
	$type = $this->input->post('type');
	$make_default = $this->input->post('make_default');
	$pass_default=$this->input->post('pass_default');

		if($type=="other")
		{
		    $notice=array(
		    'title' => $this->input->post('title'),
			'description' => $this->input->post('des'),
			'notice_type' => $this->input->post('type'),
			'is_default' => 'no',
			'is_sent' => 'yes',
			'status' =>1,
			'time' => $time,
			'added_on' =>date('Y-m-d'),
			'added_by' =>'admin',
			);
		}
		if($type=="poll")
		{
		    $notice=array(
		    'title' => $this->input->post('title'),
			'description' => $this->input->post('des'),
			'notice_type' => $this->input->post('type'),
			'is_default' => 'no',
			'is_sent' => 'yes',
			'wing_no' => $this->input->post('wingno'),
			'status' =>1,
			'time' => $time,
			'added_on' =>date('Y-m-d'),
			'added_by' =>'admin',
			);
		}
		if($type=="maintanance")
		{
			$notice=array(
		    'title' => $this->input->post('title'),
			'description' => $this->input->post('des'),
			'notice_type' => $this->input->post('type'),
			'is_default' => 'no',
			'is_sent' => 'yes',
			'status' =>1,
			'time' => $time,
			'added_on' =>date('Y-m-d'),
			'added_by' =>'admin',
			);

		$id=implode(',',$_POST['n']);
		$id1=explode(',',$id);

	}
	if($type=="festival")
	{
		$notice=array(
		    'title' => $this->input->post('title'),
			'description' => $this->input->post('des'),
			'notice_type' => $this->input->post('type'),
			'is_default' => 'no',
			'is_sent' => 'yes',
			'status' =>1,
			'time' => $time,
			'added_on' =>date('Y-m-d'),
			'added_by' =>'admin',
			);

		$fid=implode(',',$_POST['m']);
		$fid1=explode(',',$fid);
	}
	if($pass_default=='no')
	{
		$nid=$this->input->post('noticeid');
		$add_notice_sql = $this->admin_model->add_notice_mdl($notice,$nid);

		if($add_notice_sql)
		{
			$id=$this->session->userdata('admin_id');
			if($this->admin_model->getusertype_mdl($id))
			{
				$data['usertype']=$this->admin_model->getusertype_mdl($id);	
			}
			if(isset($id1))
				{
					foreach($id1 as $i)
					{
						$main = array(
						'user_id' => $i,
						'maintanance_date' =>date('Y-m-d'),
						'due_date' => $this->input->post('due_date'),
						'amount' => $this->input->post('amount'),
						'penalty' => 0,
						'pay_status' => 0,
						'added_on' => date('Y-m-d'),
						'added_by' =>'admin',
					);
					$this->admin_model->maintanance($main);
					}
				}

				if(isset($fid1))
				{
					foreach($fid1 as $fi)
					{
						$fest = array(
						'expense_revenue_name' => $this->input->post('title'),
						'user_id' => $fi,
						'amount' => $this->input->post('amountf'),
						'type' => 'revenue',
						'pay_status' => 0,
						'added_on' => date('Y-m-d'),
						'added_by' =>'admin',
					);
					$this->admin_model->festi($fest);
					}
					
				}

				$this->session->set_flashdata('addnotice','Notice Send Successfully...');
					redirect(base_url().'admin_controller/notice_cont');
			
		}
		else
		{
			$id=$this->session->userdata('admin_id');
			if($this->admin_model->getusertype_mdl($id))
			{
				$this->session->set_flashdata('addnotice','Notice Not Send Successfully...');
				$data['usertype']=$this->admin_model->getusertype_mdl($id);
			}
			redirect(base_url().'admin_controller/notice_cont');
		}

		
	}
	else
	{
	    $addnotice_sql = $this->admin_model->addnotice_mdl($notice);
		if($addnotice_sql)
		{
			$id=$this->session->userdata('admin_id');
			if($this->admin_model->getusertype_mdl($id))
			{
				$data['usertype']=$this->admin_model->getusertype_mdl($id);
			}
			if(isset($id1))
				{
					foreach($id1 as $i)
					{
						$main = array(
						'user_id' => $i,
						'maintanance_date' =>date('Y-m-d'),
						'due_date' => $this->input->post('due_date'),
						'amount' => $this->input->post('amount'),
						'penalty' => 0,
						'pay_status' => 0,
						'added_on' => date('Y-m-d'),
						'added_by' =>'admin',
					);
					$this->admin_model->maintanance($main);
					}
					
				}
			


			if(isset($fid1))
				{
					foreach($fid1 as $fi)
					{
						$fest = array(
						'expense_revenue_name' => $this->input->post('title'),
						'user_id' => $fi,
						'amount' => $this->input->post('amountf'),
						'type' => 'revenue',
						'pay_status' => 0,
						'added_on' => date('Y-m-d'),
						'added_by' =>'admin',
					);
					$this->admin_model->festi($fest);
					}
				}
				$this->session->set_flashdata('addnotice','Notice Send Successfully...');
					redirect(base_url().'admin_controller/notice_cont');
		}
		else
		{
			$id=$this->session->userdata('admin_id');
			if($this->admin_model->getusertype_mdl($id))
			{
				$this->session->set_flashdata('addnotice','Notice Not Send Successfully...');
				$data['usertype']=$this->admin_model->getusertype_mdl($id);
			}
			redirect(base_url().'admin_controller/notice_cont');
		}
	}

}

/* get default notice id  */
public function get_default_notice_info()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	if(isset($_GET['id']))
	{
		$notice_id=$_GET['id'];
	}
	$id=$this->session->userdata('admin_id');
	$data['usertype']=$this->admin_model->getusertype_mdl($id);
	if($this->admin_model->getnoticeinfo_mdl($notice_id))
	{
		$data['notice_info']=$this->admin_model->getnoticeinfo_mdl($notice_id);
	}
	if($this->admin_model->getuser_ids_mdl())
	{
		$data['m']=$this->admin_model->getuser_ids_mdl();
	}
	if($this->admin_model->getuser_ids_fest_mdl())
	{
		$data['f']=$this->admin_model->getuser_ids_fest_mdl();

	}
	$this->load->view('admin/default_notice_send',$data);
}

/* view all notice */
public function view_all_notice_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	$id=$this->session->userdata('admin_id');
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->admin_model->getusertype_mdl($id);

	}
	if(isset($_GET['id']))
		{
			$notice_delete_id = $_GET['id'];
			echo $notice_delete_id;
			$notice = array(
				'status' => 0,
			);
			$deletenotice_sql = $this->admin_model->deletenotice_mdl($notice,$notice_delete_id);
			if($deletenotice_sql)
			{
				$this->session->set_flashdata('deletenotice','Notice Deleteted Successfully...');
				redirect(base_url().'admin_controller/view_all_notice_cont');
			}
			else
			{
				$this->session->set_flashdata('deletenotice','Notice Not Deleteted Successfully...');
				redirect(base_url().'admin_controller/view_all_notice_cont');	
			}

		}
	if($this->admin_model->view_all_notice_mdl())
	{
		$data['viewnotice']=$this->admin_model->view_all_notice_mdl();
	}
	$this->load->view('admin/viewall_notice',$data);

}
/* poll */
public function poll_cont()
{
	if(! $this->session->userdata('admin_id'))
	return redirect('admin_controller');
	$id=$this->session->userdata('admin_id');
	if($this->admin_model->getusertype_mdl($id))
	{
		$data['usertype']=$this->admin_model->getusertype_mdl($id);
	}
	if($this->admin_model->poll_create_view_mdl())
	{
		$data['poll']=$this->admin_model->poll_create_view_mdl();
	}
	if($this->admin_model->pol_regi_member_mdl())
	{
		$data['poll_member']=$this->admin_model->pol_regi_member_mdl();
	}
	if($this->admin_model->open_close_mdl())
    {
      $data['o_c']='yes';
    }
    else
    {
       $data['o_c']='no';
    }
     if($this->admin_model->get_notice_id_result())
    {
      $max_notice_id=$this->admin_model->get_notice_id_result();
      if($max_notice_id)
      {
        $data['notice_id'] = $max_notice_id->notice_id;
        $max = $data['notice_id'];
      }
    }
    if($this->admin_model->disp_header_poll_result($max))
    {
    	$data['header']=$this->admin_model->disp_header_poll_result($max);
    }
    if($this->admin_model->count_votes($max))
    {
      $data['votes']=$this->admin_model->count_votes($max);
    }
    if($this->admin_model->poll_result_mdl($max))
    {
      $data['pp']=$this->admin_model->poll_result_mdl($max);
    }
    if($this->admin_model->count_total_vote_mdl($max))
    {
      $data['total_vote']=$this->admin_model->count_total_vote_mdl($max);
    }
    
	$this->load->view('admin/poll_list',$data);
}
/* open poll */
public function open_poll_cont()
{
	if(! $this->session->userdata('admin_id'))
	return redirect('admin_controller');
	date_default_timezone_set('Asia/Kolkata');
	$time=date('h:i A');
	$poll_open= array(
		'open_close' => 'open',
		'modified_on' =>date('Y-m-d'),
	);
	if($_GET['nid'])
	{
		$nid=$_GET['nid'];
		$open_poll_sql = $this->admin_model->opne_poll_mdl($nid,$poll_open);
		if($open_poll_sql)
		{
			$this->session->set_flashdata('pollopen','Poll Open Successfully...'); 
			redirect(base_url().'admin_controller/poll_cont');
		}
		else
		{
			$this->session->set_flashdata('pollopen','Poll Not Open Successfully...'); 
			redirect(base_url().'admin_controller/poll_cont');
		}
	}
}

/* colse poll */
public function close_poll_cont()
{
	if(! $this->session->userdata('admin_id'))
	return redirect('admin_controller');
date_default_timezone_set('Asia/Kolkata');
	$time=date('h:i A');
	$poll_close= array(
		'is_sent' => 'no',
		'open_close' => 'close',
		'status' => 0,
		'modified_on' =>date('Y-m-d'),
		'modified_by' => 'admin',
		'time' =>$time,
	);
	$remove_poll_user = array(
		'status' => 0,
	);
	if($_GET['nid'])
	{
		$nid=$_GET['nid'];
		$close_poll_sql = $this->admin_model->close_poll_mdl($nid,$poll_close,$remove_poll_user);
		if($close_poll_sql)
		{
			$this->session->set_flashdata('pollclose','Poll Close Successfully...'); 
			redirect(base_url().'admin_controller/poll_cont');
		}
		else
		{
			$this->session->set_flashdata('pollclose','Poll Not Close Successfully...'); 
			redirect(base_url().'admin_controller/poll_cont');
		}
	}
}

//======================================= dashbord ==================================
/* wing  dashboard */
public function dashboard_new_request_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller'); 
   	if($this->session->userdata('admin_id'))
	  {
	    $id=$this->session->userdata('admin_id');
	  }
    if($this->admin_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->admin_model->getusertype_mdl($id);
    } 
    if($this->admin_model->dashboard_new_reques_mdl())
    {
    	$data['requests']=$this->admin_model->dashboard_new_reques_mdl();
    }
     
	if(isset($_GET['approve']))
	{
		$user_id = $_GET['approve'];
		$approve = array(
		'approve_status' =>1,
		);
		$approve_sql = $this->admin_model->dashboard_request_approve_mdl($approve,$user_id);
		if($approve_sql)
		{
			if($this->admin_model->get_email($user_id))
		    {
			      $email_address=$this->admin_model->get_email($user_id);
			      if($email_address)
			      {
			        $data['email'] = $email_address->email;
			        $email1 = $data['email'];
			      }
		    }
		    require 'PHPMailer/PHPMailerAutoload.php';
		    $email = $email1;
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
	$mail->Body    = '<html><head></head><body><div style="background-color:#DBDBDB;padding:50px;margin-left:200px; margin-right:200px;"><img src="cid:my-attach" height="150px" width="150px" /><hr><p style="color:black">Hello&nbsp;&nbsp;'.$username.',<br><br>Your Account is Confirmed.<br><br>
	In order to Login, click the link below:<br><br>
	<a href="'.base_url().'front_controller/index">Pratha Apartment</a><br><br><br><center><h2>Thank You</h2>Pratha Apartment Copyright © 2018<br>All Rights Reserved.</center></p></div></body></html>';


		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		else
		{	
				$this->session->set_flashdata('approve','User Confirmed Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_new_request_cont');
			
		}
				
		}
	}
	if(isset($_GET['disapprove']))
	{
		$user_id = $_GET['disapprove'];
		if($this->admin_model->get_email($user_id))
		    {
			      $email_address=$this->admin_model->get_email($user_id);
			      if($email_address)
			      {
			        $data['email'] = $email_address->email;
			        $email1 = $data['email'];
			      }
		    }
		    require 'PHPMailer/PHPMailerAutoload.php';
		    $email = $email1;
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
	$mail->Body    = '<html><head></head><body><div style="background-color:#DBDBDB;padding:50px;margin-left:200px; margin-right:200px;"><img src="cid:my-attach" height="150px" width="150px" /><hr><p style="color:black">Hello&nbsp;&nbsp;'.$username.',<br><br>Your Account is not Confirmed.<br><br>
		<br><center><h2>Thank You</h2>Pratha Apartment Copyright © 2018<br>All Rights Reserved.</center></p></div></body></html>';


		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
		else
		{	
			$disapprove_sql = $this->admin_model->dashboard_request_disapprove_mdl($user_id);
			if($disapprove_sql)
			{
				$this->session->set_flashdata('dispprove','User Disapproved Successfully...'); 
					redirect(base_url().'admin_controller/dashboard_new_request_cont');	
			}
		
		}
	}
	$this->load->view('admin/dashboard_new_request',$data);

}
public function dashboard_wing_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if($this->admin_model->wings_mdl())
		{
			$data['wings']=$this->admin_model->wings_mdl();
		}
		if(isset($_GET['wing_id']))
		{
			$wing = array(
				'status' =>0,
			);
			$wing_id=$_GET['wing_id'];
			$delete_wing_sql = $this->admin_model->delete_wing_mdl($wing_id,$wing);
			if($delete_wing_sql)
			{
				$this->session->set_flashdata('wing_delete','Wing Deleted Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_wing_cont');
			}
			else
			{
				$this->session->set_flashdata('wing_delete','Wing Not Deleted Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_wing_cont');
			}
		}
		$this->load->view('admin/dashboard_wing',$data);	
}

public function add_wing_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		$this->load->view('admin/dashboard_add_wing',$data);	

}
public function addwing()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$wing = $this->input->post('wing_name');
		$dashboard_wing_check = $this->admin_model->dashboard_wing_check_mdl($wing);
		if($dashboard_wing_check)
		{
			$this->session->set_flashdata('wing_error','Wing Already Added...');
			redirect(base_url().'admin_controller/add_wing_cont');
		}
		else
		{
			$wing = array(
			'wing_name' => $this->input->post('wing_name'),
			'added_on' => date('Y-m-d'),
			'added_by' => 'admin',
			'status' => 1,
			);
			$wing_add=$this->admin_model->wing_add_mdl($wing);
			if($wing_add)
			{
				$this->session->set_flashdata('wing_insert','Wing Inserted Successfully...');
				redirect(base_url().'admin_controller/dashboard_wing_cont');
			}
			else
			{
				$this->session->set_flashdata('wing_insert','Wing Not Inserted Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_wing_cont');
			}
		}
}


/* dashboard home */
public function dashboard_home_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if($this->admin_model->homes_mdl())
		{
			$data['homes']=$this->admin_model->homes_mdl();
		}
		if(isset($_GET['home_id']))
		{
			$home = array(
				'status' =>0,
			);
			$home_id=$_GET['home_id'];
			$delete_home_sql = $this->admin_model->delete_home_mdl($home_id,$home);
			if($delete_home_sql)
			{
				$this->session->set_flashdata('home_delete','Home Deleted Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_home_cont');
			}
			else
			{
				$this->session->set_flashdata('home_delete','Home Not Deleted Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_home_cont');
			}
		}
		$this->load->view('admin/dashboard_home',$data);	
}

public function add_home_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if($this->admin_model->getwing_mdl())
		{
			$data['wing'] = $this->admin_model->getwing_mdl();
		}
		$this->load->view('admin/dashboard_add_home',$data);	

}

public function addhome()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$home = $this->input->post('home_no');
		$wing = $this->input->post('wingno');
		if($home == 0 )
		{
            $this->session->set_flashdata('home_no_error','Please Enter Valid Home No...');
            redirect(base_url().'admin_controller/add_home_cont');	
		}
		else
		{
			$dashboard_home_check = $this->admin_model->dashboard_home_check_mdl($home,$wing);
			if($dashboard_home_check)
			{
				$this->session->set_flashdata('home_error','Home Already Added...');
				redirect(base_url().'admin_controller/add_home_cont');
			}
			else
			{
				$home = array(
				'home_no' => $this->input->post('home_no'),
				'wing_id' => $this->input->post('wingno'),
				'added_on' => date('Y-m-d'),
				'added_by' => 'admin',
				'status' => 1,
				);
				$home_add=$this->admin_model->home_add_mdl($home);
				if($home_add)
				{
					$this->session->set_flashdata('home_insert','Home Inserted Successfully...');
					redirect(base_url().'admin_controller/dashboard_home_cont');
				}
				else
				{
					$this->session->set_flashdata('home_insert','Home Not Inserted Successfully...'); 
					redirect(base_url().'admin_controller/dashboard_home_cont');
				}
			}
		}
}

/* dashboard owner */
public function dashboard_owner_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if($this->admin_model->owners_mdl())
		{
			$data['owners']=$this->admin_model->owners_mdl();
		}
		if(isset($_GET['owner_id']))
		{
			$owner = array(
				'status' =>0,
				'modified_on' =>date('Y-m-d'),
				'modified_by' =>'admin',
			);
			$owner_id=$_GET['owner_id'];
			$delete_owner_sql = $this->admin_model->delete_owner_mdl($owner_id,$owner);
			if($delete_owner_sql)
			{
				$delete_tenant_sql = $this->admin_model->delete_tenant_with_owner_mdl($owner_id,$owner);
				$this->session->set_flashdata('owner_delete','Owner Deleted Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_owner_cont');
			}
			else
			{
				$this->session->set_flashdata('owner_delete','Owner Not Deleted Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_owner_cont');
			}
		}
		$this->load->view('admin/dashboard_owner',$data);	
}

public function dashboard_old_owner_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if($this->admin_model->owners_old_mdl())
		{
			$data['old_owners']=$this->admin_model->owners_old_mdl();
		}
		$this->load->view('admin/dashboard_old_owner',$data);	
}

/* dashboard tenant */
public function dashboard_tenant_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if($this->admin_model->tenants_mdl())
		{
			$data['tenants']=$this->admin_model->tenants_mdl();
		}
		$this->load->view('admin/dashboard_tenant',$data);	
}

/* dashboard booking */
public function dashboard_booking_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if($this->admin_model->bookings_mdl())
		{
			$data['bookings']=$this->admin_model->bookings_mdl();
		}
		if(isset($_GET['booking_id']))
		{
			$booking = array(

				'approve_disapprove_msg' => 'Booking confirmed',
				'approve_disapprove_status' =>1,
				'confirm_booking_status' =>1,
			);
			$booking_id=$_GET['booking_id'];
			$approve_booking_sql = $this->admin_model->approve_booking_mdl($booking_id,$booking);
			if($approve_booking_sql)
			{
				$this->session->set_flashdata('booking_approve','Booking Approved Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_booking_cont');
			}
			else
			{
				$this->session->set_flashdata('booking_approve','Booking Not Approved Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_booking_cont');
			}
		}
		$this->load->view('admin/dashboard_booking',$data);	
}

public function dashboard_view_booking_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if($this->admin_model->view_bookings_mdl())
		{
			$data['booked']=$this->admin_model->view_bookings_mdl();
		}
		$this->load->view('admin/dashboard_bookedfacility',$data);	
}
public function disapprove_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	$book_id = $this->input->post('book_id');
	$disapprove = array(
		'approve_disapprove_status' =>2,
		'approve_disapprove_msg' => $this->input->post('reason'),
		'status' =>0,
		'confirm_booking_status' =>0,
	);
	$disapprove_sql = $this->admin_model->disapprove_mdl($book_id,$disapprove);
	if($disapprove_sql)
	{ 
		$this->session->set_flashdata('booking_disapprove','Booking Disapproved Successfully...'); 
		redirect(base_url().'admin_controller/dashboard_booking_cont');
	}
	else
	{
		$this->session->set_flashdata('booking_disapprove','Booking Not Disapproved Successfully...'); 
		redirect(base_url().'admin_controller/dashboard_booking_cont');
	}
}

/* dashboard directory */
public function dashboard_directory_cont()
{
  if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
   if($this->session->userdata('admin_id'))
  {
    $id=$this->session->userdata('admin_id');
  }

    if($this->admin_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->admin_model->getusertype_mdl($id);
    } 
    if($this->admin_model->dashboard_directory_mdl())
    {
    	$data['directorys']=$this->admin_model->dashboard_directory_mdl();
    }
     $this->load->view('admin/dashboard_directory',$data);
}

/* dashboard maintanace */
public function dashboard_maintanance_cont()
{
 if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller'); 
   if($this->session->userdata('admin_id'))
  {
    $id=$this->session->userdata('admin_id');
  }

    if($this->admin_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->admin_model->getusertype_mdl($id);
    } 
    if($this->admin_model->dashboard_maintanance_mdl())
    {
    	$data['maintanances']=$this->admin_model->dashboard_maintanance_mdl();
    }
     $this->load->view('admin/dashboard_maintanance',$data);
}

/* dashboard expense*/
public function dashboard_expense_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
  
   if($this->session->userdata('admin_id'))
  {
    $id=$this->session->userdata('admin_id');
  }

    if($this->admin_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->admin_model->getusertype_mdl($id);
    } 
     $month = date('m');
     $year = date('Y');
    if($this->admin_model->dashboard_expense_mdl($month,$year))
    {
    	$data['expense']=$this->admin_model->dashboard_expense_mdl($month,$year);
    }
     $this->load->view('admin/dashboard_expense',$data);
}



public function add_expense_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		$this->load->view('admin/dashboard_add_expense',$data);	

}
public function addexpense()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$expdate = $this->input->post('expdate');
		if($expdate > date('Y-m-d'))
		{
			$this->session->set_flashdata('expdate_error','Plese Select Valid Date...');
			redirect(base_url().'admin_controller/add_expense_cont');
		}
		else
		{
			$expense = array(
			'expense_revenue_name' => $this->input->post('expensename'),
			'amount' => $this->input->post('amount'),
			'added_on' => date('Y-m-d'),
			'added_by' => 'admin',
			'expense_date' =>$this->input->post('expdate'),
			//'status' => 1,
			'type' => 'expense',
			);
			$expense_add=$this->admin_model->expense_add_mdl($expense);
			if($expense_add)
			{
				$this->session->set_flashdata('expense_insert','Expense Inserted Successfully...');
				redirect(base_url().'admin_controller/dashboard_expense_cont');
			}
			else
			{
				$this->session->set_flashdata('expense_insert','Expense Not Inserted Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_expense_cont');
			}
		}
		
}


public function dashboard_expense_edit_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if(isset($_GET['expense_id']))
		{
			$expense_id = $_GET['expense_id'];
			if($this->admin_model->get_expense_info_mdl($expense_id))
			{
				$data['expense_info']=$this->admin_model->get_expense_info_mdl($expense_id);
			}
		}
		$this->load->view('admin/dashboard_edit_expense',$data);	

}

public function editexpense()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$expense_id = $this->input->post('expense_id');
		$expdate = $this->input->post('expdate');
		if($expdate > date('Y-m-d'))
		{
			$this->session->set_flashdata('expdate_error','Please Select Valid Date...');
			redirect(base_url().'admin_controller/dashboard_expense_edit_cont?expense_id='.$expense_id);
		}
		else
		{
		
			$expense = array(
			'expense_revenue_name' => $this->input->post('expensename'),
			'amount' => $this->input->post('amount'),
			'modified_on' => date('Y-m-d'),
			'modified_by' => 'admin',
			'expense_date' =>$this->input->post('expdate'),
			//'status' => 1,
			);
			$expense_update=$this->admin_model->expense_update_mdl($expense,$expense_id);
			if($expense_update)
			{
				$this->session->set_flashdata('expense_update','Expense Updated Successfully...');
				redirect(base_url().'admin_controller/dashboard_expense_cont');
			}
			else
			{
				$this->session->set_flashdata('expense_update','Expense Not Updated Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_expense_cont');
			}
		}
		
}

/* dashboard revemue */
public function dashboard_revenue_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
  
   if($this->session->userdata('admin_id'))
  {
    $id=$this->session->userdata('admin_id');
  }

    if($this->admin_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->admin_model->getusertype_mdl($id);
    }
      $month = date('m');
      $year = date('Y');
    if($this->admin_model->dashboard_tol_revenue_mdl($month,$year))
	{
	    $data['tolrevenue']=$this->admin_model->dashboard_tol_revenue_mdl($month,$year);	
	}
	if($this->admin_model->dashboard_tol_revenue_tbl_mdl($month,$year))
	{
	  	$data['tolrevenuetbl']=$this->admin_model->dashboard_tol_revenue_tbl_mdl($month,$year);	
	}
	if($this->admin_model->dashboard_tol_revenue_booking_mdl($month,$year))
	{
	   	$data['bookingrevenue']=$this->admin_model->dashboard_tol_revenue_booking_mdl($month,$year);	
	}
	 if($this->admin_model->dashboard_tol_revenue_booking_penalty_mdl($month,$year))
	{
	    	$data['bookingrevenue_penalty']=$this->admin_model->dashboard_tol_revenue_booking_penalty_mdl($month,$year);	
	}
     $this->load->view('admin/dashboard_revenue',$data);
}

/* dashboard issue */
public function dashboard_issue_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
		$id=$this->session->userdata('admin_id');
		if($this->admin_model->getusertype_mdl($id))
		{
			$data['usertype']=$this->admin_model->getusertype_mdl($id);
		}
		if($this->admin_model->issue_mdl())
		{
			$data['issues']=$this->admin_model->issue_mdl();
		}
		if(isset($_GET['issue_id']))
		{
			$issue = array(
				'issue_progress_status' => 2,
			);
			$issue_id=$_GET['issue_id'];
			$solved_issue_sql = $this->admin_model->solved_issue_mdl($issue_id,$issue);
			if($solved_issue_sql)
			{
				$this->session->set_flashdata('issue_solved','Issue Solved Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_issue_cont');
			}
			else
			{
				$this->session->set_flashdata('issue_solved','Issue Not Solved Successfully...'); 
				redirect(base_url().'admin_controller/dashboard_issue_cont');
			}
		}
		$this->load->view('admin/dashboard_issue',$data);	
}

/* notification */
public function fetch_notification()
{
	if(isset($_POST["view"]))
	{
	if($_POST["view"] != '')
	{
		$read = array(
			'book_status' =>1,
		);
		$read_issue = array(
			'issue_progress_status' =>1,
		);
	$up=$this->admin_model->read_notification($read);
	$up_issue=$this->admin_model->read_notification_issue($read_issue);
	}
	$sel_q=$this->admin_model->select_notification();
	$sel_issue=$this->admin_model->select_notification_issue();
	$output='';
	$count_book=count($sel_q);
	$count_issue=count($sel_issue);
	$count = $count_issue + $count_book;
	$noti = 0;

	if($sel_q)
	{
		if($count_book > 0)
		{
			
			foreach($sel_q as $row)
			{
				$output.='
					<li>
						<a href="#">
						<strong>'.$row->firstname.'&nbsp;&nbsp;&nbsp;[ Booking ]</strong><br />
						<small>'.$row->facility_name.'</small><br />
						<small>'.$row->book_date."&nbsp;&nbsp;&nbsp;&nbsp;".$row->time_slot.'</small><br /><hr />
						</a>
					</li>
				';
				
			}
		}
		$noti =1;
	}
	else
	{
		$noti = 0;

	}
	if($sel_issue)
	{
		if($count_issue > 0)
		{
		
			foreach($sel_issue as $row1)
			{
				$output.='
					<li>
						<a href="#">
						<strong>'.$row1->firstname.'&nbsp;&nbsp;&nbsp;[ Issue ]</strong><br />
						<small>'.$row1->title.'</small><br />
						<small>'.$row1->discription.'</small><br /><hr />
						</a>
					</li>
				';
				
			}	
		}
	$noti1 =1;
	}
	else
	{
		$noti1 = 2;
	}

	if($noti == 0 && $noti1 == 2)
	{
		$output.='
			<li><a href="#" class="text-bold text-italic">No Notification</a></li>
		';
	}

	$query1=$this->admin_model->unread_noti();
	$query2=$this->admin_model->unread_noti_issue();
	$count_b = 0;
	$count_i = 0;
	$count_b=count($query1);
	$count_i = count($query2);
	$count= $count_b+ $count_i; 
	$data=array(
		'notification' => $output,
		'unseen_notification' =>$count
	);
	echo json_encode($data);
}
}

public function penalty_cont()
{
	if($this->session->userdata('admin_id'))
  	{
    	$id=$this->session->userdata('admin_id');
  	}
  	$penalty_amount = $this->input->post('penalty');
  	$days = $this->input->post('days');
  	$tol_penalty = ($penalty_amount * $days);
  	$mid = $this->input->post('maintenance_id'); 
  	$penalty = array(
  		'penalty' => $tol_penalty,
  	);
  	$penalty_sql = $this->admin_model->penalty_mdl($penalty,$mid);
  	if($penalty_sql)
  	{
  		$this->session->set_flashdata('maintenance_penalty','Maintenance Penalty Succsess...'); 
  		redirect(base_url().'admin_controller/dashboard_maintanance_cont');
  	}
  	else
  	{
  		redirect(base_url().'admin_controller/dashboard_maintanance_cont');

  	}
}

public function logout_cont()
{
	$this->session->unset_userdata('admin_id');
	$this->session->unset_userdata('title');
	$this->session->unset_userdata('description');
	$this->session->unset_userdata('type');
	$this->session->unset_userdata('pass_default');
	$this->session->unset_userdata('due_date');
	$this->session->unset_userdata('amount');
	$this->session->unset_userdata('a');
	$this->session->unset_userdata('poll_on');
	$this->session->unset_userdata('wingno');
	//$this->session->sess_destroy();
	redirect(base_url().'admin_controller');
}

/* pdf */
public function dashboard_document_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller'); 
	if($this->session->userdata('admin_id'))
	{
	    $id=$this->session->userdata('admin_id');
	}

    if($this->admin_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->admin_model->getusertype_mdl($id);
    } 
    $data['files']=directory_map('./document/');
    $this->load->view('admin/dashboard_document',$data);
}

public function documentdl_cont() 
 {   
   if ($this->input->get('filename')) 
   {
    $filename=$this->input->get('filename');
    $data = file_get_contents (base_url('document/'.$filename));
    $this->output->set_header('Content-Disposition: attachment; filename='.$filename);
    $this->output->set_content_type('application/pdf')
                 ->set_output($data,array("Attachment"=>0));
     
   }
}
public function down_pdf_cont()
{
	
	if($this->session->userdata('admin_id'))
  	{
    	$id=$this->session->userdata('admin_id');
  	}
  	$date = $this->input->post('reportdate');
	$month = date('m', strtotime($date));
	$year = date('Y', strtotime($date));
	if($this->admin_model->dashboard_tol_revenue_tbl_mdl($month,$year))
	{
    	$data['tolrevenuetbl']=$this->admin_model->dashboard_tol_revenue_tbl_mdl($month,$year);	
	}
	if($this->admin_model->dashboard_tol_revenue_mdl($month,$year))
    {
	    $data['tolrevenue']=$this->admin_model->dashboard_tol_revenue_mdl($month,$year);	
	}
	if($this->admin_model->dashboard_tol_revenue_booking_mdl($month,$year))
	{
	   	$data['bookingrevenue']=$this->admin_model->dashboard_tol_revenue_booking_mdl($month,$year);	
	}
	 if($this->admin_model->dashboard_tol_revenue_booking_penalty_mdl($month,$year))
	 {
	    	$data['bookingrevenue_penalty']=$this->admin_model->dashboard_tol_revenue_booking_penalty_mdl($month,$year);	
	}
	if($this->admin_model->dashboard_tol_expense_mdl($month,$year))
	{
	    $data['tolexpense']=$this->admin_model->dashboard_tol_expense_mdl($month,$year);	
	}
	$data['date_disp']=$this->input->post('reportdate');
	$this->load->view('admin/report.php',$data);
}
public function dashboard_create_document_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller'); 
	if($this->session->userdata('admin_id'))
	{
	    $id=$this->session->userdata('admin_id');
	}

    if($this->admin_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->admin_model->getusertype_mdl($id);
    } 
     $this->load->view('admin/dashboard_create_document',$data);
}
public function boradcast_report_cont()
{

	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller'); 
	if($this->session->userdata('admin_id'))
	{
	    $id=$this->session->userdata('admin_id');
	}
	$this->form_validation->set_rules('file', '', 'callback_file_check');
	if($this->form_validation->run() == true)
    {
				//upload configuration
                $config['upload_path']   = 'document/';
                $config['allowed_types'] = 'pdf';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);

                //upload file to directory
                if($this->upload->do_upload('file'))
                {
	                    $uploadData = $this->upload->data();
	                    $uploadedFile = $uploadData['file_name'];
	                    $this->session->set_flashdata('broadcastsuccess','Report Broadcasted successfully...');
					   	redirect(base_url().'admin_controller/dashboard_document_cont');
	               
                }
            	 else
             	{
                	$data1 = $this->upload->display_errors();
                	$this->session->set_flashdata('image_error',$data1);
                	redirect(base_url().'admin_controller/dashboard_create_document_cont');
             	 }	
	}
}

/* forgot password */
public function forgotpassword_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
	$this->load->view('admin/forgot_password');
}
public function forgotpassword_index_cont()
{
	$this->load->view('admin/forgot_password');
}
public function reset_pass_link_cont()
{
	if(! $this->session->userdata('admin_id'))
			return redirect('admin_controller');
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
<a href="'.base_url().'admin_controller/reset_password_page_cont">Reset My Password</a><br><br>If you have not made any password reset request, it is likely that another user entered your email address by mistake and you can simply disregard this email.<br><br><center><h2>Thank You</h2>Pratha Apartment Management Copyright © 2018<br>All Rights Reserved</p><center></div></body></html>';


	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} 
	else
	{	
	    $this->session->set_flashdata('resetmsg','Reset Password Link Sent Successfully.'); 
		redirect(base_url().'admin_controller/forgotpassword_cont');
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
<a href="'.base_url().'admin_controller/reset_password_page_cont">Reset My Password</a><br><br>If you have not made any password reset request, it is likely that another user entered your email address by mistake and you can simply disregard this email.<br><br><center><h2>Thank You</h2>Pratha Apartment Management Copyright © 2018<br>All Rights Reserved</p><center></div></body></html>';


	if(!$mail->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $mail->ErrorInfo;
	} 
	else
	{	
	    $this->session->set_flashdata('resetmsg','Reset Password Link Sent Successfully.'); 
		redirect(base_url().'admin_controller/forgotpassword_cont');
	}
}

public function reset_password_page_cont()
{

	$this->load->view('admin/reset_password');
}

public function reset_password_cont()
{
	$username=$this->input->post('username');

    	$n_pass=$this->input->post('password');
    	$r_pass=$this->input->post('repassword');
    	if($n_pass != $r_pass)
    	{
    		$this->session->set_flashdata('repassword_error','Retype Password Does Not Matched...');
            redirect(base_url().'admin_controller/reset_password_page_cont');
    	}
    	else
    	{
    		$n_pass1=md5($n_pass);
    		$profile = array(
    		'password' => $n_pass1,
    		);
    		$id=$this->session->userdata('admin_id');
    		$reset_success=$this->admin_model->reset_password_mdl($profile,$username);
    		if($reset_success)
    		{
    			$this->session->set_flashdata('resetpass','Password Reseted Successfully...');
				redirect(base_url().'admin_controller/reset_password_page_cont');
    		}
    		else
    		{
    			$reset_samepass_success=$this->admin_model->reset_samepassword_mdl($n_pass,$username);
    			if($reset_samepass_success)
    			{
    				$this->session->set_flashdata('resetpass','Password Reseted Successfully...');
					redirect(base_url().'admin_controller/reset_password_page_cont');
    			}
    			else
    			{
	    			$this->session->set_flashdata('resetpass_error','Invalid Username...');
					redirect(base_url().'admin_controller/reset_password_page_cont');
				}
    		}

    	}
}

}

?>