<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo_ctrl extends CI_Controller {

	public function __construct(){
        parent::__construct();   
        $this->load->model('web/Saldos_model', 'saldos_model');
		$this->load->model('web/Estudiante_model', 'Estudiante_model');
		//$this->load->model("Admin_model");
		$this->load->helper('date');
		$this->load->helper('url');
    }

	public function saldo(){

		$dato['ruta1'] = "Recarga Saldo";
		$dato['ruta'] = "Modulo Saldo / Recarga Estudiante";
		$dato['active'] = "saldos"; 
		$dato['active1'] = "recarga";

		$this->load->view('global_view/header', $dato);
        $this->load->view('admin/saldos/recarga');
        $this->load->view('global_view/foother');

	}

	public function mostrar(){

      $nombre = $this->input->post("nombre");
      $ap_pat = $this->input->post("paterno");
      $ap_mat = $this->input->post("materno");
      $numeropagina = $this->input->post("nropagina");
      $cantidad = $this->input->post("cantidad");
 
      $inicio = ($numeropagina -1)*$cantidad;
      $data = array(

        "estudiante" => $this->saldos_model->buscar(1, $nombre, $ap_pat, $ap_mat, $inicio, $cantidad),
        "totalregistros" => $this->saldos_model->buscarCantidad(1, $nombre, $ap_pat, $ap_mat),
        "cantidad" =>$cantidad
        
      );

      echo json_encode($data);
   }
	private function getCurrentDateTime(){
		$date = mdate('%Y-%m-%d', time());
		$time = mdate('%H:%i:%s', time());
		$created = $date." ".$time;
		return array('date' => $date,
			'time' => $time,
			'created' => $created);
	}
	public function pdf_por_empleadoExtraordinario(){

		$idUsuario = $_GET["id"];
		$importe = $_GET["saldo"];

		ob_start();
		//**********************************************************************************
		//       PDF
		//**********************************************************************************
//	   require_once 'vendor/autoload.php';
		$this->load->library('m_pdf');
		$mpdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'margin_top' => 36,
		]);

		/*$datosActuales = $this->Estudiante_model->get_estudiante_header_email_pdf($idUsuario);*/

		/**************************************** Hoja de estilos ****************************************************/
		$stylesheet = file_get_contents( base_url('assets/css/bootstrap-real.css'));

		$mpdf->WriteHTML($stylesheet, 1);
		/******************************************** head pdf ******************************************************/
		$data['datosEstudiante'] = $this->Estudiante_model->get_estudiante_header_email_pdf($idUsuario);
		$head              		= $this->load->view('admin/saldos/pdf/head', $data, true);
		$mpdf->SetHTMLHeader($head);
		// /***************************************** contenido pdf ****************************************************/
		$data2['datosActuales_Saldo'] = $this->Estudiante_model->get_estudiante_header_email_pdf($idUsuario);
		$data2['importe']       = $importe;
		$data2['body'] = $stylesheet;
		$html = $this->load->view('admin/saldos/pdf/contenido', $data2, true); //calcular el monto total del saldo insertado
		//**************************************** footer 1 ********************************************************
		$data3['pie_pagina'] = "";
		$footer = $this->load->view('admin/saldos/pdf/footer', $data3, true);
		$mpdf->SetHTMLFooter($footer);
		/****************************************** imprmir pagina ********************************************************/
//		$html = ob_get_contents();

		$mpdf->WriteHTML($html);
		ob_clean();
		$mpdf->Output('Nomina_ordinaria.pdf','I');
		/*var_dump($mpdf->Output('Nomina_ordinaria.pdf'.'I'));die();*/

	}

   public function alta_saldo_estudiante(){

   	   $currentDateTime = $this->getCurrentDateTime();
	   $fecha = $currentDateTime['date'];
	   $hora  = $currentDateTime['time'];
	   $created = $currentDateTime['created'];

	   $ultimoValor = $this->saldos_model->get_ultimo_elemento();

	   $idUsuario = $this->input->post("id");
	   $importe = $this->input->post("saldo");
	   $dataRecargas = array(
	   		'id_usuario' =>    $this->input->post("id"),
		   'id_user_sistem' => $this->session->userdata('id_user_sistem'),
		   'importe'=>         $this->input->post("saldo"),
		   'fecha' => $fecha,
		   'hora' => $hora,
		   'folio' => $ultimoValor,
		   'fecha_creacion' => $created
	   );

	   $query = $this->saldos_model->altaSaldo($idUsuario,$importe,$dataRecargas,$currentDateTime);

	   $query1 = $this->crear_pdf_and_envio_correo($idUsuario, $importe);

	   if ($query == 1 && $query1 == true) {
		   $result['resultado'] = true;
	   } else {
		   $result['resultado'] = false;
	   }
	   echo json_encode($result);
   }
	private function crear_pdf_and_envio_correo($id_usuario, $importe){
	   ob_start();
	   //**********************************************************************************
	   //       PDF
	   //**********************************************************************************

	   $this->load->library('m_pdf');
	   $mpdf = new \Mpdf\Mpdf([
		   'mode' => 'utf-8',
		   'margin_top' => 36,
	   ]);

	   $datosActuales = $this->Estudiante_model->get_estudiante_header_email_pdf($id_usuario);
	   /**************************************** Hoja de estilos ****************************************************/
	   $stylesheet = file_get_contents('assets/css/bootstrap.min.css');
	   $mpdf->WriteHTML($stylesheet, 1);
	   /******************************************** head pdf ******************************************************/
	   $data['datosEstudiante'] = $datosActuales;
	   $head              		= $this->load->view('admin/saldos/pdf/head', $data, true);
	   $mpdf->SetHTMLHeader($head);
	   // /***************************************** contenido pdf ****************************************************/
	   $data2['datosActuales_Saldo'] = $datosActuales;
	   $data2['importe']       = $importe;
	   $html = $this->load->view('admin/saldos/pdf/contenido', $data2, true); //calcular el monto total del saldo insertado
	   //**************************************** footer 1 ********************************************************
	   $data3['pie_pagina'] = "";
	   $footer = $this->load->view('admin/saldos/pdf/footer', $data3, true);
	   $mpdf->SetHTMLFooter($footer);
	   /****************************************** imprmir pagina ********************************************************/
//		$html = ob_get_contents();
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
		   $textDescription =  ", <br> Tu recarga al servicio de JUVEBUS CHETUMAL fue Exitoso.";
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
		   $mail->addStringAttachment($content, 'recargasaldo.pdf', $encoding = 'base64', $type = 'application/octet-stream');
		   $mail->isHTML(true); // Set email format to HTML

		   $mail->Subject = 'LA RECARGA DE SU SALDO SE REALIZÓ CORRECTAMENTE';
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

/* End of file Saldo_web_ctrl.php */
/* Location: ./application/controllers/Saldo_web_ctrl.php */
