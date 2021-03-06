<?php
class Posts extends CI_Controller{

public function __construct() {
		parent::__construct();

		$this->load->model('user_registration_model');
	}
	public function index(){
$data['title'] ='latest posts';
$data['posts'] = $this->post_model->get_posts();
$this->load->view('templates/loggout');
$this->load->view('posts/index', $data);
$this->load->view('templates/footer'); 
}
public function view($slug = NULL)
{
	$data['post'] = $this->post_model->get_posts($slug);
	if(empty($data['post']))
	{
		show_404();
	}
	$data['title'] =$data['post']['title'];
	$this->load->view('templates/loggout');
	$this->load->view('posts/view',$data);
	$this->load->view('templates/footer');

}
public function create()
{
	 $data['title'] ='Create post';
	 $this->form_validation->set_rules('category', 'Category', 'required');
	 $this->form_validation->set_rules('title', 'Title', 'required');
	 $this->form_validation->set_rules('body', 'Body', 'required');
	 if($this->form_validation->run() === FALSE)
	 {
	$this->load->view('templates/loggout');
	$this->load->view('posts/create',$data);
	$this->load->view('templates/footer');
	 }
	else
	{
		$this->post_model->create_post();
		redirect('posts');
	}
}
function search(){
	$data['posts'] = $this->post_model->searh_rooms_model($checkin,$checkout,$adults,$children);
	$this->load->view('pages/rooms-suites',$data);
}

}
?>










