<?php

namespace App\Controllers;

use App\Models\UsuariModel;

class Home extends BaseController
{
    public function __construct(){
		helper(['form', 'url', 'html']);
		$this->db = db_connect();
		$db = \Config\Database::connect();
	}

    public function index()
    {
        return view('pages/home');
    }

	public function register()
	{
		return view('pages/formulari');
	}
    
    public function rebreFormulari()
    {
    	//array con los datos recibidos.
    	$dades=$this->request->getVar();
    	$regles = [
			"codiU" => "required",
			"password" => "required",
		];

		$missatges = [
			"codiU" => [
				"required" => "Codigo de usuario obligatorio*",
				],
			"password" => [
				"required" => "Contraseña obligatoria*",
				],
		];
	
    	if($this->validate($regles,$missatges)){
			$usuario = model(UsuariModel::class);

			$datos = $usuario->validation_login();

			return view('app/index', $datos);

    		// if (!empty($codiUser) && !empty($passwordUser)) {
			// 	return view('app/index',$datos);
			// }
			// else {
			// 	return view('pages/home.php',$datos);
			// }    		
    	}else{
    		$dades["validation"]=$this->validator;
    		return view('pages/home',$dades);  		
    	}
    }

	public function rebreFormRegister() 
	{
		$dades=$this->request->getVar();
    	$regles = [
			"codiU" => "required|max_length[10]",
			"correu" => "required|valid_email",
			"password" => "required",
			"passwordConfirm" => "required|matches[password]",
			"telefon" => "required|min_length[9]|max_length[9]",
			
		];

		$missatges = [
			"codiU" => [
				"required" => "Codigo usuario obligatorio",
				"max_length" => "Máximo 10 cáracteres",
			],
			"correu" => [
				"required" => "Correo obligatorio",
				"valid_email" => "Correo invalido",
				],
			"password" => [
				"required" => "Contraseña obligatoria",
				],
			"passwordConfirm" => [
				"required" => "Confirmar la contraseña obligatoria",
				"matches" => "Las contraseñas no coinciden",
				],
			"telefon" => [
				"required" => "Telefono obligatorio",
				"min_length" => "Formato invalido del telefono",
				"max_length" => "Formato invalido del telefono",
			],
		];

		if($this->validate($regles,$missatges)){
			$usuario = model(UsuariModel::class);
			$dades['password']=hash('md5',$dades['password']);
			$usuario->save($dades);
			$files=$this->db->affectedRows();
			if($files==0){
				$dades["validation"]=$this->validator;
				$dades['registro']=false;
    			return view('pages/formulari',$dades);				
			}else{
				//Registro Ok
				$dades['registro']=true;
				return view('pages/home', $dades);
			}
			
		}
		else {
			$dades["validation"]=$this->validator;
    		return view('pages/formulari',$dades);
		}
	}
}
