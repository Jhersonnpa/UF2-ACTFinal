<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\FitxerModel;
use App\Models\CompartirFitxer;
use CodeIgniter\Files\File;
  
class Dashboard extends BaseController
{
    public function __construct(){
		helper(['form', 'url', 'html']);
		$this->db = db_connect();
		$db = \Config\Database::connect();
	}
    
    public function index()
    {
        $session = session();
        if ($session->logged_in == false) {
            $session->set('msg', 'No te has logueado');
            return redirect()->to('/');
        }
        else {
            $model = new FitxerModel();
            $compartir = new CompartirFitxer();
            $data = $model->where('codiU', $session->codiU)
            ->findAll();
            $dataCompartir = $compartir->where('codiUC', $session->codiU)
            ->findAll();
            if ($data) {
                if ($dataCompartir) {
                    $dades = ["data" => $data, "dataCompartir" => $dataCompartir];
                    return view('app/index',$dades);
                }
                else {
                    $dades = ["data" => $data];
                    return view('app/index',$dades);
                }
                 
            }
            else {
                return view('app/index'); 
            }
        }        
    }

    public function upload()
    {
        $session = session();
        // $con=mysqli_connect('localhost','root','','gndaw2022');
    	$regles = [
			'file' => [
                'rules' => 'uploaded[file]'
                    . '|is_image[file]'
                    . '|mime_in[file,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                    . '|max_size[file,100]'
                    . '|max_dims[file,1024,768]',
            ],
		];

		$missatges = [
			"file" => [
				"required" => "Ningún archivo seleccionado",
				],
		];

        if (! $this->validate($regles)) {
            $dades['validation'] = $this->validator;

            return view('app/index', $dades);
        }

        $img = $this->request->getFile('file');
        
        $imgData = file_get_contents($_FILES['file']['tmp_name']);
        if (! $img->hasMoved()) {
            $img->move(WRITEPATH . 'uploads');

            
            $dades = [
                'nomF' => $img->getName(),
                'tipusF' => $img->getClientMimeType(),
                'data' => date("Y/m/d"),
                'contingut' => $imgData,
                'nomRandom' => '',
                'codiU' => $session->codiU,
            ];
            $model = new FitxerModel();
            $model->save($dades);
            // unlink(WRITEPATH . 'uploads/'.$dades['nomF']);
            return view('app/succes', $dades);
        } else {
            $dades = ['errors' => 'El archivo ya se ha movido.'];
            
            return view('app/index', $dades);
        }
        // mysqli_close($con);
    }

    public function compartir()
    {
        $session = session();

        $dades = [
            'codiF'    => $this->request->getVar('compartirF'),
			'codiUC'     => $this->request->getVar('compartirU'),
		];

        $model = new CompartirFitxer();
        $model->insert($dades);
        $session->setFlashdata('msg', 'Archivo compartido');
        return redirect()->to('/');
    }
}