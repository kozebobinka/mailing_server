<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Mailing extends CI_Controller
{
	private $uploads_dir = "./attachments/";
	private $our_email = 'info@fru-gkh.com.ua';
    private $our_name = 'Федерація роботодавців ЖКГ України';
    private $num_emails_per_time = 50;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mailing_model');
	}

	public function index()
	{
		if (!isset($this->session->username)) {
			redirect('login');
		}

		$this->form_validation->set_rules('terget', 'підприємства', 'trim');
		$this->form_validation->set_rules('region', 'регіон', 'trim');
		$this->form_validation->set_rules('sfera', 'сфера діяльності', 'trim');
		$this->form_validation->set_rules('city', 'населений пункт', 'trim');
		$this->form_validation->set_rules('member', 'членство', 'trim');
		$this->form_validation->set_rules('subject', 'тема', 'required');
		$this->form_validation->set_rules('attachment', 'файли', 'trim');
		$this->form_validation->set_rules('message', 'повідомлення', 'trim');

		if ($this->form_validation->run()) {

			$in = $this->input->post();

			$in['filename'] = '';
            $in['tmp_filename'] = '';
            foreach ($_FILES['attachment']['name'] as $n => $file) {
                if (($_FILES['attachment']['error'][$n] == UPLOAD_ERR_OK) and ($_FILES['attachment']['name'][$n] != '')) {
                    $ext = pathinfo($_FILES['attachment']['name'][$n], PATHINFO_EXTENSION);
                    $tmp_filename = $this->uploads_dir . uniqid() . ".$ext";
                    $in['tmp_filename'] .= '>' . $tmp_filename;
                    $in['filename'] .= '>' . $_FILES['attachment']['name'][$n];
                    copy($_FILES['attachment']['tmp_name'][$n], $tmp_filename);
                }
            }
            $in['filename'] = substr($in['filename'], 1);
            $in['tmp_filename'] = substr($in['tmp_filename'], 1);

            switch ($in['target']) {
                case 1:
                    $recipients = $this->mailing_model->get_recipients_factories($in);
                    break;
                case 2:
                    $recipients = $this->mailing_model->get_recipients_oms($in);
                    break;
            }
            $report_text = '';
			$num = 0;

			// генерим правильное письмо
			$in['message'] =
				$this->load->view("mailing/includes/letter_header", array(), TRUE) .
				$in['message'] .
				$this->load->view("mailing/includes/letter_footer", array(), TRUE);

			foreach ($recipients as $recipient) {

				$message = $in['message'];
				$in['message'] = str_replace('{{email}}', $recipient['e_mail'], $in['message']);
				$in['message'] = str_replace('{{encoded_email}}', urlencode($recipient['e_mail']), $in['message']);

                $this->mailing_model->put_to_mailstack(array_merge($in, $recipient));
                $report_text .= $recipient['povne_naymenuvannya'] . ' (' . $recipient['e_mail'] . ')<br>';
				$num++;
				$in['message'] = $message;

            }

			$report['subject'] = 'Звіт про розсилку ' . date('d.m.y H:i');
            $report['message'] = 'Повідомлення <b>"' . $in['subject'] . '"</b> було доставлено наступним адресатам:<br><br>' . (($report_text == '') ? 'нікому' : $report_text);
            $report['filename'] = 0;
            $report['tmp_filename'] = 0;
            $report['e_mail'] = $this->our_email;
            $report['povne_naymenuvannya'] = $this->our_name;

            $this->mailing_model->put_to_mailstack($report);

			$this->session->set_flashdata('success', "Листи для $num успішно додані в чергу розсилки");
			redirect('mailing');
		}

		$data = array(
			'sign' => $this->load->view('mailing/includes/sign', array(), TRUE),
			'regions' => $this->mailing_model->get_regions(),
			'sferas' => $this->mailing_model->get_sferas(),
			);
		$this->load->view('mailing/mailing', $data);
	}

	// ajax
	public function autocomplete_city()
	{
		$list = $this->mailing_model->get_cities($_POST);
		$cities = array();
		foreach ($list as $city) {
			$cities[] = $city->misto;
		}
		echo json_encode($cities);

	}

	// Вывод новостей или возврашение html через
	// ajax
	public function get_news_html($show = FALSE)
	{
		$data['news']  = $this->mailing_model->get_news(2);
		$data['blogs'] = $this->mailing_model->get_news(5);
		$data['show'] = $show;
		if ($show) {
			$this->load->view("mailing/includes/letter_header");
			$this->load->view('mailing/letters/news', $data);
			$this->load->view("mailing/includes/letter_footer");
		} else {
			echo $this->load->view('mailing/letters/news', $data, TRUE);
		}
	}

	// ajax
	public function get_letter_html()
	{
		echo $this->load->view("mailing/letters/{$_POST['letter_name']}", array(), TRUE);
	}

	// cron
    public function sendmail()
    {
        $mails = $this->mailing_model->get_mailstack($this->num_emails_per_time);


	    foreach ($mails as $m) {

			$this->email->from($this->our_email, $this->our_name);
			$this->email->to($m['email']);
            $this->email->subject(htmlspecialchars_decode($m['subject']));
			$this->email->message($m['body']);

			if ($m['tmp_filename'] != '') {
                $tmp_filename = explode('>', htmlspecialchars_decode($m['tmp_filename']));
                $filename = explode('>', htmlspecialchars_decode($m['filename']));
                foreach ($tmp_filename as $key => $tmp_file) {
                    $this->email->attach($tmp_file, '', $filename[$key]);
				}
            }

			if ($this->email->send()) {
                $this->mailing_model->change_status($m['id'], 1);
            } else {
                $this->mailing_model->change_status($m['id'], -1);
            }

            $this->email->clear(TRUE);
        }

        if (!$this->mailing_model->check_all_sended()) {
            $bad_mails = $this->mailing_model->get_bad_mails();
			$report_text = '';
            foreach ($bad_mails as $recipient) {
                $report_text .= $recipient['name'] . ' (' . $recipient['email'] . ')<br>';
            }
            if ($report_text != '') {
                $report['subject'] = 'Звіт про невдачі у розсилці ' . date('d.m.y H:i');
                $report['message'] = 'Повідомлення <b>НЕ</b> були доставлені наступним адресатам:<br><br>' . $report_text;
                $report['e_mail'] = 'gella@ints.net';
                $report['povne_naymenuvannya'] = $this->our_name;
                $report['filename'] ='';
                $report['tmp_filename'] = '';
                $this->mailing_model->put_to_mailstack($report, $report);
            }
        }
    }

    public function unsubscribe($email = '')
    {
		$data['email'] = urldecode($email);
		
		$this->form_validation->set_rules('email', 'email', 'trim|required');

		if ($data['done'] = $this->form_validation->run()) {
			$data['email'] = $this->input->post('email');
			$this->mailing_model->unsubscribe($this->input->post('email'));
		}
		
		$this->load->view('mailing/unsubscribe', $data);

    }
}
