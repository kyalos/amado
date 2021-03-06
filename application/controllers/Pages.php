<?php
class Pages extends CI_Controller{
	public function __construct() {
		parent::__construct();
    $this->load->helper('form');
    $this->load->library('session');
		$this->load->model('post_model');
	}


	public function view(){

      if($this->session->userdata('loginstate')) {
    		$data['products'] = $this->post_model->get_all_products();
    		
           // $this->load->view('templates/header');
           $this->load->view('pages/homeloggedin',$data);
           // $this->load->view('templates/footer');
      }
      else
      {
         $data['products'] = $this->post_model->get_all_products();
        
           // $this->load->view('templates/header');
           $this->load->view('pages/home',$data);
      }
}

    //View each product
public function homewinkel()
{
  $data['products'] = $this->post_model->get_all_products();
  $this->load->view('pages/homewinkel',$data);
}


  public function view_product($prod_id)
  {

    $data['categories'] = $this->post_model->get_all_categories();  

    $data['products'] = $this->post_model->get_product($prod_id);

    
    $data['companies'] = $this->post_model->get_all_companies();

    $data['colors'] = $this->post_model->get_product_colors($prod_id);


    $this->load->view('pages/view_product',$data);
  }

  public function cart(){
      if($this->session->userdata('loginstate')) {


        $data['prices'] = $this->post_model->get_prices();
        $data['cart_products'] = $this->post_model->get_all_products_in_cart();
       // $this->load->view('templates/header');
       $this->load->view('pages/cart',$data);
       // $this->load->view('templates/footer');

       }
       else
       {
        $this->load->view('pages/login');
       }
} 
public function login_page(){
    
       // $this->load->view('templates/header');

       $this->load->view('pages/login');
       // $this->load->view('templates/footer');

}

public function shop(){
  if($this->session->userdata('loginstate')) {

    		$data['products'] = $this->post_model->get_all_products();

        $data['categories'] = $this->post_model->get_all_categories();	
        
        $data['companies'] = $this->post_model->get_all_companies();		
		
       // $this->load->view('templates/header');
       $this->load->view('pages/shoploggedin',$data);
       // $this->load->view('templates/footer');
     }
     else
     { 
        $data['products'] = $this->post_model->get_all_products();

        $data['categories'] = $this->post_model->get_all_categories();  
        
        $data['companies'] = $this->post_model->get_all_companies();    
       // $this->load->view('templates/header');
       $this->load->view('pages/shop',$data);
       // $this->load->view('templates/footer');
     }
   }

   public function shop_by_popularity(){
  if($this->session->userdata('loginstate')) {

        $data['products'] = $this->post_model->get_all_products_by_popularity();

        $data['categories'] = $this->post_model->get_all_categories();  
        
        $data['companies'] = $this->post_model->get_all_companies();    
    
       // $this->load->view('templates/header');
       $this->load->view('pages/shoploggedin',$data);
       // $this->load->view('templates/footer');
     }
     else
     { 
        $data['products'] = $this->post_model->get_all_products_by_popularity();

        $data['categories'] = $this->post_model->get_all_categories();  
        
        $data['companies'] = $this->post_model->get_all_companies();    
    
       // $this->load->view('templates/header');
       $this->load->view('pages/shop',$data);
       // $this->load->view('templates/footer');
     }
   }

   public function get_company_products($company){
  if($this->session->userdata('loginstate')) {

        $data['products'] = $this->post_model->get_company_products($company);

        $data['categories'] = $this->post_model->get_all_categories();  
        
        $data['companies'] = $this->post_model->get_all_companies();    
    
       // $this->load->view('templates/header');
       $this->load->view('pages/shoploggedin',$data);
       // $this->load->view('templates/footer');
     }
     else
     { 
        $data['products'] = $this->post_model->get_company_products($company);

        $data['categories'] = $this->post_model->get_all_categories();  
        
        $data['companies'] = $this->post_model->get_all_companies();    
    
       // $this->load->view('templates/header');
       $this->load->view('pages/shop',$data);
       // $this->load->view('templates/footer');
     }
   }
   public function product_details($prod_id){

   	   $data['products'] = $this->post_model->get_product($prod_id);
		
       // $this->load->view('templates/header');
       $this->load->view('pages/product_details',$data);
       // $this->load->view('templates/footer');
   }
   public function checkout(){
	
      if($this->session->userdata('loginstate')) {
       $this->load->view('pages/checkout');
       // $this->load->view('templates/footer');
     }
     else
     {
       $this->load->view('pages/login');  
     }
}

        //cart items
  public function add_to_cart($prod_id)
  {  
      //check if user is logged
      if($this->session->userdata('loginstate')) {


      $this->post_model->add_to_cart($prod_id);      
      

       $this->post_model->get_prices();

        $data['products'] = $this->post_model->get_all_products();

        $data['categories'] = $this->post_model->get_all_categories();  
        
        $data['companies'] = $this->post_model->get_all_companies(); 

         
    $this->session->set_flashdata('success', 'Successfully added a new product.');
        $this->load->view('pages/shop',$data);
   }
   else

   {

    $this->session->set_flashdata('success', 'Please Login, Thank you.');
       $this->load->view('pages/login');
   }
  }

   public function remove_from_cart($prod_id)
  {  
      //check if user is logged
      if($this->session->userdata('loginstate')) {


      $this->post_model->remove_from_cart($prod_id);      
      


        $data['cart_products'] = $this->post_model->get_all_products_in_cart();
          
        $this->session->set_flashdata('success', 'Successfully deleted product from cart.');
        $this->load->view('pages/cart',$data);
   }
 }

   function login(){
   $query = $this->post_model->validate();

   if($query['res'] == true){
     $this->session->set_userdata('loginstate', TRUE);
     $this->session->set_userdata('user_id', $query['user_id']);
     $this->session->set_userdata('email', $query['email']);
     $this->session->set_userdata('firstname', $query['firstname']);
     $this->session->set_userdata('secondname', $query['secondname']); 
     $this->session->set_userdata('profile_image', $query['profile_image']);    
     

       redirect('pages/cart');
     // $data['p'] = $this->post_model->get_list();
     // $data['categories'] = $this->post_model->get_categories();
     // $this->load->view('templates/newheader');
     // $this->load->view('pages/listpost', $data);
     // $this->load->view('templates/newfooter');

     }
   
   else{
     redirect('pages/view');
   
   }
  }
   function logout(){
   $this->session->sess_destroy();
   $data['products'] = $this->post_model->get_all_products();
   $this->load->view('pages/home',$data);
   }

   public function reduce_quantity($prod_id)
   {
      
      if($this->session->userdata('loginstate')) {
              $this->post_model->reduce_quantity($prod_id);


        $data['prices'] = $this->post_model->get_prices();
        $data['cart_products'] = $this->post_model->get_all_products_in_cart();
         $this->session->set_flashdata('warning', 'Successfully reduced the quantity.');
       // $this->load->view('templates/header');
       $this->load->view('pages/cart',$data);
       // $this->load->view('templates/footer');

       }
       else
       {
         $this->session->set_flashdata('warning', 'Please Login, Thank you.');
        $this->load->view('pages/login');
       }

   }

   public function add_quantity($prod_id)
   {
      
      if($this->session->userdata('loginstate')) {
              $this->post_model->add_quantity($prod_id);


        $data['prices'] = $this->post_model->get_prices();
        $data['cart_products'] = $this->post_model->get_all_products_in_cart();
       // $this->load->view('templates/header');

         $this->session->set_flashdata('warning', 'Successfully added the quantity.');
       $this->load->view('pages/cart',$data);
       // $this->load->view('templates/footer');

       }
       else
       {
         $this->session->set_flashdata('warning', 'Please Login, Thank you.');
        $this->load->view('pages/login');
       }
   }
 }
?>
