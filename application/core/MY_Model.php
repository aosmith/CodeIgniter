<?php
class MY_Model extends CI_Model {

  var $id;

  public function __construct() {
    parent::__construct();
    $class_name = strtolower(get_class($this));
    $class_name = str_replace('_model','',$class_name);
    $this->_class_name = $class_name;
    $this->_table = $class_name.'s';
    $this->id = false;
  }


  public function find_by($properties=array()) {
    foreach ($properties as $key=>$value) {
      $this->db->where($key,$value);
    }
    $query = $this->db->get($this->_table);
    $result = $query->result(get_class($this));
    if (count($result) == 0) {
      return false;
    } else {
      return $result;
    }
  }
  public function find_by_id($id) {
    $query = $this->db->where('id',$id)->get($this->_table);
    $result = $query->result(get_class($this));
    if (count($result) == 1) {
      return $result[0];
    } else {
      return false;
    }
  }

  public function find_all() {
    $query = $this->db->get($this->_table);
    $result = $query->result(get_class($this));
    return (count($result) > 0 ? $result : false);
  }

  public function find_by_short_code($short_code) {
    $query = $this->db->where('short_code',$short_code)->get($this->_table);
    $result = $query->result(get_class($this));
    if (count($result) == 1) {
      return $result[0];
    } else {
      return false;
    }
  }

  public function update($data) {
    if ($data['id']) {
      $this->db->where('id',$data['id'])->get($this->_table);
      foreach($data as $key=>$value) {
        if ($key != "id") {
          $this->db->set($key,$value);
        }
      }
      $result = $this->db->update($this->_table);
      return $result;
    }
  }

  public function sanitize() {
    //This function should remove any sensitive keys
    unset($this->_class_name);
    unset($this->_table);
  }

  public function __toString() {
    return $this->id;
  }

  public function get_form_elements_array() {
    $form_array = array();
    if ($this->id) {
      $this->sanitize();
      foreach (get_object_vars($this) as $key=>$value) {
        $form_array[$key] = "<input type=\"text\" name=\"$key\" value=\"$value\" style=\"width:100%;\"></input>";
      }
    } else {
      foreach ($this->db->list_fields($this->_table) as $column) {
        $form_array[$column] = "<input type=\"text\" name=\"$column\" style=\"width:100%;\"></input>";
      }
    }
    return $form_array;
  }
}
?>
