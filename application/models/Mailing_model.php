<?
class Mailing_model extends CI_Model
{
	private $db_general;
	private $db_news;
	
	public function __construct()
	{
		parent::__construct();
		$this->db_general = $this->load->database('general', TRUE);
		$this->db_news = $this->load->database('news', TRUE);
	}
	
	public function get_regions()
	{
		$this->db->select('DISTINCT(`region`)');
		$this->db->from('table_1');
		$this->db->where("TRIM(`region`)<>''");
		$this->db->order_by('region');
		
		return $this->db->get()->result();

	}
	
	public function get_sferas()
	{
		return array(
			'1'  => 'Теплопостачання',
			'2'  => 'Водопостачання та водовідведення',
			'3'  => 'Вивезення та переробка побутових відходів',
			'4'  => 'Управління та утримання будинків та прибудинкових територій',
			'5'  => 'Обслуговування ліфтів',
			'6'  => 'Громадське обслуговування',
			'7'  => 'Ритуальні послуги',
			'8'  => 'Газопостачання',
			'9'  => 'Електропостачання',
			'10' => 'Благоустрій' ,
			'11' => 'Громадський транспорт',
			'12' => 'Зовнішнє освітлення',
			'13' => 'Обслуговування доріг'
		);
	}
	
	public function get_cities($in)
	{
		$this->db->select('misto');
		$this->db->from('table_3');
		$this->db->where("`misto` LIKE '%{$in['city']}%'");
		if ($in['region']) {
			$this->db->where('region', $in['region']);
		}
		$this->db->order_by('misto', 'ASC');
		return $this->db->get()->result();
	}
	
	public function get_recipients_factories($in)
	{
		$this->db->select('e_mail');
		$this->db->select('povne_naymenuvannya');
		$this->db->from('table_1');
		$this->db->where("TRIM(`e_mail`)<>''");
		if ($in['region']) {
			$this->db->where('region', $in['region']);
		}
		if ($in['sfera']) {
			$this->db->where("TRIM(`sfera_{$in['sfera']}`)<>''");
		}
		if ($in['city']) {
			$this->db->where('misto', $in['city']);
		}
		if (isset($in['member'])) {
			$this->db->where('member_or_not', 1);
		} else {
			$this->db->where('member_or_not', 0);
		}
		return $this->db->get()->result_array();
	}
	
	public function get_recipients_oms($in)
	{
		$this->db->select('e_mail');
		$this->db->select('`naymenuvannya` AS `povne_naymenuvannya`');
		$this->db->from('table_3');
		$this->db->where("TRIM(`e_mail`)<>''");
		return $this->db->get()->result_array();
	}
	
	public function get_news($punct)
	{
		$this->db_news->select('`news`.`id`');
		$this->db_news->select('`news`.`title`');
		$this->db_news->select('`pic_news`.`image_name`');
		$this->db_news->select('`news`.`news_anons`');
		$this->db_news->from('news');
		$this->db_news->join('pic_news', '`pic_news`.`news_name`=`news`.`title` AND `pic_news`.`anonsimg`=1', 'left');
		$this->db_news->where('punct', $punct);
		$this->db_news->order_by('`news`.`id`', 'DESC');
		$this->db_news->limit(3);
		return $this->db_news->get()->result_array();
	}
	
	public function put_to_mailstack($in)
	{
		$data = array(
			'email'			=> $in['e_mail'],
			'name'			=> $in['povne_naymenuvannya'],
			'subject'		=> $in['subject'],
			'body'			=> $in['message'],
			'filename'		=> $in['filename'],
			'tmp_filename'	=> $in['tmp_filename'],
		);
		$this->db_general->insert('mailstack', $data);
	}
	
	public function get_mailstack($num = 50)
	{
		$this->db_general->from('mailstack');
		$this->db_general->where('status', 0);
		$this->db_general->limit($num);
		return $this->db_general->get()->result_array();
	}
	
	public function change_status($id, $status)
	{
		$this->db_general->set('status', $status);
		$this->db_general->where('id', $id);
		$this->db_general->update('mailstack');
	}
	
	public function check_all_sended()
	{
		$this->db_general->select('id');
		$this->db_general->from('mailstack');
		$this->db_general->where('status', 0);
		return $this->db_general->get()->num_rows();
	}
	
	public function get_bad_mails()
	{
		$this->db_general->from('mailstack');
		$this->db_general->where('status', -1);
		$res = $this->db_general->get()->result_array();

		$this->db_general->set('status', -2);
		$this->db_general->where('status', -1);
		$this->db_general->update('mailstack');

		return $res;
	}
	
	public function unsubscribe($email)
	{
		$this->db->set('unsubscribed', 1);
		$this->db->where('e_mail', $email);
		$this->db->update('table_1');
		
		$this->db->set('unsubscribed', 1);
		$this->db->where('e_mail', $email);
		$this->db->update('table_3');
	}
	
}
