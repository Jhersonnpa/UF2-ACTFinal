<?php namespace App\Controllers;
  
use CodeIgniter\Controller;
use App\Models\FitxerModel;
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
            $data = $model->where('codiU', $session->codiU)
            ->findAll();
            if ($data) {
                $dades = ["data" => $data];
                return view('app/index',$dades); 
            }
            else {
                return view('app/index'); 
            }
        }        
    }

    public function upload()
    {
        $session = session();
        $con=mysqli_connect('localhost','root','','uf2_afinal');
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
            $dades = ['errors' => $this->validator->getErrors()];

            return view('app/index', $dades);
        }

        $img = $this->request->getFile('file');
        
        $imgData = file_get_contents($_FILES['file']['tmp_name']);
        $imgData= mysqli_real_escape_string($con, $imgData);

        $sql="insert into fitxers (nomF, tipusF, data, contingut, nomRandom, codiU) values ('".$img->getName()."','".$img->getClientMimeType()."','".date("Y/m/d")."','".$imgData."', '','".$session->codiU."')";

        mysqli_query($con, $sql);
        if(mysqli_error($con)){
            $dades = ['errors' => 'El archivo ya se ha movido.'];

            return view('app/index', $dades);
        }
        else {
            // $img->move(WRITEPATH . 'uploads');
            $dades = [
                'nomF' => $img->getName(),
                'tipusF' => $img->getClientMimeType(),
                'data' => date("Y/m/d"),
                'contingut' => $imgData,
                'nomRandom' => '',
                'codiU' => $session->codiU,
            ];
            // $model = new FitxerModel();
            // $model->save($dades);
            return view('app/succes', $dades);
        }
        mysqli_close($con);
    }
}