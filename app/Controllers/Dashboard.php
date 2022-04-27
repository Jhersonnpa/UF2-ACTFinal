<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\FitxerModel;
  
class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->logged_in == false) {
            $session->set('msg', 'No te has logueado');
            return redirect()->to('/');
        }
        else {
            $model = new FitxerModel();
            $data = $model->where('codiU', $session->codiU)
            ->findAll();
            if ($data) {
                $dades = ["data" => $data];
                return view('app/index',$dades); 
            }
            else {
                return view('pages/home'); 
            }
        }        
    }
}