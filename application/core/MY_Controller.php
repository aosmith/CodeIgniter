<?php

class MY_Controller extends CI_Controller {
  

  public function __contruct() {
    $this->error_messages = array();
    parent::__construct();
  }

  public function add_error_message($error) {
    array_push($this->error_messages, $error);
  }
  
  public function getURL($url) {
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
  }

  public function postURL($url,$post_data) {
    $post_string = "";
    foreach($post_data as $key=>$value) {
      $post_string .= "{$key} = {$value}&";
    }
    rtrim($post_string,'&');


    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
  }


}

class ApiController extends MY_Controller {
  public function __construct() {
    parent::__construct();
  }

  public function authenticate() {
  }

  public function check_params($list = array()) {
    $data = array();
    foreach ($list as $key) {
      if (!$this->input->post($key)) {
        die("missing required variable: {$key}");
      }
    }
    return true;
  }
}

?>
