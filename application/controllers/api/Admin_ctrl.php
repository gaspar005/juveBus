<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: content-type, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');

require APPPATH . "/libraries/REST_Controller.php";

class Admin_ctrl extends REST_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('web/Estudiante_model', 'Estudiante_model');
		$this->load->model("api/Admin_model","Admin_model");
		$this->load->model('web/Saldos_model', 'saldos_model');
	}
	
	public function getDataUser_get($codJoven){
		$userData = $this->Admin_model->getUserData($codJoven);

		if (!is_null($userData)) {
			$this->response(array("response"=>$userData),200);
		}else{
			$this->response(array('error' => "Ha ocurrido un error al recargar saldo del usuario con código joven: ".$codJoven),404);
		}
	}
	public function altaSaldo_post(){
		
		$postdata = file_get_contents("php://input");
		//Obtener la fecha y hora actual
		$currentDateTime = $this->_getCurrentDateTime();
		$fecha = $currentDateTime['date'];
		$hora  = $currentDateTime['time'];
		$created = $currentDateTime['created'];
		//-------------------------------------
		if (isset($postdata)) {
			$request = json_decode($postdata);
			$idUsuario = $request->idUsuario;
			$idUserSistem = $request->idUserSistem;
			$importe = $request->importe;
		}else{
			var_dump("error");
		}
		// $idUsuario = $this->input->post('idUsuario');
		// $idUserSistem = $this->input->post('idUserSistem');
		// $importe = $this->input->post('importe');
		$ultimoValor = $this->saldos_model->get_ultimo_elemento();

		$dataRecargas = array(	'id_usuario' => $idUsuario,
								'id_user_sistem' => $idUserSistem,
								'importe'=>$importe,
								'fecha' => $fecha,
								'hora' => $hora,
								'folio' => $ultimoValor,
								'fecha_creacion' => $created);

		$query = $this->Admin_model->altaSaldo($idUsuario,$importe,$dataRecargas,$currentDateTime);
		$sendEmail = $this->crear_pdf_and_envio_correo($idUsuario,$importe,$idUserSistem);
		
		if ($query == true && $sendEmail == true) {
		   $result = true;
	   } else {
		   $result = false;
	   }
		$this->response(array("response"=>$result),200);

	}

	private function crear_pdf_and_envio_correo($id_usuario, $importe,$idUserSistem){
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
	   $datosAdmin = $this->Estudiante_model->getAdminData($idUserSistem);
	   /**************************************** Hoja de estilos ****************************************************/
	   $stylesheet = file_get_contents('assets/css/bootstrap.min.css');
	   $mpdf->WriteHTML($stylesheet, 1);
	   /******************************************** head pdf ******************************************************/
	   $data['datosEstudiante'] = $datosActuales;
	   $data['adminData']       = $datosAdmin;
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
	    $mpdf->WriteHTML($html);
		ob_clean();
		$content = $mpdf->Output('','S');

	   //**********************************************************************************
	   //    FIN   PDF
	   //**********************************************************************************
		$this->load->library('my_phpmailer');
		$mail = new PHPMailer;
		try {

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

	public function getSomeOperatorData_get(){
		$query = $this->Admin_model->getSomeOperatorData();

		if (!is_null($query)) {
			$this->response(array('response' => $query),200);
		}else{
			$this->response(array('response' => 'No hay datos'),404);
		}
	}

	public function realizarCorte_get($fecha)
	{
		$query = $this->Admin_model->cortePagoOperador($fecha);

		if (!is_null($query)) {
			$query = array('success' => true, );
			$this->response(array('response' => $query),200);
		}else{
			$query = array('success' => false, );
			$this->response(array('response' => $query),200);
		}
	}

	private function _getCurrentDateTime(){
		$date = mdate('%Y-%m-%d', time());
		$time = mdate('%H:%i:%s', time());
		$created = $date." ".$time;
		return array('date' => $date,
					 'time' => $time,
					 'created' => $created);
	}


}

/* End of file Admin_ctrl.php */
/* Location: ./application/controllers/Admin_ctrl.php */