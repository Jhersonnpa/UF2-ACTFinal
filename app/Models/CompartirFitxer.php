<?php

namespace App\Models;

use CodeIgniter\Model;

class CompartirFitxer extends Model
{
    protected $table = 'compartir';
    protected $primaryKey = 'codiF';
    protected $returnType = 'array';
    protected $allowedFields = [
        "codiF",
        "codiUC",
    ]; 
}

?>