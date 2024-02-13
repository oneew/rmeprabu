<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Model_signature;
use Config\Services;

class Signature extends Controller
{
	public function index()
	{
		$m_sign = new Model_signature();
		$data['list'] = $m_sign->get_list();
		echo view('signature/index', $data);
	}

	public function insert_sign()
	{
		$sign = $this->request->getPost('signature');
		$m_sign = new Model_signature();
		$m_sign->insert_sign($sign);
		echo '<div class="col-4">
			<img src="' . $sign . '" class="img-fluid">
		</div>';
	}
}
