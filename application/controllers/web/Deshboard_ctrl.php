<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deshboard_ctrl extends CI_Controller {

	public function __construct(){
        parent::__construct();      
        $this->load->library('bcrypt');
        $this->load->model('web/Dashboard_model', 'Dashboard_model');
    }

	public function dashboard_admin()
	{  
        $dato['active'] = "dashboard";  
        $dato['ruta1'] = "Dashboard";
        $dato['ruta'] = "PANEL DE CONTROL ADMINISTRADOR";

		$this->load->view('global_view/header', $dato);
        $this->load->view('admin/dashboard/index');
        $this->load->view('global_view/foother');
	}
	public function get_estadisticas_general_dashboard(){
		$query = $this->Dashboard_model->get_estadisticas();
		echo json_encode($query);
	}
	public function get_estadisticas_operador_dia(){
		$query = $this->Dashboard_model->get_estadisticas_operador_dia();
		echo json_encode($query);
	}
	public function pdf_por_corte_dia(){

//		header('Content-type: application/pdf');
		$id_operador = $_GET["id"];
		ob_start();
		//**********************************************************************************
		//       PDF
		//**********************************************************************************

		$this->load->library('m_pdf');
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'margin_top' => 36,
		]);

		/**************************************** Hoja de estilos ****************************************************/
		$stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));

        $mpdf->WriteHTML($stylesheet, 1);
		/******************************************** head pdf ******************************************************/
		$data['datosOperador'] = $this->Dashboard_model->get_operador_header_pdf($id_operador);
        $head              		= $this->load->view('admin/dashboard/pdf/head', $data, true);
        $mpdf->SetHTMLHeader($head);
// /***************************************** contenido pdf ****************************************************/
		$data2['datosCorte'] = $this->Dashboard_model->get_operador_contenido_pdf($id_operador);
        $data2['body'] = $stylesheet;
        $html = $this->load->view('admin/dashboard/pdf/contenido', $data2, true); //calcular el monto total del saldo insertado
//**************************************** footer 1 ********************************************************
		$data3['pie_pagina'] = "";
        $footer = $this->load->view('admin/dashboard/pdf/footer', $data3, true);
        $mpdf->SetHTMLFooter($footer);
		/****************************************** imprmir pagina ********************************************************/

		$mpdf->WriteHTML($html);
        ob_clean();
        $mpdf->Output();
	}
	public function send_email_day_operador(){

		$id_operador = $_POST["id_operador"];
		$query = $this->create_pdf_and_send_email($id_operador);

		if ($query == true) {
			echo true;
		} else {
			echo false;
		}

	}
	public function create_pdf_and_send_email($id_operador){

		ob_start();
		$this->load->library('m_pdf');
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'margin_top' => 36,
		]);

		$datosActuales = $this->Dashboard_model->get_operador_contenido_pdf($id_operador);

		/**************************************** Hoja de estilos ****************************************************/
		$stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));

		$mpdf->WriteHTML($stylesheet, 1);
		/******************************************** head pdf ******************************************************/
		$data['datosOperador'] = $this->Dashboard_model->get_operador_header_pdf($id_operador);
		$head              		= $this->load->view('admin/dashboard/pdf/head', $data, true);
		$mpdf->SetHTMLHeader($head);
// /***************************************** contenido pdf ****************************************************/
		$data2['datosCorte'] = $this->Dashboard_model->get_operador_contenido_pdf($id_operador);
		$data2['body'] = $stylesheet;
		$html = $this->load->view('admin/dashboard/pdf/contenido', $data2, true); //calcular el monto total del saldo insertado
//**************************************** footer 1 ********************************************************
		$data3['pie_pagina'] = "";
		$footer = $this->load->view('admin/dashboard/pdf/footer', $data3, true);
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
			$textArea      = "Hola ".$datosActuales[0]->nombre.$textDescription;
			$email_estudiante   = $datosActuales[0]->correo;

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
}
