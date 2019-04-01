<?
class Login_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	
	public function chesk_user($in)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('username', $in['login']);
		$this->db->where('password', $in['password']);
		
		return $this->db->get()->row_array();
	}
}
