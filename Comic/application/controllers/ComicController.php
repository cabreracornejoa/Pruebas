<?php 
include(APPPATH.'libraries/xlsxwriter.class.php');

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ComicController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('inicio');
	}

	function traerData() {
		

		$postdata = http_build_query(
		    array(
		        'user' => 'Solutest',
		        'pass' => '4ef47aeb23b313ef9fcfc4248d330759'
		    )
		);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $postdata
		    )
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://preqa.colmenaseguros.net/POSTULACION/index.php/Tools/API_POSTULACION_REST/getData', false, $context);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($result));
	}

	function borrar(){

		$id = $this->input->post('id');
		$postdata = http_build_query(
		    array(
		        'user' => 'Solutest',
		        'pass' => '4ef47aeb23b313ef9fcfc4248d330759',
		        'id'=> $id
		    )
		);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $postdata
		    )
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://preqa.colmenaseguros.net/POSTULACION/index.php/Tools/API_POSTULACION_REST/deleteData', false, $context);

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($result));
	}
	function exportar(){

		$postdata = http_build_query(
		    array(
		        'user' => 'Solutest',
		        'pass' => '4ef47aeb23b313ef9fcfc4248d330759'
		    )
		);

		$opts = array('http' =>
		    array(
		        'method'  => 'POST',
		        'header'  => 'Content-type: application/x-www-form-urlencoded',
		        'content' => $postdata
		    )
		);

		$context  = stream_context_create($opts);

		$result = file_get_contents('http://preqa.colmenaseguros.net/POSTULACION/index.php/Tools/API_POSTULACION_REST/getData', false, $context);

		$comic = json_decode($result, True);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Descargas/Comic.xlsx"');
		header('Cache-Control: max-age=0');
		$headers = array();
		foreach ($comic[0] as $k => $v) {
			$headers[] = $k;
		}
		$final = array_merge(array($headers), $comic);
		$this->xlswriter = new XLSXWriter();
		$this->xlswriter->writeSheet($final, 'Comic');
		$this->xlswriter->writeToStdOut();
	}

}

/* End of file ComicController.php */
/* Location: ./application/controllers/ComicController.php */