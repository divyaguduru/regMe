<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set("Asia/Kolkata");
  }

  public function create_user(){
  	$username=$this->input->post('username');
  	$fathername=$this->input->post('fathername');
  	$email=$this->input->post('email');
  	$gender=$this->input->post('gender');

  	$this->db->where('username',$username);
  	$this->db->from('users');
  	$query=$this->db->get();
  	if($query->num_rows>0)return 2;
  	$dump_array=array(
  		'username'=>$username,
  		'fathername'=>$fathername,
  		'email'=>$email,
  		'gender'=>$gender
  		);
  	$this->db->insert('users',$dump_array);
  	if($this->db->affected_rows()){
  		return 1;
  	}
  	return -1;
  }

  public function get_user_details($username){
  	$this->db->select('*');
  	$this->db->from('users');
  	$this->db->where('username',$username);
  	$query=$this->db->get();
  	$return_array=array();
  	if($query->num_rows>0){
  		
  		foreach ($query->result() as $rows) {
  			$temp=array(
  				'username'=>$rows->username,
  				'fathername'=>$rows->fathername,
  				'email'=>$rows->email,
  				'gender'=>$rows->gender,
  				'dateofsignup'=>$rows->date_of_signup
  				);
  			array_push($return_array,$temp );
  		}
  		return $return_array;
  	}
  	return false;
  }
  public function get_all_user_details(){
  	$query=$this->db->query('select * from users');

  	$return_array=array();
  	if($query->num_rows>0){
  		foreach ($query->result() as $rows) {

  			$temp=array(
  				'username'=>$rows->username,
  				'fathername'=>$rows->fathername,
  				'email'=>$rows->email,
  				'gender'=>$rows->gender,
  				'dateofsignup'=>$rows->date_of_signup
  				);
  			array_push($return_array,$temp );
  		}
  		return $return_array;
  	}
  	return false;
  }


  public function update_user($username){
  	$this->db->where('username',$username);
  	$data=array(
  		'email'=>$this->input->post('email'),
  		'fathername'=>$this->input->post('fathername'),
  		'gender'=>$this->input->post('gender')
  		);
  	$this->db->update('users',$data);
  	if($this->db->affected_rows()){
  		return true;
  	}
  	return false;
  }

  public function delete_user($username){
  	$count = $this->db->count_all('users');
  	$sql="DELETE FROM users where username='".$username."'";
  	$this->db->query($sql);
  	$newcount=$this->db->count_all('users');
  	if($newcount<$count){
  		return true;
  	}
  	return false;	
  }

}

?>