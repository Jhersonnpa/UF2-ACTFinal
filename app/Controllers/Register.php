<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\UsuariModel;

class Register extends BaseController
{
    public function index()
    {
        //include helper form
        helper(['form']);
        $data = [];
        return view('pages/formulari', $data);
    }

    public function __construct(){
		helper(['form', 'url', 'html']);
		$this->db = db_connect();
		$db = \Config\Database::connect();
	}
  
    public function save()
    {
        $dades = [
			'codiU'     => $this->request->getVar('codiU'),
			'correu'    => $this->request->getVar('correu'),
			'password' 	=> $this->request->getVar('password'),
            'passwordConfirm' => $this->request->getVar('passwordConfirm'),
            'telefon' 	=> $this->request->getVar('telefon'),
			'msg' 		=> "Registro exitoso.",
		];

    	$regles = [
			"codiU" => "required|max_length[10]",
			"correu" => "required|valid_email",
			"password" => "required",
			"passwordConfirm" => "matches[password]",
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
			$model = new UsuariModel();
            $model->save($dades);
            return view('pages/home',$dades);
			
		}
		else {
			$dades['validation'] = $this->validator;
            return view('pages/formulari', $dades);
		}
          
    }
  
}