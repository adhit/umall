<?php
class User_model extends Model {

    function User_model()
    {
        parent::Model();
    }
	
	function get($data) {
		$this->db->from('um_user')->where($data);
		$q=$this->db->get();
		if($q->num_rows()==0) return false;
		else return $q->result_array();
	}
	
	function get_custom($query) {
		$this->db->from('um_user');
		$this->db->where($query);
		$q=$this->db->get();
		if($q->num_rows()==0) return false;
		else return $q->result_array();
	}
	
	function update($old, $new) {
		$this->db->where($old);
		$this->db->update('um_user', $new);
	}
	
	function delete($data) {
		$this->db->where($data);
		$this->db->delete('um_user');
	}
	
	function signin($email, $pass) {
		$data=array('email'=>$email,'pass'=>$pass,'enabled'=>'yes');
		$q=$this->get($data);
		if(!$q) return false; 
		else return $q[0];
	}
	
	function find_nonpending($email) {
		$data=array('email'=>$email,'enabled !='=>'pending');
		$q = $this->get($data);
		if(!$q) return false; 
		else return $q[0];
	}
		
	function find_disabled($email) {
		$this->db->from('um_user');
		$this->db->where('email', $email);
		$this->db->where('enabled', 'no'); 
		$query = $this->db->get();
		$data=array('email'=>$email,'enabled'=>'no');
		$q = $this->get($data);
		if(!$q) return false; 
		else return $q[0];
	}
	
	function register($data) {
		$this->db->insert('um_user',$data);
	}
	
	function getone($data) {
		$q = $this->get($data);
		if(!$q) return false; 
		else return $q[0];
	}
	
	function getone_custom($query) {
		$q=$this->get_custom($query);
		if(!$q) return false;
		else return $q[0];
	}
	
	function activate($user) {
		$user['enabled']='yes';
		$user['timeEdited']=date("Y-m-d H:m:s",time());
		$this->update(array('userID'=>$user['userID']),$user);
	}
	
	function set_pass($user,$pass) {
		$user['pass']=$pass;
		$user['timeEdited']=date("Y-m-d H:m:s",time());
		$this->update(array('userID'=>$user['userID']),$user);
	}
}
?>
