<?php

class Model_user extends CI_Model

{
	function __construct()

    {

        parent::__construct();

		$this->image_path = (APPPATH . './uploads/');

		$this->image_path_url = base_url().'uploads/';



    }

}



?>