<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *       http://example.com/index.php/welcome
   *   - or -
   *       http://example.com/index.php/welcome/index
   *   - or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see https://codeigniter.com/user_guide/general/urls.html
   */
  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    $this->load->view('login/login');
  }
  public function checkUserInfo()
  {

    if ($this->input->is_ajax_request()) {
      $response = array('status' => 500, 'msg' => 'Some Internal Error');
      $email =  $this->input->post('email');
      $password =  $this->input->post('password');
      $required = ['email', 'password'];
      // print_r($_POST);
      $proceed = 1;
      foreach ($required as $key => $val) {
        if (empty($_POST[$val])) {
          $data =  ['field' => $val, 'msg' => 'Field Is Required'];
          $response['status'] = 201;
          $response['msg'] = "No Fields";
          $response['err'][] = $data;
          $proceed = 0;
          // exit;
        }
      }
      if ($proceed) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $response = array('status' => 202, 'msg' => 'Invalid Email');
        } else {
          $this->load->model('User_model');
          $return_query = $this->User_model->checkEmailAndPassword($email, $password);
          if (empty($return_query)) {
            $response = array('status' => 203, 'msg' => 'Invalid User');
          } else {
            $this->session->set_userdata('logged_session', $return_query);
            $response = array('status' => 200, 'msg' => 'Success  You Will Redirect Shortly', 'data' => $return_query);
          }
        }
      }

      echo json_encode($response);
    }
  }

  public function logout($value = '')
  {
    $this->session->unset_userdata('logged_session');
    $this->load->view('login/login');
  }

  public function armstrongCalculation()
  {
    $number  = 40000;
    $start_time = microtime(true);
    $is_number_armstrong = 1;
    if ($this->getNumberArmstrong($number)) {
      $is_number_armstrong = 1;
      echo "yes armstrong";
    } else {
      //  To Calculate Smallest Armstrong Number
      $smallest_arm = $number;
      while (true) {
        if ($smallest_arm == 0) {
          break;
        } else {
          $smallest_arm--;
          // print_r($number);    
          if ($this->getNumberArmstrong($smallest_arm)) {
            // print_r($smallest_arm);
            break;
          }
        }
      }

      //  To Calculate Largest Armstrong Number
      $largest_arm = $number;
      while (true) {
        if ($number == 2000) {
          break;
        }
        if ($number == 0) {
          break;
        } else {
          $number++;
          // print_r($number);    
          if ($this->getNumberArmstrong($number)) {
            // print_r($largest_arm);
            break;
          }
        }
      }
      $end_time = microtime(true);
      $execution_time = ($end_time - $start_time);

      $memory_usage =  $this->print_mem();
      echo "The largest Armstrong Number Is :-" . $number;
      echo "<br>";
      echo "The Smallest Armstrong Number Is :-" . $smallest_arm;
      echo "<br>";
      echo "The Memory Usage  Is :-" . $memory_usage;
      echo "<br>";
      echo "The Execution Time  Is :-" . $execution_time;
    }
  }
  function print_mem()
  {
    /* Currently used memory */
    $mem_usage = memory_get_usage();

    /* Peak memory usage */
    $mem_peak = memory_get_peak_usage();
    $data = round($mem_usage / 1024);
    return $data;
  }

  private function getNumberArmstrong($number)
  {
    if (is_numeric($number)) {
      trim($number);
      $split_number = str_split($number);
      $total = 0;
      $count_num =  count($split_number);
      foreach ($split_number as $key => $value) {
        $val_total = $value;
        for ($i = 1; $i < $count_num; $i++) {
          $val_total = $value * $val_total;
        }
        $total = $total + $val_total;
      }
      if ($number == $total) {
        return true;
      } else {
        return false;
      }
    } else {
      echo "Please Enter Valid Number";
      exit;
    }
  }
}
