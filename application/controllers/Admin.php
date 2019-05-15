<?php
class Admin extends CI_Controller{
	public function __construct() {
	parent::__construct();
    $this->load->helper('form');
    $this->load->library('session');
	$this->load->model('post_model');
	}


	public function view(){

      // if($this->session->userdata('loginstate')) {
    		$data['products'] = $this->post_model->get_all_products();
    		$data['users'] = $this->post_model->get_all_users();
    		
           $this->load->view('pages/table',$data);
      }
      // else
      // {
      //      $this->load->view('pages/login',$data);
      // }



   public function remove_product_from_list($prod_id)
  {  
      //check if user is logged
      if($this->session->userdata('loginstate')) {


      $this->post_model->remove_product_from_list($prod_id);      
      

        $data['products'] = $this->post_model->get_all_products();
        $data['users'] = $this->post_model->get_all_users();

        $this->load->view('pages/table',$data);
   }
 }


   public function remove_user($user_id)
  {  
      //check if user is logged
      if($this->session->userdata('loginstate')) {


      $this->post_model->remove_user($user_id);      
      

        $data['products'] = $this->post_model->get_all_products();
        $data['users'] = $this->post_model->get_all_users();

        $this->load->view('pages/table',$data);
   }
}
   public function add_new_product()
   {
        $this->load->view('pages/add_new_product');
   }

   public function create()
{
   $this->form_validation->set_rules('product_firstname', 'Product_firsname','required');
   $this->form_validation->set_rules('product_lastname', 'Product_lastname');
   $this->form_validation->set_rules('description', 'Description','required');
   $this->form_validation->set_rules('company', 'Company','required');
   $this->form_validation->set_rules('in_stock', 'In_stock','required');
   $this->form_validation->set_rules('price', 'Price','required');
   $this->form_validation->set_rules('quantity', 'Quanity','required');

   if($this->form_validation->run() != FALSE)
   {
      $data = array(
      'product_firstname'=>$this->input->post('product_firstname'),
      'product_lastname' => $this->input->post('product_lastname'),
      'description' => $this->input->post('description'),
      'company' => $this->input->post('company'),
      'in_stock' => $this->input->post('in_stock'),
      'price' => $this->input->post('price'),
      'quantity' => $this->input->post('quantity')
    );
    $res = $this->post_model->save_product($data);
    redirect('admin/view');
   }
  else
  {
    $this->load->view('pages/home');   
  }
}
 
}
?>