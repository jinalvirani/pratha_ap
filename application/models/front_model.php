<?php
class Front_model extends CI_model
{
	public function get_facility_mdl()
	{
		$this->db->where('status',1);
		$facility = $this->db->get('facility_tb');
		if($facility->num_rows() > 0)
		{
			return $facility->result();
		}
		else
		{
			return false;
		}
	}
	public function get_associative_mdl()
	{
		$this->db->select('*');
	    $this->db->from('users_tb u');
	    $this->db->join('usertype_tb ut','ut.user_id=u.user_id');
	    
	    $where = "user_type='admin' or user_type='associative' and u.status=1";
	    $this->db->where($where);
	    $asso_sql=$this->db->get();
	    if($asso_sql->num_rows())
	    {
	        return $asso_sql->result();
	    }
	    else
	    {
	        return false;
	    }
	}
}
?>