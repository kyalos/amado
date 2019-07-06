	<?php
class Post_model extends CI_Model{
     public function __constrget_get_uct(){
          $this->load->database();
          $this->load->dbforge();
          $this->load->library('session');
     }
     public function add_to_cart($prod_id){

          //initialization
          $product_firstname = "kitcheco";

          $this->db->select('product_firstname'); 
          $this->db->from('product');
          $this->db->where( array('prod_id'=>$prod_id));
          

          $query = $this->db->get();
          $result = $query->result();

          foreach ($result as $row){
          $product_firstname = $row->product_firstname;
         }

         $product_firstname;

          $product_lastname = "kitcheco";

          $this->db->select('product_lastname'); 
          $this->db->from('product');
          $this->db->where( array('prod_id'=>$prod_id));
          

          $query = $this->db->get();
          $result = $query->result();

          foreach ($result as $row){
          $product_lastname = $row->product_lastname;
         }

           $product_lastname;
    
          $price = 100;

          $this->db->select('price'); 
          $this->db->from('product');
          $this->db->where( array('prod_id'=>$prod_id));

          $query = $this->db->get();
          $result = $query->result();

          foreach ($result as $row){
          $price = $row->price;
         }

           $price;

           $image1 = "img.jpg";

          $this->db->select('image_1'); 
          $this->db->from('product');
          $this->db->where( array('prod_id'=>$prod_id));

          $query = $this->db->get();
          $result = $query->result();

          foreach ($result as $row){
          $image_1 = $row->image_1;
         }

           $image_1;

          $user_id=$this->session->userdata('user_id');


          //default quantity
          $quantity =1;
          $data = array(
            'product_firstname' => $product_firstname,
            'product_lastname' => $product_lastname,
            'price' => $price,
            'quantity'=>$quantity,
            'user_id' => $user_id,
            'image_1' => $image_1,
            'prod_id' => $prod_id
);

       $this->db->insert('cart', $data);
      
      $cart_id = 1;

      $this->db->select('cart_id'); 
      $this->db->from('cart');
      $this->db->where( array('prod_id'=>$prod_id));
        
      $query = $this->db->get();
      $result = $query->result();      
      
      foreach ($result as $row){
          $cart_id = $row->cart_id;
         }
          
          $user_id=$this->session->userdata('user_id');
          $d = array(
            'cart_id' => $cart_id,
            'price' => $price,
            'user_id' => $user_id
);
         return $this->db->insert('receipt', $d);

         
	}

 public function get_prices()
 {
        $price = 1;
        $total_price=1;
         
          $user_id=$this->session->userdata('user_id');

          $this->db->select('*'); 
          $this->db->from('receipt');
          $array = array('user_id' => $user_id);
          $this->db->where($array);
          $query = $this->db->get();
          return $query->result();

         //  foreach ($result as $row){
         //  $price = $row->price;
         //  $total_price+=$price;
         // }         

         // $receipt = array('total_price' => $total_price);
         // return $receipt;
 }

 public function get_all_users()
 {
        $this->db->select('*'); 
          $this->db->from('users');
          $query = $this->db->get();
          return $query->result();

 }

 public function get_all_user_types()
 {
        $this->db->select('*'); 
          $this->db->from('user_type');
          $query = $this->db->get();
          return $query->result();

 }
     
 public function get_product($prod_id)
 {
    $x = 1;

     $this->db->select('*'); 
          $this->db->from('product');
          $this->db->where( array('prod_id'=>$prod_id));
          $this->db->where( array('in_stock'=>$x));
          $query = $this->db->get();
          return $query->result();
 }

 public function get_product_colors($prod_id)
 {
    $this->db->select('color'); 
          $this->db->from('product');
          $this->db->where( array('prod_id'=>$prod_id));
          $query = $this->db->get();
          return $query->result();
 }

 public function get_all_products()
 {
          $this->db->select('*'); 
          $this->db->from('product');
          $query = $this->db->get();
          return $query->result();
 }
 public function products_by_popularity(){
          $this->db->select('*'); 
          $this->db->from('product');
          $this->db->order_by("sell_count","desc");
          $query = $this->db->get();
          return $query->result();
 }
 public function get_company_products($company)
 {
          $this->db->select('*');
          $this->db->where( array('company'=>$company)); 
          $this->db->from('product');
          $query = $this->db->get();
          return $query->result();
 }
 public function get_all_products_in_cart()
 {
          $user_id=$this->session->userdata('user_id');

          $this->db->select('*'); 
          $this->db->from('cart');

          $array = array('user_id' => $user_id);
          $this->db->where($array);
          $query = $this->db->get();
          return $query->result();


 }

 public function get_all_categories()
 {
          $this->db->select('*'); 
          $this->db->from('category');
          $query = $this->db->get();
          return $query->result();
 }
  public function get_all_companies()
 {
          $this->db->select('company'); 
          $this->db->from('product');
          $query = $this->db->get();
          return $query->result();
 }


    //validate a user

    function validate(){    
    $user_password = $this->input->post('user_password');
    $this->db->where('email', $this->input->post('email'));
    $this->db->where('user_password', $user_password);
    
    $query = $this->db->get('users');
    
    if($query->num_rows() == 1){
      $data = array (       
        'last_update' => date("m/d/Y", time())
      );
      foreach ($query->result() as $row){
        $user_id = $row->user_id;
        $email = $row->email;
        $firstname=  $row->firstname;
        $secondname= $row->secondname;
        $profile_image = $row->profile_image;
      }     
      $arr_return = array('user_id' => $user_id, 'firstname' => $firstname, 'secondname' => $secondname, 'email' => $email, 'profile_image' => $profile_image, 'res' => true);      
      return $arr_return;     
      
      return true;
    }else{
      $arr_return = array('user_id' => '', 'email' => '', 'firstname' => '' , 'secondname' => '', 'profile_image' => '','res' => false);      
      return $arr_return;
    }
  }
    
     public function register_user($data){
      $insert = $this->db->insert('users',$data);
      return $insert;
     }


  public function remove_from_cart($prod_id)
  {
     $user_id=$this->session->userdata('user_id');

     $array = array('user_id' => $user_id, 'prod_id' => $prod_id);
     $this->db->where($array);
     $this->db->delete('cart'); 
  }

  public function remove_product_from_list($prod_id)
  {
     $this->db->where('prod_id',$prod_id);
     $this->db->delete('product'); 
  }
  public function remove_user($user_id)
  {
     $this->db->where('user_id', $user_id);
     $this->db->delete('user'); 
  }


  function save_product($data){
    $insert = $this->db->insert('product',$data);
    $insert_id = $this->db->insert_id();

     //get the insert Id and use to insert images

          if ($insert){
            $res = $this->upload_image1($insert_id);
                  
            $r= $this->upload_image2($insert_id);

      if ($res['result'] && $r['result'] && $rr['result'] == true){
        $array_return = array('result'=>true,'message'=>'Saved and uploaded image successfully');       
      }else{
        $array_return = array('result'=>false,'message'=>'Saved but did not upload image successfully. ' . $res['message']);
        //redirect('pages/reading');
      }

    }else{
      $array_return = array('result'=>false,'message'=>'Could not save article successfully. Please try again.');
      //redirect('posts/write');
    }

    return $array_return;
  }
  public function upload_image1($id){
    
      if(basename($_FILES['image_1']['name'])!=''){
      $config = array(
        'upload_path' => "./uploads/",
        'allowed_types' => "gif|jpg|png|jpeg|pdf",
        'overwrite' => TRUE,
        'max_size' => "2048000",
        'max_height' => "0",
        'max_width' => "0"
      );
             $this->load->library('upload');
      $this->upload->initialize($config);

      if($this->upload->do_upload('image_1')){
        $dt = $this->upload->data();
        $this->db->where(array('prod_id'=>$id));
        $this->db->update('product',array('image_1'=>$dt['file_name']));

        $array_return = array('result'=>true,'message'=>'Image uploaded successfully');
        //$data = array('upload_data' => $this->upload->data());
        //$this->load->view('upload_success',$data);
      }else{
        $array_return = array('result'=>false, 'message'=>$this->upload->display_errors());
        //$error = array('error' => $this->upload->display_errors());
        //$this->load->view('custom_view', $error);
      }

    }
  

    return $array_return;
  }
  public function upload_image2($id){
    if (basename($_FILES['image_2']['name']) != ''){
      
      $config = array(
        'upload_path' => "./uploads/",
        'allowed_types' => "gif|jpg|png|jpeg|pdf",
        'overwrite' => TRUE,
        'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
        'max_height' => "0",
        'max_width' => "0"
      );

      $this->load->library('upload');
      $this->upload->initialize($config);

      if($this->upload->do_upload('image_2')){
        $dt = $this->upload->data();

        $this->db->where(array('prod_id'=>$id));
        $this->db->update('product',array('image_2'=>$dt['file_name']));

        $array_return = array('result'=>true,'message'=>'Image uploaded successfully');
        //$data = array('upload_data' => $this->upload->data());
        //$this->load->view('upload_success',$data);
      }else{
        $array_return = array('result'=>false, 'message'=>$this->upload->display_errors());
        //$error = array('error' => $this->upload->display_errors());
        //$this->load->view('custom_view', $error);
      }

    }

    return $array_return;
  }

  public function reduce_quantity($qty)
  {

     $user_id=$this->session->userdata('user_id');
     $this->db->where('user_id', $user_id);
     $this->db->update('quantity', $qty);
  }

  public function add_quantity($qty)
  {
     $user_id=$this->session->userdata('user_id');
     $this->db->where('user_id', $user_id);
     $this->db->update('quantity', $qty);
  }

}
?>