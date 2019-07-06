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
 

 //All lists here
  public function products_list()
  {
     $data['products'] = $this->post_model->get_all_products();
        
     $this->load->view('pages/products_list',$data);   
  }

  public function users_list()
  {
     $data['users'] = $this->post_model->get_all_users();
        
      $this->load->view('pages/users_list',$data);
  }

   public function remove_product_from_list($prod_id)
  
  {  
      //check if user is logged
     // if($this->session->userdata('loginstate')) {


      $this->post_model->remove_product_from_list($prod_id);      
      

        $data['products'] = $this->post_model->get_all_products();

        $this->load->view('pages/products_list',$data);
   //}
   // else
   // {

   // }

 }


       public function remove_user($user_id)
      {  
          //check if user is logged
          if($this->session->userdata('loginstate')) {


          $this->post_model->remove_user($user_id);      
          

            $data['users'] = $this->post_model->get_all_users();

            $this->load->view('pages/users_list',$data);
       }
    }




   public function add_new_user()
   {
      $data['user_types'] = $this->post_model->get_all_user_types();
      
      $this->load->view('pages/add_new_user',$data);
   }



   public function register_new_user_admin()
   {
   $this->form_validation->set_rules('firstname', 'Firstname','required');
   $this->form_validation->set_rules('lastname', 'Lastname','required');
   $this->form_validation->set_rules('email', 'Email', 'required');
   $this->form_validation->set_rules('dob', 'Dob','required');
   $this->form_validation->set_rules('country', 'Country','required');
   $this->form_validation->set_rules('address', 'Address','required');
   $this->form_validation->set_rules('gender', 'Gender','required');
   $this->form_validation->set_rules('town', 'Town','required');
   $this->form_validation->set_rules('user_type', 'User_type','required');
   $this->form_validation->set_rules('user_password', 'User_password','required');
   $this->form_validation->set_rules('phonenumber', 'Phonenumber','required');

   if($this->form_validation->run() != FALSE)
   {
      $data = array(
      'firstname'=>$this->input->post('firstname'),
      'lastname' => $this->input->post('lastname'),
      'email' => $this->input->post('email'),
      'dob' => $this->input->post('dob'),
      'country' => $this->input->post('country'),
      'address' => $this->input->post('address'),
      'gender' => $this->input->post('gender'),
      'town' => $this->input->post('town'),
      'user_type' => $this->input->post('user_type'),
      'user_password' => $this->input->post('user_password'),
      'phonenumber' => $this->input->post('phonenumber')
    );
    $res = $this->post_model->register_user($data);
    redirect('admin/add_new_user');
   }
  else
  {
    $data['products'] = $this->post_model->get_all_products();
    $this->load->view('pages/home',$data);   
  }
   }



   public function add_new_product()
   {
        $data['products'] = $this->post_model->get_all_products();
        $this->load->view('pages/add_new_product',$data);
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

    $this->session->set_flashdata('success', 'Successfully added a new product.');
    redirect('admin/add_new_product');
   }
  else
  {
    $this->session->set_flashdata('error', 'Unable to add new product.');
    $this->load->view('pages/home',$data);   
  }
}
 
}
?>