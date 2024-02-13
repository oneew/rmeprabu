<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Modeledukasibedah;
use Config\Services;

class Book_operasi extends Controller
{
	public function index()
	{
		$book= new Modeledukasibedah();
    	$data['list']=$book->get_list_book();
    	echo view('book_operasi/index',$data);
	}

	public function ajax_switch()
	{
		$request = Services::request();
		$book= new Modeledukasibedah();
		$post=$request->getPost();
		$book->edit_book($post);
		//$data['list']=$book->get_list_book();
    	//var_dump($post);
	}
}