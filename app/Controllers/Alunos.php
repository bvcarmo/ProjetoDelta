<?php

namespace App\Controllers;

class Alunos extends BaseController
{

	protected $helpers = ['url'];

	public function index()
	{
		$alunoModel = new \App\Models\AlunoModel();
		$data['titulo'] = "Alunos";
		$data['alunos'] = $alunoModel->find();
		$data['msg'] = $this->session->getFlashdata('mensagem');
		$data['status'] = $this->session->getFlashdata('status');

		return view('alunos',$data);

	}

	public function inserir()
	{

		$alunoModel = new \App\Models\AlunoModel();

		$data['titulo'] = "Inserir novo aluno";
		$data['acao'] = "Inserir";
		$data['msg'] = "";
		$data['status'] = "";

		if($this->request->getMethod() === 'post'){

			$file = $this->request->getFile('imagem');
			
			if($file->getName() == ""){

				$data['msg'] = "Foto é um campo obrigatório.";
				$data['status'] = "500";
				return view('alunos_form',$data);

			}

			$imagemNome = $file->getRandomName();
			
			$alunoModel->set('nome',$this->request->getPost('nome'));
			$alunoModel->set('endereco',$this->request->getPost('endereco'));
			$alunoModel->set('nomeImagem',$imagemNome);

			if($alunoModel->insert()){
				
				if($file->isValid() && !$file->hasMoved()){

					$file->move('uploads/',$imagemNome);

				}

				$this->session->setFlashdata('status', '200');
				$this->session->setFlashdata('mensagem', 'Aluno inserido com sucesso!!');
				return redirect()->to(base_url('alunos/'));
			}
			else{
				$data['msg'] = "Erro ao inserir aluno.";
				$data['status'] = "500";
			}

		}

		return view('alunos_form',$data);

	}

	public function editar($id = null){

		if(is_null($id)){

			$this->session->setFlashdata('status', '500');
			$this->session->setFlashdata('mensagem', 'Rota inválida.');
			return redirect()->to(base_url('alunos/'));

		}

		$alunoModel = new \App\Models\AlunoModel();

		$data['titulo'] = "Editar aluno";
		$data['acao'] = "Editar";
		$data['msg'] = "";
		$data['status'] = "";

		$aluno = $alunoModel->find($id);

		$data['aluno'] = $aluno;

		if($this->request->getMethod() === 'post'){			

			$file = $this->request->getFile('imagem');

			$imagemNome = $file->getRandomName();
			
			$alunoModel->set('nome',$this->request->getPost('nome'));
			$alunoModel->set('endereco',$this->request->getPost('endereco'));
			$alunoModel->set('nomeImagem',$imagemNome);

			if($alunoModel->update($id,$alunoModel)){
				
				if($file->isValid() && !$file->hasMoved()){

					$file->move('uploads/',$imagemNome);

				}
				
				$this->session->setFlashdata('status', '200');
				$this->session->setFlashdata('mensagem', 'Aluno atualizado com sucesso!!');
				return redirect()->to(base_url('alunos/'));
			
			}
			else{
				$data['msg'] = "Erro ao atualizar aluno.";
				$data['status'] = "500";

			}

		}

		return view('alunos_form',$data);

	}

	public function excluir($id = null){

		if(is_null($id)){
			
			$this->session->setFlashdata('status', '500');
			$this->session->setFlashdata('mensagem', 'Rota inválida.');
			return redirect()->to(base_url('alunos/'));

		}

		$alunoModel = new \App\Models\AlunoModel();
		$aluno = $alunoModel->find($id);
		$nomeImagem = $aluno->nomeImagem;

		if($alunoModel->delete($id)){
			
			if(file_exists("uploads/".$nomeImagem)){
				unlink("uploads/".$nomeImagem);
			}

			$this->session->setFlashdata('status', '200');
			$this->session->setFlashdata('mensagem', 'Usuário excluído com sucesso!');
			
		}
		else{

			$this->session->setFlashdata('status', '500');
			$this->session->setFlashdata('mensagem', 'Erro ao excluir aluno');

		}

		return redirect()->to(base_url('alunos/'));

	}
}

