<?php 

class Owner_controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
	  $this->load->library('email');
	  $this->load->library('form_validation');
	  $this->load->helper('file');
    $this->load->model('owner_model');
    $this->load->library('phpqrcode/qrlib');
    $this->load->helper('url');
    $this->load->helper('download');
    $this->load->helper('directory');
    $this->load->library('encryption');
  $key = bin2hex($this->encryption->create_key(16));
  $config['encryption_key'] = hex2bin($key);
    $this->encryption->initialize(
        array(
                'cipher' => 'aes-256',
                'mode' => 'ctr',
                'key' => '<a 32-character random string>'
        )
);
    $this->encryption->initialize(array('driver' => 'mcrypt'));

// Switch back to the OpenSSL driver
$this->encryption->initialize(array('driver' => 'openssl'));
	}
	public function  index()
	{	
    $this->load->view('user/index');     
 	}
public function ownerlogin_cont()
{

  $unm=$this->input->post("username");
      $pass=$this->input->post("password");
      $pass1=md5($pass);
      $loginid = $this->owner_model->ownerlogin_mdl($unm,$pass1);
      if($loginid)
      {
        $this->session->set_userdata('id',$loginid);
       redirect(base_url().'owner_controller/showowner_cont');
        
      }
      else
      {
        $this->session->set_flashdata('loginfailed','Username And Password Not Matched...'); 
        redirect(base_url().'owner_controller/index');
        
      }
}
/*show owner info*/
public function showowner_cont()
  {
    if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $id=$this->session->userdata('id');

 if($this->owner_model->getusertype_mdl($id))
  {
    $data['usertype']=$this->owner_model->getusertype_mdl($id);
  }
    
    $this->load->view('user/client_view',$data);

  }
 
	public function registration_view()
  {
      if($this->owner_model->getcity_mdl())
      {
        $data['city'] = $this->owner_model->getcity_mdl();
      }
      if($this->owner_model->getwing_mdl())
      {
         $data['wing'] = $this->owner_model->getwing_mdl();
      }
        $this->load->view('user/owner_view',$data); 
  }

      public function fillhome_cont()
      {
      	$wing_id=$this->input->post('wing_id');
      	$home=$this->owner_model->fillhome_mdl($wing_id);
      	if(count($home) > 0)
      	{

      			$home_select_box = '';
      			$home_select_box .= '<option value="">select_home_no</option>';

      		foreach ($home as $homeno) {
      			$home_select_box .= '<option value="'.$homeno->home_id.'">'.$homeno->home_no.'</option>';

      		}
      		echo json_encode($home_select_box);
      	}

      }




 public function register_cont()
 {    
   $this->form_validation->set_rules('file', '', 'callback_file_check');

            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/owner/';
                $config['allowed_types'] = 'jpeg|png|jpg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload('file'))
                {
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    
                     $users=array();
          $user_type=array();
          $user['firstname']=$this->input->post("firstname");
          $user['lastname']=$this->input->post("lastname");
          $user['username']=$this->input->post("username");
          $pass=$this->input->post("password");
          $user['password']=md5($pass);
          $user['email']=$this->input->post("email");
          $user['gender']=$this->input->post("gender");
          $user['age']=$this->input->post("age");
          $user['mobile_no']=$this->input->post("mobile_no");
          $user['land_line_no']=$this->input->post("land_line_no");
          $user['wing_id']=$this->input->post("wing_no");
          $user['home_id']=$this->input->post("home_no");
          $user['city_id']=$this->input->post("city");
          $user['address']=$this->input->post("address");
          $user['pic']=$_FILES['file']['name'];
          $pic1=$user['pic'];
          $user['added_on']=date('Y-m-d');
          $user['added_by']="owner";
          $user['is_resident']="yes";
          $wing_id1=$user['wing_id'];
          $home_id1=$user['home_id'];
          $username=$user['username'];
          $user['status']=1;
          

          /*user type table*/
          $user_type['user_type']="owner";
          $user_type['added_on']=date('Y-m-d');
          $user_type['added_by']="owner";
          $img_size=$_FILES['file']['size'];
          $flag=0;
          if($this->owner_model->already_exist($wing_id1,$home_id1))
          { 
                
                  $this->session->set_flashdata('wing_home','This Home Number Is Already Registered...');
                  $flag=1;
                
         }
         if($this->owner_model->already_exist_username($username))
         {
                  $this->session->set_flashdata('username','This Username Is Already Exist...');
                  $flag=1;
         }


          if($flag ==  1 )
          {
            redirect(base_url().'owner_controller/registration_view');
          }
          else
          {
          $insert_user=$this->owner_model->registration_mdl($user,$user_type);
              if($insert_user > 0)
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
        $mail->Body    = '<html><head></head><body><div style="background-color:#DBDBDB;padding:50px;"><img src="cid:my-attach" height="150px" width="150px" /><hr><p style="color:black">Dear&nbsp;&nbsp;'.$username.',<br><br>Welcome to Pratha Apartment Management System.<br><br>Please Wait for confirmation Mail from Admin.<br><br>
         <br><center><h2>Thank You</h2>Pratha Apartment Management Copyright © 2018<br>All Rights Reserved</center></p></div></body></html>';


         if(!$mail->send()) {
             echo 'Message could not be sent.';
             echo 'Mailer Error: ' . $mail->ErrorInfo;
         } 
         else
         { 
             $this->session->set_flashdata('addguard','Registration Successfull...');
             redirect(base_url().'owner_controller/registration_view');
         }
                

              }
        
             
            }
                    }
                else
                {
                  $data1 = $this->upload->display_errors();
                  $this->session->set_flashdata('image_error',$data1);
                  redirect(base_url().'owner_controller/registration_view');

               // 

                }
            }

 }


 public function file_check($str)
 {
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

public function myunitlist_cont()
{
  if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $id=$this->session->userdata('id');
    if($this->owner_model->getusertype_mdl($id))
    {
    $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }

    //jinal
    if($this->owner_model->maintanance_mdl($id))
    {
    $data['maintanance']=$this->owner_model->maintanance_mdl($id);
    }
    if($this->owner_model->booking_unpaid_mdl($id))
    {
    $data['booking_unpaid']=$this->owner_model->booking_unpaid_mdl($id);
    }
    if($this->owner_model->booking_unpaid_penalty_mdl($id))
    {
    $data['booking_unpaid_penalty']=$this->owner_model->booking_unpaid_penalty_mdl($id);
    }
    if($this->owner_model->revenue_unpaid_mdl($id))
    {
    $data['revenue_unpaid']=$this->owner_model->revenue_unpaid_mdl($id);
    }
    if($this->owner_model->getusertype_mdl($id))
    {
      $wingg_id=$this->owner_model->getusertype_mdl($id);
      if($wingg_id)
      {
        foreach($wingg_id as $w)
        {
          $wing_id = $w->wing_id;
        }
      }
    }
    if($this->owner_model->getusertype_mdl($id))
    {
      $homee_id=$this->owner_model->getusertype_mdl($id);
      if($homee_id)
      {
        foreach($homee_id as $h)
        {
          $home_id = $h->home_id;
        }
      }
    }

  if($this->owner_model->display_visiter_mdl($wing_id,$home_id))
    {
      $data['visiter']=$this->owner_model->display_visiter_mdl($wing_id,$home_id);
    }
    
    $this->load->view('user/myunitlist_index',$data);

}

/*load view for add*/

public function addmember_cont()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $id=$this->session->userdata('id');
    if($this->owner_model->getusertype_mdl($id))
    {
    $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
    if($this->owner_model->emergency_status_mdl($id))
    {
    $data['emergency_count']=$this->owner_model->emergency_status_mdl($id);
    }
    else
    {
      $data['emergency_count']=$this->owner_model->emergency_status_mdl($id); 
    }
    $emergency_count1=$this->owner_model->emergency_status_mdl($id);
     if($emergency_count1 <= 1 )
     {

     }
     else
    {
      $this->session->set_flashdata('emergency','You Already Add 2 Emergency Contact So You Can Not Add More Emeregency Contact...');
    }
    $this->load->view('user/addmember_index',$data);


}
/*add member in database*/
public function add_cont()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $member=array();
     $id=$this->session->userdata('id');
    $emergency_count=$this->owner_model->emergency_status_mdl($id);

                    if($emergency_count <= 1)
                    {
                   
                    $member['user_id']=$id;
                    $member['firstname']=$this->input->post("firstname");
                    $member['lastname']=$this->input->post("lastname");
                    $member['gender']=$this->input->post("gender");
                    $member['mobile_no']=$this->input->post("mobile_no");
                    $member['pic']=$_FILES['file']['name'];
                    $pic= $member['pic'];
                    $member['member_type']=$this->input->post("member_type");
                    $emer = $this->input->post("emergency_status"); 
                    if($emer=="")
                    {
                      $member['emergency_status']='no';
                     
                    }
                    else
                    {
                       $member['emergency_status']=$this->input->post("emergency_status");
                    }
                    $member['added_on']=date('Y-m-d');
                    $member['added_by']="owner";
                    $member['status']=1;
                  }
                  else
                  {

                    $member['user_id']=$id;
                    $member['firstname']=$this->input->post("firstname");
                    $member['lastname']=$this->input->post("lastname");
                    $member['gender']=$this->input->post("gender");
                    $member['mobile_no']=$this->input->post("mobile_no");
                    $member['pic']=$_FILES['file']['name'];
                    $pic= $member['pic'];
                    $member['member_type']=$this->input->post("member_type");
                    $member['emergency_status']="no";
                    $member['added_on']=date('Y-m-d');
                    $member['added_by']="owner";
                    $member['status']=1;


                  }
                  $this->form_validation->set_rules('file', '', 'callback_file_check');
      if(file_exists('img/owner/member/'.$pic))
            {
                   
                    $addmember=$this->owner_model->addmember_mdl($member);

                    if($addmember)
                    {

                     $this->session->set_flashdata('add_member','Member Added Successfully...');                      
                     redirect(base_url().'owner_controller/display_memberlist_cont');
                    }
                    else
                    {
                       $this->session->set_flashdata('add_member','Member Not Added Successfully...');                      
                     redirect(base_url().'owner_controller/display_memberlist_cont');
                    }
            }

            


            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/owner/member/';
                $config['allowed_types'] = 'jpeg|png|jpg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload('file'))
                {
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];

                   
                    $addmember=$this->owner_model->addmember_mdl($member);

                    if($addmember > 0)
                    {
                      $this->session->set_flashdata('add_member','Member Added Successfully...');                      
                     redirect(base_url().'owner_controller/display_memberlist_cont');
                    }
                    else
                    {

                      $this->session->set_flashdata('add_member','Member Not Added Successfully...');                      
                     redirect(base_url().'owner_controller/display_memberlist_cont');
                    }

     }
                else
                {
                  $data1 = $this->upload->display_errors();
                  $this->session->set_flashdata('image_error',$data1);
                  redirect(base_url().'owner_controller/addmember_cont');

               // 

                }
            }

 }

public function display_memberlist_cont()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  $id=$this->session->userdata('id');
    $data['usertype']=$this->owner_model->getusertype_mdl($id);
    /*delete logic*/
    if($this->input->get('id'))
    {
      $del_id=$this->input->get('id');
      
    $delete_member=$this->owner_model->delete_member_mdl($del_id);
    if($delete_member)
    {

      $this->session->set_flashdata('delete_member','Member Deleted Successfully...');
      redirect(base_url().'owner_controller/display_memberlist_cont');
    }
  }
    if($this->owner_model->display_member_mdl($id))
    {
    $data['members']=$this->owner_model->display_member_mdl($id);
    }
    $this->load->view('user/memberlist_index',$data);
}
public function update_member_cont()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $id=$this->session->userdata('id');
    if($this->owner_model->getusertype_mdl($id))
    {
    $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
    if($this->input->get('id'))
    {
      $mid=$this->input->get('id');
     
      
      if($this->owner_model->update_member_mdl($mid))
      {
      $data['update_member']=$this->owner_model->update_member_mdl($mid);
      }
    }
    if($this->owner_model->emergency_status_mdl($id))
    {
     $data['emergency_count']=$this->owner_model->emergency_status_mdl($id);
    }
    else
    {
      $data['emergency_count']=$this->owner_model->emergency_status_mdl($id);
    }
     $emergency_count1=$this->owner_model->emergency_status_mdl($id);
     if($emergency_count1 <= 1 )
     {

     }
     else
    {
      $this->session->set_flashdata('emergency','You Already Add 2 Emaergency Contact So You Can Not Add More Emeregency Contact');
    }

    $yes_no_status=$this->owner_model->yes_no_mdl($mid);
    if($yes_no_status)
    {
      $data['yes']='yes';
    }
    $this->load->view('user/update_member',$data);
}
/*update member record in database*/

public function update_record_cont()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $member=array();
    $mid=$this->input->post('mid');
     $id=$this->session->userdata('id');
     $pic=$_FILES['file']['name'];
                    if($pic == "")
                        {
                          $pic=$this->input->post('updatepic');
                        }
                        else
                        {
                          $pic=$_FILES['file']['name'];
                        }


                          $emergency_count=$this->owner_model->emergency_status_mdl($id);
                         if($emergency_count <= 1)
                    {
                       
                        $member['user_id']=$id;
                        $member['firstname']=$this->input->post("firstname");
                        $member['lastname']=$this->input->post("lastname");
                        $member['gender']=$this->input->post("gender");
                        $member['mobile_no']=$this->input->post("mobile_no");
                        $member['pic']=$pic;
                        $member['member_type']=$this->input->post("member_type");
                        $member['emergency_status']=$this->input->post("emergency_status");
                        $member['modified_on']=date('Y-m-d');
                        $member['modified_by']="owner";
                  }
                  else
                  {

                        $member['user_id']=$id;
                        $member['firstname']=$this->input->post("firstname");
                        $member['lastname']=$this->input->post("lastname");
                        $member['gender']=$this->input->post("gender");
                        $member['mobile_no']=$this->input->post("mobile_no");
                        $member['pic']=$pic;
                        $member['member_type']=$this->input->post("member_type");
                    if($this->owner_model->getemergency_status_update_mdl($mid))
                    {
                      $e=$this->owner_model->getemergency_status_update_mdl($mid);
                      if($e)
                      {
                        $member['emergency_status']="yes";
                      }
                      else
                      {
                        $member['emergency_status']="no";
                      }
                    }
                    
                    $member['modified_on']=date('Y-m-d');
                    $member['modified_by']="owner";


                  }
  

            $this->form_validation->set_rules('file', '', 'callback_file_check');

            if(file_exists('img/owner/member/'.$pic))
            {
                    $updaterecord=$this->owner_model->update_record($mid,$member);

                    if($updaterecord)
                    {

                     $this->session->set_flashdata('update_member','Member Updated Successfully...');                      
                     redirect(base_url().'owner_controller/display_memberlist_cont');
                    }
                    else
                    {
                       $this->session->set_flashdata('update_member','Member Update Not Successfully...');                      
                     redirect(base_url().'owner_controller/display_memberlist_cont');
                    }
            }
            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/owner/member/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload('file'))
                {
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    $pic=$_FILES['file']['name'];
                   
                   
                    $updaterecord=$this->owner_model->update_record($mid,$member);
                    


                    if($updaterecord)
                    {
                     $this->session->set_flashdata('update_member','Member Updated Successfully...');                      
                     redirect(base_url().'owner_controller/display_memberlist_cont');
                    }
                
                    else
                    {
                      $this->session->set_flashdata('update_member','Member Not Updated Successfully...');                      
                     redirect(base_url().'owner_controller/display_memberlist_cont');
                    }
                    

                }
                else
                {
                  $data1 = $this->upload->display_errors();
                  $this->session->set_flashdata('image_error',$data1);
                  redirect(base_url().'owner_controller/update_member_cont?id='.$mid);

                }
            }

}
public function vehicle_list_cont()
{
     if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $id=$this->session->userdata('id');
    if($this->owner_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
    if($this->owner_model->vehicle_list_mdl($id))
    {
        $data['vehicle']=$this->owner_model->vehicle_list_mdl($id);
    }
    if($this->input->get('id'))
    {
      $del_id=$this->input->get('id');
      $vehicle = array(
        'status' => 0,
      );
       $delete_vehicle=$this->owner_model->delete_vehicle_mdl($vehicle,$del_id);
        if($delete_vehicle)
        {
          $this->session->set_flashdata('delete_vehicle','Vehicle Deleted Successfully...');
          redirect(base_url().'owner_controller/vehicle_list_cont');
        }
    }
      
    $this->load->view('user/vehicle_list',$data);

}

public function addvehicle_cont()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    if($this->session->userdata('id'))
    {
    $id=$this->session->userdata('id');
    }
        if($this->owner_model->getusertype_mdl($id))
    {
    $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
        if($this->owner_model->wing_vehicle_mdl($id))
    {
         $data['wing_name']=$this->owner_model->wing_vehicle_mdl($id);
    }
    //latest
  /*  if($this->owner_model->oldwing_mdl($$id))
  {
    $oldwing=$this->owner_model->oldwing_mdl($id);
        if($oldwing)
        {
            $data['wing']=$oldwing->wing_name;
            $get_oldwing=$data['wing'];
        }

  }*/
  
  if($this->owner_model->getall_slotnumber())
  {
    $data['all_slot']=$this->owner_model->getall_slotnumber();
  }
  else
  {
     $data['all_slot']=$this->owner_model->getall_slotnumber();
  }
  if($this->owner_model->getall_all_slotnumber())
  {
    $data['all_all_slot']=$this->owner_model->getall_all_slotnumber();
  }
  else
  {
     $data['all_all_slot']=$this->owner_model->getall_all_slotnumber();
  }

//..4 Wheeler   
  if($this->owner_model->getall_slotnumber1())
  {
    $data['all_slot1']=$this->owner_model->getall_slotnumber1();
  }
  else
  {
     $data['all_slot1']=$this->owner_model->getall_slotnumber1();
  }

  if($this->owner_model->getall_all_slotnumber1())
  {
    $data['all_all_slot1']=$this->owner_model->getall_all_slotnumber1();
  }
  else
  {
     $data['all_all_slot1']=$this->owner_model->getall_all_slotnumber1();
  }
 // print_r($data);


  /*if($this->owner_model->get_oldslotvehicleid_mdl())
             {
               $data['get_oldslot']=$this->owner_model->get_oldslotvehicleid_mdl();
                
             }
   if($this->owner_model->get_oldslotvehicleid_mdl1())
             {
                $data['get_oldslot1']=$this->owner_model->get_oldslotvehicleid_mdl1();
               
             }    */       
            
    $this->load->view('user/addvehicle',$data);
}

public function add_vehicle_cont()
{      
 if(! $this->session->userdata('id'))
      return redirect('owner_controller');     
  if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }
  $wing_name=$this->input->post('wing_name');
  
if($this->input->post('vehicle_type') == "2-wheeler")
{
 // $vehicle_id=$this->input->post('vehicle_id');
  if($this->input->post('same_wing')!= "")
  {
    $slot_no1=$this->input->post('same_wing');
    $this->owner_model->delete_oldslot_mdl($slot_no1);
    echo $slot_no1;
  }
  else
  {
    $count = $this->input->post('count');
    if($count <=3)
    {
        $count++;
        $slot_no1 = $wing_name.'-'.$count;
        echo $slot_no1;
    }
    else
    {
      $this->session->set_flashdata('add_vehicle','No Parking Slot Availabel For 2 Wheeler...');          
      redirect(base_url().'owner_controller/addvehicle_cont');
    }
  }
}


  if($this->input->post('vehicle_type') == "4-wheeler")
{
 // $vehicle_id=$this->input->post('vehicle_id');

  if($this->input->post('same_wing2')!= "")
  {
    $slot_no1=$this->input->post('same_wing2');
    $this->owner_model->delete_oldslot_mdl($slot_no1);
    echo $slot_no1;
  }
  else
  {
    $count2 = $this->input->post('count22');
    if($count2 <=3)
    {
        $count2++;
        $slot_no1 = $wing_name.$wing_name.'-'.$count2;
        echo $slot_no1;
    }
    else
    {
      $this->session->set_flashdata('add_vehicle','No Parking Slot Availabel For 4 Wheeler...');          
      redirect(base_url().'owner_controller/addvehicle_cont');
    }
  }
}



$vehicle=array();
                    $vehicle['vehicle_no']=$this->input->post("vehicle_no");
                    $vehicle['user_id']=$id;
                    $vehicle['vehicle_type']=$this->input->post("vehicle_type");
                    $vehicle['slot_no']=$slot_no1;
                    $vehicle['sticker_no']=$slot_no1;                   
                    $vehicle['added_on']=date('Y-m-d');
                    $vehicle['added_by']="owner"; 
                    $vehicle['status']=1;
                   

                   $addvehicle=$this->owner_model->add_vehicle_mdl($vehicle);

                    if($addvehicle)
                    {

                     $this->session->set_flashdata('add_vehicle','Add Vehicle Successfully...');                      
                     redirect(base_url().'owner_controller/vehicle_list_cont');
                    }
                    else
                    {
                       $this->session->set_flashdata('add_vehicle','Add Vehicle Successfully...');                      
                       redirect(base_url().'owner_controller/vehicle_list_cont');
                    }
  
                            
                
 
 }


public function staff_list_cont()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $id=$this->session->userdata('id');
    if($this->owner_model->getusertype_mdl($id))
    {
    $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
   if($this->input->get('id'))
    {
    $del_id = $this->input->get('id');
    $delete_staff=$this->owner_model->delete_staff_mdl($del_id);
    if($delete_staff)
    {
      $this->session->set_flashdata('delete_staff','Staff Deleted Successfully...');
      redirect(base_url().'owner_controller/staff_list_cont');
    }
  }
    if($this->owner_model->staff_list_mdl($id))
    {
    $data['staff']=$this->owner_model->staff_list_mdl($id);
    }
    $this->load->view('user/staff_list',$data);
}

public function add_staff_cont()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $id=$this->session->userdata('id');
    if($this->owner_model->getusertype_mdl($id))
    {
    $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
    $this->load->view('user/add_staff',$data);
}

public function addstaff_cont()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
   $id=$this->session->userdata('id');
   $staff=array();
   $staff['user_id']=$id;
   $staff['firstname']=$this->input->post('firstname');
   $fname= $staff['firstname'];
   $staff['lastname']=$this->input->post('lastname');
   $staff['gender']=$this->input->post('gender');
   $staff['address']=$this->input->post('address');
   $staff['mobile_no']=$this->input->post('mobile_no');
   $mobile=$staff['mobile_no'];

   $staff['vehicle_no']=$this->input->post('vehicle_no');
   $staff['category']=$this->input->post('categorytype');
   $cat = $staff['category']; 
   $staff['pic']=$_FILES['file']['name'];
   $staff['added_on']=date('Y-m-d');
   $staff['added_by']='owner';
   $staff['status']=1;
   $pic=$staff['pic'];
//qrcode
   $qrtext=$fname.$mobile.$cat;
      //file path for store images
        $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/pratha_ap/img/staffqrcode/';
      $text = $qrtext;
      $text1= substr($text, 0,9);
      
      $folder = $SERVERFILEPATH;
      $file_name1 = $text1."-Qrcode" . rand(2,200) . ".png";
      $file_name = $folder.$file_name1;
      QRcode::png($text,$file_name);
      
   $staff['qrcode']=$file_name1;
   $this->form_validation->set_rules('file', '', 'callback_file_check');
    

         if(file_exists('img/owner/staff/'.$pic))
            {
                    $insert_staff=$this->owner_model->add_staff_mdl($staff);

                    if($insert_staff)
                    {
                      $this->session->set_flashdata('add_staff','Staff Added Successfully...'); 
                     redirect(base_url().'owner_controller/staffqrcode_cont');
                    }
                    else
                    {
                      $this->session->set_flashdata('add_staff','Staff Not Added Successfully...'); 
                     //redirect(base_url().'owner_controller/staff_list_cont');
                    }
            }
            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/owner/staff/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload('file'))
                {
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    $pic=$_FILES['file']['name'];
                    $addrecord=$this->owner_model->add_staff_mdl($staff);


                    if($addrecord)
                    {
                     $this->session->set_flashdata('add_staff','Staff Added Successfully...'); 
                     redirect(base_url().'owner_controller/staffqrcode_cont');
                    }
                    else
                    {
                      $this->session->set_flashdata('add_staff','Staff Not Added Successfully...'); 
                     redirect(base_url().'owner_controller/staffqrcode_cont');
                    }

                   }
                else
                {
                  $data1 = $this->upload->display_errors();
                  $this->session->set_flashdata('image_error',$data1);
                  redirect(base_url().'owner_controller/add_staff_cont');

                }
            }

}

public function staffqrcode_cont()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $id=$this->session->userdata('id');
    if($this->owner_model->getusertype_mdl($id))
    {
    $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
   
    if($this->owner_model->staffqrcode_mdl($id))
    {
    $data['staffqrcode']=$this->owner_model->staffqrcode_mdl($id);
    }
    $this->load->view('user/staffqrcode',$data);

}
/*fill update record*/
public function update_staff_cont()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $id=$this->session->userdata('id');
    if($this->input->get('id'))
    {
     $sid=$this->input->get('id');
      if($this->owner_model->update_staff_mdl($sid))
    {
      $data['staff']=$this->owner_model->update_staff_mdl($sid); 
    }
    }

     if($this->owner_model->getusertype_mdl($id))
     {
      $data['usertype']=$this->owner_model->getusertype_mdl($id);
     }
   
    $this->load->view('user/update_staff',$data);
}
/*update record*/
public function updatestaff_cont()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $staff=array();
    $sid=$this->input->post('sid');
     $id=$this->session->userdata('id');
     $pic=$_FILES['file']['name'];
                    if($pic == "")
                        {
                          $pic=$this->input->post('updatepic');
                        }
                        else
                        {
                          $pic=$_FILES['file']['name'];
                        }
               $staff['user_id']=$id;
               $staff['firstname']=$this->input->post('firstname');
               $staff['lastname']=$this->input->post('lastname');
               $staff['gender']=$this->input->post('gender');
               $staff['address']=$this->input->post('address');
               $staff['mobile_no']=$this->input->post('mobile_no');
               $staff['vehicle_no']=$this->input->post('vehicle_no');
               $staff['category']=$this->input->post('categorytype');
               $staff['pic']=$pic;
               $staff['modified_on']=date('Y-m-d');
               $staff['modified_by']='owner';

 $this->form_validation->set_rules('file', '', 'callback_file_check');

            if(file_exists('img/owner/staff/'.$pic))
            {
                    $updaterecord=$this->owner_model->updatestaff_mdl($sid,$staff);

                    if($updaterecord)
                    {

                     $this->session->set_flashdata('update_staff','Staff Updated Successfully...'); 
                     redirect(base_url().'owner_controller/staff_list_cont');
                    }
                    else
                    {
                      $this->session->set_flashdata('update_staff','Staff Not Updated Successfully...'); 
                      redirect(base_url().'owner_controller/staff_list_cont');
                    }
            

              }
            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/owner/staff/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload('file'))
                {
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    $pic=$_FILES['file']['name'];
                   
                   
                    $updaterecord=$this->owner_model->updatestaff_mdl($sid,$staff);


                    if($updaterecord)
                    {
                     $this->session->set_flashdata('update_staff','Staff Updated Successfully...'); 
                      redirect(base_url().'owner_controller/staff_list_cont');
                    }
                    else
                    {
                      $this->session->set_flashdata('update_staff','Staff Not Updated Successfully...'); 
                      redirect(base_url().'owner_controller/staff_list_cont');
                    }

                   }
                else
                {
                  $data1 = $this->upload->display_errors();
                  $this->session->set_flashdata('image_error',$data1);
                  redirect(base_url().'owner_controller/update_staff_cont?id='.$sid);

                }
            }
          
          }
          //register tenant 


   public function add_tenant_cont()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    if($this->session->userdata('id'))
    {
       $id=$this->session->userdata('id');
    }
   
    if($this->owner_model->getusertype_mdl($id))
    {
    $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
     if($this->owner_model->getcity_mdl())
      {
        $data['city'] = $this->owner_model->getcity_mdl();
      }
      if($this->owner_model->getwing_mdl())
      {
         $data['wing'] = $this->owner_model->getwing_mdl();
      }
       if($this->owner_model->getwing_mdl())
      {
         $data['home_no'] = $this->owner_model->gethome_no_mdl($id);
      }
      
    $this->load->view('user/add_tenant',$data);


}

 public function register_tenat_cont(){

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');

        $users=array();
          $user_type=array();
          $user['firstname']=$this->input->post("firstname");
          $user['lastname']=$this->input->post("lastname");
          $user['username']=$this->input->post("username");
          $pass=$this->input->post("password");
          $user['password']=md5($pass);
          $user['email']=$this->input->post("email");
          $user['gender']=$this->input->post("gender");
          $user['age']=$this->input->post("age");
          $user['mobile_no']=$this->input->post("mobile_no");
          $user['land_line_no']=$this->input->post("land_line_no");
          $user['wing_id']=$this->input->post("wing_no");
          $user['home_id']=$this->input->post("home_no");
          $user['city_id']=$this->input->post("city");
          $user['address']=$this->input->post("address");
          $user['pic']=$_FILES['file']['name'];
          $pic1=$user['pic'];
          $user['added_on']=date('Y-m-d');
          $user['added_by']="owner";
          $user['is_resident']="yes";
          $user['status']=1;
          $user['approve_status']=1;
          $username=$user['username'];

          if($this->session->userdata('id'))
          {
             $id=$this->session->userdata('id');
          }
   
          $user['owner_id']=$id;
          $owner_id=$user['owner_id'];
          

          /*user type table*/
          $user_type['user_type']="tenant";
          $user_type['added_on']=date('Y-m-d');
          $user_type['added_by']="owner";
          $img_size=$_FILES['file']['size'];
          $flag=0;
          
         if($this->owner_model->already_exist_username($username))
         {
                  $this->session->set_flashdata('username','This Username Is Already Exist...');
                  $flag=1;
         }
          if($this->owner_model->already_tenant_mdl($owner_id))
           {
             $this->session->set_flashdata('already_tenant','You Already Add Tenant...');
              $flag=2;
           }

            $this->form_validation->set_rules('file', '', 'callback_file_check');

  
       
            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/owner/';
                $config['allowed_types'] = 'gif|png|jpg|pdf';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload('file'))
                {
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    
                     
          if($flag ==  1 )
          {
            redirect(base_url().'owner_controller/add_tenant_cont');
          }
           if($flag ==  2 )
          {
            redirect(base_url().'owner_controller/add_tenant_cont');
          }
          else
          {

          $insert_user=$this->owner_model->registration_mdl($user,$user_type);
              if($insert_user > 0)
              {
                 //update status yes with no in users table
                  $user = array(
                  'is_resident' => 'no',
                  );
                $is_reident_update_no=  $this->owner_model->is_resident_update_yesno_mdl($id,$user);
                //delete vehicle and member of owner as soon as add his tenant
                $vehicle=array('status' => 0,
              );
                $delete_vehicle=$this->owner_model->delete_vehicle_owner_mdl($id,$vehicle);
                $member=array('status' => 0,
              );
                $delete_member=$this->owner_model->delete_member_owner_mdl($id,$member);

                $staff=array('status' => 0,
              );
                $delete_staff=$this->owner_model->delete_staff_owner_mdl($id,$staff); 
                $delete_issue=$this->owner_model->delete_issue_owner_mdl($id);

                 $wing_id=$this->input->post("wing_no");
                 $home_id=$this->input->post("home_no");
                $delete_visiter=$this->owner_model->delete_visiter_owner_mdl($wing_id,$home_id); 

                require 'PHPMailer/PHPMailerAutoload.php';
        $email = $this->input->post('email');
        $parts = explode("@", $email);
        $username1 = $parts[0];
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
        $mail->Body    = '<html><head></head><body><div style="background-color:#DBDBDB;padding:50px;"><img src="cid:my-attach" height="150px" width="150px" /><hr><p style="color:black">Dear&nbsp;&nbsp;'.$username1.',<br><br>Welcome to Pratha Apartment Management System.<br><br>Your Username and Password is below!<br><br>
         Username : '.$username.'<br>
         Password : '.$pass.'<br><br>Login with this username and password and change it.<br><br>
         In order to Login, click the link below:<br><br>
 <a href="'.base_url().'front_controller/index">Pratha Apartment</a>
         <br><center><h2>Thank You</h2>Pratha Apartment Management Copyright © 2018<br>All Rights Reserved</center></p></div></body></html>';


         if(!$mail->send()) {
             echo 'Message could not be sent.';
             echo 'Mailer Error: ' . $mail->ErrorInfo;
         } 
         else
         { 
              $this->session->set_flashdata('add_tenant','Add Tenant Successfully...');
                redirect(base_url().'owner_controller/view_tenant_cont');
         }
               
              }
        
            }
                    }
                else
                {
                  $data1 = $this->upload->display_errors();
                  $this->session->set_flashdata('image_error',$data1);
                  redirect(base_url().'owner_controller/add_tenant_contadd');

               // 

                }
            }
        
        
        //load the view
 }

 public function view_tenant_cont()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }

    if($this->owner_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
    if($this->owner_model->view_tenant_mdl($id))
    {
        $data['tenant']=$this->owner_model->view_tenant_mdl($id);
    }

    if($this->input->get('id'))
    {
      $del_id=$this->input->get('id');
       $vehicle = array(
            'status' => 0,
        );
          $delete_vehicle=$this->owner_model->delete_vehicle_owner_mdl($del_id,$vehicle);
         $tenant = array(
        'status' => 0,
        'approve_status'=> 1,
        'modified_on' => date('Y-m-d'),
        'modified_by' =>'owner',
      );
       $delete_tenant=$this->owner_model->delete_tenant_mdl($tenant,$del_id);

        if($delete_tenant)
        {

          $user = array(
                  'is_resident' => 'yes',
                  );
                $is_resident_update_noyes=  $this->owner_model->is_resident_update_noyes_mdl($id,$user);
                
                $member=array('status' => 1,
              );
                $delete_member=$this->owner_model->delete_member_owner_mdl($id,$member);

                $staff=array('status' => 1,
              );
                $delete_staff=$this->owner_model->delete_staff_owner_mdl($id,$staff); 
                if($is_resident_update_noyes)
                {
                  $this->session->set_flashdata('delete_tenant','Tenant Deleted Successfully...');
                }
                else
                {
                  $this->session->set_flashdata('delete_tenant','Tenant Not Deleted Successfully...');
                }
          redirect(base_url().'owner_controller/display_memberlist_cont');
        }
    }
      
    $this->load->view('user/view_tenant',$data);

}


public function view_old_tenant_cont()
{
  if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }

    if($this->owner_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
    if($this->owner_model->view_old_tenant_mdl($id))
    {
        $data['old_tenant']=$this->owner_model->view_old_tenant_mdl($id);
    }
    $this->load->view('user/view_old_tenant',$data);
}

public function count_total_member_cont()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
   if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }

  $total_member=$this->owner_model->count_total_member_mdl($id);
  
}

//book facility aayathi aapvanu
public function bookfacility_list_cont()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }

    if($this->owner_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
    if($this->owner_model->bookfacility_list_mdl())
    {
        $data['facility']=$this->owner_model->bookfacility_list_mdl();
    }
     $this->load->view('user/bookfacility_list',$data);

}

public function bookfacility_page_cont()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }

    if($this->owner_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
    } 
    if($this->input->get('id'))
    {
      $fid=$this->input->get('id');
    }
      if($this->owner_model->getfacility_name_mdl($fid))
    {
      $data['facility']=$this->owner_model->getfacility_name_mdl($fid); 
     
    }
   
    $this->load->view('user/bookfacility',$data);
}

public function bookfacility_cont()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
   if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }

    if($this->owner_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
    } 
    $charge=$this->input->post('charge');
    $time=$this->input->post('timeslot');
    $time1=explode('-',$time );
    $totime=$time1[0];
    //echo $totime;
    @$fromtime=$time1[1];

    $hour=explode(':',$totime);
    $hour1=explode(':',$fromtime);
    $a=$hour[0];
    $b=$hour1[0];
    if($a == 12 )
    {
      $h=$b;
    }
    else
    {
      @$h=abs($a-$b);
    }
    
    $totalcharge1=$charge*$h;
    $result='';
    $result .= $totalcharge1;
    echo json_encode($result);
  
}

public function bookfacility_record_cont()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
   if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }
  
    $book['user_id']=$id;
    $book['facility_id']=$this->input->post('facility_id');
    $book['book_date'] = $this->input->post('bookdate');
    $book['time_slot'] = $this->input->post('time');
    $book['total_charge'] = $this->input->post('totalcharge');
    $book['added_on']=date('Y-m-d');
    $book['added_by']='user';
    $book['status']=1;
    $time_slot= $book['time_slot'];
    $book_date= $book['book_date'];
    $facility_id=$book['facility_id'];
    $flag=0;
//$date1=date('Y-m-d', strtotime(' + 1 days'));
       if ($book_date <=  date('Y-m-d'))
         {
                  $this->session->set_flashdata('book_error','Please, Book Facility One Day Advance...');
                  redirect(base_url().'owner_controller/bookfacility_page_cont?id='.$facility_id);
                  $flag=1;
         }
          if($this->owner_model->already_book_facility($time_slot,$book_date,$facility_id))
          { 
                
                  $this->session->set_flashdata('book_error','This Facility Is Already Booked...');
                  redirect(base_url().'owner_controller/bookfacility_page_cont?id='.$facility_id);
                  $flag=1;
         }
         if($flag==0)
         {
         
      $book_facility=$this->owner_model->bookfacility_record_mdl($book);

         if($book_facility)
         {
            $this->session->set_flashdata('book_facility','Book Facility Successfully...'); 
            redirect(base_url().'owner_controller/bookinghistory_page_cont');
         }
         else
         {
           $this->session->set_flashdata('book_facility','Book Facility Not Successfully...'); 
           redirect(base_url().'owner_controller/bookinghistory_page_cont');
         }
       
      }
      
               
}
public function bookinghistory_page_cont()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
   if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }

    if($this->owner_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
    } 
    if($this->owner_model->bookinghistory_mdl($id))
    {
    $data['book_history']=$this->owner_model->bookinghistory_mdl($id);
    }
    if($this->input->get('id'))
    {
      $id=$this->input->get('id');
      $facility=array(
        'status' => 0,
        'penalty' => 100,
      );
      print_r($facility);
    
    $delete_facility=$this->owner_model->delete_facility_mdl($id,$facility);
    if($delete_facility)
    {
      //$this->owner_model->penalty_gacility_mdl();
      $this->session->set_flashdata('delete_facility','Facility Cancel Successfully...');
      redirect(base_url().'owner_controller/bookinghistory_page_cont');
    }
  }
  

    $this->load->view('user/bookinghistory',$data);
}
public function directorylist_cont()
{
  
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
   if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }

    if($this->owner_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
    } 
    if($this->owner_model->directorylist_mdl())
    {
    $data['directory_list']=$this->owner_model->directorylist_mdl();
  //  print_r($data['directory_list']);
    }
     $this->load->view('user/directory_list',$data);
}

public function venderlist_cont()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  
   if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }

    if($this->owner_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
    } 
    if($this->owner_model->venderlist_mdl())
    {
    $data['vender_list']=$this->owner_model->venderlist_mdl();
  //  print_r($data['directory_list']);
    }
     $this->load->view('user/vender_list',$data);
}


//notification for booking facility

public function fetch_notification()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }

  if(isset($_POST["view"]))
  {
  if($_POST["view"] != '')
  {
    $read = array(
      'approve_disapprove_status' => 0,
    );

    $read_issue = array(
      'issue_progress_status' => 3,
    );
  $up=$this->owner_model->read_notification($read);
  $up_issue=$this->owner_model->read_notification_issue($read_issue);
  }
  $sel_q=$this->owner_model->select_notification($id);
  $sel_issue=$this->owner_model->select_notification_issue($id);
  $output='';
  $count_book=count($sel_q);
  $count_issue=count($sel_issue);
  $noti=0;
  if($sel_q)
  {
  if($count_book > 0)
  {
  
    foreach($sel_q as $row)
    {
      $output.='
        <li>
          <a href="#">
          <strong>'.$row->facility_name.'&nbsp;&nbsp;&nbsp;[ booking ]</strong><br />
          <small>'.$row->book_date."&nbsp;&nbsp;&nbsp;&nbsp;".$row->time_slot.'</small><br />
          <small style="color:red;">'.$row->approve_disapprove_msg.'</small>
          </a>
        </li>
      ';
    }
  }
    $noti=1;
  }
  else
  {
 
    $noti=0;

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
          <strong>'.$row1->title.'&nbsp;&nbsp;&nbsp;[ Issue ]</strong><br />
          <small style="color:red;"><p style="color:red;">Issue Solved</p></small>
          </a>
        </li>
      ';
    }
  }
    $noti1=1;
  }
  else
  {
 
    $noti1=2;

  }
  if($noti == 0 && $noti1 == 2)
  {
    $output.='
      <li><a href="#" class="text-bold text-italic">No Notification</a></li>
    ';
  }
  $query1=$this->owner_model->unread_noti($id);
  $query2=$this->owner_model->unread_noti_issue($id);
  $count_b=0;
  $count_i=0;
  $count_b=count($query1);
  $count_i=count($query2);
  $count=$count_b+$count_i;
  $data=array(
    'notification' => $output,
    'unseen_notification' =>$count
  );
  echo json_encode($data);
}
}


public function panicalert_cont()
{

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }
   if($this->owner_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
    } 
   
   if($this->owner_model->panicalert_mdl($id))
   {
   
    $data['member']=$this->owner_model->panicalert_mdl($id);


   }
  
   $this->load->view('user/client_view',$data);
   
  
}
//webcame
/*public function indexpage()
{
  $this->load->view('user/webcame');
}
public function action_cont()
{
  $j=$this->input->get('id');
  echo $j;
  $imagefolder="img/web";
   
        $name = "owner".date('YmdHis').".jpg"; 
        $img=array();
        $img['name']=$name;
        $i=$imagefolder.$name;
 
        
       $file = file_put_contents($i, file_get_contents('php://input') );
       
         $insert=$this->owner_model->insert_record($img);       // this line is for saveing image to database
          
                          //if you want to go for base64 encode than enable this line
       }*/

public function issue_cont()
 {

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  if($this->session->userdata('id'))
  {
    $id=$this->session->userdata('id');
  }
   if($this->owner_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
    } 
    $this->load->view('user/add_issue',$data);

  }
  

  public function show_issue_cont()
  {

   if(! $this->session->userdata('id'))
      return redirect('owner_controller');

     if($this->session->userdata('id'))
      {
        $id=$this->session->userdata('id');
      }
      if($this->owner_model->getusertype_mdl($id))
    {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
    } 
      if($this->owner_model->show_issue_mdl($id))
      {
        $data['issue']=$this->owner_model->show_issue_mdl($id);
      }
      if($this->input->get('id'))
    {
      $del_id=$this->input->get('id');
      $issue = array(
        'status' => 0,
      );
    $delete_issue=$this->owner_model->delete_issue_mdl($issue,$del_id);
    if($delete_issue)
    {
      $this->session->set_flashdata('delete_issue','Issue Deleted Successfully...');
      redirect(base_url().'owner_controller/show_issue_cont');
    }
  }
      $this->load->view('user/show_issue',$data);
  }



  public function add_issue_cont()
  {
     if(! $this->session->userdata('id'))
      return redirect('owner_controller');
     if($this->session->userdata('id'))
      {
        $id=$this->session->userdata('id');
      }
      $issue=array(); 
      $issue['title']=$this->input->post('issue_title');
      $issue['added_on']=$this->input->post('issue_date');
      $issue['discription']=$this->input->post('issue_discription');
      $issue['user_id']=$id;
      $issue['added_by']="user";
      $issue['status']=1;
       $issue['pic']=$_FILES['file']['name'];
       $date=$issue['added_on'];
       if($date > date('Y-m-d'))
       {
            $this->session->set_flashdata('date','Please Select Valid Date...'); 
            redirect(base_url().'owner_controller/issue_cont');

       } 
       $issue['added_by']='owner';
       //$pic=$staff['pic'];




   $this->form_validation->set_rules('file', '', 'callback_file_check');

            
            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/issue/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload('file'))
                {
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    //$pic=$_FILES['file']['name'];
                    
                        $issu=$this->owner_model->add_issue_mdl($issue);
                        if($issu)
                        {
                          $this->session->set_flashdata('send_issue','Send Issue Successfully...'); 
                           //
                           redirect(base_url().'owner_controller/show_issue_cont');
                        }
                        
                       

                   }
                else
                {
                  $data1 = $this->upload->display_errors();
                  $this->session->set_flashdata('image_error',$data1);
                  redirect(base_url().'owner_controller/issue_cont');

                }
            }
  }
  //change password
public function changepassword_cont()
{
      if(! $this->session->userdata('id'))
      return redirect('owner_controller');
      $id=$this->session->userdata('id');
    if($this->owner_model->getusertype_mdl($id))
    {
      $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
      $this->load->view('user/change_password',$data);
}

 public function ownerprofile_cont()
    {
      if(! $this->session->userdata('id'))
      return redirect('owner_controller');
      $cur_pass=$this->input->post('curr_password');

      $n_pass=$this->input->post('password');
      $r_pass=$this->input->post('repassword');
      if($n_pass != $r_pass)
      {
        $this->session->set_flashdata('repassword_error','Retype Password Does Not Matched...');
            redirect(base_url().'owner_controller/changepassword_cont');
      }
      else
      {
        $n_pass1=md5($n_pass);
        $profile = array(
        'password' => $n_pass1,
        );
        $id=$this->session->userdata('id');
        $change_success=$this->owner_model->changeprofile_mdl($id,$profile,$cur_pass,$n_pass);
        if($change_success)
        {
          $this->session->set_flashdata('changepass','Password Changed Successfully...');
        redirect(base_url().'owner_controller/changepassword_cont');
        }
        else
        {
          $new_pass_same=$this->owner_model->changeprofile_same_pass_mdl($id,$n_pass,$cur_pass);
               if($new_pass_same)
               {
                $this->session->set_flashdata('changepass','Password Changed Successfully...');
             redirect(base_url().'owner_controller/changepassword_cont');
               }
               else
               {
                $this->session->set_flashdata('changepass_error','Invalid Current Password...');
             redirect(base_url().'owner_controller/changepassword_cont');
               }  
         }

      }
    } 
//download qrcode
 public function filedl() 
 {   
   if ($this->input->get('filename')) {
    $filename=$this->input->get('filename');
     $data = file_get_contents (base_url('img/staffqrcode/'.$filename));
     force_download ( $filename, $data );
   }

  }

//change pr update profile
public function change_profile_cont()
{

      if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    if($this->session->userdata('id'))
    {
      $id=$this->session->userdata('id');
    }
    if($this->owner_model->getusertype_mdl($id))
    {
      $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
    $this->load->view('user/change_profile',$data);
}

 public function changeprofile_cont()
 {
       if(! $this->session->userdata('id'))
      return redirect('owner_controller');       
    if($this->session->userdata('id'))
    {
      $uid=$this->session->userdata('id');
    }
    $pic=$_FILES['file']['name'];

       if($pic== "")
       {
        $pic=$this->input->post('updatepic');
       }
       else
       {
        $pic=$_FILES['file']['name'];
       }

       $users=array();
                        $user['firstname']=$this->input->post("firstname");
                        $user['lastname']=$this->input->post("lastname");
                        $user['username']=$this->input->post("username");
                        $user['email']=$this->input->post("email");
                        $user['mobile_no']=$this->input->post("mobile_no");
                        $user['pic']=$pic;
                        $user['modified_on']=date('Y-m-d');
                        $user['modified_by']="owner";
                        $username=$user['username'];
                        
            $this->form_validation->set_rules('file', '', 'callback_file_check');
            if(file_exists('img/owner/'.$pic))
            {
                   $update_user=$this->owner_model->change_profile_mdl($user,$uid);
                    if($update_user > 0)
                    {
                      $this->session->set_flashdata('change_profile','Change Profile Successfully...');
                      redirect(base_url().'owner_controller/change_profile_cont');
                    }
        
                    else
                    {
                      $this->session->set_flashdata('change_profile','Change Profile Not Successfully...'); 
                       redirect(base_url().'owner_controller/change_profile_cont');
                    }
            

              }

            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/owner/';
                $config['allowed_types'] = 'jpeg|png|jpg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);
                //upload file to directory
                if($this->upload->do_upload('file'))
                {
                    $uploadData = $this->upload->data();
                    $uploadedFile = $uploadData['file_name'];
                    
                       
          $update_user=$this->owner_model->change_profile_mdl($user,$uid);
              if($update_user > 0)
              {
                $this->session->set_flashdata('change_profile','Change Profile Successfully...'); 
                redirect(base_url().'owner_controller/change_profile_cont');
              }
        
             
            
                    }
                else
                {
                  $data1 = $this->upload->display_errors();
   
                  $this->session->set_flashdata('image_error',$data1);
                  redirect(base_url().'owner_controller/change_profile_cont');

               // 

                }
            }
        }


        
     public function document_cont()
        {
           if(! $this->session->userdata('id'))
      return redirect('owner_controller');
      if($this->session->userdata('id'))
      {
        $id=$this->session->userdata('id');
      }
      if($this->owner_model->getusertype_mdl($id))
      {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
      }
    
      $data['files']=directory_map('./document/');
      $this->load->view('user/document',$data);
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
//payment

public function payindex_cont()
 {
  if(! $this->session->userdata('id'))
      return redirect('owner_controller');

     if($this->session->userdata('id'))
      {
        $id=$this->session->userdata('id');
      }
       if($this->owner_model->getusertype_mdl($id))
      {
        $data['usertype']=$this->owner_model->getusertype_mdl($id);
      }
      if($this->input->get('id'))
      {
        $uid=$this->input->get('id');
          if($this->owner_model->paymentdetail_mdl($uid,$id))
          {
          $data['pay_history']=$this->owner_model->paymentdetail_mdl($uid,$id);
          }
      }
      if($this->input->get('bid'))
      {
        $uid=$this->input->get('bid');
          if($this->owner_model->paymentdetail_mdl($uid,$id))
          {
          $data['myunit_pay_history']=$this->owner_model->paymentdetail_mdl($uid,$id);
          }
      }
      if($this->input->get('m_id'))
      {
        $m_id=$this->input->get('m_id');
          if($this->owner_model->paymentdetail_maintenance_mdl($m_id,$id))
          {
          $data['pay_maintenance']=$this->owner_model->paymentdetail_maintenance_mdl($m_id,$id);
          }

      }

      if($this->input->get('bpid'))
      {
         $bpid=$this->input->get('bpid');
          if($this->owner_model->paymentdetail_booking_penalty_mdl($bpid,$id))
          {
          $data['pay_booking_penalty']=$this->owner_model->paymentdetail_booking_penalty_mdl($bpid,$id);
          }

      }

       if($this->input->get('rid'))
      {
         $rid=$this->input->get('rid');
          if($this->owner_model->paymentdetail_revenue_mdl($rid,$id))
          {
            $data['pay_revenue']=$this->owner_model->paymentdetail_revenue_mdl($rid,$id);
          }

      }

         $this->load->view('user/pay_index',$data);
}



public function paynow_cont()
{
if($this->input->get('book_id'))
{
   $book_id=$this->input->post('book_id');  
  $facility_name=$this->input->post('facility_name');
   $firstname=$this->input->post('firstname');
   $book_date=$this->input->post('book_date');
   $total_charge=$this->input->post('total_charge');
   $time_slot=$this->input->post('time_slot');
   $email=$this->input->post('email');
   $mobile_no=$this->input->post('mobile_no');



   $this->session->set_userdata('book_id',$book_id);
   $this->session->set_userdata('facility_name',$facility_name);
   $this->session->set_userdata('firstname',$firstname);
  $this->session->set_userdata('book_date',$book_date);
  $this->session->set_userdata('total_charge',$total_charge);
  $this->session->set_userdata('time_slot',$time_slot);
  $this->session->set_userdata('email',$email);
  $this->session->set_userdata('mobile_no',$mobile_no);
  $this->load->view('user/pay_now');

}
if($this->input->get('myunit_book_id'))
{
   $book_id=$this->input->post('book_id');  
  $facility_name=$this->input->post('facility_name');
   $firstname=$this->input->post('firstname');
   $book_date=$this->input->post('book_date');
   $total_charge=$this->input->post('total_charge');
   $time_slot=$this->input->post('time_slot');
   $email=$this->input->post('email');
   $mobile_no=$this->input->post('mobile_no');



   $this->session->set_userdata('book_id',$book_id);
   $this->session->set_userdata('facility_name',$facility_name);
   $this->session->set_userdata('firstname',$firstname);
  $this->session->set_userdata('book_date',$book_date);
  $this->session->set_userdata('total_charge',$total_charge);
  $this->session->set_userdata('time_slot',$time_slot);
  $this->session->set_userdata('email',$email);
  $this->session->set_userdata('mobile_no',$mobile_no);
  $this->load->view('user/myunit_pay_now');

}

if($this->input->get('bookpenalty_id'))
{
   $book_id=$this->input->post('book_id');  
  $facility_name=$this->input->post('facility_name');
   $firstname=$this->input->post('firstname');
   $book_date=$this->input->post('book_date');
   $total_charge=$this->input->post('total_charge');
   $time_slot=$this->input->post('time_slot');
   $email=$this->input->post('email');
   $mobile_no=$this->input->post('mobile_no');



   $this->session->set_userdata('book_id',$book_id);
   $this->session->set_userdata('facility_name',$facility_name);
   $this->session->set_userdata('firstname',$firstname);
  $this->session->set_userdata('book_date',$book_date);
  $this->session->set_userdata('total_charge',$total_charge);
  $this->session->set_userdata('time_slot',$time_slot);
  $this->session->set_userdata('email',$email);
  $this->session->set_userdata('mobile_no',$mobile_no);
  $this->load->view('user/myunit_pay_now');

}


if($this->input->get('maintanance_id'))
{
  $maintanance_id = $this->input->post('maintanance_id');
  $maintanance_date=$this->input->post('maintanance_date');
  $total_charge=$this->input->post('total_charge');
  $firstname=$this->input->post('firstname');
  $email=$this->input->post('email');
  $mobile_no=$this->input->post('mobile_no');

 $this->session->set_userdata('maintanance_id',$maintanance_id);
  $this->session->set_userdata('maintanance_date',$maintanance_date);
  $this->session->set_userdata('total_charge',$total_charge);
  $this->session->set_userdata('firstname',$firstname);
  $this->session->set_userdata('email',$email);
  $this->session->set_userdata('mobile_no',$mobile_no);
  $this->load->view('user/pay_maintanance_now');
}
if($this->input->get('expense_revenue_id'))
{
  $expense_revenue_id = $this->input->post('expense_revenue_id');
  $expense_revenue_name=$this->input->post('expense_revenue_name');
  $amount=$this->input->post('amount');
  $firstname=$this->input->post('firstname');
  $email=$this->input->post('email');
  $mobile_no=$this->input->post('mobile_no');

 $this->session->set_userdata('expense_revenue_id',$expense_revenue_id);
  $this->session->set_userdata('expense_revenue_name',$expense_revenue_name);
  $this->session->set_userdata('amount',$amount);
  $this->session->set_userdata('firstname',$firstname);
  $this->session->set_userdata('email',$email);
  $this->session->set_userdata('mobile_no',$mobile_no);
  $this->load->view('user/pay_revenue_now');
}
  

 
}
public function update_pay_status_cont()
{
  if($this->input->get('book_id'))
  {
    $book_id=$this->input->get('book_id');
    $update_status=array(
                'modified_on'=>date('Y-m-d'),
                'pay_status'=> 1,
      );
    $pay_status=$this->owner_model->update_pay_status_mdl($book_id,$update_status);
    if($pay_status)
    {
        $this->load->view('user/thanku');
    }
    else
    {
      echo "something went wrong";
    }
  }

if($this->input->get('myunit_book_id'))
  {
    $book_id=$this->input->get('myunit_book_id');
    $update_status=array(
                'modified_on'=>date('Y-m-d'),
                'pay_status'=> 1,
      );
    $pay_status=$this->owner_model->update_pay_status_mdl($book_id,$update_status);
    if($pay_status)
    {
        $this->load->view('user/thanku_myunit');
    }
    else
    {
      echo "something went wrong";
    }
  }
  if($this->input->get('maintanance_id'))
  {
    $maintanance_id=$this->input->get('maintanance_id');
    $update_status=array(
                'pay_status'=> 1,
                'modified_on'=>date('Y-m-d'),
      );
    $pay_status=$this->owner_model->update_pay_status_maintanance_mdl($maintanance_id,$update_status);
    if($pay_status)
    {
        $this->load->view('user/thanku_myunit');
    }
    else
    {
      echo "something went wrong";
    }
  }
  if($this->input->get('expense_revenue_id'))
  {
    $expense_revenue_id=$this->input->get('expense_revenue_id');
    $update_status=array(
                'pay_status'=> 1,
                'modified_on'=>date('Y-m-d'),
      );
    $pay_status=$this->owner_model->update_pay_revenue_mdl($expense_revenue_id,$update_status);
    if($pay_status)
    {
        $this->load->view('user/thanku_myunit');
    }
    else
    {
      echo "something went wrong";
    }
  }
 


  }

 function forgotpassword_cont()
{
 
       if(! $this->session->userdata('id'))
      return redirect('owner_controller');
     
 $this->load->view('user/forgot_password');
}

function forgotpassword_index_cont()
{
 
   $this->load->view('user/forgot_password');
}
public function reset_pass_link_cont()
{
  if(! $this->session->userdata('id'))
      return redirect('owner_controller');
 require 'PHPMailer/PHPMailerAutoload.php';

$email = $this->input->post('email');
$parts = explode("@", $email);
$username = $parts[0];
$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'rahuldholariya001@gmail.com';          // SMTP username
$mail->Password = 'Rsquare@3032'; // SMTP password
$mail->SMTPSecure ='tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                  // TCP port to connect to

$mail->setFrom('rahuldholariya001@gmail.com', 'Pratha Apartment Management');
$mail->addReplyTo($email, 'Pratha Apartment Management');
$mail->addAddress($email);   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML
$mail->Subject = 'Email from Pratha Apartment Management';
$mail->AddEmbeddedImage("img/logo.jpeg", "my-attach", "img/logo.jpeg");
$mail->Body    = '<html><head></head><body><div style="background-color:#DBDBDB;padding:50px;"><img src="cid:my-attach" height="150px" width="150px" /><hr><p style="color:black">Hello&nbsp;&nbsp;'.$username.',<br><br>We have received a request to reset password at pratha Apartment.<br><br>
In order to change your password, click the link below:<br><br>
<a href="'.base_url().'owner_controller/reset_password_page_cont">Reset My Password</a><br><br>If you have not made any password reset request, it is likely that another user entered your email address by mistake and you can simply disregard this email.<br><center><h2>Thank You</h2></center></p></div></body></html>';


 if(!$mail->send()) {
     echo 'Message could not be sent.';
     echo 'Mailer Error: ' . $mail->ErrorInfo;
 } 
 else
 { 
     $this->session->set_flashdata('resetmsg','Reset Password Link Sent Successfully.'); 
  redirect(base_url().'owner_controller/forgotpassword_cont');
 }
}
public function reset_pass_link_contt()
{
 
 require 'PHPMailer/PHPMailerAutoload.php';

$email = $this->input->post('email');
$parts = explode("@", $email);
$username = $parts[0];
$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                    // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                            // Enable SMTP authentication
$mail->Username = 'rahuldholariya001@gmail.com';          // SMTP username
$mail->Password = 'Rsquare@3032'; // SMTP password
$mail->SMTPSecure ='tls';                         // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                  // TCP port to connect to

$mail->setFrom('rahuldholariya001@gmail.com', 'Pratha Apartment Management');
$mail->addReplyTo($email, 'Pratha Apartment Management');
$mail->addAddress($email);   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML
$mail->Subject = 'Email from Pratha Apartment Management';
$mail->AddEmbeddedImage("img/logo.jpeg", "my-attach", "img/logo.jpeg");
$mail->Body    = '<html><head></head><body><div style="background-color:#DBDBDB;padding:50px;"><img src="cid:my-attach" height="150px" width="150px" /><hr><p style="color:black">Hello&nbsp;&nbsp;'.$username.',<br><br>We have received a request to reset password at pratha Apartment.<br><br>
In order to change your password, click the link below:<br><br>
<a href="'.base_url().'owner_controller/reset_password_page_cont">Reset My Password</a><br><br>If you have not made any password reset request, it is likely that another user entered your email address by mistake and you can simply disregard this email.<br><center><h2>Thank You</h2></center></p></div></body></html>';


 if(!$mail->send()) {
     echo 'Message could not be sent.';
     echo 'Mailer Error: ' . $mail->ErrorInfo;
 } 
 else
 { 
     $this->session->set_flashdata('resetmsg','Reset Password Link Sent Successfully.'); 
  redirect(base_url().'owner_controller/forgotpassword_cont');
 }
}

public function reset_password_page_cont()
{

 $this->load->view('user/reset_password');
}

public function reset_password_cont()
{
 $username=$this->input->post('username');

     $n_pass=$this->input->post('password');
     $r_pass=$this->input->post('repassword');
     if($n_pass != $r_pass)
     {
      $this->session->set_flashdata('repassword_error','Retype Password Does Not Matched...');
            redirect(base_url().'owner_controller/reset_password_page_cont');
     }
     else
     {
      $n_pass1=md5($n_pass);
      $profile = array(
      'password' => $n_pass1,
      );
      $id=$this->session->userdata('id');
      $reset_success=$this->owner_model->reset_password_mdl($profile,$username);
      if($reset_success)
      {
       $this->session->set_flashdata('resetpass','Password Reseted Successfully...');
    redirect(base_url().'owner_controller/reset_password_page_cont');
      }
      else
      {
      $reset_samepass_success=$this->owner_model->reset_samepassword_mdl($n_pass,$username);
       if($reset_samepass_success)
       {
        $this->session->set_flashdata('resetpass','Password Reseted Successfully...');
     redirect(base_url().'owner_controller/reset_password_page_cont');
       }
       else
       {
        $this->session->set_flashdata('resetpass_error','Invalid Username...');
     redirect(base_url().'owner_controller/reset_password_page_cont');
    }
      }

     }
}

public function logout_cont()
{
   $this->session->unset_userdata('id');
   $this->session->unset_userdata('book_id');
   $this->session->unset_userdata('facility_name');
   $this->session->unset_userdata('firstname');
  $this->session->unset_userdata('book_date');
  $this->session->unset_userdata('total_charge');
  $this->session->unset_userdata('time_slot');
  $this->session->unset_userdata('email');
  $this->session->unset_userdata('mobile_no');

  $this->session->userdata('maintanance_id');
  $this->session->userdata('maintanance_date');
  $this->session->userdata('total_charge');
  $this->session->userdata('firstname');
  $this->session->userdata('email');
  $this->session->userdata('mobile_no');

   $this->session->userdata('expense_revenue_id');
  $this->session->userdata('expense_revenue_name');
  $this->session->userdata('amount');
  $this->session->userdata('firstname');
  $this->session->userdata('email');
  $this->session->userdata('mobile_no');
 //$this->session->sess_destroy();
 redirect(base_url().'owner_controller');
}





/* jinal virani */

/* my apartment */
public function my_apartment_list_cont()
  {
    if(! $this->session->userdata('id'))
      return redirect('owner_controller');

    $id=$this->session->userdata('id');
    if($this->owner_model->getusertype_mdl($id))
    {
      $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
    // post show //
    if($this->owner_model->show_post_mdl())
    {
      $data['showpost']=$this->owner_model->show_post_mdl();
    }


    // notice show //
    if($this->owner_model->show_notice_mdl())
    {
      $data['shownotice']=$this->owner_model->show_notice_mdl();
    }
    if($this->owner_model->get_admin_info_mdl())
    {
      $data['admin_info']=$this->owner_model->get_admin_info_mdl();
    }
    if($this->owner_model->regi_unregi_mdl($id))
    {
      $data['regi_unregi']='yes';
    }
    else
    {
       $data['regi_unregi']='no';
    }
    if($this->owner_model->check_user_vote_mdl($id))
    {
     $data['vote']='yes';
    }
    else
    {
      $data['vote']='no';
    }

    /* display poll*/
    if($this->owner_model->poll_create_view_mdl())
    {
      $data['poll']=$this->owner_model->poll_create_view_mdl();
    }
    if($this->owner_model->pol_regi_member_mdl())
    {
      $data['poll_member']=$this->owner_model->pol_regi_member_mdl();
    }
     if($this->owner_model->get_notice_id_result())
    {
      $max_notice_id=$this->owner_model->get_notice_id_result();
      if($max_notice_id)
      {
        $data['notice_id'] = $max_notice_id->notice_id;
        $max = $data['notice_id'];
      }
    }
    if($this->owner_model->disp_header_poll_result($max))
    {
      $data['header']=$this->owner_model->disp_header_poll_result($max);
    }
    if($this->owner_model->poll_result_mdl($max))
    {
      $data['pp']=$this->owner_model->poll_result_mdl($max);
    }
    if($this->owner_model->count_votes($max))
    {
      $data['votes']=$this->owner_model->count_votes($max);
    }
    if($this->owner_model->check_poll_associative())
    {
      $data['check_associative']=$this->owner_model->check_poll_associative();
    }
    else
    {
    $data['check_admin']="";
    }
    if($this->owner_model->count_total_vote_mdl($max))
    {
      $data['total_vote']=$this->owner_model->count_total_vote_mdl($max);
    }

    $this->load->view('user/my_apartment_list',$data);

  }

/* registration_for_poll */
public function registration_for_poll_cont()
{
  if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  $id=$this->session->userdata('id');
  if($this->input->post('poll_id'))
  {
    $poll_id=$this->input->post('poll_id');
    $regi_poll = array(
      'notice_id' => $poll_id,
      'user_id' =>$id,
      'added_on' => date('Y-m-d'),
      'added_by' => 'owner',
      'status' =>1,
    );
      $this->owner_model->registration_for_poll_mdl($regi_poll);
      redirect(base_url().'owner_controller/my_apartment_list_cont');
  }
}

public function unregistration_for_poll_cont()
{
  if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  $id=$this->session->userdata('id');
  $this->owner_model->unregistration_for_poll_mdl($id);
  redirect(base_url().'owner_controller/my_apartment_list_cont');
}


/* vote */
public function vote_cont()
{
  if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  $id=$this->session->userdata('id');
  if($_POST['notice_id'] && $_POST['user_id'])
  {
    $nid=$_POST['notice_id'];
    $v_id=$_POST['user_id'];
    $vote = array(
      'notice_id' => $nid,
      'user_id' => $id,
      'given_vote' => $v_id,
      'added_on' => date('Y-m-d'),
      'added_by' => 'owner',
      'status' =>1,
    );

    $vote_sql= $this->owner_model->vote_mdl($vote);
    if($vote_sql)
    {
       redirect(base_url().'owner_controller/my_apartment_list_cont');
    }
  }
}

public function make_conversation_cont()
{
  if(! $this->session->userdata('id'))
      return redirect('owner_controller');

    $id=$this->session->userdata('id');
    if($this->owner_model->getusertype_mdl($id))
    {
      $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }
    $this->load->view('user/make_conversation',$data);
}

public function post_conversation_cont()
{
  if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $id=$this->session->userdata('id');
    date_default_timezone_set('Asia/Kolkata');
  $time=date('H:i A');
       $post=array(
        'user_id' => $id,
        'caption' => $this->input->post('caption'),
        'pic' => $pic= $_FILES['file']['name'],
        'added_on' =>date('Y-m-d'),
        'time' => $time,
        'added_by' =>'user',
        'status' =>1,
        'likes' =>0,
         );

        $this->form_validation->set_rules('file', '', 'callback_file_check');

            if($this->form_validation->run() == true)
            {
                //upload configuration
                $config['upload_path']   = 'img/owner/conversation/';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size']      = 1024;
                $this->load->library('upload', $config);

                //upload file to directory
                if(file_exists('img/owner/conversation/'.$_FILES['file']['name']))
                {
                    $post_sql = $this->owner_model->post_mdl($post);
                    if($post_sql)
                    {
                        $id=$this->session->userdata('id');
                        if($this->owner_model->getusertype_mdl($id))
                        {
                          $data['usertype']=$this->owner_model->getusertype_mdl($id);
                        }
                        redirect(base_url().'owner_controller/my_apartment_list_cont');
                    }
                    else
                    {
                      $id=$this->session->userdata('id');
                      if($this->owner_model->getusertype_mdl($id))
                      {
                        $data['usertype']=$this->owner_model->getusertype_mdl($id);
                      }
                      redirect(base_url().'owner_controller/my_apartment_list_cont');
                    }
                }
                else
                {
                  if($this->upload->do_upload('file'))
                  {
                        $uploadData = $this->upload->data();
                        $uploadedFile = $uploadData['file_name'];

                        $post_sql = $this->owner_model->post_mdl($post);
                      if($post_sql)
                      {
                        $id=$this->session->userdata('id');
                      if($this->owner_model->getusertype_mdl($id))
                      {
                        $data['usertype']=$this->owner_model->getusertype_mdl($id);
                      }
                        redirect(base_url().'owner_controller/my_apartment_list_cont');
                      }
                      else
                      {
                        $id=$this->session->userdata('id');
                      if($this->owner_model->getusertype_mdl($id))
                      {
                        $data['usertype']=$this->owner_model->getusertype_mdl($id);
                      }
                        redirect(base_url().'owner_controller/my_apartment_list_cont');
                      }
                    }
                     else
                    {
                        $data1 = $this->upload->display_errors();
                        $this->session->set_flashdata('image_error',$data1);
                        redirect(base_url().'owner_controller/make_conversation_cont');
                     }
              }

        } 
}

public function post_like()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $id=$this->session->userdata('id');
    if(isset($_POST['postid']))
    {
      $post_id = $this->input->post('postid');
        $like_insert = array(
          'post_id' =>$post_id,
          'user_id' =>$id,
        ); 
        $post_like_sql = $this->owner_model->post_like_mdl($like_insert);
        $old_like = $this->owner_model->old_like_mdl($post_id);
        if($old_like)
            {
              $data['old_like'] = $old_like->likes;
              $old_like = $data['old_like'];
            }
            $update_like =array();
        $update_like['likes']=$old_like + 1;
       $update_like_sql = $this->owner_model->update_like_mdl($update_like,$post_id);
       $likes_disp = $update_like['likes'];
        echo $old_like + 1;
     
    }
  
}

public function post_unlike()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');
    $id=$this->session->userdata('id');
  $post_id = $this->input->post('postid');
  $post_unlike_sql = $this->owner_model->post_unlike_mdl($post_id,$id);
  $old_like = $this->owner_model->old_like_mdl($post_id);
  if($old_like)
      {
        $data['old_like'] = $old_like->likes;
        $old_like = $data['old_like'];
      }
  $update_like = array(
    'likes' => $old_like - 1,
  );
 $update_like_sql = $this->owner_model->update_like_mdl($update_like,$post_id);
 echo $old_like - 1;
}
/* visiter */
public function myunit_visiter_cont()
{
  if(! $this->session->userdata('id'))
      return redirect('owner_controller');
  $id=$this->session->userdata('id');
  if($this->owner_model->getusertype_mdl($id))
  {
    $data['usertype']=$this->owner_model->getusertype_mdl($id);
  } 
  if($this->owner_model->getusertype_mdl($id))
    {
      $wingg_id=$this->owner_model->getusertype_mdl($id);
      if($wingg_id)
      {
        foreach($wingg_id as $w)
        {
          $wing_id = $w->wing_id;
        }
      }
    }
    if($this->owner_model->getusertype_mdl($id))
    {
      $homee_id=$this->owner_model->getusertype_mdl($id);
      if($homee_id)
      {
        foreach($homee_id as $h)
        {
          $home_id = $h->home_id;
        }
      }
    }

  if($this->owner_model->display_visiter_mdl($wing_id,$home_id))
    {
      $data['visiter']=$this->owner_model->display_visiter_mdl($wing_id,$home_id);
    }
  $this->load->view('user/visiter_list',$data);

}

public function staff_attendence_cont()
{
   if(! $this->session->userdata('id'))
      return redirect('owner_controller');

    $id=$this->session->userdata('id');
    if($this->owner_model->getusertype_mdl($id))
    {
      $data['usertype']=$this->owner_model->getusertype_mdl($id);
    }

    if($this->owner_model->staff_attendence_mdl())
    {
      $data['staff_att']=$this->owner_model->staff_attendence_mdl();
    }

    $this->load->view('user/staff_attendence',$data);
}


}
?>
