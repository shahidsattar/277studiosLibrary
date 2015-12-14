<?php
class Shop extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); 
		$this->load->model('model_shop');
		$this->load->model('model_users');
		$this->load->model('model_shop_cat_list');
		$this->load->library('flexi_cart');	
		$this->load->vars('base_url', base_url());
		$this->load->vars('includes_dir', base_url().'includes/');
		$this->load->vars('current_url', $this->uri->uri_to_assoc(1));
		
		/*$this->load->model('admin/model_orders');
		$this->load->model('admin/model_guideline');
		$this->load->model('admin/model_framed');
		$this->load->model('admin/model_urllink');
		$this->load->model('admin/model_notifications');
*/		
		
	}
	function index()
	{
		/************** Pagination Start **************/		
		$per_page =12;
		$total = $this->model_shop->count_rec_all();  //total post
		$data['results'] = $this->model_shop->view_all($per_page, $this->uri->segment(3));
		$config['base_url'] = $this->config->item('base_url').'shop/index/';
		$config['uri_segment'] = '3';
		$config['total_rows'] = $total;
		$config['per_page'] =   $per_page;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['cur_tag_open'] = '<b> &nbsp;';
		$config['cur_tag_close'] = '</b>';
		$config['full_tag_open'] = '<p>';
      	$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config);	
		/********** Pagination End *************/
		//$data['results'] = $this->model_shop->view_all();						
		$data['meta_desc'] = "Shop";
		$data['meta_keywords'] = "Shop";	
		$data['page_title'] = "Shop";	
		
		$data['left_cat_result']=$this->model_shop->get_all_cat_records();
		$data['left_quotes']=$this->model_urllink->get_urllink();
		$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
		$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
		$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
		$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
		$data['result_bottom_message'] = $this->model_bottom_message->get_record();
		$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
		$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();	
		/*$data['shop_basket'] = $this->model_shop->get_basket_record();*/
		
		$data['result_search'] = $this->model_shop->get_sub_record_search();
		$data['show_heading'] = "No";
	    $this->load->view('shop', $data);
	}
	
	function view()
	{
		$search_key = $this->uri->segment('3');
		/************** Pagination Start **************/		
		$per_page =12;
		$total = $this->model_shop->count_rec_all_key($search_key);  //total post
		$data['results'] = $this->model_shop->view_all_key($search_key,$per_page, $this->uri->segment(4));
		$config['base_url'] = $this->config->item('base_url').'shop/view/'.$search_key.'/';
		$config['uri_segment'] = '4';
		$config['total_rows'] = $total;
		$config['per_page'] =   $per_page;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['cur_tag_open'] = '<b> &nbsp;';
		$config['cur_tag_close'] = '</b>';
		$config['full_tag_open'] = '<p>';
      	$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config);	
		/********** Pagination End *************/						
		//$data['results'] = $this->model_shop->view_all_key($search_key);
		$data['meta_desc'] = "Shop";
		$data['meta_keywords'] = "Shop";	
		$data['page_title'] = "Shop";	
		
		$data['left_cat_result']=$this->model_shop->get_all_cat_records();
		$data['left_quotes']=$this->model_urllink->get_urllink();
		$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
		$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
		$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
		$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
		$data['result_bottom_message'] = $this->model_bottom_message->get_record();
		$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
		$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();	
		/*$data['shop_basket'] = $this->model_shop->get_basket_record();*/
		
		
		$data['result_search'] = $this->model_shop->get_sub_record_search();
		$data['show_heading'] = "No";
	    $this->load->view('shop', $data);
	}
	function search()
	{
		$search_key = $this->input->post('search_bar_1');
		/************** Pagination Start **************/		
		/*$per_page =12;
		$total = $this->model_shop->count_rec_all_search($search_key);  //total post
		$data['results'] = $this->model_shop->view_all_search($search_key,$per_page, $this->uri->segment(3));
		$config['base_url'] = $this->config->item('base_url').'shop/search/';
		$config['uri_segment'] = '3';
		$config['total_rows'] = $total;
		$config['per_page'] =   $per_page;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['cur_tag_open'] = '<b> &nbsp;';
		$config['cur_tag_close'] = '</b>';
		$config['full_tag_open'] = '<p>';
      	$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config);*/	
		/********** Pagination End *************/	
		$data['results'] = $this->model_shop->view_all_search($search_key);					
		$data['meta_desc'] = "Shop";
		$data['meta_keywords'] = "Shop";	
		$data['page_title'] = "Shop";	
		
		$data['left_cat_result']=$this->model_shop->get_all_cat_records();
		$data['left_quotes']=$this->model_urllink->get_urllink();
		$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
		$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
		$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
		$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
		$data['result_bottom_message'] = $this->model_bottom_message->get_record();
		$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
		$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();
		/*$data['shop_basket'] = $this->model_shop->get_basket_record();*/	
		
		
		$data['result_search'] = $this->model_shop->get_sub_record_search();
		$data['show_heading'] = "No";
		$data['search_indication'] = "1";
	    $this->load->view('shop', $data);
	}
	function shop_products()
	{						
		
		/************** Pagination Start **************/
		$cat_id = $this->uri->segment(3);
		//$shop_id = 7;
		$data['cart_items'] = $this->flexi_cart->cart_items();
		$per_page =12;
		$total = $this->model_shop->count_rec_cat_prod($cat_id);  //total post
		$data['results'] = $this->model_shop->view($cat_id,$per_page, $this->uri->segment(4));
		$config['base_url'] = $this->config->item('base_url').'shop/shop_products/'.$cat_id.'/';
		$config['uri_segment'] = '4';
		$config['total_rows'] = $total;
		$config['per_page'] =   $per_page;
		$config['first_link'] = 'First';
		$config['last_link'] = 'Last';
		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['cur_tag_open'] = '<b> &nbsp;';
		$config['cur_tag_close'] = '</b>';
		$config['full_tag_open'] = '<p>';
      	$config['full_tag_close'] = '</p>';
		$this->pagination->initialize($config);	
		/********** Pagination End *************/						
		$data['meta_desc'] = "Product";
		$data['meta_keywords'] = "Product";	
		$data['page_title'] = "Product";	
		
		$this->load->view('product_detail', $data);
	}
	
	function product()
	{
		//$cat_id = $this->uri->segment(3);
		//$sub_cat_id = $this->uri->segment(4);
		$product_id = $this->uri->segment(3);
		
		/*********Regular using***********/
		$data['meta_desc'] = "Product";
		$data['meta_keywords'] = "Product";	
		$data['page_title'] = "Product";			
		//$data['left_cat_result']=$this->model_shop->get_all_cat_records();
		/*$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
		$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
		$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
		$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
		$data['result_bottom_message'] = $this->model_bottom_message->get_record();
		$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
		$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();
		$data['result_search'] = $this->model_shop->get_sub_record_search();*/
		
		/*********Regular using***********/
		
		$data['product'] = $this->model_shop->get_product_detail($product_id);
		//$data['prode_info_all'] = $this->model_shop->get_product_detail_all();
		//$data['guideline_info'] = $this->model_guideline->get_record();
	    $this->load->view('product_detail', $data);
	}
	
	function show()
	{
		/*********Regular using***********/
		$data['meta_desc'] = "Shop";
		$data['meta_keywords'] = "Shop";	
		$data['page_title'] = "Shop";			
		$data['left_cat_result']=$this->model_shop->get_all_cat_records();
		$data['left_quotes']=$this->model_urllink->get_urllink();
		$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
		$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
		$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
		$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
		$data['result_bottom_message'] = $this->model_bottom_message->get_record();
		$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
		$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();
		$data['result_search'] = $this->model_shop->get_sub_record_search();
		/*$data['shop_basket'] = $this->model_shop->get_basket_record();*/
		/*********Regular using***********/		
		// Framed price
		$data['framed_price'] = $this->model_framed->get_framed_price();
		
		$data['prode_info'] = $this->model_shop->get_temp_product_detail('product');
		$data['prode_gift'] = $this->model_shop->get_temp_gift_detail('gift');
	    $this->load->view('cart', $data);
	}
	function cart()
	{
		$this->load->view('user_session_check');
		$session_id = $this->session->userdata('login_id');
		/*if($session_id > 0)
		{
			$data['user_info'] = $this->model_users->user_login_sp($session_id);
		}*/
		if($this->input->post('product_type') == 'gift')
		{
			$giftid = $this->input->post('gift_id');			
			$product_type = $this->input->post('product_type');
			$ip_address = $this->input->post('ip_address');
			$org_price = $this->input->post('org_pricesss');
			$giftiddd = $this->model_shop->check_gift_cart($giftid,$product_type,$session_id);
			if($giftiddd->num_rows() > 0)
			{
				
			}
			else
			{
				$date = date("Y-m-d h:i:s"); 
				$record = array(				
				'temp_quantity'=>'1',
				'temp_giftid'=>$giftid,
				'product_type'=>$product_type,
				'status'=>'1',
				'ip_address'=>$ip_address,
				'temp_sub_total'=>$org_price,
				'temp_user_id'=>$session_id,
				'added_date' =>$date 
				);
				$result = $this->model_shop->insert_temp_record($record);
				redirect(base_url().'shop/cart/','location');
			}
			
		}
		if($this->input->post('product_type') == 'product')
		{
			$catid = $this->input->post('catid');
			$subcatid = $this->input->post('subcatid');
			$prodid = $this->input->post('prodid');
			$product_type = $this->input->post('product_type');
			$org_price = $this->input->post('org_price');
			$small = $this->input->post('small');
			$medium = $this->input->post('mediums');
			$large = $this->input->post('large');
			$golden = $this->input->post('golden');
			$silver = $this->input->post('silver');
			$black = $this->input->post('black');
			$ff = $this->input->post('ff');
			$unframe = $this->input->post('unframe');
			$unframe_value = $this->input->post('unframe_value');						
			$ip_address = $this->input->post('ip_address');
			if($ff == '1')
			{
				$check_record = $this->model_shop->check_record($catid,$subcatid,$prodid,$ff,$session_id);
				if($check_record->num_rows() > 0)
				{
					$record = $check_record->row();
					$quantity = $record->temp_quantity;
					$total_quantity = $quantity + 1;
					$tempid = $record->id;					
					$data = array(
						'temp_quantity'=>$total_quantity,
						'temp_sub_total'=>$org_price				
					);
					$update = $this->model_shop->update_temp($data,$tempid);
					redirect(base_url().'shop/cart/','location');
				}
				else
				{
					$date = date("Y-m-d h:i:s"); 
					//die();
					$record = array(
						'size_small'=>$small,
						'size_medium'=>$medium,
						'size_large'=>$large,
						'framed'=>$ff,
						'framed_color_golden'=>$golden,
						'framed_color_silver'=>$silver,
						'framed_color_black'=>$black,
						'unframed'=>$unframe_value,
						'temp_catid'=>$catid,
						'temp_subcatid'=>$subcatid,
						'temp_prodid'=>$prodid,
						'temp_quantity'=>'1',
						'product_type'=>$product_type,
						'status'=>'1',
						'temp_sub_total'=>$org_price,
						'ip_address'=>$ip_address,
						'temp_user_id'=>$session_id,
						'added_date' =>$date 
					);
									
					$result = $this->model_shop->insert_temp_record($record);
					redirect(base_url().'shop/cart/','location');
				}
			}
			else
			{
				$check_record = $this->model_shop->check_record($catid,$subcatid,$prodid,$ff,$session_id);
				if($check_record->num_rows() > 0 and $this->input->post('upd')=='Uppdate')
				{
					$record = $check_record->row();
					$quantity = $record->temp_quantity;
					$total_quantity = $quantity + 1;
					$tempid = $record->id;
					$data = array(
						'temp_quantity'=>$total_quantity,
						'temp_sub_total'=>$org_price				
					);
					$update = $this->model_shop->update_temp($data,$tempid);
					redirect(base_url().'shop/cart/','location');
				}
				else
				{
					$date = date("Y-m-d h:i:s"); 
					//die();
					$record = array(
						'size_small'=>$small,
						'size_medium'=>$medium,
						'size_large'=>$large,
						'framed'=>$ff,
						'framed_color_golden'=>$golden,
						'framed_color_silver'=>$silver,
						'framed_color_black'=>$black,
						'unframed'=>$unframe_value,
						'temp_catid'=>$catid,
						'temp_subcatid'=>$subcatid,
						'temp_prodid'=>$prodid,
						'temp_quantity'=>'1',
						'product_type'=>$product_type,
						'status'=>'1',
						'temp_sub_total'=>$org_price,
						'ip_address'=>$ip_address,
						'temp_user_id'=>$session_id,
						'added_date' =>$date 
					);				
					$result = $this->model_shop->insert_temp_record($record);
					redirect(base_url().'shop/cart/','location');
				}
			}
			
			
			$data['catid'] = $catid;
			$data['subcatid'] = $subcatid;
			$data['prodid'] = $prodid;
		}
		
		/*********Regular using***********/
		$data['meta_desc'] = "Shop";
		$data['meta_keywords'] = "Shop";	
		$data['page_title'] = "Shop";			
		$data['left_cat_result']=$this->model_shop->get_all_cat_records();
		$data['left_quotes']=$this->model_urllink->get_urllink();
		$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
		$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
		$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
		$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
		$data['result_bottom_message'] = $this->model_bottom_message->get_record();
		$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
		$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();
		$data['result_search'] = $this->model_shop->get_sub_record_search();
		$data['shop_basket'] = $this->model_shop->get_basket_record();
		/*********Regular using***********/		
		// Framed price
		$data['framed_price'] = $this->model_framed->get_framed_price();
		
		$data['prode_info'] = $this->model_shop->get_temp_product_detail('product');
		$data['prode_gift'] = $this->model_shop->get_temp_gift_detail('gift');
	    $this->load->view('cart', $data);				
	}
	function cartt()
	{						
		$tmep_prodid = $this->input->post('temp_prodid');
		$update = $this->input->post('upd');
		$checkout = $this->input->post('checkout');
		//die();
		/*$catid = $this->input->post('catid');
		$subcatid = $this->input->post('subcatid');
		$prodid = $this->input->post('prodid');*/
		/*********Regular using***********/
		$data['meta_desc'] = "Shop";
		$data['meta_keywords'] = "Shop";	
		$data['page_title'] = "Shop";			
		$data['left_cat_result']=$this->model_shop->get_all_cat_records();
		$data['left_quotes']=$this->model_urllink->get_urllink();
		$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
		$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
		$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
		$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
		$data['result_bottom_message'] = $this->model_bottom_message->get_record();
		$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
		$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();
		$data['result_search'] = $this->model_shop->get_sub_record_search();
		/*$data['shop_basket'] = $this->model_shop->get_basket_record();*/
		/*$data['catid'] = $catid;
		$data['subcatid'] = $subcatid;
		$data['prodid'] = $prodid;*/
		/*********Regular using***********/		
		if(!empty($update))
		{
			foreach($tmep_prodid as $res)
			{				
				$val = $this->input->post('quant_'.$res.'');				
				if($val == '0')
				$val ='1';
				$this->model_shop->update_temp2($res , $val);
			}
			
			/*$data['catid'] = $this->input->post('catid');
			$data['subcatid'] =  $this->input->post('subcatid');
			$data['prodid'] =  $this->input->post('prodid');*/
			$data['framed_price'] = $this->model_framed->get_framed_price();
			$data['prode_info'] = $this->model_shop->get_temp_product_detail('product');
			$data['prode_gift'] = $this->model_shop->get_temp_gift_detail('gift');
			$this->load->view('cart', $data);
		}
		else if(!empty($checkout))
		{									
			$this->load->view('user_session_check');
			$data['country'] = $this->model_users->get_country();
			$data['states']  = $this->model_users->get_states();
			$session_id = $this->session->userdata('login_id');
			if($session_id > 0)
			{
				$data['user_info'] = $this->model_users->user_login_sp($session_id);
			}
			$data['total_subtotal'] = $this->input->post('total_subtotal');
			$data['framed_price'] = $this->model_framed->get_framed_price();
			$data['prode_info'] = $this->model_shop->get_temp_product_detail('product');
			$data['prode_gift'] = $this->model_shop->get_temp_gift_detail('gift');
			$this->load->view('address', $data);
		}
		else
		{
			$action = $this->uri->segment(3);
			if(!empty($action))
			{
				if($action == 'remove')
				{
					$id = $this->uri->segment(4);
					$result = $this->model_shop->remove($id);
					if($result==true)
					{
						$data['framed_price'] = $this->model_framed->get_framed_price();
						$data['prode_info'] = $this->model_shop->get_temp_product_detail('product');
						$data['prode_gift'] = $this->model_shop->get_temp_gift_detail('gift');
						$this->load->view('cart', $data);
					}
				}
				if($action == 'wishlist')
				{
					$this->load->view('user_session_check');
					$catid = $this->uri->segment(4);
					$subcatid = $this->uri->segment(5);
					$prodid = $this->uri->segment(6);
					$framed = $this->uri->segment(7);
					$session_id = $this->session->userdata('login_id');
					$result = $this->model_shop->add_to_wishlist($catid,$subcatid,$prodid,$session_id,$framed);
					if($result=='No')
					{
						$data['errormsg'] = "Product already add in the wishlist.";
						$data['prode_info'] = $this->model_shop->get_temp_product_detail('product');
						$data['prode_gift'] = $this->model_shop->get_temp_gift_detail('gift');
						$this->load->view('cart', $data);
					}
					else
					{
						$data['msg'] = "Product add successfully in the wishlist.";
						$data['framed_price'] = $this->model_framed->get_framed_price();
						$data['prode_info'] = $this->model_shop->get_temp_product_detail('product');
						$data['prode_gift'] = $this->model_shop->get_temp_gift_detail('gift');
						
						$this->load->view('cart', $data);
					}
				}
				
			}
			
		}
		
	}
	function address()
	{
		$this->load->view('user_session_check');
		$this->form_validation->set_rules('first_name', 'Shipping First Name', 'trim|required|alpha');
		$this->form_validation->set_rules('last_name', 'Shipping Last Name', 'trim|required|alpha');
		$this->form_validation->set_rules('email', 'Shipping Email Address', 'trim|required|valid_email');				
		$this->form_validation->set_rules('address', 'Shipping Address', 'trim|required');	
		if($this->input->post('country_list') == "")
		{
			$this->form_validation->set_rules('country_hidden', 'Shipping Coutry', 'trim|required');
		}
		if($this->input->post('state_id') == "")
		{
			$this->form_validation->set_rules('state_hidden', 'Shipping State', 'trim|required');
		}
		$this->form_validation->set_rules('city', 'Shipping City', 'required');
		$this->form_validation->set_rules('zip_code', 'Shipping Zip Code', 'trim|required|numeric');
		$this->form_validation->set_rules('work_phone', 'Shipping Phone Number', 'trim|required|numeric');
		if ($this->form_validation->run() == FALSE)
		{           
			$data['country'] = $this->model_users->get_country();
			$data['states']  = $this->model_users->get_states();
			$session_id = $this->session->userdata('login_id');
			if($session_id > 0)
			{
				$data['user_info'] = $this->model_users->user_login_sp($session_id);
			}
			/*********Regular using***********/
			$data['meta_desc'] = "Shop";
			$data['meta_keywords'] = "Shop";	
			$data['page_title'] = "Shop";			
			$data['left_cat_result']=$this->model_shop->get_all_cat_records();
			$data['left_quotes']=$this->model_urllink->get_urllink();
			$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
			$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
			$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
			$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
			$data['result_bottom_message'] = $this->model_bottom_message->get_record();
			$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
			$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();
			$data['result_search'] = $this->model_shop->get_sub_record_search();
			/*********Regular using***********/	
			$data['total_subtotal'] = $this->input->post('total_subtotal');
			$data['framed_price'] = $this->model_framed->get_framed_price();
			$data['prode_info'] = $this->model_shop->get_temp_product_detail('product');
			$data['prode_gift'] = $this->model_shop->get_temp_gift_detail('gift');
			$this->load->view('address', $data);
        }
		
        else
		{
			$generate_number = $this->model_shop->orderid_generate();			
			$data['country'] = $this->model_users->get_country();
			$data['states']  = $this->model_users->get_states();
			$session_id = $this->session->userdata('login_id');	
			if($this->input->post('code_number') !='')
			{
				$this->db->select('*');
				$this->db->from('pride_coupons');
				$this->db->where('coupon_generate_code',$this->input->post('code_number'));		
				$query1 = $this->db->get();
				$result1 = $query1->result();
				$coupon_amount = $result1[0]->coupon_amount;
				$discount_amount = $coupon_amount;
				if($discount_amount >0)
				{
					$discount_amount = ($discount_amount/100)*($this->input->post('sub_total')+$this->input->post('total_tax')+$this->input->post('shipping_charges'));
				}
				else
				{
					$discount_amount = 0;
				}
			}
			else
			{
				$discount_amount = 0;
				$coupon_amount = 0;
			}
			
			$date = date("Y-m-d h:i:s A");
			$data1 = array(
				'member_id'=>$this->session->userdata('login_id'),
				'order_id'=>$generate_number+1,
				'sp_f_name'=>$this->input->post('first_name'),
				'sp_l_name'=>$this->input->post('last_name'),
				'sp_email'=>$this->input->post('email'),
				'sp_address1'=>$this->input->post('address'),
				'sp_address2'=>$this->input->post('address2'),
				'sp_country'=>$this->input->post('country_list'),
				'sp_state'=>$this->input->post('state_id'),
				'sp_city'=>$this->input->post('city'),
				'sp_zip_code'=>$this->input->post('zip_code'),
				'sp_phone'=>$this->input->post('work_phone'),
				'bl_f_name'=>$this->input->post('first_name'),
				'bl_l_name'=>$this->input->post('last_name'),
				'bl_email'=>$this->input->post('email'),
				'bl_address1'=>$this->input->post('address'),
				'bl_address2'=>$this->input->post('address2'),
				'bl_country'=>$this->input->post('country_list'),
				'bl_state'=>$this->input->post('state_id'),
				'bl_city'=>$this->input->post('city'),
				'bl_zip_code'=>$this->input->post('zip_code'),
				'bl_phone'=>$this->input->post('work_phone'),
				'sub_total'=>$this->input->post('sub_total'),
				'total_tax'=>$this->input->post('total_tax'),
				'tax_percentage'=>$this->input->post('tax_percentage'),
				'shipping_charges'=>$this->input->post('shipping_charges'),
				'grand_total'=>$this->input->post('sub_total')+$this->input->post('total_tax')+$this->input->post('shipping_charges'),
				'total_amount'=>$this->input->post('total_amount'),
				'discount_amount'=>$discount_amount,
				'discount_percentage'=>$coupon_amount,
				'discount_type'=>$this->input->post('code'),
				'discount_code'=>$this->input->post('code_number'),
				'order_date'=>$date,
				'order_status'=>'1',
				'order_type'=>'1',
				'gift_comment'=>$this->input->post('friend_comments'),
				'date_added'=>$date					
			);
			$this->session->set_userdata('payerdata',$data1);
			$this->session->set_userdata('total_amount',$this->input->post('total_amount'));
			
			/*echo "<pre>";
			print_r($this->session->userdata('payerdata'));
			echo "</pre>";*/
			/*if($this->model_orders->insert($data1))
			{
				
				echo "<pre>";
				print_r($this->session->userdata('payerdata'));
				echo "</pre>";
			}*/
			if($this->input->post('friend_email')!='')
			
			{
			$this->session->set_userdata('friend_email',$this->input->post('friend_email'));
			$this->session->set_userdata('friend_email_subject',$this->input->post('friend_email_subject'));
			$this->session->set_userdata('friend_comments',$this->input->post('friend_comments'));
			$this->session->set_userdata('orderid',$generate_number+1);
			}
			
			
			/*********Regular using***********/
			$data = array(
				'member_id'=>$this->session->userdata('login_id'),
				'order_id'=>$generate_number+1,
				'first_name'=>$this->input->post('first_name'),
				'last_name'=>$this->input->post('last_name'),
				'email'=>$this->input->post('email'),
				'address'=>$this->input->post('address'),
				'address2'=>$this->input->post('address2'),
				'sp_country'=>$this->input->post('country_list'),
				'sp_state'=>$this->input->post('state_id'),
				'city'=>$this->input->post('city'),
				'zip_code'=>$this->input->post('zip_code'),
				'work_phone'=>$this->input->post('work_phone'));

			$data['meta_desc'] = "Shop";
			$data['meta_keywords'] = "Shop";	
			$data['page_title'] = "Shop";			
			$data['left_cat_result']=$this->model_shop->get_all_cat_records();
			$data['left_quotes']=$this->model_urllink->get_urllink();
			$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
			$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
			$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
			$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
			$data['result_bottom_message'] = $this->model_bottom_message->get_record();
			$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
			$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();
			$data['result_search'] = $this->model_shop->get_sub_record_search();
			$order_iddd = $this->input->post('orderid');
						/*$data['shop_basket'] = $this->model_shop->get_basket_record();*/
			/*$data['catid'] = $catid;
			$data['subcatid'] = $subcatid;
			$data['prodid'] = $prodid;*/
			/*********Regular using***********/	
			
			$data['orderid'] = $number = $generate_number + 1;
			//die();
			$data['total_subtotal'] = $this->input->post('sub_total');
			$data['code_number'] = $this->input->post('code_number');
			$data['code'] = $this->input->post('code');
			$data['framed_price'] = $this->model_framed->get_framed_price();
			$data['prode_info'] = $this->model_shop->get_temp_product_detail('product');
			$data['prode_gift'] = $this->model_shop->get_temp_gift_detail('gift');
			$this->load->view('address_confirm', $data);
		}
	}
	function remove()
	{
		$id = $this->uri->segment(3);
		$result = $this->model_shop->remove(id);
	   if($result==true)
	   {
		   
		   //$this->session->set_flashdata('message','Shop Category(s) deleted successfully.');
		   //redirect($this->config->item("base_url")."admin/shop_cat_list");
	   }
	}
	
	function checkout()
	{
		
		$this->load->library('Paypal_Lib');	
		$config['Sandbox'] = TRUE;
		$config['APIVersion'] = '66.0';
		$config['APIUsername'] = $config['Sandbox'] ? 'desmond_api1.pride-picks.com' : 'desmond_api1.pride-picks.com';
		$config['APIPassword'] = $config['Sandbox'] ? '5GKEF3EJJMND9RCE' : '5GKEF3EJJMND9RCE';
		$config['APISignature'] = $config['Sandbox'] ? 'A..CCBC6doKcHgyYOf6beRhBK9-UA7-GBLv9t-0ZkUtXPxZqVStaRuu2' : 'A..CCBC6doKcHgyYOf6beRhBK9-UA7-GBLv9t-0ZkUtXPxZqVStaRuu2';
		
		$DPFields = array(
			'paymentaction' => '', 						// How you want to obtain payment.  Authorization indidicates the payment is a basic auth subject to settlement with Auth & Capture.  Sale indicates that this is a final sale for which you are requesting payment.  Default is Sale.
			'ipaddress' => '', 							// Required.  IP address of the payer's browser.
			'returnfmfdetails' => '' 					// Flag to determine whether you want the results returned by FMF.  1 or 0.  Default is 0.
		);
						
		$CCDetails = array(
		'creditcardtype' => $this->input->post('card_type'), 					// Required. Type of credit card.  Visa, MasterCard, Discover, Amex, Maestro, Solo.  If Maestro or Solo, the currency code must be GBP.  In addition, either start date or issue number must be specified.
		'acct' => $this->input->post('credit_card_number'), 								// Required.  Credit card number.  No spaces or punctuation.  
		'expdate' => $this->input->post('month').$this->input->post('year'), 							// Required.  Credit card expiration date.  Format is MMYYYY
		'cvv2' => $this->input->post('ccv'), 								// Requirements determined by your PayPal account settings.  Security digits for credit card.
		'startdate' => '', 							// Month and year that Maestro or Solo card was issued.  MMYYYY
		'issuenumber' => ''							// Issue number of Maestro or Solo card.  Two numeric digits max.
	);
						
		$PayerInfo = array(
			'email' => '', 								// Email address of payer.
			'payerid' => '', 							// Unique PayPal customer ID for payer.
			'payerstatus' => '', 						// Status of payer.  Values are verified or unverified
			'business' => '' 							// Payer's business name.
		);
						
		$PayerName = array(
			'salutation' => '', 						// Payer's salutation.  20 char max.
			'firstname' => '', 							// Payer's first name.  25 char max.
			'middlename' => '', 						// Payer's middle name.  25 char max.
			'lastname' => '', 							// Payer's last name.  25 char max.
			'suffix' => ''								// Payer's suffix.  12 char max.
		);
						
		$BillingAddress = array(
			'street' => $this->input->post('bill_address'), 						// Required.  First street address.
			'street2' => $this->input->post('bill_address2'), 						// Second street address.
			'city' => $this->input->post('bill_city'), 							// Required.  Name of City.
			'state' => $this->input->post('bill_state_id'), 							// Required. Name of State or Province.
			'countrycode' => $this->input->post('bill_country_list'), 					// Required.  Country code.
			'zip' => $this->input->post('bill_zip_code'), 							// Required.  Postal code of payer.
			'phonenum' => $this->input->post('work_phone') 						// Phone Number of payer.  20 char max.
		);
							
		$ShippingAddress = array(
		'shiptoname' => $this->input->post('first_name')." ".$this->input->post('last_name'), 					// Required if shipping is included.  Person's name associated with this address.  32 char max.
		'shiptostreet' => $this->input->post('address'), 					// Required if shipping is included.  First street address.  100 char max.
		'shiptostreet2' => $this->input->post('address2'), 					// Second street address.  100 char max.
		'shiptocity' => $this->input->post('city'), 					// Required if shipping is included.  Name of city.  40 char max.
		'shiptostate' => $this->input->post('state_id'), 					// Required if shipping is included.  Name of state or province.  40 char max.
		'shiptozip' => $this->input->post('zip_code'), 						// Required if shipping is included.  Postal code of shipping address.  20 char max.
		'shiptocountry' => $this->input->post('country_list'), 					// Required if shipping is included.  Country code of shipping address.  2 char max.
		'shiptophonenum' => $this->input->post('work_phone')					// Phone number for shipping address.  20 char max.
		);
							
		$PaymentDetails = array(
			'amt' => $this->input->post('total'), 							// Required.  Total amount of order, including shipping, handling, and tax.  
			'currencycode' => 'RM', 					// Required.  Three-letter currency code.  Default is USD.
			'itemamt' => '', 						// Required if you include itemized cart details. (L_AMTn, etc.)  Subtotal of items not including S&H, or tax.
			'shippingamt' => $this->input->post('shippingcharges'), 					// Total shipping costs for the order.  If you specify shippingamt, you must also specify itemamt.
			'shipdiscamt' => '', 					// Shipping discount for the order, specified as a negative number.  
			'handlingamt' => '', 					// Total handling costs for the order.  If you specify handlingamt, you must also specify itemamt.
			'taxamt' => $this->input->post('tax'), 						// Required if you specify itemized cart tax details. Sum of tax for all items on the order.  Total sales tax. 
			'desc' => '', 							// Description of the order the customer is purchasing.  127 char max.
			'custom' => '', 						// Free-form field for your own use.  256 char max.
			'invnum' => $this->input->post('orderid'), 						// Your own invoice or tracking number
			'buttonsource' => '', 					// An ID code for use by 3rd party apps to identify transactions.
			'notifyurl' => ''						// URL for receiving Instant Payment Notifications.  This overrides what your profile is set to use.
		);
		
		// For order items you populate a nested array with multiple $Item arrays.  
		// Normally you'll be looping through cart items to populate the $Item array
		// Then push it into the $OrderItems array at the end of each loop for an entire 
		// collection of all items in $OrderItems.
				
		$OrderItems = array();
			
		$Item	 = array(
			'l_name' => '', 						// Item Name.  127 char max.
			'l_desc' => '', 						// Item description.  127 char max.
			'l_amt' => '', 							// Cost of individual item.
			'l_number' => '', 						// Item Number.  127 char max.
			'l_qty' => '', 							// Item quantity.  Must be any positive integer.  
			'l_taxamt' => '', 						// Item's sales tax amount.
			'l_ebayitemnumber' => '', 				// eBay auction number of item.
			'l_ebayitemauctiontxnid' => '', 		// eBay transaction ID of purchased item.
			'l_ebayitemorderid' => '' 				// eBay order ID for the item.
	);
		
		array_push($OrderItems, $Item);
		
		$Secure3D = array(
		  'authstatus3d' => '', 
		  'mpivendor3ds' => '', 
		  'cavv' => '', 
		  'eci3ds' => '', 
		  'xid' => ''
		  );
						  
		$PayPalRequestData = array(
			'DPFields' => $DPFields, 
			'CCDetails' => $CCDetails, 
			'PayerInfo' => $PayerInfo, 
			'PayerName' => $PayerName, 
			'BillingAddress' => $BillingAddress, 
			'ShippingAddress' => $ShippingAddress, 
			'PaymentDetails' => $PaymentDetails, 
			'OrderItems' => $OrderItems, 
			'Secure3D' => $Secure3D
		);
						
		$PayPalResult = $this->paypal_pro->DoDirectPayment($PayPalRequestData);
		
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);
			$this->load->view('paypal_error',$errors);
		}
		else
		{
			$prode_info = $this->model_shop->get_temp_product_detail('product');
			$prode_gift = $this->model_shop->get_temp_gift_detail('gift');
			
			if($prode_info->num_rows() > 0)
			{
				foreach($prode_info->result() as $value)
				{
					$data = array(
					'size_small'=>$value->size_small,
					'size_medium'=>$value->size_medium,
					'size_large'=>$value->size_large,
					'framed'=>$value->framed,
					'framed_color_golden'=>$value->framed_color_golden,
					'framed_color_silver'=>$value->framed_color_silver,
					'framed_color_black'=>$value->framed_color_black,
					'unframed'=>$value->unframed,
					'order_id' => $this->input->post('orderid'),
					'product_id' => $value->psprod_id,
					'title' => $value->prod_title,
					'qty' => $value->temp_quantity,
					'price' => $value->prod_price,
					'type' => $value->product_type
					);
					$this->model_orders->insert_order_product($data);
				}
			}
			if($prode_gift->num_rows() > 0)
			{
				foreach($prode_gift->result() as $value)
				{
					$data = array(
					'order_id' => $this->input->post('orderid'),
					'product_id' => $value->giftid,
					'title' => $value->gift_title,
					'qty' => $value->temp_quantity,
					'price' => $value->gift_amount,
					'type' => $value->product_type
					);
					$this->model_orders->insert_order_product($data);
					$data1 = array(
						'available'=> '0'
					);
					$id = $value->giftid;
					$this->model_orders->update_order_product($data1,$id);
				}
				
				/*************** Email to friend ************************/
				$order_iddd = $this->input->post('orderid');
				$gift_card_information = $this->model_shop->get_product_gift_informations($order_iddd,'gift');
				
				$friend_email = $this->input->post('friend_email');
				$friend_email_subject = $this->input->post('friend_email_subject');
				$friend_comments = $this->input->post('friend_comments');
				$i = 1;
				foreach($gift_card_information->result() as $val)
				{				
					$collect = array(
						'gift_title'=>$val->gift_title,
						'gift_amount'=>$val->gift_amount,
						'gift_generate_code'=>$val->gift_generate_code
					);
					$this->model_shop->insert_temp_gift_cart_info($collect);
				}			
				$session_id = $this->session->userdata('login_id');
				if($session_id > 0)
				{
					$user_info = $this->model_users->user_login_sp($session_id);
				}
				$user = $user_info->row();
				$name = $user->first_name." ".$user->last_name;
				$subject = "PridePicks - Gift Card ".$friend_email_subject;	
				$notifi = $this->model_notifications->get_notification('9');	
				foreach($notifi as $val)
				{
					$email_template = $val->email_text;
				}
				$resultsss = $this->model_shop->get_temp_gift_record();
				$codevalue = $resultsss->row();
				$giftamount  = $codevalue->gift_amount;
				$giftcode = $codevalue->gift_generate_code;
				$friend_comments = substr($friend_comments,0,250);			
				$find = array('##BUYER_NAME##','##MESSAGE##','##CODE##','##VALUE##');
				$replace = array($name,$friend_comments,$giftamount,$giftcode);
				$message = str_replace($find,$replace,$email_template);						
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.$name.' <'.$user->email.'>' . "\r\n";
				@mail($user->email, $subject, $message, $headers);
				@mail($friend_email, $subject, $message, $headers);
				
				$this->model_shop->truncate_temp_table('pride_temp_gift_info');
			//$this->input->post('bill_email');
			/**********************************************************/
			}
			//die();
			$date = date("Y-m-d h:i:s A");
			$data = array(
				'member_id'=>$this->input->post('memberid'),
				'order_id'=>$this->input->post('orderid'),
				'sp_f_name'=>$this->input->post('first_name'),
				'sp_l_name'=>$this->input->post('last_name'),
				'sp_email'=>$this->input->post('email'),
				'sp_address1'=>$this->input->post('address'),
				'sp_address2'=>$this->input->post('address2'),
				'sp_country'=>$this->input->post('country_list'),
				'sp_state'=>$this->input->post('state_id'),
				'sp_city'=>$this->input->post('city'),
				'sp_zip_code'=>$this->input->post('zip_code'),
				'sp_phone'=>$this->input->post('work_phone'),
				/*'name_of_card'=>$this->input->post('name_of_card'),*/
				'cc_number'=>$this->input->post('credit_card_number'),
				'cc_type'=>$this->input->post('card_type'),
				'cc_expiry'=>$this->input->post('month').",".$this->input->post('year'),						
				'bl_f_name'=>$this->input->post('bill_first_name'),
				'bl_l_name'=>$this->input->post('bill_last_name'),
				'bl_address1'=>$this->input->post('bill_address'),
				'bl_address2'=>$this->input->post('bill_address2'),
				'bl_country'=>$this->input->post('bill_country_list'),
				'bl_email'=>$this->input->post('bill_email'),
				'bl_state'=>$this->input->post('bill_state_id'),
				'bl_city'=>$this->input->post('bill_city'),
				'bl_zip_code'=>$this->input->post('bill_zip_code'),
				/*'code'=>$this->input->post('code'),
				'code_number'=>$this->input->post('code_number'),*/
				'sub_total'=>$this->input->post('total_subtotal'),
				'total_tax'=>$this->input->post('tax'),
				'shipping_charges'=>$this->input->post('shippingcharges'),
				'grand_total'=>$this->input->post('total'),
				'bl_zip_code'=>$this->input->post('bill_zip_code'),	
				'order_date'=>$date,
				'order_status'=>'1',
				'order_type'=>'1',
				'date_added'=>$date,						
			);
			
			$data = array(
				'number'=>$this->input->post('orderid')		
			);
			$id = '1';
			$this->model_orders->update_order_number($data,$id);
			
			
			// empty temprory table
			$this->model_shop->truncate_temp_table('pride_addtocart_temp_record');
			
			
			
			/*********Regular using***********/
			/*$data['meta_desc'] = "Shop";
			$data['meta_keywords'] = "Shop";	
			$data['page_title'] = "Shop";*/			
			$data['left_cat_result']=$this->model_shop->get_all_cat_records();
			$data['left_quotes']=$this->model_urllink->get_urllink();
			$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
			$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
			$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
			$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
			$data['result_bottom_message'] = $this->model_bottom_message->get_record();
			$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
			$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();
			$data['result_search'] = $this->model_shop->get_sub_record_search();
			/*$data['shop_basket'] = $this->model_shop->get_basket_record();*/	
			/*********Regular using***********/
			$data['result']=$this->model_cmspages->get_page_record('26');
			$data['id']=$id;	
			$this->load->view('thanks', $data);
		}
		
	}
		
	function tab_process()
	{
		$data['id'] = $this->input->post('id');
		$this->load->view('tabs', $data);						
	}
		
	function all()
	{
		$cat_id = $this->uri->segment('3');			
		/*********Regular using***********/
		$data['meta_desc'] = "All Shop Categories";
		$data['meta_keywords'] = "All Shop Categories";	
		$data['page_title'] = "All Shop Categories";			
		$data['left_cat_result']=$this->model_shop->get_all_cat_records();
		$data['left_quotes']=$this->model_urllink->get_urllink();
		$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
		$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
		$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
		$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
		$data['result_bottom_message'] = $this->model_bottom_message->get_record();
		$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
		$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();
		$data['result_search'] = $this->model_shop->get_sub_record_search();
		/*$data['shop_basket'] = $this->model_shop->get_basket_record();*/
		/*********Regular using***********/
		$data['catid'] = $cat_id;
		$data['cat_name']=$this->model_shop->get_all_cat_records_id($cat_id);
		$data['results']=$this->model_shop->get_sub_record_all($cat_id);
		$data['prode_info_all'] = $this->model_shop->get_product_detail_all_all(10);
		
		$this->load->view('all_categories', $data);
	}
	function paypal_failure()
	{
		 // Include the paypal library
$this->load->library('Paypal_Lib');
// Log the IPN results

// Check validity and write down it
if ($this->paypal_lib->validate_ipn()) 
	{
 echo "success";
}
else
{
	 $errors = array('Errors'=>'');
	 $this->load->view('thanx',$errors);

}
die();
}
function payment_complete()
{}
function payment_error()
{
					 //file_put_contents('paypal.txt', "FAILURE\n\n" . $myPaypal->ipnData);
					 
	$errors = array('Errors'=>'couldnt completed your transaction please try again later');
	$data['left_cat_result']=$this->model_shop->get_all_cat_records();
	$data['left_quotes']=$this->model_urllink->get_urllink();
	$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
	$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
	$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
	$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
	$data['result_bottom_message'] = $this->model_bottom_message->get_record();
	$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
	$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();
	$data['result_search'] = $this->model_shop->get_sub_record_search();
	/*$data['shop_basket'] = $this->model_shop->get_basket_record();*/	
	/*********Regular using***********/
	$data['result']=$this->model_cmspages->get_page_record('26');
	$data['id']=1;
	$data['meta_desc'] = "Paypal Return";
	$data['meta_keywords'] = "Paypal Return";	
	$data['page_title'] = "Paypal Return";
	$data['Errors'] = 'couldnt completed your transaction please try again later';			
	
	$this->load->view('paypal_error',$data);
}
function payment_success()
{
					 //file_put_contents('paypal.txt', "FAILURE\n\n" . $myPaypal->ipnData);
					 
	if(count($_POST) >0)
	{
	if($_POST['payment_status'] == 'Completed')
	{
	
				$this->session->set_userdata('log','verified');
				//$to    = 'desmond@pride-picks.com';
				$to    = 'aymee.ahmd@gmail.com';
				$payerdata=$this->session->userdata('payerdata'); 
				$session_id = $this->session->userdata('login_id');
				$user_info = $this->model_users->user_login_sp($session_id);
				$user = $user_info->row();
				// load email lib and email results
				$this->model_orders->insert($payerdata);
				$order_table_id = $this->db->insert_id();
				$prode_info = $this->model_shop->get_temp_product_detail('product');
				$prode_gift = $this->model_shop->get_temp_gift_detail('gift');
				
				$data='';
				$data1='';
				if($prode_info->num_rows() > 0)
				{
					foreach($prode_info->result() as $value)
					{
						$data = array(
						'size_small'=>$value->size_small,
						'size_medium'=>$value->size_medium,
						'size_large'=>$value->size_large,
						'framed'=>$value->framed,
						'framed_color_golden'=>$value->framed_color_golden,
						'framed_color_silver'=>$value->framed_color_silver,
						'framed_color_black'=>$value->framed_color_black,
						'unframed'=>$value->unframed,
						'order_id' => $order_table_id,
						'product_id' => $value->psprod_id,
						'title' => $value->prod_title,
						'qty' => $value->temp_quantity,
						'price' => $value->prod_price,
						'type' => $value->product_type
						);
						$this->model_orders->insert_order_product($data);
						//$order_id = $this->db->insert_id();
					}
				}
				if($prode_gift->num_rows() > 0)
				{
					foreach($prode_gift->result() as $value)
					{
						$data1 = array(
						'order_id' => $order_table_id,
						'product_id' => $value->giftid,
						'title' => $value->gift_title,
						'qty' => $value->temp_quantity,
						'price' => $value->gift_amount,
						'type' => $value->product_type
						);
						$this->model_orders->insert_order_product($data1);
						$data2 = array(
							'available'=> '0'
						);
						$id = $value->giftid;
						$this->model_orders->update_order_product($data2,$id);
					}
					
					/*************** Email to friend ************************/
					$order_iddd = $order_table_id;
					$gift_card_information = $this->model_shop->get_product_gift_informations($order_iddd,'gift');
					
					$friend_email = $this->session->userdata('friend_email');
					$friend_email_subject = $this->session->userdata('friend_email_subject');
					$friend_comments = $this->session->userdata('friend_comments');
					$i = 1;
					foreach($gift_card_information->result() as $val)
					{				
						$collect = array(
							'gift_title'=>$val->gift_title,
							'gift_amount'=>$val->gift_amount,
							'gift_generate_code'=>$val->gift_generate_code
						);
						$this->model_shop->insert_temp_gift_cart_info($collect);
					}			
					$session_id = $this->session->userdata('login_id');
					if($session_id > 0)
					{
						$user_info = $this->model_users->user_login_sp($session_id);
					}
					$user = $user_info->row();
					$name = $user->first_name." ".$user->last_name;
					$subject = "PridePicks - A Gift Card For You <br>".$friend_email_subject;	
					$notifi = $this->model_notifications->get_notification('9');	
					foreach($notifi as $val)
					{
						$email_template = $val->email_text;
					}
					$resultsss = $this->model_shop->get_temp_gift_record();
					$codevalue = $resultsss->row();
					$giftamount  = $codevalue->gift_amount;
					$giftcode = $codevalue->gift_generate_code;
					$friend_comments = substr($friend_comments,0,250);			
					$find = array('##BUYER_NAME##','##MESSAGE##','##CODE##','##VALUE##');
					$replace = array($friend_email,$friend_comments,$giftcode,$giftamount);
					$message = str_replace($find,$replace,$email_template);						
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers .= 'From: '.$name.' <'.$user->email.'>' . "\r\n";
					@mail($user->email, $subject, $message, $headers);
					@mail($friend_email, $subject, $message, $headers);	
					$this->model_shop->truncate_temp_table('pride_temp_gift_info');
					//$this->input->post('bill_email');
					/**********************************************************/
				
				}
				$purchase_detail = '';
				if(is_array($data) and is_array($data1))
				{
					$purchase_detail = array_merge($data,$data1);
				}
				else if(is_array($data) and !is_array($data1))
					$purchase_detail = $data;
				else
					$purchase_detail = $data1;
				/*********************Email to about transaction********************/
				$session_id = $this->session->userdata('login_id');
				if($session_id > 0)
				{
					$user_info = $this->model_users->user_login_sp($session_id);
				}
				$today = date("F j, Y, g:i a");
				$items_detail='<table>';
				$items_detail.='<tr><td>Order Number:</td><td>'.$order_table_id.'</td></tr>';
				$items_detail.='<tr><td>Payment Date:</td><td>'.$_POST['payment_date'].'</td></tr>';
				$items_detail.='<tr><td>Payment Status</td><td>'.$_POST['payment_status'].'</td></tr>';
				$items_detail.='<tr><td></td><td></td></tr>';
				$items_detail.='<tr><td colspan="2">Billing Information</td></tr>';
				$items_detail.='<tr><td >Name</td><td>'.$_POST['first_name'].' '.$_POST['last_name'].'</td></tr>';
				$items_detail.='<tr><td >Address1</td><td>'.$_POST['address_street'].'</td></tr>';
				$items_detail.='<tr><td >City</td><td>'.$_POST['address_city'].'</td></tr>';
				$items_detail.='<tr><td >Zip/Postal Code</td><td>'.$_POST['address_zip'].'</td></tr>';
				$items_detail.='<tr><td >Zip/Postal Code</td><td>'.$_POST['address_zip'].'</td></tr>';
				$items_detail.='<tr><td colspan="2">Ship to Information</td></tr>';
				$items_detail.='<tr><td >Name</td><td>'.$_POST['first_name'].' '.$_POST['last_name'].'</td></tr>';
				$items_detail.='<tr><td >Address1</td><td>'.$_POST['address_street'].'</td></tr>';
				$items_detail.='<tr><td >City</td><td>'.$_POST['address_city'].'</td></tr>';
				$items_detail.='<tr><td >Zip/Postal Code</td><td>'.$_POST['address_zip'].'</td></tr>';
				$items_detail.='<tr><td >Phone Code</td><td>'.$_POST['address_zip'].'</td></tr>';
				$items_detail.='<tr><td colspan="2">Pride Picks Sdn Bhd</td></tr>';
				$items_detail.='<tr><td >Merchant</td><td>'.$_POST['business'].'</td></tr>';
				$items_detail.='<tr><td colspan="2">Order Items<br>----------------------</td></tr>';
				for($i = 1; $i<$_POST['num_cart_items'];$i++)
				{
					$items_detail.='<tr><td>Product</td><td>'.$_POST['item_name'.$i].'</td></tr>';
					$items_detail.='<tr><td>Quantity</td><td>'.$_POST['quantity'.$i].'</td></tr>';
					/*$items_detail.='<tr><td>Item</td><td>'.$_POST['item_name'].'</td></tr>';
					$items_detail.='<tr><td>Price</td><td>'.$_POST['item_name'].'</td></tr>';*/
				}
				$items_detail.='<tr><td >Sub Total</td><td>'.$_POST['mc_gross'].'</td></tr>';
				$items_detail.='<tr><td >Shipping and Handling Fee</td><td>'.$_POST['mc_shipping']+$_POST['mc_handling'].'</td></tr>';
				$items_detail.='<tr><td >Coupon Discount Amount</td><td>'.$payerdata['discount_amount'].'</td></tr>';
				$items_detail.='<tr><td >Total</td><td>------------------------</td></tr>';
				$items_detail.='<tr><td >Total</td><td>'.$payerdata['grand_total'].'</td></tr>';
				$items_detail.='</table>';
				$user = $user_info->row();
				$name = $user->first_name." ".$user->last_name;
				$subject = "PridePicks - Shopping Notification ";	
				$notice_buyer = $this->model_notifications->get_notification('1');
				
				foreach($notice_buyer as $val)
				{
					$email_template = $val->email_text;
				}
				$find = array('##BUYER_NAME##','##ORDER_DETAIL##');
				$replace = array($name,$items_detail);
				$message = str_replace($find,$replace,$email_template);						
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From: '.$name.' <'.$user->email.'>' . "\r\n";
				
				@mail($user->email, $subject, $message, $headers);
				
				/*********************Email to admin about transaction********************/	
				$notice_buyer = $this->model_notifications->get_notification('2');
				foreach($notice_buyer as $val)
				{
					$email_template = $val->email_text;
				}
				$message = str_replace($find,$replace,$email_template);	
				@mail($to, $subject, $message, $headers);
				//echo $to.$message;die();
					
				$session_id = $this->session->userdata('login_id');
					if($session_id > 0)
					{
						$user_info = $this->model_users->user_login_sp($session_id);
					}
					
					$data = array('number'=>$this->session->userdata('orderid')		);
				$id = '1';
				$this->model_orders->update_order_number($data,$id);
				// empty temprory table
				$this->model_shop->truncate_temp_table('pride_addtocart_temp_record');
				$data['pp_info'] = $_POST; 
				$data['left_cat_result']=$this->model_shop->get_all_cat_records();
				$data['left_quotes']=$this->model_urllink->get_urllink();
				$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
				$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
				$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
				$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
				$data['result_bottom_message'] = $this->model_bottom_message->get_record();
				$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
				$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();
				$data['result_search'] = $this->model_shop->get_sub_record_search();
				/*$data['shop_basket'] = $this->model_shop->get_basket_record();*/	
				/*********Regular using***********/
				$data['result']=$this->model_cmspages->get_page_record('26');
				//$data['id']=$id;	
				$data['result']=$this->model_cmspages->get_page_record('26');
				$data['id']=1;
				$data['meta_desc'] = "Paypal Return";
				$data['meta_keywords'] = "Paypal Return";	
				$data['page_title'] = "Paypal Return";
				$this->load->view('thanks', $data);		
			
						
				
			 }
	}
	$data['pp_info'] = $_POST; 
	$data['left_cat_result']=$this->model_shop->get_all_cat_records();
	$data['left_quotes']=$this->model_urllink->get_urllink();
	$data['result_advertisment'] = $this->model_advertisment->get_advertisment(2,'DESC');
	$data['result_advertisment_one'] = $this->model_advertisment->get_advertisment(1,'ASC');
	$data['result_advertisment_3'] = $this->model_advertisment_left->get_advertisment(1,'DESC');
	$data['result_bottom_logo'] = $this->model_bottom_logo->get_record();
	$data['result_bottom_message'] = $this->model_bottom_message->get_record();
	$data['result_bottom_message2'] = $this->model_bottom_message2->get_record();
	$data['slideshow']=$this->model_slideshow_shop->get_all_slideshow();
	$data['result_search'] = $this->model_shop->get_sub_record_search();
	/*$data['shop_basket'] = $this->model_shop->get_basket_record();*/	
	/*********Regular using***********/
	$data['result']=$this->model_cmspages->get_page_record('26');
	//$data['id']=$id;	
	$data['result']=$this->model_cmspages->get_page_record('26');
	$data['id']=1;
	$data['meta_desc'] = "Paypal Return";
	$data['meta_keywords'] = "Paypal Return";	
	$data['page_title'] = "Paypal Return";

		$this->load->view('thanks', $data);		
	
	}
	
}
?>