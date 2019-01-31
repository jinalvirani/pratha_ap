<?php
class Admin_model extends CI_model
{
	/* login */
	public function loginadmin_mdl($unm,$pass1)
	{
        $this->db->select('*');
        $this->db->from('users_tb u');
        $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
        $this->db->where(['username'=>$unm,'password'=>$pass1]);
        $this->db->where('user_type','admin');
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

	/* set profile */
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

	/* fill wing & home  */
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

    /* change profile */
    public function changeadmin_mdl($admin,$admin_type,$id)
    {
    	$admin_type['user_id']=$id;
        $this->db->where('user_id',$id);
    	$this->db->update('usertype_tb',$admin_type);

        $this->db->where('user_id',$id);
        $this->db->update('users_tb',$admin);
    	if($this->db->affected_rows())
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }
 /* display admin */
    public function showadmin_mdl($id)
    {

        $this->db->select('*');
        $this->db->from('users_tb u');
        $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
        $this->db->join('wing_tb w','w.wing_id=u.wing_id');
        $this->db->where('user_type','admin');
        
        $showadmin_sql=$this->db->get();
    	if($showadmin_sql->num_rows())
    	{
    		return $showadmin_sql->result();
    	}
    	else
    	{
    		return false;
    	}
    }

    /* change password */

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

/*  check username */
public function checkusername_mdl($username)
{

    $this->db->select('*');
    $this->db->from('users_tb');
    $this->db->where('status',1);
    $this->db->where('username',$username);
     $existusernm_sql=$this->db->get();
        if($existusernm_sql->num_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
   
   
} 

/* check wing for admin and associative */
public function checkwing_mdl($wingno)
{
    $where="wing_id='$wingno' and ( user_type='admin' or user_type='associative' )";
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
    $this->db->where('u.status',1);
    $this->db->where($where);
     $existwing_sql=$this->db->get();
        if($existwing_sql->num_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
}

public function checkwingedit_mdl($wingno,$id)
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
    $where="wing_id='$wingno' and ( user_type='admin' or user_type='associative' ) and u.user_id!='$id' and u.status=1";
    $this->db->where($where);
     $existwing_sql=$this->db->get();
        if($existwing_sql->num_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
}

/* edit admin info */
 public function editadmin_mdl($admin,$id)
    {
      
        $this->db->where('user_id',$id);
        $this->db->update('users_tb',$admin);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

/* associative insert */
public function addassociative_mdl($associative,$associative_type)
{
    $this->db->insert('users_tb',$associative);
    $lastid =$this->db->insert_id();
    $associative_type['user_id']=$lastid;
    $this->db->insert('usertype_tb',$associative_type);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* associative display*/
 public function showassociative_mdl()
    {

        $this->db->select('*');
        $this->db->from('users_tb u');
        $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
        $this->db->join('wing_tb w','w.wing_id=u.wing_id');
        $this->db->where('u.status',1);
        $this->db->where('user_type','associative');
        
        $showassociative_sql=$this->db->get();
        if($showassociative_sql->num_rows())
        {
            return $showassociative_sql->result();
        }
        else
        {
            return false;
        }
    }

/* fill feilds of associative*/
    public function getassociativeinfo_mdl($asso_id)
    {
        $this->db->select('*');
        $this->db->from('users_tb u');
        $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
        $this->db->join('wing_tb w','w.wing_id=u.wing_id');
        $this->db->where('user_type','associative');
        $this->db->where('u.user_id',$asso_id);
        $editassociative_sql=$this->db->get();
        if($editassociative_sql->num_rows())
        {
            return $editassociative_sql->result();
        }
        else
        {
            return false;
        }
    }

/* edit associative*/
public function editassociative_mdl($associative,$asso_id,$associative_type)
{
        $this->db->where('user_id',$asso_id);
        $this->db->update('usertype_tb',$associative_type);

         $this->db->where('user_id',$asso_id);
        $this->db->update('users_tb',$associative);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
   
}

/* delete associative */
public function deleteassociative_mdl($asso,$asso_delete_id)
{
    $this->db->where('user_id',$asso_delete_id);
    $this->db->update('users_tb',$asso);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}


/* add security guard */

public function addguard_mdl($guard,$guard_type)
{
    $this->db->insert('users_tb',$guard);
    $lastid =$this->db->insert_id();
    $guard_type['user_id']=$lastid;
    $this->db->insert('usertype_tb',$guard_type);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* guard display */
 public function showguard_mdl()
    {

        $this->db->select('*');
        $this->db->from('users_tb u');
        $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
        $this->db->where('status',1);
        $this->db->where('user_type','securityguard');
        $showguard_sql=$this->db->get();
        if($showguard_sql->num_rows())
        {
            return $showguard_sql->result();
        }
        else
        {
            return false;
        }
    }

/* get guard info for edit*/
 public function getguardinfo_mdl($guard_id)
    {
        $this->db->select('*');
        $this->db->from('users_tb u');
        $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
        $this->db->where('user_type','securityguard');
        $this->db->where('u.user_id',$guard_id);
        $editguard_sql=$this->db->get();
        if($editguard_sql->num_rows())
        {
            return $editguard_sql->result();
        }
        else
        {
            return false;
        }
    }

/* update guard */
public function editguard_mdl($guard,$guard_id,$guard_type)
{
        $this->db->where('user_id',$guard_id);
        $this->db->update('usertype_tb',$guard_type);
         $this->db->where('user_id',$guard_id);
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

/* delete guard */
public function deleteguard_mdl($guard,$guard_delete_id)
{
    $this->db->where('user_id',$guard_delete_id);
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

/* vender insert */
public function addvender_mdl($vender)
{
    $this->db->insert('vender_tb',$vender);
     if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* show vender */
public function showvender_mdl()
    {

        $this->db->select('*');
        $this->db->from('vender_tb');
        $this->db->where('status',1);
        $showvender_sql=$this->db->get();
        if($showvender_sql->num_rows())
        {
            return $showvender_sql->result();
        }
        else
        {
            return false;
        }
    }

/* delete vender */
public function deletevender_mdl($vender,$vender_delete_id)
{
    echo $vender_delete_id;
    $this->db->where('vender_id',$vender_delete_id);
    $this->db->update('vender_tb',$vender);
     if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
}

/* fill vender info */
public function getvenderinfo_mdl($vender_id)
{
        $this->db->select('*');
        $this->db->from('vender_tb');
        $this->db->where('vender_id',$vender_id);
        $editvender_sql=$this->db->get();
        if($editvender_sql->num_rows())
        {
            return $editvender_sql->result();
        }
        else
        {
            return false;
        }
}


/* update vender */
public function editvender_mdl($vender,$vender_id)
{
        $this->db->where('vender_id',$vender_id);
        $this->db->update('vender_tb',$vender);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }

}

/* facility insert */
public function addfacility_mdl($facility)
{
    $this->db->insert('facility_tb',$facility);
     if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* display facility */
public function showfacility_mdl()
{
        $this->db->select('*');
        $this->db->from('facility_tb');
        $this->db->where('status',1);
        $showvender_sql=$this->db->get();
        if($showvender_sql->num_rows())
        {
            return $showvender_sql->result();
        }
        else
        {
            return false;
        }
}

/* delete facility */
public function deletefacility_mdl($facility,$facility_delete_id)
{
    $this->db->where('facility_id',$facility_delete_id);
    $this->db->update('facility_tb',$facility);
     if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }
}

/* fill facility info */
public function getfacilityinfo_mdl($facility_id)
{
        $this->db->select('*');
        $this->db->from('facility_tb');
        $this->db->where('facility_id',$facility_id);
        $editfacility_sql=$this->db->get();
        if($editfacility_sql->num_rows())
        {
            return $editfacility_sql->result();
        }
        else
        {
            return false;
        }
}

/* update facility */
public function editfacility_mdl($facility,$facility_id)
{
        $this->db->where('facility_id',$facility_id);
        $this->db->update('facility_tb',$facility);
        if($this->db->affected_rows())
        {
            return true;
        }
        else
        {
            return false;
        }

}


/* insert notice */
public function addnotice_mdl($notice)
{
    $this->db->insert('notice_tb',$notice);
     if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* get id */
public function getnoticeid()
{
    $this->db->select_max('notice_id');
     $id=$this->db->get('notice_tb');
     if($id->num_rows())
    {
        return $id->row();;
    }
    else
    {
       return false;
   }
}

/* notice updateee 1 */
public function add_notice_mdl($notice,$nid)
{
    $this->db->where('notice_id',$nid);
    $this->db->update('notice_tb',$notice);
     if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* get owner and tenant*/
public function getuser_ids_mdl()
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('usertype_tb ut','ut.user_id=u.user_id');  
    $this->db->where(['user_type' => 'owner','u.status' => 1, 'u.approve_status' => 1]); 
    $r = $this->db->get();
    return $r->result();
}
public function getuser_ids_fest_mdl()
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('usertype_tb ut','ut.user_id=u.user_id'); 
    $where="(user_type='owner' or user_type='tenant') and is_resident = 'yes' and u.status=1 and approve_status=1"; 
    //$this->db->where(['user_type' => 'owner','u.status' => 1]); 
    $this->db->where($where);
    $rr = $this->db->get();
    if($rr)
    {
        return $rr->result();
    }
    else
    {
        return false;
    }
}

/* maintanace table entry */
public function maintanance($main)
{
    $this->db->insert('maintanance_tb',$main);
}
public function festi($fest)
{
    $this->db->insert('expense_tb',$fest);
}

/* show default notice */
public function shownotice_mdl()
{   $this->db->select('*');
    $this->db->from('notice_tb');
    $this->db->where('is_default','yes');
    $this->db->where('status',1);
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
/* defalut notice fill */
public function getnoticeinfo_mdl($notice_id)
{
        $this->db->select('*');
        $this->db->from('notice_tb');
        $this->db->where('notice_id',$notice_id);
        $getnoticeinfo_sql=$this->db->get();
        if($getnoticeinfo_sql->num_rows())
        {
            return $getnoticeinfo_sql->result();
        }
        else
        {
            return false;
        }
}

/* delete notice */
public function deletenotice_mdl($notice,$notice_delete_id)
{
    $this->db->where('notice_id',$notice_delete_id);
    $this->db->update('poll_registration',$notice);

    $this->db->where('notice_id',$notice_delete_id);
    $this->db->update('notice_tb',$notice);

    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* poll created or not */
public function getpoll_mdl()
{
    $this->db->select('*');
    $this->db->from('notice_tb');
    $this->db->where('is_sent','yes');
    $this->db->where('notice_type','poll');
    $this->db->where('status',1);
    $poll_sql=$this->db->get();
    if($poll_sql->num_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* view all notice */
public function view_all_notice_mdl()
{
    $this->db->select('*');
    $this->db->from('notice_tb');
    $this->db->where('is_sent','yes');
    $this->db->where('status',1);
    $viewotice_sql=$this->db->get();
    if($viewotice_sql->num_rows())
    {
        return $viewotice_sql->result();
    }
    else
    {
        return false;
    }
}

/* poll */

/* poll_create_view */
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

public function opne_poll_mdl($nid,$poll_open)
{
    $this->db->where('notice_id',$nid);
    $this->db->update('notice_tb',$poll_open);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function close_poll_mdl($nid,$poll_close,$remove_poll_user)
{
    $this->db->where('notice_id',$nid);
    $this->db->update('poll_registration',$remove_poll_user);
    $this->db->where('notice_id',$nid);
    $this->db->update('vote_tb',$remove_poll_user);
    $this->db->where('notice_id',$nid);
    $this->db->update('notice_tb',$poll_close);

    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function open_close_mdl()
{
    $this->db->where('open_close','open');
    $this->db->where('status',1);
    $o_c_sql = $this->db->get('notice_tb');
    if($o_c_sql->num_rows())
    {
        return $o_c_sql->result();
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



//============================== dashboard ========================
public function dashboard_new_reques_mdl()
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('usertype_tb ut','u.user_id =ut.user_id');
    $this->db->join('wing_tb w','w.wing_id=u.wing_id');
    $this->db->join('home_tb h','h.home_id=u.home_id');
    $this->db->where('user_type','owner');
    $this->db->where('approve_status',0);
    $new_sql = $this->db->get();
    if($new_sql->num_rows() > 0)
    {
        return $new_sql->result();
    }
    else
    {
        return false;
    }
}
public function dashboard_request_approve_mdl($approve,$user_id)
{
    $this->db->where('user_id',$user_id);
    $this->db->update('users_tb',$approve);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}
public function get_email($user_id)
{   
    $this->db->where('user_id',$user_id);
    $this->db->select('email');
    $id=$this->db->get('users_tb');
     if($id->num_rows())
    {
        return $id->row();
    }
    else
    {
       return false;
   }
}
public function dashboard_request_disapprove_mdl($user_id)
{
    $this->db->where('user_id',$user_id);
    $this->db->delete('users_tb');
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function wings_mdl()
{
    $this->db->where('status',1);
    $wing_sql = $this->db->get('wing_tb');
    if($wing_sql->num_rows())
    {
        return $wing_sql->result();
    }
    else
    {
        return false;
    }
}

public function wing_add_mdl($wing)
{
    $this->db->insert('wing_tb',$wing);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function dashboard_wing_check_mdl($wing)
{
    $this->db->where('status',1);
    $this->db->where('wing_name',$wing);
    $check_wing_sql = $this->db->get('wing_tb');
    if($check_wing_sql->num_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}
public function delete_wing_mdl($wing_id,$wing)
{
    $this->db->where('wing_id',$wing_id);
    $this->db->update('Wing_tb',$wing);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}


public function homes_mdl()
{
    $this->db->select('*');
    $this->db->from('wing_tb w');
    $this->db->join('home_tb h','w.wing_id = h.wing_id');
    $this->db->where('h.status',1);
    $home_sql = $this->db->get();
    if($home_sql->num_rows())
    {
        return $home_sql->result();
    }
    else
    {
        return false;
    }
}

public function home_add_mdl($home)
{
    $this->db->insert('home_tb',$home);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}
/* dashboard owner */

public function owners_mdl()
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
    $this->db->join('wing_tb w','w.wing_id=u.wing_id');
    $this->db->join('home_tb h','h.home_id=u.home_id');
    $this->db->group_by('u.user_id');
    $this->db->where('u.status',1);
     $this->db->where('approve_status',1);
    $this->db->where('user_type','owner');
    //$this->db->where('is_resident','yes');
    $showadmin_sql=$this->db->get();
    if($showadmin_sql->num_rows())
    {
        return $showadmin_sql->result();
    }
   else
    {
        return false;
    }
}
public function owners_old_mdl()
{
    $this->db->select('u.*,w.*,h.*,ut.user_type');
    $this->db->from('users_tb u');
    $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
    $this->db->join('wing_tb w','w.wing_id=u.wing_id');
    $this->db->join('home_tb h','h.home_id=u.home_id');
    $this->db->where('u.status',0);
    $this->db->where('user_type','owner');

    $showadmin_sql=$this->db->get();
    if($showadmin_sql->num_rows())
    {
        return $showadmin_sql->result();
    }
   else
    {
        return false;
    }
}
public function delete_owner_mdl($owner_id,$owner)
{
    $this->db->where('user_id',$owner_id);
    $this->db->update('users_tb',$owner);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}
public function delete_tenant_with_owner_mdl($owner_id,$owner)
{
    $this->db->where('owner_id',$owner_id);
    $this->db->update('users_tb',$owner);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* dashboard tenant */
public function tenants_mdl()
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
    $this->db->join('wing_tb w','w.wing_id=u.wing_id');
    $this->db->join('home_tb h','h.home_id=u.home_id');
    $this->db->group_by('u.user_id');
    $this->db->where('u.status',1);
    $this->db->where('user_type','tenant');
    $this->db->where('is_resident','yes');
    $showadmin_sql=$this->db->get();
    if($showadmin_sql->num_rows())
    {
        return $showadmin_sql->result();
    }
   else
    {
        return false;
    }
}


/* dashboard booking */
public function bookings_mdl()
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('bookfacility_tb b','u.user_id = b.user_id');
    $this->db->join('facility_tb f','f.facility_id = b.facility_id ');
    $where = "approve_disapprove_msg IS NULL";
    $this->db->where($where);
    $showadmin_sql=$this->db->get();
    if($showadmin_sql->num_rows())
    {
        return $showadmin_sql->result();
    }
   else
    {
        return false;
    }
}
public function approve_booking_mdl($booking_id,$booking)
{
    $this->db->where('book_id',$booking_id);
    $this->db->update('bookfacility_tb',$booking);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function disapprove_mdl($book_id,$disapprove)
{
    $this->db->where('book_id',$book_id);
    $this->db->update('bookfacility_tb',$disapprove);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}
public function view_bookings_mdl()
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('bookfacility_tb b','u.user_id = b.user_id');
    $this->db->join('facility_tb f','f.facility_id = b.facility_id ');
    $this->db->where('b.status',1);
    $this->db->where('confirm_booking_status',1);
    $this->db->where('pay_status',0);
    $showadmin_sql=$this->db->get();
    if($showadmin_sql->num_rows())
    {
        return $showadmin_sql->result();
    }
   else
    {
        return false;
    }
}
public function dashboard_booking_count()
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('bookfacility_tb b','u.user_id = b.user_id');
    $this->db->join('facility_tb f','f.facility_id = b.facility_id ');
    $where = "book_status=0 and approve_disapprove_msg IS NULL";
    $this->db->where($where);
    $showadmin_sql=$this->db->get();
    if($showadmin_sql->num_rows())
    {
        return $showadmin_sql->result();
    }
   else
    {
        return false;
    }
}

public function dashboard_directory_mdl()
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
public function dashboard_maintanance_mdl()
{
    $this->db->select('*');
    $this->db->from('users_tb u');
    $this->db->join('wing_tb w','w.wing_id=u.wing_id');
    $this->db->join('home_tb h','h.wing_id=w.wing_id and h.home_id=u.home_id');
    $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
    $this->db->join('maintanance_tb m','m.user_id=u.user_id');
   $where = "u.status=1 and (user_type='owner' or user_type='tenant') and ( CURRENT_DATE() > due_date and CURRENT_DATE() != due_date ) and pay_status = 0";
    
    $this->db->where($where);
    $maintanance=$this->db->get();
    if($maintanance)
    {
        return $maintanance->result();
    }
    else
    {
        return false;
    }

}



public function dashboard_home_check_mdl($home,$wing)
{
    $this->db->where('status',1);
    $this->db->where('home_no',$home);
    $this->db->where('wing_id',$wing);
    $check_home_sql = $this->db->get('home_tb');
    if($check_home_sql->num_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}
public function delete_home_mdl($home_id,$home)
{
    $this->db->where('home_id',$home_id);
    $this->db->update('home_tb',$home);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

/* notification */
public function read_notification($read)
{
    $this->db->where('book_status',0);
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
public function select_notification()
{
    $this->db->select('*');
    $this->db->from('facility_tb f');
    $this->db->join('bookfacility_tb b','b.facility_id=f.facility_id');
        $this->db->join('users_tb u','u.user_id=b.user_id');
    $this->db->order_by("book_id","desc");
    $this->db->limit(5);
    $select_sql = $this->db->get('');
    if($select_sql->num_rows() > 0)
    {
        return $select_sql->result();
    }
     else
    {
        return false;
    }
}
public function unread_noti()
{
    $this->db->where('book_status',0);
    $select_sql = $this->db->get('bookfacility_tb');
    if($select_sql->num_rows() > 0)
    {
        return $select_sql->result();
    }
}


public function read_notification_issue($read)
{
    $this->db->where('issue_progress_status',0);
    $this->db->update('issue_tb',$read);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}
public function select_notification_issue()
{
    $this->db->select('*');
    $this->db->from('issue_tb i');
    $this->db->join('users_tb u','u.user_id=i.user_id');
    $this->db->order_by("issue_id","desc");
    $this->db->where('i.status',1);
    $this->db->limit(5);
    $select_sql_issue = $this->db->get();
    if($select_sql_issue->num_rows() > 0)
    {
        return $select_sql_issue->result();
    }
    else
    {
        return false;
    }
   
}
public function unread_noti_issue()
{
    $this->db->where('issue_progress_status',0);
    $this->db->where('status',1);
    $select_sql_issue = $this->db->get('issue_tb');
    if($select_sql_issue->num_rows() > 0)
    {
        return $select_sql_issue->result();
    }
}

public function penalty_mdl($penalty,$mid)
{
    $this->db->where('maintanance_id',$mid);
    $this->db->update('maintanance_tb',$penalty);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function expense_add_mdl($expense)
{
    $this->db->insert('expense_tb',$expense);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function dashboard_expense_mdl($month,$year)
{
    $this->db->where('type','expense');
    $this->db->where('MONTH(added_on)',$month);
    $this->db->where('YEAR(added_on)',$year);
    $expense_sql = $this->db->get('expense_tb');
    if($expense_sql->num_rows() > 0)
    {
        return $expense_sql->result();
    }
    else
    {
        return false;
    }
}

public function dashboard_tol_expense_mdl($month,$year)
{
    $this->db->where('type','expense');
    $this->db->where('MONTH(added_on)',$month);
    $this->db->where('YEAR(added_on)',$year);
    $tol_expense = $this->db->get('expense_tb');
    if($tol_expense)
    {
        return $tol_expense->result();
    }
    else
    {
        return false;
    }
}

public function get_expense_info_mdl($expense_id)
{
    $this->db->where('type','expense');
    $this->db->where('expense_revenue_id',$expense_id);
    $get_expense = $this->db->get('expense_tb');
    if($get_expense)
    {
        return $get_expense->result();
    }
    else
    {
        return false;
    }
}

public function expense_update_mdl($expense,$expense_id)
{
    $this->db->where('expense_revenue_id',$expense_id);
    $this->db->update('expense_tb',$expense);
    if($this->db->affected_rows())
    {
        return true;
    }
    else
    {
        return false;
    }
}

public function dashboard_tol_revenue_mdl($month,$year)
{

    $this->db->where('pay_status',1);
    $this->db->where('MONTH(modified_on)',$month);
    $this->db->where('YEAR(modified_on)',$year);
    $tol_revenue = $this->db->get('maintanance_tb');
    if($tol_revenue)
    {
        return $tol_revenue->result();
    }
    else
    {
        return false;
    }
}

public function dashboard_tol_revenue_tbl_mdl($month,$year)
{
    $this->db->select('expense_revenue_name,sum(amount) as amt');
    $this->db->where('type','revenue');
    $this->db->where('MONTH(modified_on)',$month);
    $this->db->where('YEAR(modified_on)',$year);
    $this->db->where('pay_status',1);
    $this->db->group_by('expense_revenue_name');
    $tol_revenue = $this->db->get('expense_tb');
    if($tol_revenue)
    {
        return $tol_revenue->result();
    }
    else
    {
        return false;
    }
}

public function dashboard_tol_revenue_booking_mdl($month,$year)
{
    $this->db->where('pay_status',1);
    $this->db->where('status',1);
    $this->db->where('MONTH(modified_on)',$month);
    $this->db->where('YEAR(modified_on)',$year);
    $tol_revenue = $this->db->get('bookfacility_tb');
    if($tol_revenue)
    {
        return $tol_revenue->result();
    }
    else
    {
        return false;
    }
}

public function dashboard_tol_revenue_booking_penalty_mdl($month,$year)
{
    $this->db->where('pay_status',1);
    $this->db->where('status',0);
    $this->db->where('MONTH(modified_on)',$month);
    $this->db->where('YEAR(modified_on)',$year);
    $tol_revenue = $this->db->get('bookfacility_tb');
    if($tol_revenue)
    {
        return $tol_revenue->result();
    }
    else
    {
        return false;
    }
}


public function issue_mdl()
{
    $this->db->select('title,firstname,discription,i.pic,issue_id');
    $this->db->from('issue_tb i');
    $this->db->join('users_tb u','u.user_id=i.user_id');
    $this->db->where('issue_progress_status',1);
    $this->db->where('i.status',1);
    $issue_sql = $this->db->get();
    if($issue_sql->num_rows() > 0)
    {
        return $issue_sql->result();
    }
    else
    {
        return false;
    }
}

public function solved_issue_mdl($issue_id,$issue)
{
    $this->db->where('issue_id',$issue_id);
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
/* reset pass */
public function reset_password_mdl($profile,$username)
{
        $this->db->where('username',$username);
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