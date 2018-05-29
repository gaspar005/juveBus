<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Operador_ctrl extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("web/Operador_model", 'Operador_model');
		$this->load->model('web/Dashboard_model', 'Dashboard_model');
    	$this->load->library('bcrypt');
	}
  // MODULO DE REGISTRO DE OPERADORES
  public function registro(){

    $dato['active'] = "operador";
    $dato['active1'] = "registro-operador";
    $dato['ruta1'] = "Registro Operador";
    $dato['ruta'] = "Modulo Operador / Registro";

    $this->load->view('global_view/header', $dato);
    $this->load->view('admin/operador/registro');
    $this->load->view('global_view/foother');
  }
  public function searchRFC(){

    $rfc = $this->input->post("rfc");
    $query = $this->Operador_model->existeRFC($rfc);

    if ($query == 1) {
        $result['resultado'] = true;
    } else {
        $result['resultado'] = false;
    }
    echo json_encode($result);
  }
  public function guardar_operador(){

	  if (isset($_FILES["img_operador"]["name"]) && $_FILES["img_operador"]["name"] != null  ) {

		  $type = explode('.', $_FILES["img_operador"]["name"]);
		  $type = $type[count($type) - 1];

		  date_default_timezone_set('America/Cancun');

		  $date = date('H:i:s');
		  $now = date('Y-m-d');

		  $nombreEntero = $_FILES["img_operador"]["name"];
		  $nombre1 =  str_replace(' ', '_',$nombreEntero);
		  $nombre = explode(".", $nombre1);

		  $url = "./assets/imgs/operador/perfil/" . $nombre[0] . '_' . str_replace(':', '-', $date) . '_' . $now . '.' . $type;
		  if (in_array($type, array("jpg", "png", "jpeg"))) {
			  if (is_uploaded_file($_FILES["img_operador"]["tmp_name"])) {
				  move_uploaded_file($_FILES["img_operador"]["tmp_name"], $url);

				  $fecha = $this->input->post("year_fecha") . '-' . $this->input->post("mes_fecha") . '-' . $this->input->post("dia_fecha");
				  $operador = array(
					  'rfc' => $this->input->post("rfc"),
					  'nombre' => $this->input->post("nombre"),
					  'ap_pat' => $this->input->post("ap_pat"),
					  'ap_mat' => $this->input->post("ap_mat"),
					  'telefono' => $this->input->post("telefono"),
					  'correo' => $this->input->post("correo"),
					  'colonia' => $this->input->post("colonia"),
					  'domicilio' => $this->input->post("domicilio"),
					  'cruzamientos' => $this->input->post("cruzamientos"),
					  'avatar'  => $nombre[0].'_'.str_replace(':', '-', $date).'_'.$now.'.'.$type,
					  'fecha_nacimiento' => $fecha,
					  'status' => 1,
					  'id_role' => 2,
					  'password' => $this->bcrypt->hash_password($this->input->post("rfc"))
				  );
				  $query = $this->Operador_model->save_operador($operador);
				  if ($query == 1) {
					  $result['resultado'] = true;
				  } else {
					  $result['resultado'] = false;
				  }
				  echo json_encode($result);
			  }
		  } else {
			  $result['resultado'] = false;
			  echo json_encode($result);
		  }
	  }else {

		  $fecha = $this->input->post("year_fecha") . '-' . $this->input->post("mes_fecha") . '-' . $this->input->post("dia_fecha");

		  $operador = array(
			  'rfc' => $this->input->post("rfc"),
			  'nombre' => $this->input->post("nombre"),
			  'ap_pat' => $this->input->post("ap_pat"),
			  'ap_mat' => $this->input->post("ap_mat"),
			  'telefono' => $this->input->post("telefono"),
			  'correo' => $this->input->post("correo"),
			  'colonia' => $this->input->post("colonia"),
			  'domicilio' => $this->input->post("domicilio"),
			  'cruzamientos' => $this->input->post("cruzamientos"),
			  'fecha_nacimiento' => $fecha,
			  'status' => 1,
			  'id_role' => 2,
			  'password' => $this->bcrypt->hash_password($this->input->post("rfc"))
		  );

		  $query = $this->Operador_model->save_operador($operador);
		  if ($query == 1) {
			  $result['resultado'] = true;
		  } else {
			  $result['resultado'] = false;
		  }
		  echo json_encode($result);
	  }
  }

  // MODULO DE REPORTES DE OPERADORES
  public function reportes(){

		$dato['active'] = "operador";
    	$dato['active1'] = "reportes-operador";
		$dato['ruta1'] = "Reporte de Operadores";
		$dato['ruta'] = "Modulo Operador / Reportes";

		$vista['operadores'] = $this->Operador_model->get_list_operadores();

		$this->load->view('global_view/header', $dato);
    	$this->load->view('admin/operador/reportes', $vista);
    	$this->load->view('global_view/foother');

  }
  public function getInfor_operador(){

 		$id = $this->input->post('operador');

    	date_default_timezone_set('America/Cancun');
		$fecha = date('Y-m-d');

 		$query = $this->Operador_model->getReportePorDia($id,$fecha);

 		if ($query != false) {

          $result['resultado'] = true;
          $result['operador'] = $query;

		  } else {
			  $result['resultado'] = false;
		  }
		  echo json_encode($result);

  }
  public function searchQueryDay(){

    $id = $this->input->post('id_operador');
    $fecha1 = $this->input->post('fecha_dia');

    $inicio1 = explode("/", $fecha1);
    $fecha = $inicio1[2].'-'.$inicio1[1].'-'.$inicio1[0];

    $query = $this->Operador_model->getReportePorDia($id,$fecha);

    if ($query != false) {

          $result['resultado'] = true;
          $result['operador'] = $query;

      } else {
          $result['resultado'] = false;
      }
      echo json_encode($result);

  }
  public function searchQueryRango(){

    $id = $this->input->post('id_operador');
    $fecha_inicio = $this->input->post('dia_inicio');
    $fecha_fin = $this->input->post('dia_fin');

    $inicio1 = explode("/", $fecha_inicio);
    $inicio = $inicio1[2].'-'.$inicio1[1].'-'.$inicio1[0];

    $fin1 = explode("/", $fecha_fin);
    $fin = $fin1[2].'-'.$fin1[1].'-'.$fin1[0];

    $query = $this->Operador_model->getReportePorRango($id,$inicio, $fin);

    if ($query != false) {

          $result['resultado'] = true;
          $result['operador'] = $query;

      } else {
          $result['resultado'] = false;
      }
      echo json_encode($result);

  }
  public function searchQueryMonth(){

    $id = $this->input->post('id_operador');
    $mes = $this->input->post('mes');
    $year = $this->input->post('year');

    $query = $this->Operador_model->getReportePorMonth($id,$mes, $year);

    if ($query != false) {

          $result['resultado'] = true;
          $result['operador'] = $query;

      } else {
          $result['resultado'] = false;
      }
      echo json_encode($result);

  }
  public function getYearEsistentes(){

    $query = $this->Operador_model->getYears();

    if ($query != false) {

          $result['resultado'] = true;
          $result['years'] = $query;

      } else {
          $result['resultado'] = false;
      }
      echo json_encode($result);

  }
  public function searchQueryYear(){

    $id = $this->input->post('id_operador');
    $year = $this->input->post('year');

    $query = $this->Operador_model->getReportePorYear($id, $year);

    if ($query != false) {

          $result['resultado'] = true;
          $result['operador'] = $query;

      } else {
          $result['resultado'] = false;
      }
      echo json_encode($result);
  }
	//PDF IMPRIMIR
  public function pdf_operador_corte_dia(){

	  $id_operador = $this->input->get('id');
	  ob_start();
	  //**********************************************************************************
	  //       PDF
	  //**********************************************************************************
	  $this->load->library('m_pdf');
	  $mpdf = new \Mpdf\Mpdf([
		  'mode' => 'utf-8',
		  'margin_top' => 36,
	  ]);
	  date_default_timezone_set('America/Cancun');
	  $fecha = date('Y-m-d');

	  $datosCorteDia = $this->Operador_model->getReportePorDia($id_operador,$fecha);
	  $datosOperador = $this->Dashboard_model->get_operador_header_pdf($id_operador);
	  /**************************************** Hoja de estilos ****************************************************/
	  $stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));
	  $mpdf->WriteHTML($stylesheet, 1);
	  /******************************************** head pdf ******************************************************/
	  $data['datosOperador'] = $datosOperador;
	  $head              		= $this->load->view('admin/operador/pdf_dia/head', $data, true);
	  $mpdf->SetHTMLHeader($head);
// /***************************************** contenido pdf ****************************************************/
	  $data2['datosCorte'] = $datosCorteDia;
	  $data2['datosOperador'] = $datosOperador;
	  $data2['body'] = $stylesheet;
	  $html = $this->load->view('admin/operador/pdf_dia/contenido', $data2, true); //calcular el monto total del saldo insertado
//**************************************** footer 1 ********************************************************
	  $data3['pie_pagina'] = "";
	  $footer = $this->load->view('admin/operador/pdf_dia/footer', $data3, true);
	  $mpdf->SetHTMLFooter($footer);
	  /****************************************** imprmir pagina ********************************************************/

	  $mpdf->WriteHTML($html);
	  ob_clean();
	  $mpdf->Output();

  }
  public function pdf_operador_corte_consulta_dia(){
	  $id_operador = $this->input->get('id');
	  $fecha1 = $this->input->get('fecha_dia');
	  $inicio1 = explode("/", $fecha1);
	  $fecha = $inicio1[2].'-'.$inicio1[1].'-'.$inicio1[0];
	  ob_start();
	  //**********************************************************************************
	  //       PDF
	  //**********************************************************************************
	  $this->load->library('m_pdf');
	  $mpdf = new \Mpdf\Mpdf([
		  'mode' => 'utf-8',
		  'margin_top' => 36,
	  ]);
	  $datosCorteDia = $this->Operador_model->getReportePorDia($id_operador,$fecha);
	  $datosOperador = $this->Dashboard_model->get_operador_header_pdf($id_operador);
	  /**************************************** Hoja de estilos ****************************************************/
	  $stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));
	  $mpdf->WriteHTML($stylesheet, 1);
	  /******************************************** head pdf ******************************************************/
	  $data['datosOperador'] = $datosOperador;
	  $head              		= $this->load->view('admin/operador/pdf_dia_consulta/head', $data, true);
	  $mpdf->SetHTMLHeader($head);
// /***************************************** contenido pdf ****************************************************/
	  $data2['datosCorte'] = $datosCorteDia;
	  $data2['datosOperador'] = $datosOperador;
	  $data2['body'] = $stylesheet;
	  $html = $this->load->view('admin/operador/pdf_dia_consulta/contenido', $data2, true); //calcular el monto total del saldo insertado
//**************************************** footer 1 ********************************************************
	  $data3['pie_pagina'] = "";
	  $footer = $this->load->view('admin/operador/pdf_dia_consulta/footer', $data3, true);
	  $mpdf->SetHTMLFooter($footer);
	  /****************************************** imprmir pagina ********************************************************/

	  $mpdf->WriteHTML($html);
	  ob_clean();
	  $mpdf->Output();

  }
  public function pdf_operador_corte_consulta_rango(){

	  $id_operador = $this->input->get('id');
	  $fecha_inicio = $this->input->get('inicio');
	  $fecha_fin = $this->input->get('fin');

	  $inicio1 = explode("/", $fecha_inicio);
	  $inicio = $inicio1[2].'-'.$inicio1[1].'-'.$inicio1[0];

	  $fin1 = explode("/", $fecha_fin);
	  $fin = $fin1[2].'-'.$fin1[1].'-'.$fin1[0];
	  ob_start();
	  //**********************************************************************************
	  //       PDF
	  //**********************************************************************************
	  $this->load->library('m_pdf');
	  $mpdf = new \Mpdf\Mpdf([
		  'mode' => 'utf-8',
		  'margin_top' => 36,
	  ]);
	  $datosCorteDia = $this->Operador_model->getReportePorRango($id_operador,$inicio, $fin);
	  $datosOperador = $this->Dashboard_model->get_operador_header_pdf($id_operador);
	  /**************************************** Hoja de estilos ****************************************************/
	  $stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));
	  $mpdf->WriteHTML($stylesheet, 1);
	  /******************************************** head pdf ******************************************************/
	  $data['datosOperador'] = $datosOperador;
	  $head              		= $this->load->view('admin/operador/pdf_rango/head', $data, true);
	  $mpdf->SetHTMLHeader($head);
// /***************************************** contenido pdf ****************************************************/
	  $data2['datosCorte'] = $datosCorteDia;
	  $data2['datosOperador'] = $datosOperador;
	  $data2['body'] = $stylesheet;
	  $html = $this->load->view('admin/operador/pdf_rango/contenido', $data2, true); //calcular el monto total del saldo insertado
//**************************************** footer 1 ********************************************************
	  $data3['pie_pagina'] = "";
	  $footer = $this->load->view('admin/operador/pdf_rango/footer', $data3, true);
	  $mpdf->SetHTMLFooter($footer);
	  /****************************************** imprmir pagina ********************************************************/

	  $mpdf->WriteHTML($html);
	  ob_clean();
	  $mpdf->Output();

  }
  public function pdf_operador_corte_mes(){

	  $id_operador = $this->input->get('id');
	  $mes = $this->input->get('month');
	  $year = $this->input->get('year');

	  ob_start();
	  //**********************************************************************************
	  //       PDF
	  //**********************************************************************************
	  $this->load->library('m_pdf');
	  $mpdf = new \Mpdf\Mpdf([
		  'mode' => 'utf-8',
		  'margin_top' => 36,
	  ]);
	  $datosCorteDia = $this->Operador_model->getReportePorMonth($id_operador,$mes, $year);
	  $datosOperador = $this->Dashboard_model->get_operador_header_pdf($id_operador);
	  /**************************************** Hoja de estilos ****************************************************/
	  $stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));
	  $mpdf->WriteHTML($stylesheet, 1);
	  /******************************************** head pdf ******************************************************/
	  $data['datosOperador'] = $datosOperador;
	  $head              		= $this->load->view('admin/operador/pdf_mes/head', $data, true);
	  $mpdf->SetHTMLHeader($head);
// /***************************************** contenido pdf ****************************************************/
	  $data2['datosCorte'] = $datosCorteDia;
	  $data2['datosOperador'] = $datosOperador;
	  $data2['body'] = $stylesheet;
	  $html = $this->load->view('admin/operador/pdf_mes/contenido', $data2, true); //calcular el monto total del saldo insertado
//**************************************** footer 1 ********************************************************
	  $data3['pie_pagina'] = "";
	  $footer = $this->load->view('admin/operador/pdf_mes/footer', $data3, true);
	  $mpdf->SetHTMLFooter($footer);
	  /****************************************** imprmir pagina ********************************************************/

	  $mpdf->WriteHTML($html);
	  ob_clean();
	  $mpdf->Output();

  }
  public function pdf_operador_corte_year(){

	  $id_operador = $this->input->get('id');
	  $year = $this->input->get('year');

	  ob_start();
	  //**********************************************************************************
	  //       PDF
	  //**********************************************************************************
	  $this->load->library('m_pdf');
	  $mpdf = new \Mpdf\Mpdf([
		  'mode' => 'utf-8',
		  'margin_top' => 36,
	  ]);
	  $datosCorteDia = $this->Operador_model->getReportePorYear($id_operador, $year);
	  $datosOperador = $this->Dashboard_model->get_operador_header_pdf($id_operador);
	  /**************************************** Hoja de estilos ****************************************************/
	  $stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));
	  $mpdf->WriteHTML($stylesheet, 1);
	  /******************************************** head pdf ******************************************************/
	  $data['datosOperador'] = $datosOperador;
	  $head              		= $this->load->view('admin/operador/pdf_año/head', $data, true);
	  $mpdf->SetHTMLHeader($head);
// /***************************************** contenido pdf ****************************************************/
	  $data2['datosCorte'] = $datosCorteDia;
	  $data2['datosOperador'] = $datosOperador;
	  $data2['body'] = $stylesheet;
	  $html = $this->load->view('admin/operador/pdf_año/contenido', $data2, true); //calcular el monto total del saldo insertado
//**************************************** footer 1 ********************************************************
	  $data3['pie_pagina'] = "";
	  $footer = $this->load->view('admin/operador/pdf_año/footer', $data3, true);
	  $mpdf->SetHTMLFooter($footer);
	  /****************************************** imprmir pagina ********************************************************/

	  $mpdf->WriteHTML($html);
	  ob_clean();
	  $mpdf->Output('','I');

  }
	//CREATE PDF AND SEND EMAIL
  public function send_email_day(){

	  $id_operador =  $this->input->post('id_operador');
	  $query = $this->create_pdf_and_send_email_dia($id_operador);

	  if ($query == true) {
		  echo true;
	  } else {
		  echo false;
	  }
  }
  public function create_pdf_and_send_email_dia($id_operador){
	  ob_start();
	  //**********************************************************************************
	  //       PDF
	  //**********************************************************************************
	  $this->load->library('m_pdf');
	  $mpdf = new \Mpdf\Mpdf([
		  'mode' => 'utf-8',
		  'margin_top' => 36,
	  ]);
	  date_default_timezone_set('America/Cancun');
//    $fecha = date('Y-m-d');
	  $fecha = '2018-05-18';
	  $datosCorteDia = $this->Operador_model->getReportePorDia($id_operador,$fecha);
	  $datosOperador = $this->Dashboard_model->get_operador_header_pdf($id_operador);
	  /**************************************** Hoja de estilos ****************************************************/
	  $stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));
	  $mpdf->WriteHTML($stylesheet, 1);
	  /******************************************** head pdf ******************************************************/
	  $data['datosOperador'] = $datosOperador;
	  $head              		= $this->load->view('admin/operador/pdf_dia/head', $data, true);
	  $mpdf->SetHTMLHeader($head);
// /***************************************** contenido pdf ****************************************************/
	  $data2['datosCorte'] = $datosCorteDia;
	  $data2['datosOperador'] = $datosOperador;
	  $data2['body'] = $stylesheet;
	  $html = $this->load->view('admin/operador/pdf_dia/contenido', $data2, true); //calcular el monto total del saldo insertado
//**************************************** footer 1 ********************************************************
	  $data3['pie_pagina'] = "";
	  $footer = $this->load->view('admin/operador/pdf_dia/footer', $data3, true);
	  $mpdf->SetHTMLFooter($footer);
	  /****************************************** imprmir pagina ********************************************************/

	  $mpdf->WriteHTML($html);
	  ob_clean();
	  $content = $mpdf->Output('','S');
	  //**********************************************************************************
	  //    FIN   PDF
	  //**********************************************************************************
	  $this->load->library('my_phpmailer');
	  $mail = new PHPMailer;
	  try {

//		   $mail->SMTPDebug = 2;
		  $mail->isSMTP(); // Set mailer to use SMTP
		  $mail->CharSet = "UTF-8";
		  $textDescription =  ", <br> Corde del dia.";
		  $textArea      = "Hola ".$datosOperador[0]->nombre.$textDescription;
		  $email_estudiante   = $datosCorteDia['correo'];

		  $mail->Host       = 'mx1.hostinger.mx'; // Specify main and backup SMTP servers
		  $mail->SMTPAuth   = true; // Enable SMTP authentication
		  $mail->Username   = 'juvebus_iqj@juvebus.juventudqroo.com'; // SMTP username
		  $mail->Password   = 'imjuvechetumal_2018'; // SMTP password
		  $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		  $mail->Port       = 587; // TCP port to connect to

		  $mail->setFrom('juvebus_iqj@juvebus.juventudqroo.com', 'IQJ');
		  $mail->addAddress($email_estudiante);
		  $mail->addStringAttachment($content, 'recortedia.pdf', $encoding = 'base64', $type = 'application/octet-stream');
		  $mail->isHTML(true); // Set email format to HTML

		  $mail->Subject = 'Corte de ganacias del día';
		  $mail->Body    = $textArea;
		  if($mail->send()) {
			  return TRUE;
		  } else {
			  return FALSE;
		  }

	  } catch (Exception $e) {
		  return FALSE;
	  }
  }

  public function send_email_day_consulta(){

	  $id_operador =  $this->input->post('id_operador');
	  $fecha1 = $this->input->post('fecha_dia');
	  $inicio1 = explode("/", $fecha1);
	  $fecha = $inicio1[2].'-'.$inicio1[1].'-'.$inicio1[0];

	  $query = $this->create_pdf_and_send_email_consulta_dia($id_operador, $fecha);

	  if ($query == true) {
		  echo true;
	  } else {
		  echo false;
	  }
  }
  public function create_pdf_and_send_email_consulta_dia($id_operador, $fecha){
	  ob_start();
	  //**********************************************************************************
	  //       PDF
	  //**********************************************************************************
	  $this->load->library('m_pdf');
	  $mpdf = new \Mpdf\Mpdf([
		  'mode' => 'utf-8',
		  'margin_top' => 36,
	  ]);
	  $datosCorteDia = $this->Operador_model->getReportePorDia($id_operador,$fecha);
	  $datosOperador = $this->Dashboard_model->get_operador_header_pdf($id_operador);
	  /**************************************** Hoja de estilos ****************************************************/
	  $stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));
	  $mpdf->WriteHTML($stylesheet, 1);
	  /******************************************** head pdf ******************************************************/
	  $data['datosOperador'] = $datosOperador;
	  $head              		= $this->load->view('admin/operador/pdf_dia_consulta/head', $data, true);
	  $mpdf->SetHTMLHeader($head);
// /***************************************** contenido pdf ****************************************************/
	  $data2['datosCorte'] = $datosCorteDia;
	  $data2['datosOperador'] = $datosOperador;
	  $data2['body'] = $stylesheet;
	  $html = $this->load->view('admin/operador/pdf_dia_consulta/contenido', $data2, true); //calcular el monto total del saldo insertado
//**************************************** footer 1 ********************************************************
	  $data3['pie_pagina'] = "";
	  $footer = $this->load->view('admin/operador/pdf_dia_consulta/footer', $data3, true);
	  $mpdf->SetHTMLFooter($footer);
	  /****************************************** imprmir pagina ********************************************************/

	  $mpdf->WriteHTML($html);
	  ob_clean();
	  $content = $mpdf->Output('','S');
	  //**********************************************************************************
	  //    FIN   PDF
	  //**********************************************************************************
	  $this->load->library('my_phpmailer');
	  $mail = new PHPMailer;
	  try {

//		   $mail->SMTPDebug = 2;
		  $mail->isSMTP(); // Set mailer to use SMTP
		  $mail->CharSet = "UTF-8";
		  $textDescription =  ", <br> Corte del día.";
		  $textArea      = "Hola ".$datosOperador[0]->nombre.$textDescription;
		  $email_estudiante   = $datosCorteDia['correo'];

		  $mail->Host       = 'mx1.hostinger.mx'; // Specify main and backup SMTP servers
		  $mail->SMTPAuth   = true; // Enable SMTP authentication
		  $mail->Username   = 'juvebus_iqj@juvebus.juventudqroo.com'; // SMTP username
		  $mail->Password   = 'imjuvechetumal_2018'; // SMTP password
		  $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		  $mail->Port       = 587; // TCP port to connect to

		  $mail->setFrom('juvebus_iqj@juvebus.juventudqroo.com', 'IQJ');
		  $mail->addAddress($email_estudiante);
		  $mail->addStringAttachment($content, 'recortedia.pdf', $encoding = 'base64', $type = 'application/octet-stream');
		  $mail->isHTML(true); // Set email format to HTML

		  $mail->Subject = 'Corte de ganacias del día';
		  $mail->Body    = $textArea;
		  if($mail->send()) {
			  return TRUE;
		  } else {
			  return FALSE;
		  }

	  } catch (Exception $e) {
		  return FALSE;
	  }
  }
  public function send_email_rango(){

	  $id_operador =  $this->input->post('id_operador');
	  $fecha_inicio = $this->input->post('inicio');
	  $fecha_fin = $this->input->post('fin');

	  $inicio1 = explode("/", $fecha_inicio);
	  $inicio = $inicio1[2].'-'.$inicio1[1].'-'.$inicio1[0];

	  $fin1 = explode("/", $fecha_fin);
	  $fin = $fin1[2].'-'.$fin1[1].'-'.$fin1[0];

	  $query = $this->create_pdf_and_send_email_rango($id_operador, $inicio, $fin);

	  if ($query == true) {
		  echo true;
	  } else {
		  echo false;
	  }
  }
  public function create_pdf_and_send_email_rango($id_operador,$inicio, $fin){
	  ob_start();
	  //**********************************************************************************
	  //       PDF
	  //**********************************************************************************
	  $this->load->library('m_pdf');
	  $mpdf = new \Mpdf\Mpdf([
		  'mode' => 'utf-8',
		  'margin_top' => 36,
	  ]);
	  $datosCorteDia = $this->Operador_model->getReportePorRango($id_operador,$inicio, $fin);
	  $datosOperador = $this->Dashboard_model->get_operador_header_pdf($id_operador);
	  /**************************************** Hoja de estilos ****************************************************/
	  $stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));
	  $mpdf->WriteHTML($stylesheet, 1);
	  /******************************************** head pdf ******************************************************/
	  $data['datosOperador'] = $datosOperador;
	  $head              		= $this->load->view('admin/operador/pdf_rango/head', $data, true);
	  $mpdf->SetHTMLHeader($head);
// /***************************************** contenido pdf ****************************************************/
	  $data2['datosCorte'] = $datosCorteDia;
	  $data2['datosOperador'] = $datosOperador;
	  $data2['body'] = $stylesheet;
	  $html = $this->load->view('admin/operador/pdf_rango/contenido', $data2, true); //calcular el monto total del saldo insertado
//**************************************** footer 1 ********************************************************
	  $data3['pie_pagina'] = "";
	  $footer = $this->load->view('admin/operador/pdf_rango/footer', $data3, true);
	  $mpdf->SetHTMLFooter($footer);
	  /****************************************** imprmir pagina ********************************************************/

	  $mpdf->WriteHTML($html);
	  ob_clean();
	  $content = $mpdf->Output('','S');
	  //**********************************************************************************
	  //    FIN   PDF
	  //**********************************************************************************
	  $this->load->library('my_phpmailer');
	  $mail = new PHPMailer;
	  try {

//		   $mail->SMTPDebug = 2;
		  $mail->isSMTP(); // Set mailer to use SMTP
		  $mail->CharSet = "UTF-8";
		  $textDescription =  ", <br> Corde del dia.";
		  $textArea      = "Hola ".$datosOperador[0]->nombre.$textDescription;
		  $email_estudiante   = $datosCorteDia['correo'];

		  $mail->Host       = 'mx1.hostinger.mx'; // Specify main and backup SMTP servers
		  $mail->SMTPAuth   = true; // Enable SMTP authentication
		  $mail->Username   = 'juvebus_iqj@juvebus.juventudqroo.com'; // SMTP username
		  $mail->Password   = 'imjuvechetumal_2018'; // SMTP password
		  $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		  $mail->Port       = 587; // TCP port to connect to

		  $mail->setFrom('juvebus_iqj@juvebus.juventudqroo.com', 'IQJ');
		  $mail->addAddress($email_estudiante);
		  $mail->addStringAttachment($content, 'recortedia.pdf', $encoding = 'base64', $type = 'application/octet-stream');
		  $mail->isHTML(true); // Set email format to HTML

		  $mail->Subject = 'Corte de ganacias Rango de Fechas';
		  $mail->Body    = $textArea;
		  if($mail->send()) {
			  return TRUE;
		  } else {
			  return FALSE;
		  }

	  } catch (Exception $e) {
		  return FALSE;
	  }
  }
  public function send_email_mes(){

	  $id_operador =  $this->input->post('id_operador');
	  $mes = $this->input->post('month');
	  $year = $this->input->post('year');

	  $query = $this->create_pdf_and_send_email_mes($id_operador, $mes, $year);

	  if ($query == true) {
		  echo true;
	  } else {
		  echo false;
	  }
  }
  public function create_pdf_and_send_email_mes($id_operador, $mes, $year){
	  ob_start();
	  //**********************************************************************************
	  //       PDF
	  //**********************************************************************************
	  $this->load->library('m_pdf');
	  $mpdf = new \Mpdf\Mpdf([
		  'mode' => 'utf-8',
		  'margin_top' => 36,
	  ]);

	  $datosCorteDia = $this->Operador_model->getReportePorMonth($id_operador,$mes, $year);
	  $datosOperador = $this->Dashboard_model->get_operador_header_pdf($id_operador);
	  /**************************************** Hoja de estilos ****************************************************/
	  $stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));
	  $mpdf->WriteHTML($stylesheet, 1);
	  /******************************************** head pdf ******************************************************/
	  $data['datosOperador'] = $datosOperador;
	  $head              		= $this->load->view('admin/operador/pdf_mes/head', $data, true);
	  $mpdf->SetHTMLHeader($head);
// /***************************************** contenido pdf ****************************************************/
	  $data2['datosCorte'] = $datosCorteDia;
	  $data2['datosOperador'] = $datosOperador;
	  $data2['body'] = $stylesheet;
	  $html = $this->load->view('admin/operador/pdf_mes/contenido', $data2, true); //calcular el monto total del saldo insertado
//**************************************** footer 1 ********************************************************
	  $data3['pie_pagina'] = "";
	  $footer = $this->load->view('admin/operador/pdf_mes/footer', $data3, true);
	  $mpdf->SetHTMLFooter($footer);
	  /****************************************** imprmir pagina ********************************************************/

	  $mpdf->WriteHTML($html);
	  ob_clean();
	  $content = $mpdf->Output('','S');
	  //**********************************************************************************
	  //    FIN   PDF
	  //**********************************************************************************
	  $this->load->library('my_phpmailer');
	  $mail = new PHPMailer;
	  try {

//		   $mail->SMTPDebug = 2;
		  $mail->isSMTP(); // Set mailer to use SMTP
		  $mail->CharSet = "UTF-8";
		  $textDescription =  ", <br> Corde del dia.";
		  $textArea      = "Hola ".$datosOperador[0]->nombre.$textDescription;
		  $email_estudiante   = $datosCorteDia['correo'];

		  $mail->Host       = 'mx1.hostinger.mx'; // Specify main and backup SMTP servers
		  $mail->SMTPAuth   = true; // Enable SMTP authentication
		  $mail->Username   = 'juvebus_iqj@juvebus.juventudqroo.com'; // SMTP username
		  $mail->Password   = 'imjuvechetumal_2018'; // SMTP password
		  $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		  $mail->Port       = 587; // TCP port to connect to

		  $mail->setFrom('juvebus_iqj@juvebus.juventudqroo.com', 'IQJ');
		  $mail->addAddress($email_estudiante);
		  $mail->addStringAttachment($content, 'recortedia.pdf', $encoding = 'base64', $type = 'application/octet-stream');
		  $mail->isHTML(true); // Set email format to HTML

		  $mail->Subject = 'Corte de ganacias por Mes';
		  $mail->Body    = $textArea;
		  if($mail->send()) {
			  return TRUE;
		  } else {
			  return FALSE;
		  }

	  } catch (Exception $e) {
		  return FALSE;
	  }
  }
  public function send_email_year(){

	  $id_operador =  $this->input->post('id_operador');
	  $year = $this->input->post('year');

	  $query = $this->create_pdf_and_send_email_year($id_operador, $year);

	  if ($query == true) {
		  echo true;
	  } else {
		  echo false;
	  }
  }
  public function create_pdf_and_send_email_year($id_operador, $year){
	  ob_start();
	  //**********************************************************************************
	  //       PDF
	  //**********************************************************************************
	  $this->load->library('m_pdf');
	  $mpdf = new \Mpdf\Mpdf([
		  'mode' => 'utf-8',
		  'margin_top' => 36,
	  ]);

	  $datosCorteDia = $this->Operador_model->getReportePorYear($id_operador, $year);
	  $datosOperador = $this->Dashboard_model->get_operador_header_pdf($id_operador);
	  /**************************************** Hoja de estilos ****************************************************/
	  $stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));
	  $mpdf->WriteHTML($stylesheet, 1);
	  /******************************************** head pdf ******************************************************/
	  $data['datosOperador'] = $datosOperador;
	  $head              		= $this->load->view('admin/operador/pdf_año/head', $data, true);
	  $mpdf->SetHTMLHeader($head);
// /***************************************** contenido pdf ****************************************************/
	  $data2['datosCorte'] = $datosCorteDia;
	  $data2['datosOperador'] = $datosOperador;
	  $data2['body'] = $stylesheet;
	  $html = $this->load->view('admin/operador/pdf_año/contenido', $data2, true); //calcular el monto total del saldo insertado
//**************************************** footer 1 ********************************************************
	  $data3['pie_pagina'] = "";
	  $footer = $this->load->view('admin/operador/pdf_año/footer', $data3, true);
	  $mpdf->SetHTMLFooter($footer);
	  /****************************************** imprmir pagina ********************************************************/

	  $mpdf->WriteHTML($html);
	  ob_clean();
	  $content = $mpdf->Output('','S');
	  //**********************************************************************************
	  //    FIN   PDF
	  //**********************************************************************************
	  $this->load->library('my_phpmailer');
	  $mail = new PHPMailer;
	  try {

//		   $mail->SMTPDebug = 2;
		  $mail->isSMTP(); // Set mailer to use SMTP
		  $mail->CharSet = "UTF-8";
		  $textDescription =  ", <br> Corde del dia.";
		  $textArea      = "Hola ".$datosOperador[0]->nombre.$textDescription;
		  $email_estudiante   = $datosCorteDia['correo'];

		  $mail->Host       = 'mx1.hostinger.mx'; // Specify main and backup SMTP servers
		  $mail->SMTPAuth   = true; // Enable SMTP authentication
		  $mail->Username   = 'juvebus_iqj@juvebus.juventudqroo.com'; // SMTP username
		  $mail->Password   = 'imjuvechetumal_2018'; // SMTP password
		  $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
		  $mail->Port       = 587; // TCP port to connect to

		  $mail->setFrom('juvebus_iqj@juvebus.juventudqroo.com', 'IQJ');
		  $mail->addAddress($email_estudiante);
		  $mail->addStringAttachment($content, 'corte.pdf', $encoding = 'base64', $type = 'application/octet-stream');
		  $mail->isHTML(true); // Set email format to HTML

		  $mail->Subject = 'Corte de ganacias del Año';
		  $mail->Body    = $textArea;
		  if($mail->send()) {
			  return TRUE;
		  } else {
			  return FALSE;
		  }

	  } catch (Exception $e) {
		  return FALSE;
	  }
  }
  // MODULO DE LISTA DE OPERADORES (editar, habilitar, dehabilitar )
  public function lista(){

    $dato['active'] = "operador";
    $dato['active1'] = "lista-operador";
    $dato['ruta1'] = "Lista de Operadores";
    $dato['ruta'] = "Modulo Operador / Lista: editar datos, deshabilitar, habilitar ";

    $vista['operadores'] = $this->Operador_model->get_list_operadoresAll();

    $this->load->view('global_view/header', $dato);
    $this->load->view('admin/operador/lista', $vista);
    $this->load->view('global_view/foother');

  }
  public function updater_operador(){

    $id = $this->input->post("id");

    $operador = array(
        'nombre' => $this->input->post("nombre"),
        'ap_pat' => $this->input->post("ap_pat"),
        'ap_mat' => $this->input->post("ap_mat"),
        'rfc' => $this->input->post("rfc"),
        'telefono' => $this->input->post("telefono"),
        'colonia' => $this->input->post("colonia"),
        'domicilio' => $this->input->post("domicilio"),
        'cruzamientos' => $this->input->post("cruzamientos"),
        'fecha_nacimiento' => $this->input->post("fecha_nacimiento"),
    );

    $query = $this->Operador_model->save_edit_operador($id, $operador);

    if ($query == 1) {
        $result['resultado'] = true;
    } else {
        $result['resultado'] = false;
    }

    echo json_encode($result);

  }
  public function habilitar_operador(){

    $id = $this->input->post('id');
    $query = $this->Operador_model->habilitarOperador($id);

    if ($query == 1) {
        $result['resultado'] = true;
    } else {
        $result['resultado'] = false;
    }
    echo json_encode($result);

  }
  public function deshabilitar_operador(){

    $id = $this->input->post('id');
    $query = $this->Operador_model->deshabilitarOperador($id);

    if ($query == 1) {
        $result['resultado'] = true;
    } else {
        $result['resultado'] = false;
    }
    echo json_encode($result);

  }

}

/* End of file Operador_ctrl.php */
/* Location: ./application/controllers/Operador_ctrl.php */
