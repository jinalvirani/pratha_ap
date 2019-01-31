<?php
class Guard_model extends CI_model
{
	public function loginguard_mdl($unm,$pass)
	{
		
		$this->db->select('*');
		$this->db->from('users_tb u');
		$this->db->join('usertype_tb ut','ut.user_id=u.user_id');
		$this->db->where(['username'=>$unm,'password'=>$pass]);
		$this->db->where('user_type','securityguard');
		$this->db->where('status',1);
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
	public function getwing_mdl()
    {
        $this->db->where('status',1);
        $query = $this->db->get('wing_tb');
        return $query->result(); 
    }
    public function fillhome_mdl($wing_id)
    {
        $this->db->where('status',1);
        $query= $this->db->get_where('home_tb',array('wing_id' => $wing_id));
     return $query->result();
    }
	public function getusertype_mdl($userid)
	{
		$this->db->select('*');
		$this->db->from('users_tb u');
		$this->db->join('usertype_tb ut','ut.user_id=u.user_id');
		$this->db->where('u.user_id',$userid);
		$getusertype_sql=$this->db->get();

		if($getusertype_sql->num_rows())
		{
		return $getusertype_sql->result();
		}
	}


	public function display_staff_mdl()
	{
 		$this->db->select('*');
        $this->db->from('staff_tb');
        $showstaff_sql=$this->db->get();
        if($showstaff_sql->num_rows())
        {
            return $showstaff_sql->result();
        }
        else
        {
            return false;
        }
	}

	public function staff_in_mdl($staff)
	{
		$this->db->insert('visiter_tb',$staff);
	    if($this->db->affected_rows())
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	    }

	}

	public function staff_out_mdl($staff,$staff_id)
	{	
		$this->db->where('staff_id',$staff_id);
		$this->db->update('visiter_tb',$staff);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
	}

	public function check_staff_in($staff_id)
	{
		$this->db->where('added_on',date('Y-m-d'));
		$this->db->where('staff_id',$staff_id);
		$this->db->where('in_out_status',1);
		$in_out_sql = $this->db->get('visiter_tb');
		if($in_out_sql->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	/*public function check_staff_out($staff_id)
	{
		$this->db->where('added_on',date('Y-m-d'));
		$this->db->where('staff_id',$staff_id);
		$this->db->where('in_out_status',0);
		$in_out_sql = $this->db->get('visiter_tb');
		if($in_out_sql->num_rows() > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}*/


	/* wbecam*/
	public function add_visiter_mdl($visiter)
	{
		$this->db->insert('visiter_tb',$visiter);
	    if($this->db->affected_rows())
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	    }

	}

	public function display_visiter_mdl()
	{
 		$this->db->select('*');
        $this->db->from('visiter_tb v');
        $this->db->join('wing_tb w','w.wing_id=v.wing_id');
        $this->db->join('home_tb h','h.home_id=v.home_id');
        $this->db->where('in_out_status',1);
        $where="staff_id IS NULL";
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
	public function out_visiter_mdl($visiter,$visiter_id)
	{	
		$this->db->where('visiter_id',$visiter_id);
		$this->db->update('visiter_tb',$visiter);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
	}


/*public function changeprofile_mdl($id,$profile,$cur_pass,$n_pass)
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
    }*/

    public function changeprofile_mdl($id,$profile,$cur_pass,$n_pass)
    {
        $cur_pass1=md5($cur_pass);
        $this->db->where('user_id',$id);
        $this->db->where('password',$cur_pass1);
        $this->db->update('users_tb',$profile);
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

/* profile change */
 public function editguard_mdl($guard,$id)
    {
      
        $this->db->where('user_id',$id);
        $this->db->update('users_tb',$guard);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
 public function sound_mdl()
 {
 	$this->db->select('wing_name,home_no');
 	$this->db->from('users_tb u');
 	$this->db->join('member_tb m','u.user_id=m.user_id');
 	$this->db->join('wing_tb w','w.wing_id=u.wing_id');
 	$this->db->join('home_tb h','h.home_id=u.home_id');
 	$this->db->group_by('home_no');
 	$this->db->group_by('wing_name');
 	$this->db->where('emergency_notification',1);
 	$sound_sql = $this->db->get();
 	if($sound_sql->num_rows() > 0)
 	{
 		return $sound_sql->result();
 	}
 	
 }
 public function ok_mdl($ok)
 {
 	$this->db->update('member_tb',$ok);
 	if($this->db->affected_rows())
 	{
 		return true;
 	}
 }

 /* landline no*/
public function landline_no_mdl()
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('wing_tb w','w.wing_id=u.wing_id');
    $this->db->join('home_tb h','h.wing_id=w.wing_id and h.home_id=u.home_id');
    $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
    $where = "u.status=1 and (user_type='owner' or user_type='tenant')";
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
 /* reset pass */
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

}
?>