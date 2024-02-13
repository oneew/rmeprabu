<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Config\Services;
use LZCompressor\LZString as LZString;
use GuzzleHttp\Client;

class Bpjs extends Controller
{

	function vclaim_conf()
	{
		$vclaim_conf = [
			'cons_id' => '1168',
			'secret_key' => '4iK5B08401',
			'base_url' => 'https://apijkn.bpjs-kesehatan.go.id/',
			'service_name' => 'vclaim-rest/'

		];


		return $vclaim_conf;
	}

	public function header()
	{
		//const id
		$data = "1168";
		//secret key
		$secretKey = "4iK5B08401";
		$user_key = "783a9f584e4ec299389c10185b90235b";
		date_default_timezone_set('UTC');
		$tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
		$signature = hash_hmac('sha256', $data . "&" . $tStamp, $secretKey, true);

		$encodedSignature = base64_encode($signature);


		$header = [
			"X-cons-id" => $data,
			"X-timestamp" => $tStamp,
			"X-signature" => $encodedSignature,
			"user_key" => $user_key,
		];
		return $header;
	}




	public function check_cardv1()
	{
		$param = $this->request->getPost();
		$vclaim_conf = $this->vclaim_conf();
		$peserta = new \Nsulistiyawan\Bpjs\VClaim\Peserta($vclaim_conf);
		$data = $peserta->getByNoKartu($param['card'], $param['date']);


		echo json_encode($data);
	}

	public function check_nikcard()
	{
		//base url
		$base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
		//service name
		$service_name = 'vclaim-rest/';

		$client = new Client();
		$header = $this->header();
		//$header['Content-Type'] = "application/json; charset=utf-8";
		$param = $this->request->getPost();
		$noPeserta = $param['card'];
		//$noPeserta = '0000000953559';
		$tglSep = $param['date'];

		$response = $client->request('GET', $base_url . $service_name . 'Peserta/nik/' . $noPeserta . '/' . 'tglSEP/'  . $tglSep, [
			'headers' => $this->header(),
		])->getBody()->getContents();

		$cons_id = $header['X-cons-id'];
		$secretKey = "4iK5B08401";
		$tStamp = $header['X-timestamp'];

		$key = $cons_id . $secretKey . $tStamp;
		$string = json_decode($response, true);
		$keluaran = $this->stringDecrypt($key, $string['response']);
		$datakeluaran = json_decode($keluaran, true);


		$data = [
			"metaData" => $string["metaData"],
			"response" => $datakeluaran,
		];

		echo json_encode($data);
	}

	public function check_card()
	{
		//base url
		$base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
		//service name
		$service_name = 'vclaim-rest/';

		$client = new Client();
		$header = $this->header();
		//$header['Content-Type'] = "application/json; charset=utf-8";
		$param = $this->request->getPost();
		$noPeserta = $param['card'];
		//$noPeserta = '0000000953559';
		$tglSep = $param['date'];

		$response = $client->request('GET', $base_url . $service_name . 'Peserta/nokartu/' . $noPeserta . '/' . 'tglSEP/'  . $tglSep, [
			'headers' => $this->header(),
		])->getBody()->getContents();
		//penambahan pencarian NIK


		$cons_id = $header['X-cons-id'];
		$secretKey = "4iK5B08401";
		$tStamp = $header['X-timestamp'];

		$key = $cons_id . $secretKey . $tStamp;
		$string = json_decode($response, true);
		$keluaran = $this->stringDecrypt($key, $string['response']);
		$datakeluaran = json_decode($keluaran, true);


		$data = [
			"metaData" => $string["metaData"],
			"response" => $datakeluaran,
		];

		echo json_encode($data);
	}

	public function check_fingerprint()
	{
		$base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
		$service_name = 'vclaim-rest/';

		$client = new Client();
		$header = $this->header();
		//$header['Content-Type'] = "application/json; charset=utf-8";
		$search = $this->request->getPost();
		$dateout = explode('-', $search['tglpelayanan']);
		$mulai = str_replace('/', '-', $dateout[0]);
		$sampai = str_replace('/', '-', $dateout[1]);

		//$tglawal = date('Y-m-d', strtotime($mulai));
		$tglawal = date('Y-m-d');
		$param = $this->request->getPost();
		$filter = $param['card'];

		$response = $client->request('GET', $base_url .  $service_name . 'SEP/FingerPrint/Peserta/' . $filter . '/' . 'TglPelayanan/' . $tglawal, [
			'headers' => $this->header(),
		])->getBody()->getContents();

		$cons_id = $header['X-cons-id'];
		$secretKey = "4iK5B08401";
		$tStamp = $header['X-timestamp'];

		$key = $cons_id . $secretKey . $tStamp;
		$string = json_decode($response, true);
		$keluaran = $this->stringDecrypt($key, $string['response']);
		$datakeluaran = json_decode($keluaran, true);

		$data = [
			"metaData" => $string["metaData"],
			"response" => $datakeluaran,
		];
		echo json_encode($data);
	}

	public function check_nikV1()
	{
		$param = $this->request->getPost();
		$vclaim_conf = $this->vclaim_conf();
		$peserta = new \Nsulistiyawan\Bpjs\VClaim\Peserta($vclaim_conf);
		$data = $peserta->getByNIK($param['nik'], $param['date']);

		echo json_encode($data);
	}


	public function check_rujukan_kartuV1()
	{

		$searchBy = $this->request->getVar('searchBy');
		$param = $this->request->getPost();
		$vclaim_conf = $this->vclaim_conf();
		$peserta = new \Nsulistiyawan\Bpjs\VClaim\Rujukan($vclaim_conf);
		$data = $peserta->cariByNoKartu($searchBy, $param['card']);
		echo json_encode($data);
	}

	public function check_rujukan_kartu()
	{
		//base url
		$base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
		//service name
		$service_name = 'vclaim-rest/';

		$client = new Client();
		$header = $this->header();
		//$header['Content-Type'] = "application/json; charset=utf-8";

		$searchBy = $this->request->getVar('searchBy');
		$card = $this->request->getVar('card');

		if ($searchBy == 'RS') {
			$response = $client->request('GET', $base_url . $service_name . 'Rujukan/RS/Peserta/' . $card, [
				'headers' => $this->header(),
			])->getBody()->getContents();
		} else {
			$response = $client->request('GET', $base_url . $service_name . 'Rujukan/Peserta/' . $card, [
				'headers' => $this->header(),
			])->getBody()->getContents();
		}

		$cons_id = $header['X-cons-id'];
		$secretKey = "4iK5B08401";
		$tStamp = $header['X-timestamp'];

		$key = $cons_id . $secretKey . $tStamp;
		$string = json_decode($response, true);
		$keluaran = $this->stringDecrypt($key, $string['response']);
		$datakeluaran = json_decode($keluaran, true);


		$data = [
			"metaData" => $string["metaData"],
			"response" => $datakeluaran,
		];

		echo json_encode($data);
	}

	public function check_rujukan_kartuV2()
	{
		//base url
		$base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
		//service name
		$service_name = 'vclaim-rest/';

		$client = new Client();
		$header = $this->header();
		//$header['Content-Type'] = "application/json; charset=utf-8";

		$searchBy = $this->request->getVar('searchBy');
		$card = $this->request->getVar('card');

		if ($searchBy == 'RS') {
			$response = $client->request('GET', $base_url . $service_name . 'Rujukan/RS/Peserta/' . $card, [
				'headers' => $this->header(),
			])->getBody()->getContents();
		} else {
			$response = $client->request('GET', $base_url . $service_name . 'Rujukan/Peserta/' . $card, [
				'headers' => $this->header(),
			])->getBody()->getContents();
		}

		$cons_id = $header['X-cons-id'];
		$secretKey = "4iK5B08401";
		$tStamp = $header['X-timestamp'];

		$key = $cons_id . $secretKey . $tStamp;
		$string = json_decode($response, true);
		$keluaran = $this->stringDecrypt($key, $string['response']);
		$datakeluaran = json_decode($keluaran, true);


		$data = [
			"metaData" => $string["metaData"],
			"response" => $datakeluaran,
		];

		echo json_encode($data);
	}

	public function check_rujukan_kartu2()
	{
		$searchBy = 'RS';
		$param = $this->request->getPost();
		$vclaim_conf = $this->vclaim_conf();
		$peserta = new \Nsulistiyawan\Bpjs\VClaim\Rujukan($vclaim_conf);
		$data = $peserta->cariByNoKartu($searchBy, $param['card']);

		echo json_encode($data);
	}

	public function check_rujukan_kartu_noRujukan()
	{
		$searchBy = 'RS';
		$noRujukan = '101005010921P000472';
		$param = $this->request->getPost();
		$vclaim_conf = $this->vclaim_conf();
		$peserta = new \Nsulistiyawan\Bpjs\VClaim\Rujukan($vclaim_conf);
		$data = $peserta->cariByNoRujukan($searchBy, $noRujukan);
		echo json_encode($data);
	}

	public function check_card_baru()
	{
		$param = $this->request->getPost();
		$vclaim_conf = $this->vclaim_conf();
		$peserta = new \Nsulistiyawan\Bpjs\VClaim\Peserta($vclaim_conf);
		$data = $peserta->getByNoKartu($param['card'], $param['date']);

		echo json_encode($data);
	}


	public function stringDecrypt($key, $string)
	{

		$encrypt_method = 'AES-256-CBC';
		$key_hash = hex2bin(hash('sha256', $key));
		$iv = substr(hex2bin(hash('sha256', $key)), 0, 16);
		$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);
		return \LZCompressor\LZString::decompressFromEncodedURIComponent($output);

		return $output;
	}

	public function check_nik()
	{
		//base url
		$base_url = 'https://apijkn.bpjs-kesehatan.go.id/';
		//service name
		$service_name = 'vclaim-rest/';

		$client = new Client();
		$header = $this->header();
		//$header['Content-Type'] = "application/json; charset=utf-8";
		$param = $this->request->getPost();
		$nik = $param['nik'];
		//$noPeserta = '0000000953559';
		$tglSep = $param['date'];
		$response = $client->request('GET', $base_url . $service_name . 'Peserta/nik/' . $nik . '/' . 'tglSEP/'  . $tglSep, [
			'headers' => $this->header(),
		])->getBody()->getContents();

		$cons_id = $header['X-cons-id'];
		$secretKey = "4iK5B08401";
		$tStamp = $header['X-timestamp'];

		$key = $cons_id . $secretKey . $tStamp;
		$string = json_decode($response, true);
		$keluaran = $this->stringDecrypt($key, $string['response']);
		$datakeluaran = json_decode($keluaran, true);


		$data = [
			"metaData" => $string["metaData"],
			"response" => $datakeluaran,
		];

		echo json_encode($data);
	}
}
