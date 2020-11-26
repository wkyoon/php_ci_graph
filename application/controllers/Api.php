<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';



class Api extends RestController {

	public function __construct() {
		parent::__construct();
		$this->load->model('Tbdatum_model');
		$this->load->helper('date');
		$this->load->driver('cache');
	 }

	 public function index_get($mkey = '')
	 {
        // if(!empty($id)){
        //     $data = $this->db->get_where("items", ['id' => $id])->row_array();
        // }else{
        //     $data = $this->db->get("items")->result();
		// }
		//$this->Tbdatum_model->get_tbdatum_by_mac('D1:AA:92:67:42:98');
		//$data['a'] = now('Asia/Seoul');
		//$data['b'] = $this->Tbdatum_model->get_tbdatum_by_mac('D1:AA:92:67:42:98');

		if(class_exists('memcached'))
		{
            //$data['memcached'] = 'memcached';
		}
		else
		{
			//$data['memcached'] = 'no memcached';
		}

		$mvalue = $this->cache->memcached->get($mkey);
		
		$mkeys = explode("_", $mkey);
		$mac = $mkeys[0];
		$tinfo = $mkeys[1];
		
		$data['mac'] = $mac;
		$data['tinfo'] = $tinfo;
		
		$data['mvalue'] = $mvalue;

		if($mvalue!=false)
		{
			$mvalues = explode("_", $mvalue);
			$val01 = $mvalues[0];
			$thrhlder = $mvalues[1];
			$data['val01'] = $val01;
			$data['thrhlder'] = $thrhlder;

		}
		else
		{
			
			
		}
		

		#$data['tinfo_org'] = $tinfo;
		#$tinfo = date('Y-m-d H:i:s', $tinfo/1000);
		
		#$data['tinfo'] = $tinfo;
		#$data['tbdatum'] = $this->Tbdatum_model->get_tbdatum_realtime($tinfo);
        $this->response($data, RestController::HTTP_OK);
	}


	public function daily_get($mac = '',$tinfo)
	 {
       

		
		

		//$data['mac'] = $mac;
		//$data['tinfo'] =$tinfo;
		//$tinfo = date('Y-m-d H:i:s', $tinfo/1000);
		
		
		//$data["temp"] =(string) $tinfo;
		//$data["temp2"] =$data["temp"]."_".$data["temp"];
		$data['tbdatum'] = $this->Tbdatum_model->get_tbdatum_daily_by_mac_tinfo($mac,$tinfo);
        $this->response($data, RestController::HTTP_OK);
	}

}
