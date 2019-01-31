<?php
class Owner_model extends CI_Model
{
    public function ownerlogin_mdl($unm,$pass)
    {
        $this->db->select('*');
        $this->db->from('users_tb u');
        $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
        $where="username='$unm' and password='$pass' and ( user_type='owner' or user_type='tenant') and approve_status=1 and status=1";
        $this->db->where($where);
        $login_sql=$this->db->get();

        if( $login_sql->num_rows() )
        {
            return $login_sql->row()->user_id;
        }
        else
        {
            return FALSE;
        }
    }

    /*show owner info*/
    public function getusertype_mdl($userid)
    { 
        $this->db->select('*');
        $this->db->from('users_tb u');
        $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
        $this->db->join('wing_tb w','w.wing_id=u.wing_id');
        //jinal
        $this->db->join('home_tb h','h.home_id=u.home_id');
        $this->db->where('u.user_id',$userid);
        $getusertype_sql=$this->db->get();

        if($getusertype_sql->num_rows())
        {
        return $getusertype_sql->result();
        }
    }
//registration owner

	public function registration_mdl($user,$user_type)
	{
		$this->db->insert('users_tb',$user);
		$user_id=$this->db->insert_id();
		$user_type['user_id']=$user_id;
		$registration_sql=$this->db->insert('usertype_tb',$user_type);
        if($registration_sql)
        {
		return $user_id;
        }
        else
        {
            return false;
        }
	}
    public function already_exist($wing_id1,$home_id1)
    {
        $this->db->where('wing_id',$wing_id1);
        $this->db->where('home_id',$home_id1);
        $this->db->where('status',1);
        $this->db->where('approve_status',1);
        $this->db->where('is_resident','yes');
        $this->db->from('users_tb');
        $query=$this->db->get();
        $result=$query->num_rows();
        return $result;
        
    }
     public function already_exist_username($username)
    {
        $this->db->where('username',$username);
        $this->db->where('status',1);
        $this->db->from('users_tb');
        $query=$this->db->get();
        $result=$query->num_rows();
        return $result;
        
    }

	public function getwing_mdl()
    {
        $this->db->where('status',1);
        $query = $this->db->get('wing_tb');
        return $query->result();
    }

	public function getcity_mdl()
    {
        $query = $this->db->get('city_tb');
        return $query->result();
    }
/*function gethome_mdl()
    {
       

        $query = $this->db->get('city_tb');
        return $query->result();

       
    }*/

    public function fillhome_mdl($wing_id)
    {
        $this->db->where('status',1);
    	$query= $this->db->get_where('home_tb',array('wing_id' => $wing_id));
        return $query->result();
    }


  public function addmember_mdl($member)
  {
        $this->db->insert('member_tb',$member);
        return $this->db->insert_id();
  }
  public function emergency_status_mdl($id)
  {
    $this->db->where('user_id',$id);
    $this->db->where('emergency_status','yes');
    $emergency_count=$this->db->get('member_tb');
    $count=$emergency_count->num_rows();
    return $count;
  }

  public function display_member_mdl($id)

  { 
    $this->db->where('user_id',$id);
    $this->db->where('status',1);
    $display=$this->db->get('member_tb');
    return $display->result();
  }
 /*fetch data at update*/
  public function update_member_mdl($mid)
  {
    $this->db->where('member_id',$mid);
    $display=$this->db->get('member_tb');
    return $display->result();

  }

/*update record*/
function update_record($mid,$member)
{
$this->db->where('member_id', $mid);
$this->db->update('member_tb', $member);
if($this->db->affected_rows())
{
    return $this->db->affected_rows();
}
else
{
    return $this->db->affected_rows();
}


}

/*get stautus yes or no*/
public function yes_no_mdl($mid)
{
    $this->db->where('emergency_status','yes');
    $this->db->where('member_id',$mid);
    $yes_no_sql=$this->db->get('member_tb');
    if($yes_no_sql)
    {
        return $yes_no_sql->result();
    }
    else
    {
        return false;
    }
}

//get e status updte time
public function getemergency_status_update_mdl($mid)
{
    $this->db->select('emergency_status');
    $this->db->where('member_id',$mid);
    $status=$this->db->get('member_tb');
    if($status)
    {
        return true;
    }
    else
    {
        return false;
    }

}
/*delete member*/
public function delete_member_mdl($del_id)
{
    $this->db->where('member_id',$del_id);
    $this->db->delete('member_tb');
    if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
}
/*get wing name for genereate slot number*/
public function wing_vehicle_mdl($id)
{
        $this->db->select('wing_name');
        $this->db->from('users_tb u');
        $this->db->join('wing_tb w','w.wing_id=u.wing_id');
        $this->db->where('u.user_id',$id);
        $getwing_sql=$this->db->get();

        if($getwing_sql->num_rows())
        {
        return $getwing_sql->result();
        }
        else
        {
            return false;
        }

}
public function getall_slotnumber()
{
    $this->db->select('slot_no');
    $this->db->from('vehicle_tb');
    $this->db->where('vehicle_type','2-wheeler');
    $this->db->where('status',0);

    $slot=$this->db->get(
    );
    if($slot->num_rows())
    {
        return $slot->result();
    }
    else
    {
        return false;
    }
}
public function getall_all_slotnumber()
{
    $this->db->select('slot_no');
    $this->db->from('vehicle_tb');
     $this->db->where('vehicle_type','2-wheeler');
    $this->db->where('status',1);

    $slot1=$this->db->get();
    if($slot1->num_rows() > 0)
    {
        return $slot1->result();
    }
    else
    {
        return false;
    }
}


public function getall_slotnumber1()
{
    $this->db->select('slot_no');
    $this->db->from('vehicle_tb');
    $this->db->where('vehicle_type','4-wheeler');
    $this->db->where('status',0);

    $slot=$this->db->get();
    if($slot->num_rows())
    {
        return $slot->result();
    }
    else
    {
        return false;
    }
}
public function getall_all_slotnumber1()
{
    $this->db->select('slot_no');
    $this->db->from('vehicle_tb');
     $this->db->where('vehicle_type','4-wheeler');
    $this->db->where('status',1);

    $slot1=$this->db->get();
    if($slot1->num_rows() > 0)
    {
        return $slot1->result();
    }
    else
    {
        return false;
    }
}
public function twowheel_record_mdl($wing_name)
{
        $this->db->select('u.wing_id');
        $this->db->from('users_tb u');
        $this->db->join('vehicle_tb v','v.user_id=u.user_id');
        $this->db->join('wing_tb w','w.wing_id=u.wing_id');
        $this->db->where('vehicle_type','2-wheeler');
        $this->db->where('w.wing_name',$wing_name);
        $getwing_id_sql=$this->db->get();
        if($getwing_id_sql)
        {
           // return true;
            return $getwing_id_sql->num_rows();
        }
        else
        {
            //return false;
            return $getwing_id_sql->num_rows();
        }


}
public function fourwheel_record_mdl($wing_name)
{
        $this->db->select('u.wing_id');
        $this->db->from('users_tb u');
        $this->db->join('vehicle_tb v','v.user_id=u.user_id');
        $this->db->join('wing_tb w','w.wing_id=u.wing_id');
        $this->db->where('vehicle_type','4-wheeler');
        $this->db->where('w.wing_name',$wing_name);
        $getwing_id_sql=$this->db->get();
        if($getwing_id_sql)
        {
            return $getwing_id_sql->num_rows();
        }
        else
        {
            return $getwing_id_sql->num_rows();
        }
    }

public function get_oldslotvehicleid_mdl()
{
    $this->db->select_min('vehicle_id');
    $this->db->from('vehicle_tb');
     $this->db->where('vehicle_type','2-wheeler');
     $this->db->where('status',0);
    $display=$this->db->get();
    if($display)
    {
        return $display->result();
    }
    else
    {
        return false;
    }


}

public function get_oldslotvehicleid_mdl1()
{
    $this->db->select_min('vehicle_id');
    $this->db->from('vehicle_tb');
     $this->db->where('vehicle_type','4-wheeler');
     $this->db->where('status',0);
    $display=$this->db->get();
    if($display)
    {
        return $display->result();
    }
    else
    {
        return false;
    }

}

public function getold_slot_mdl($vehicle_id)
{
    $this->db->select('*');
     $this->db->where('vehicle_id',$vehicle_id);
    $query = $this->db->get('vehicle_tb');
    if($query->num_rows() == 1)
    {
        return $query->row();
    }
    else
    {
    return false;
    }


}
public function delete_oldslot_mdl($slot_no1)
{
    $this->db->where('slot_no',$slot_no1);
    $delete=$this->db->delete('vehicle_tb');
    if($delete)
    {
        return true;
    }
    else
    {
        return false;
    }
}



  public function add_vehicle_mdl($vehicle)
  {
        $this->db->insert('vehicle_tb',$vehicle);
        return $this->db->insert_id();
  }
  public function vehicle_list_mdl($id)
  { 
        $this->db->where('user_id',$id);
        $this->db->where('status',1);
        $display=$this->db->get('vehicle_tb');
        if($display)
        {
             return $display->result();

        }
        else
        {
            return false;
        }
       
  }

public function delete_vehicle_mdl($vehicle,$del_id)
{
    $this->db->where('vehicle_id',$del_id);
    $this->db->update('vehicle_tb',$vehicle);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}


 public function add_staff_mdl($staff)
  {
        $this->db->insert('staff_tb',$staff);
        return $this->db->insert_id();
  }


  public function staff_list_mdl($id)
  {
    $this->db->where('user_id',$id);
    $this->db->where('status',1);
    $display_staff=$this->db->get('staff_tb');
    return $display_staff->result();

  }
  public function delete_staff_mdl($del_id)
{
       $this->db->where('staff_id',$del_id);
    $this->db->delete('staff_tb');
    if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
}
/*fetch record for update*/
public function update_staff_mdl($sid)
{
    $this->db->where('staff_id',$sid);
    $display=$this->db->get('staff_tb');
    return $display->result();


}
/*update record in database*/
function updatestaff_mdl($sid,$staff)
{
$this->db->where('staff_id', $sid);
$this->db->update('staff_tb ', $staff);
if($this->db->affected_rows())
{
    return true;
}
else
{
    return false;
}


}

//get home number for tenant at registration
public function gethome_no_mdl($id)
{
     $this->db->select('h.home_no');
        $this->db->from('home_tb h');
        $this->db->join('users_tb u','u.home_id=h.home_id');
        $this->db->where('u.user_id',$id);
        $home_no=$this->db->get();
        if($home_no)
        {
            return $home_no->result();
        }
        else
        {
            return false;
        }
}
public function already_tenant_mdl($owner_id)
{
    $this->db->where('owner_id',$owner_id);
    $this->db->where('status',1);
    $query=$this->db->get('users_tb');
    $result=$query->num_rows();
    return $result;
}


   /* public function registration_tenant_mdl($user,$user_type)
    {
        $this->db->insert('users_tb',$user);
        $user_id=$this->db->insert_id();
        $user_type['user_id']=$user_id;

        $registration_sql=$this->db->insert('usertype_tb',$user_type);
        if($registration_sql)
        {
        return true;
        }
        else
        {
            return false;
        }


    }*/
    public function delete_vehicle_owner_mdl($id,$vehicle)
    {
        $this->db->where('user_id', $id);
        $this->db->update('vehicle_tb', $vehicle);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
 public function delete_member_owner_mdl($id,$member)
    {
        $this->db->where('user_id', $id);
        $this->db->update('member_tb', $member);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
 public function delete_staff_owner_mdl($id,$staff)
    {
        $this->db->where('user_id', $id);
        $this->db->update('staff_tb', $staff);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function delete_issue_owner_mdl($id)
    {
        $this->db->where('user_id', $id);
        $this->db->delete('issue_tb');
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

 public function delete_visiter_owner_mdl($wing_id,$home_id)
    {
        $this->db->where('wing_id',$wing_id);
        $this->db->where('home_id',$home_id);
        $this->db->delete('visiter_tb');
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
public function staffqrcode_mdl()
  {
    $this->db->order_by('staff_id',"desc");
    $this->db->limit(1);
    $qr=$this->db->get('staff_tb');
    if($qr->num_rows())
    {
        return $qr->result();
    }
    else
    {
        return false;
    }
        


  }
  public function view_tenant_mdl($id)
  {  
    $this->db->where('owner_id',$id);
    $this->db->where('status',1);
   $display=$this->db->get('users_tb');
   if($display)
   {
    return $display->result();
   }
    else
    {
        return $display->result();
    }
}

public function view_old_tenant_mdl($id)
{
    $this->db->where('owner_id',$id);
    $this->db->where('status',0);
   $display=$this->db->get('users_tb');
   if($display)
   {
    return $display->result();
   }
    else
    {
        return $display->result();
    }
}

public function is_resident_update_yesno_mdl($id,$user)
{
    $this->db->where('user_id', $id);
    $this->db->update('users_tb', $user);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}


public function is_resident_update_noyes_mdl($id,$user)
{
    $this->db->where('user_id', $id);
    $this->db->update('users_tb', $user);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}
public function delete_tenant_mdl($tenant,$del_id)
{
    $this->db->where('user_id',$del_id);
    $this->db->update('users_tb',$tenant);
    if($this->db->affected_rows())
{
    return true;
}
else
{
    return false;
}

}

public function count_total_member_mdl($id)
{
    $this->db->where('user_id',$id);
    $this->db->where('status',1);
    $total_member=$this->db->get('member_tb');
    if($total_member){
        return $total_member->num_rows();
    }
    else
    {
        return $total_member->num_rows();
    }

}

public function count_total_vehicle_mdl($id)
{
    $this->db->where('user_id',$id);
    $this->db->where('status',1);
    $total_member=$this->db->get('vehicle_tb');
    if($total_member){
        return $total_member->num_rows();
    }
    else
    {
        return $total_member->num_rows();
    }

}


public function count_total_staff_mdl($id)
{
    $this->db->where('user_id',$id);
    $this->db->where('status',1);
    $total_member=$this->db->get('staff_tb');
    if($total_member){
        return $total_member->num_rows();
    }
    else
    {
        return $total_member->num_rows();
    }

}
public function count_total_issue_mdl($id)
{
    $this->db->where('user_id',$id);
    $this->db->where('issue_progress_status',1);
    $total_member=$this->db->get('issue_tb');
    if($total_member){
        return $total_member->num_rows();
    }
    else
    {
        return $total_member->num_rows();
    }

}



//book facility
public function bookfacility_list_mdl()
{
   
    $this->db->where('status',1);
    $facility_display=$this->db->get('facility_tb');
    if($facility_display)
    {
        return $facility_display->result();
    }
    else
    {
        return false;
    }

}

public function getfacility_name_mdl($fid)
{
    $this->db->where('facility_id',$fid);
    $display=$this->db->get('facility_tb');
    if($display)
    {
       return $display->result();
    }
    else
    {
        return false;
    }

}

public function bookfacility_record_mdl($book)
{
    $book_facility=$this->db->insert('bookfacility_tb',$book);
    if($book_facility)
    {
        return true;
    }
    else
    {
        return false;
    }

}

public function already_book_facility($time_slot,$book_date,$facility_id)
{
    $this->db->where('time_slot',$time_slot);
    $this->db->where('book_date',$book_date);
    $this->db->where('facility_id',$facility_id);
    $this->db->where('status',1);
    $count=$this->db->get('bookfacility_tb');
    if($count)
    {
        return $count->num_rows();
    }
    else
    {
        return $count->num_rows();
    }
}

public function bookinghistory_mdl($id)
{
    $this->db->select('*');
    $this->db->from('bookfacility_tb bf');
    $this->db->join('facility_tb f','f.facility_id=bf.facility_id');
    $this->db->where('bf.user_id',$id);
    $where="bf.confirm_booking_status =1 and bf.status=1 and bf.pay_status=0";
    $this->db->where($where);
    $book_history=$this->db->get();
    if($book_history)
    {
        return $book_history->result();
    }
    else
    {
        return false;
    }
     }

     public function directorylist_mdl()
     {
        $this->db->select('*');
        $this->db->from('users_tb u');
        $this->db->join('wing_tb w','w.wing_id=u.wing_id');
        $this->db->join('home_tb h','h.wing_id=w.wing_id and h.home_id=u.home_id');
        $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
        $where="u.status=1 and (user_type= 'owner' or user_type='tenant')";
        $this->db->where($where);
        $this->db->order_by("wing_name", "asc");
        $this->db->order_by("home_no", "asc");
        $directory=$this->db->get();
        if($directory)
        {
            return $directory->result();
        }
        else
        {
            return false;
        }

     }
     public function venderlist_mdl()
     {
        $this->db->where('status',1);
        $vender_list=$this->db->get('vender_tb');
        if($vender_list)
        {
            return $vender_list->result();
        }
        else
        {
            return false;
        }

     }

     //notification for booking facility
    
public function read_notification($read)
{   $where="approve_disapprove_status=2 or approve_disapprove_status=1";
    $this->db->where($where);
    $this->db->update('bookfacility_tb',$read);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}
public function select_notification($id)
{
    $this->db->select('*');
    $this->db->from('facility_tb f');
    $this->db->join('bookfacility_tb b','b.facility_id=f.facility_id');
    $where = "user_id ='$id'";
    $this->db->where($where);
    $this->db->limit(5);
    $this->db->order_by("book_id","desc");
    $select_sql = $this->db->get();
    if($select_sql->num_rows())
    {
        return $select_sql->result();
    }
    else
    {
        return false;
    }
}
public function unread_noti($id)
{
    $this->db->select('*');
    $this->db->from('facility_tb f');
     $this->db->join('bookfacility_tb b','b.facility_id=f.facility_id');
    $where = "user_id ='$id' and (approve_disapprove_status=1 or approve_disapprove_status=2)";
    $this->db->where($where);
    $select_sql = $this->db->get();
    if($select_sql->num_rows())
    {
        return $select_sql->result();
    }
}
public function read_notification_issue($read_issue)
{
    $this->db->where('issue_progress_status',2);
    $this->db->update('issue_tb',$read_issue);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}
public function select_notification_issue($id)
{
    $this->db->select('*');
    $this->db->from('issue_tb');
    $where = "user_id ='$id' and (issue_progress_status=3 or issue_progress_status=2)";
    $this->db->where($where);
    $this->db->limit(5);
    $this->db->order_by("issue_id","desc");
    $select_sql = $this->db->get();
    if($select_sql->num_rows())
    {
        return $select_sql->result();
    }
    else
    {
        return false;
    }
}
public function unread_noti_issue($id)
{
    $this->db->select('*');
    $this->db->from('issue_tb f');
    $where = "user_id ='$id' and  issue_progress_status = 2";
    $this->db->where($where);
    $select_sql = $this->db->get();
    if($select_sql->num_rows())
    {
        return $select_sql->result();
    }
}
public function delete_facility_mdl($id,$facility)
{
    /*$this->db->where('book_id',$id);
    $delete=$this->db->delete('bookfacility_tb');
    if($delete)
    {
        return true;
    }
    else
    {
        return false;
    }*/

    $this->db->where('book_id',$id);
    $this->db->update('bookfacility_tb',$facility);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function panicalert_mdl($id)
{
    $this->db->select('*');
     $this->db->where('user_id',$id);
     $this->db->where('emergency_status','yes');
    $query = $this->db->get('member_tb');
    if($query)
    {
        return $query->result();
    }
    else
    {
    return false;
    }
    echo "hudfg";


}
public function emergency_notification_mdl($emergency,$utid)
{
    $this->db->where('user_id',$utid);
    $this->db->where('emergency_status','yes');
    $this->db->update('member_tb',$emergency);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}


public function insert_record($img)
{
    $insert=$this->db->insert('webcame',$img);
    if($insert)
    {
        return true;
    }
    else
    {
        return false;
    }

}
public function delete_issue_mdl($issue,$del_id)
{
    $this->db->where('issue_id',$del_id);
    $this->db->update('issue_tb',$issue);
    if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
}

public function add_issue_mdl($issue)
{
    $issu=$this->db->insert('issue_tb',$issue);
    if($issu)
    {
        return true;
    }
    else
    {
        return false;
    }

}
public function show_issue_mdl($id)
{
    $this->db->select('*');
    $this->db->where('user_id',$id);
    $this->db->where('status',1);
    $issue=$this->db->get('issue_tb');
    if($issue)
    {
        return $issue->result();
    }
    else
    {
        return false;
    }

}
//change password

 public function changeprofile_mdl($id,$profile,$cur_pass,$n_pass)
    {
        $cur_pass1=md5($cur_pass);
        $this->db->where('user_id',$id);
        $this->db->where('password',$cur_pass1);
        $change_sql=$this->db->update('users_tb',$profile);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

 public function changeprofile_same_pass_mdl($id,$n_pass,$cur_pass)
    {
        $n_pass1=md5($n_pass);
        $cur_pass1 =md5($cur_pass);
        $this->db->select('*');
        $this->db->from('users_tb');
        $this->db->where('user_id',$id);
        $this->db->where('password',$cur_pass1);
        $this->db->where('password',$n_pass1);
        $samepass_sql=$this->db->get();
        if($samepass_sql->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function change_profile_mdl($user,$uid)
    {
        $this->db->where('user_id', $uid);
        $this->db->update('users_tb', $user);
        if($this->db->affected_rows())
        {
            return $this->db->affected_rows();
        }
        else
        {
            return $this->db->affected_rows();
        }
        echo "hoo";

    }

   public function paymentdetail_mdl($uid,$id)
{
    $this->db->select('*');
    $this->db->from('bookfacility_tb bf');
    $this->db->join('facility_tb f','f.facility_id=bf.facility_id');
    $this->db->join('users_tb u','u.user_id=bf.user_id');
    $this->db->where('bf.book_id',$uid);
    $this->db->where('u.user_id',$id);
    $this->db->where('bf.confirm_booking_status',1);
    //jinal
    $this->db->where('bf.status',1);
    $paymenthistory=$this->db->get();
    if($paymenthistory)
    {
        return $paymenthistory->result();
    }
    else
    {
        return false;
    }
     }

     public function update_pay_status_mdl($book_id,$update_status)
     {
        $this->db->where('book_id',$book_id);
        $this->db->update('bookfacility_tb',$update_status);
       if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
     }
public function reset_password_mdl($profile,$username)
{
        $this->db->where('username',$username);
        $change_sql=$this->db->update('users_tb',$profile);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
}
public function reset_samepassword_mdl($n_pass,$username)
{
    $n_pass1 = md5($n_pass);
    $this->db->select('*');
    $this->db->from('users_tb');
    $this->db->where('username',$username);
    $this->db->where('password',$n_pass1);
    $reset_samepass_sql = $this->db->get();
    if($reset_samepass_sql->num_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}






/* jinal virani */ 

// notice //

public function show_notice_mdl()
{
    $this->db->select('*');
    $this->db->from('notice_tb');
    $this->db->where('is_sent','yes');
    $this->db->where('status',1);
    $this->db->order_by("added_on desc,time desc");
    $shownotice_sql=$this->db->get();
    if($shownotice_sql->num_rows())
    {
        return $shownotice_sql->result();
    }
    else
    {
        return false;
    }

}

/* admin info */
public function get_admin_info_mdl()
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
    $this->db->where('user_type','admin');
    $getusertype_sql=$this->db->get();
    if($getusertype_sql->num_rows())
    {
    return $getusertype_sql->result();
    }
}

public function registration_for_poll_mdl($regi_poll)
{
    $this->db->insert('poll_registration',$regi_poll);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}
public function unregistration_for_poll_mdl($id)
{
    $this->db->where('user_id',$id);
    $this->db->where('status',1);
    $this->db->delete('poll_registration');
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }   
}

public function regi_unregi_mdl($id)
{
    $this->db->select('*');
    $this->db->from('poll_registration');
    $this->db->where('user_id',$id);
    $this->db->where('status',1);
    $regi_unregi_sql=$this->db->get();
    if($regi_unregi_sql->num_rows())
    {
         return $regi_unregi_sql->result();
    }
}

/* display poll for vot */
public function poll_create_view_mdl()
{
    $this->db->select('*');
    $this->db->from('notice_tb');
    $this->db->where('notice_type','poll');
    $this->db->where('is_sent','yes');    
    $this->db->where('status',1);
    $poll_sql = $this->db->get();
    if($poll_sql->num_rows())
    {
        return $poll_sql->result();
    }
    else
    {
        return false;
    }
}

public function pol_regi_member_mdl()
{
    $this->db->select('*');
    $this->db->from('notice_tb n ');
    $this->db->join('poll_registration p','p.notice_id=n.notice_id'); 
    $this->db->join('users_tb u','u.user_id=p.user_id');  
    $this->db->where('p.status',1);
    $this->db->limit(2);
    $poll_sql = $this->db->get();
    if($poll_sql->num_rows())
    {
        return $poll_sql->result();
    }
    else
    {
        return false;
    }
}
public function disp_header_poll_result($max)
{
    $this->db->where('notice_id',$max);
    $header_sql = $this->db->get('notice_tb');
    if($header_sql->num_rows() > 0)
    {
        return $header_sql->result();
    }
    else
    {
        return false;
    }
}
/* vote */
public function vote_mdl($vote)
{
    $this->db->insert('vote_tb',$vote);
    $this->db->insert_id();
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function check_user_vote_mdl($id)
{
    $this->db->select('*');
    $this->db->from('vote_tb');
    $this->db->where('user_id',$id);
    $this->db->where('status',1);
    $vote_sql=$this->db->get();
    if($vote_sql->num_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* poll result */
public function get_notice_id_result()
{
     $this->db->select_max('notice_id');
     $id=$this->db->get('poll_registration');
     if($id->num_rows())
    {
        return $id->row();
    }
    else
    {
       return false;
   }
}
public function poll_result_mdl($max)
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('poll_registration p','p.user_id = u.user_id');
    $this->db->where('notice_id',$max);
    $this->db->order_by('p.user_id');
    $this->db->limit(2);
    $result_sql = $this->db->get();
    if($result_sql->num_rows())
    {
        return $result_sql->result();
    }
    else
    {
        return false;
    }
}

public function count_votes($max)
{
    $this->db->select('given_vote,count(given_vote) as countvotes');
    $this->db->from('vote_tb');
    $this->db->where('notice_id',$max);
    $this->db->group_by("given_vote");
    $this->db->order_by('given_vote');
    $vote_sql = $this->db->get();
    if($vote_sql->num_rows())
    {
        return $vote_sql->result();
    }
}

public function count_total_vote_mdl($max)
{
   $this->db->select('count(given_vote) as counttotalvotes');
    $this->db->from('vote_tb');
    $this->db->where('notice_id',$max);
    $vote_sql = $this->db->get();
    if($vote_sql->num_rows())
    {
        return $vote_sql->result();
    }
}
public function win_mdl($user_id)
{
    $this->db->select('firstname');
    $this->db->where('user_id',$user_id);
    $name_sql = $this->db->get('users_tb');
    if($name_sql->num_rows() > 0)
    {
        return $name_sql->result();
    }
    else
    {
        return false;
    }
}
public function check_poll_associative()
{
    $this->db->where('is_sent','yes');
    $this->db->where('status',1);
    $this->db->where('notice_type','poll');
    $check_poll_associative_sql= $this->db->get('notice_tb');
     if($check_poll_associative_sql->num_rows())
    {
        return $check_poll_associative_sql->result();
    }
    else
    {
        return false;
    }
}

//select count('given_vote'),firstname from users_tb u,vote_tb v WHERE u.user_id=v.given_vote GROUP BY given_vote
    
public function post_mdl($post)
{
    $this->db->insert('Post_tb',$post);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}



public function show_post_mdl()
{
    $this->db->select('caption,p.pic,post_id,likes,u.pic as picc,username,p.time,p.added_on,w.wing_name,h.home_no,ut.user_type');
    $this->db->from('post_tb p');
    $this->db->join('users_tb u','u.user_id = p.user_id');
    $this->db->join('wing_tb w','w.wing_id = u.wing_id');
    $this->db->join('home_tb h','h.home_id = u.home_id');
    $this->db->join('usertype_tb ut','u.user_id = ut.user_id');
    $this->db->where('p.status',1);
    $this->db->order_by("p.added_on desc,time desc");
    $showpost_sql=$this->db->get();
    if($showpost_sql->num_rows())
    {
        return $showpost_sql->result();
    }
    else
    {
        return false;
    }

}

public function post_like_mdl($like)
{
    $this->db->insert('like_tb',$like);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function check_like_mdl($utid,$post_id)
{
    $this->db->where('post_id',$post_id);
    $this->db->where('user_id',$utid);
    $like_unlike_sql = $this->db->get('like_tb');
    if($like_unlike_sql->num_rows() == 1)
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function old_like_mdl($post_id)
{
    $this->db->select('likes');
    $this->db->where('post_id',$post_id);
     $likes=$this->db->get('post_tb');
     if($likes->num_rows())
    {
        return $likes->row();
    }
    else
    {
       return false;
   }  
}

public function update_like_mdl($update_like,$post_id)
{
    $this->db->where('post_id', $post_id);
    $this->db->update('post_tb', $update_like);
}

public function post_unlike_mdl($post_id,$id)
{
    $this->db->where('post_id',$post_id);
    $this->db->where('user_id',$id);
    $this->db->delete('like_tb');
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function maintanance_mdl($id)
{
    $this->db->where('user_id',$id);
    $this->db->where('pay_status',0);
    $maintanance_sql = $this->db->get('maintanance_tb');
    if($maintanance_sql->num_rows() > 0)
    {
        return $maintanance_sql->result();
    }
    else
    {
        return false;
    }
}
public function booking_unpaid_mdl($id)
{
    $this->db->select('*');
    $this->db->from('bookfacility_tb bf');
    $this->db->join('facility_tb f','f.facility_id=bf.facility_id');
    $this->db->where('bf.user_id',$id);
    $where="(bf.confirm_booking_status =1 and bf.status=1 and bf.pay_status=0 )";
    $this->db->where($where);
    $book_history=$this->db->get();
    if($book_history)
    {
        return $book_history->result();
    }
    else
    {
        return false;
    }   
}
public function booking_unpaid_penalty_mdl($id)
{
    $this->db->select('*');
    $this->db->from('bookfacility_tb bf');
    $this->db->join('facility_tb f','f.facility_id=bf.facility_id');
    $this->db->where('bf.user_id',$id);
    $where="(bf.status=0 and bf.pay_status=0 )";
    $this->db->where($where);
    $book_history=$this->db->get();
    if($book_history)
    {
        return $book_history->result();
    }
    else
    {
        return false;
    }   
}

public function revenue_unpaid_mdl($id)
{
    $this->db->where('user_id',$id);
    $where = "type='revenue' and pay_status=0";
    $this->db->where($where);
    $revenue_unpaid_sql = $this->db->get('expense_tb');
    if($revenue_unpaid_sql->num_rows() > 0)
    {
        return $revenue_unpaid_sql->result();
    }
    else
    {
        return false;
    }
}
/* visiter */
public function display_visiter_mdl($wing_id,$home_id)
    {
        $this->db->select('*');
        $this->db->from('visiter_tb v');
        $this->db->join('wing_tb w','w.wing_id=v.wing_id');
        $this->db->join('home_tb h','h.home_id=v.home_id');
        $this->db->where('v.added_on',date('Y-m-d'));
        $this->db->where('v.wing_id',$wing_id);
        $this->db->where('v.home_id',$home_id);
        $where="staff_id IS NULL and (in_out_status=1 or in_out_status=0)";
        $this->db->where($where);
        $showvisiter_sql=$this->db->get();
        if($showvisiter_sql->num_rows())
        {
            return $showvisiter_sql->result();
        }
        else
        {
            return false;
        }
    }
public function count_total_visiter_mdl($wing_id,$home_id)
    {
       $this->db->select('*');
        $this->db->from('visiter_tb v');
        $this->db->join('wing_tb w','w.wing_id=v.wing_id');
        $this->db->join('home_tb h','h.home_id=v.home_id');
        $this->db->where('v.added_on',date('Y-m-d'));
        $this->db->where('in_out_status',1);
        $this->db->where('v.wing_id',$wing_id);
        $this->db->where('v.home_id',$home_id);
       $where="staff_id IS NULL and (in_out_status=1 or in_out_status=0)";
        $this->db->where($where);
        $countvisiter_sql=$this->db->get();
        if($countvisiter_sql){
            return $countvisiter_sql->result();
        }
        
}

public function staff_attendence_mdl()
{
        $this->db->select('*');
        $this->db->from('visiter_tb v');
        $this->db->join('staff_tb s','s.staff_id = v.staff_id');
        $this->db->where('v.added_on',date('Y-m-d'));
        $where="v.staff_id IS NOT NULL and (in_out_status=1 or in_out_status=0)";
        $this->db->where($where);
        $showvisiter_sql=$this->db->get();
        if($showvisiter_sql->num_rows())
        {
            return $showvisiter_sql->result();
        }
        else
        {
            return false;
        }   
}

public function paymentdetail_maintenance_mdl($m_id,$id)
{
    $this->db->select('*');
    $this->db->from('maintanance_tb m');
    $this->db->join('users_tb u','u.user_id=m.user_id');
    $this->db->where('maintanance_id',$m_id);
    $this->db->where('u.user_id',$id);
    $pay_maintenace_sql = $this->db->get();
    if($pay_maintenace_sql->num_rows() > 0)
    {   
        return $pay_maintenace_sql->result();
    }   
    else
    {
        return false;
    }
}
public function update_pay_status_maintanance_mdl($maintanance_id,$update_status)
{
    $this->db->where('maintanance_id',$maintanance_id);
    $this->db->update('maintanance_tb',$update_status);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}
public function paymentdetail_booking_penalty_mdl($bpid,$id)
{
    $this->db->select('*');
    $this->db->from('bookfacility_tb bf');
    $this->db->join('facility_tb f','f.facility_id=bf.facility_id');
    $this->db->join('users_tb u','u.user_id=bf.user_id');
    $this->db->where('bf.book_id',$bpid);
    $this->db->where('u.user_id',$id);
    $this->db->where('bf.confirm_booking_status',1);
    //jinal
    $this->db->where('bf.status',0);
    $paymenthistory=$this->db->get();
    if($paymenthistory)
    {
        return $paymenthistory->result();
    }
    else
    {
        return false;
    }
}

public function paymentdetail_revenue_mdl($rid,$id)
{
    $this->db->select('*');
    $this->db->from('expense_tb e');
    $this->db->join('users_tb u','u.user_id=e.user_id');
    $this->db->where('expense_revenue_id',$rid);
    $this->db->where('u.user_id',$id);
    $this->db->where('type','revenue');
    $paymenthistory=$this->db->get();
    if($paymenthistory)
    {
        return $paymenthistory->result();
    }
    else
    {
        return false;
    }
}
public function update_pay_revenue_mdl($expense_revenue_id,$update_status)
{
    $this->db->where('expense_revenue_id',$expense_revenue_id);
    $this->db->update('expense_tb',$update_status);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

}
?> 