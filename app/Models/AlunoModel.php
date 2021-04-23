<?php

namespace App\Models;

use CodeIgniter\Model;

class AlunoModel extends Model {

	protected $table = 'alunos';
	protected $primaryKey = 'id';
	protected $allowedFields = ['nome','endereco','nomeImagem'];
	protected $returnType = 'object';
}