<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\UsuariModel;
  
class Login extends BaseController
{
    public function index()
    {
        helper(['form']);
        $session = session();
        if ($session->has('codiU')) {
            return redirect()->to('/dashboard');
        }
        return view('pages/home');
    } 

    public function __construct(){
		helper(['form', 'url', 'html']);
		$this->db = db_connect();
		$db = \Config\Database::connect();
	}
  
    public function auth()
    {
        $session = session();
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
            $model = new UsuariModel();
            $codiU = $this->request->getVar('codiU');
            $password = $this->request->getVar('password');
            $data = $model->where('codiU', $codiU)->first();
            if($data){
                $pass = $data['password'];
                if($pass == $password){
                    $ses_data = [
                        'codiU'       => $data['codiU'],
                        'correu'     => $data['correu'],
                        'telefon'    => $data['telefon'],
                        'logged_in'     => TRUE
                    ];
                    $session->set($ses_data);
                    return redirect()->to('/dashboard');
                }else{
                    $session->setFlashdata('msg', 'Contraseña erronea.');
                    return redirect()->to('/');
                }
            }else{
                $session->setFlashdata('msg', 'No existe el usuario.');
                return redirect()->to('/');
            }
        }
        else {
            $dades["validation"]=$this->validator;
    		return view('pages/home',$dades);
        }
        
        
    }
  
    public function logout()
    {
        $session = session();
        $session->destroy();
        return view('pages/home');
    }
}