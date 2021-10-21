<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

class Graph extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}


	// remake: hitung total orderan
	public function year_orderfinish(){
		try{
			$year = date('Y');

			// require param year
			$totalOrder = intval($this->Dashboard_model->yearCount($year)->total_order_selesai);

			// variable array
			$dataResult = array(
				'tahun' => intval($year),
				'total_order' => $totalOrder
			);
			echo json_encode($dataResult);
		}catch(Exception $e){
			echo "Error : ".$e->getMessage();
		}
	}

	// remake: hitung total no_invoice selesai selama setahun
	public function month_orderfinish(){
		try{
			$year = date('Y');

			// require param year
			$totalMonthly = $this->Dashboard_model->graphMonthly($year);

			// variable array
			$dataResult = array(
				'tahun' => intval($year),
				'graphbulan' => $totalMonthly
			);
			echo json_encode($dataResult);
		}catch(Exception $e){
			echo "Error : ".$e->getMessage();
		}
	}

	// remake: status order kinerja dalam setahun & Persentasi Kinerja
	public function year_stat(){
		try{
			$year = date('Y');

			// require param year
			$yearStat = $this->Dashboard_model->yearStat();

			// variable array
			$dataResult = array(
				'tahun' => intval($year),
				'tahunberjalan' => $yearStat
			);
			echo json_encode($dataResult);
		}catch(Exception $e){
			echo "Error : ".$e->getMessage();
		}
	}

	// remake: status kinerja divisi
	public function divisi_stat(){
		try{
			$year = date('Y');

			// require param year
			$divisiStat = $this->Dashboard_model->divisiStat();

			// variable array
			$dataResult = array(
				'tahun' => intval($year),
				'kinerjadivisi' => $divisiStat
			);
			echo json_encode($dataResult);
		}catch(Exception $e){
			echo "Error : ".$e->getMessage();
		}
	}

	// remake: employee bad divisi
	public function employee_bad(){
		try{
			$year = date('Y');

			// require param year
			$empBad = $this->Dashboard_model->employeeBad();

			// variable array
			$dataResult = array(
				'tahun' => intval($year),
				'kinerjadivisi' => $empBad
			);
			echo json_encode($dataResult);
		}catch(Exception $e){
			echo "Error : ".$e->getMessage();
		}
	}

	// remake: employee bad divisi
	public function employee_good(){
		try{
			$year = date('Y');

			// require param year
			$empGood = $this->Dashboard_model->employeeGood();

			// variable array
			$dataResult = array(
				'tahun' => intval($year),
				'kinerjadivisi' => $empGood
			);
			echo json_encode($dataResult);
		}catch(Exception $e){
			echo "Error : ".$e->getMessage();
		}
	}
}