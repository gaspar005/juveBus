<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');
	//LIBRERÍAS DE JSON WEB TOKENS
	use Firebase\JWT\JWT;
	require __DIR__ . '../../../vendor/autoload.php';
	

	//FUNCIÓN PARA GENERAR UN NUEVO TOKEN
	if ( ! function_exists('createToken'))
	{
		function createToken(){
			//CLAVE DE ENCRIPTACIÓN
			$key = "\izTcwH7BQgejQ\ANh";
			//TIEMPO DE CADUCIDAD DEL TOKEN
			$segundo 	= 60;
			$minuto 	= $segundo;
			$hora		= intval($minuto * 60);
			$dia 		= intval($hora * 24);
			$timeOut 	= intval(($minuto * 60)); 
	    	
	    	$time = time();
			$token = array(
			    "iss" => "http://go-to-school.juventudqroo.com",
			    "aud" => "http://go-to-school.juventudqroo.com",
			    "iat" => $time, //hora (tiempo) en que se genero el token
			    "nbf" => $time + (1), //hora (tiempo) en que el token es valido
			    "exp" => $time + $timeOut //hora (tiempo) en que caduca el token
			);

			/**
			 * IMPORTANT:
			 * You must specify supported algorithms for your application. See
			 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
			 * for a list of spec-compliant algorithms.
			 */
			$jwt = JWT::encode($token, $key);

			return $jwt;
	    }
	}

	//VALIDAR QUE EL TOKEN SEA VALIDO
	if ( ! function_exists('validateToken'))
	{
		function validateToken($jwt){
			//CLAVE DE ENCRIPTACIÓN
			$key = "\izTcwH7BQgejQ\ANh";
			try {
				$decoded = JWT::decode($jwt, $key, array('HS256'));
				return true;
			} catch (Exception $e) {
				return false;
			}
		}
	}

?>