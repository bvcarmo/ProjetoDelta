<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$alunoModel = new \App\Models\AlunoModel();
		$data['titulo'] = "Alunos";
		$data['alunos'] = $alunoModel->find();
		$data['msg'] = $this->session->getFlashdata('mensagem');
		$data['status'] = $this->session->getFlashdata('status');

		return view('alunos',$data);
	}
}
