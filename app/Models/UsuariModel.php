<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariModel extends Model
{
    protected $table = 'usuaris';
    protected $primaryKey = 'correu';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $allowedFields = [
        "codiU",
        "correu",
        "password",
        "telefon",
    ];
    protected $skipValidation = false;    
}

?>