<?php

namespace App\Controllers;

class Bridging extends BaseController
{
    var $vclaim_conf;
    var $aplicares_conf;

    public function __construct()
    {

        parent::__construct();


        $this->vclaim_conf = [
            'cons_id' => '22619',
            'secret_key' => '2qL18A14F5',
            'base_url' => 'https://new-api.bpjs-kesehatan.go.id:8080',
            'service_name' => 'new-vclaim-rest'

        ];

        $this->aplicares_conf = [
            'cons_id' => '22619',
            'secret_key' => '2qL18A14F5',
            'base_url' => 'http://api.bpjs-kesehatan.go.id',
            'service_name' => 'aplicaresws'
        ];
    }


    public function index()
    {
        //use your own bpjs config


        // use Referensi service
        // https://dvlp.bpjs-kesehatan.go.id/VClaim-Katalog/Referensi
        $vclaim_conf = $this->vclaim_conf;
        $referensi = new Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        var_dump($referensi->diagnosa('A00'));

        //use Peserta service
        //https://dvlp.bpjs-kesehatan.go.id/VClaim-Katalog/Peserta

        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Peserta($vclaim_conf);
        var_dump($peserta->getByNoKartu('0000165372401', '2018-09-16'));



        $this->load->view('welcome_message', $peserta);
    }


    public function peserta($nokartu, $tglpelayanan)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Peserta($vclaim_conf);
        //$data=$peserta->getByNoKartu($nokartu,$tglpelayanan);
        $data = $peserta->getByNoKartu($nokartu, $tglpelayanan);

        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";
        //var_dump($data); 

        //var_dump($data['metaData']);
    }

    public function carinik($nokartu, $tglpelayanan)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Peserta($vclaim_conf);
        //$data=$peserta->getByNIK($nokartu,$tglpelayanan);
        $data = $peserta->getByNIK($nokartu, $tglpelayanan);

        echo $data;
    }

    public function referensipoli($keyword)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->poli($keyword);

        echo $data;
    }

    public function procedure($keyword)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->procedure($keyword);

        echo $data;
    }

    public function kelasRawat()
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->kelasRawat();

        echo $data;
    }

    public function ruangrawat()
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->ruangrawat();

        echo $data;
    }

    public function spesialistik()
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->spesialistik();

        echo $data;
    }

    public function carakeluar()
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->carakeluar();

        echo $data;
    }

    public function pascapulang()
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->pascapulang();

        echo $data;
    }

    public function provinsi()
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->propinsi();

        echo $data;
    }

    public function kabupaten($keyword)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->kabupaten($keyword);

        echo $data;
    }

    public function dokter($search)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->dokter($search);

        echo $data;
    }

    public function faskes($kodeFaskes, $jenisFaskes)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->faskes($kodeFaskes, $jenisFaskes);

        echo $data;
    }

    public function dokterDpjp($jnsPelayanan, $tglPelayanan, $spesialis)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->dokterDpjp($jnsPelayanan, $tglPelayanan, $spesialis);

        echo $data;
    }

    public function kecamatan($keyword)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Referensi($vclaim_conf);
        $data = $peserta->kecamatan($keyword);

        echo $data;
    }

    public function rujukanbynomor($searchBy, $keyword)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Rujukan($vclaim_conf);
        //$data=$peserta->getByNIK($nokartu,$tglpelayanan);
        $data = $peserta->cariByNoRujukan($searchBy, $keyword);

        echo $data;
    }

    public function rujukanByKartu($searchBy, $keyword)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Rujukan($vclaim_conf);
        //$data=$peserta->getByNIK($nokartu,$tglpelayanan);
        $data = $peserta->cariByNoKartu($searchBy, $keyword);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }

    public function cariSep($keyword)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);
        $data = $peserta->cariSEP($keyword);

        echo $data;
    }

    public function insertSep($searchBy)
    {

        function encrypt($str)
        {
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) + ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return urlencode(base64_encode($hasil));
        }
        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);


        $datasep = array(
            "request" => array(
                "t_sep" => array(
                    "noKartu" => $searchBy[1],
                    "tglSep" => $searchBy[2],
                    "ppkPelayanan" => $searchBy[3],
                    "jnsPelayanan" => "2",
                    "klsRawat" => $searchBy[5],
                    "noMR" => $searchBy[6],
                    "rujukan" => array(
                        "asalRujukan" => $searchBy[7],
                        "tglRujukan" => $searchBy[8],
                        "noRujukan" => $searchBy[9],
                        "ppkRujukan" => $searchBy[10]
                    ),
                    "catatan" => $searchBy[11],
                    "diagAwal" => $searchBy[12],
                    "poli" => array(
                        "tujuan" => $searchBy[13],
                        "eksekutif" => $searchBy[14]
                    ),
                    "cob" => array(
                        "cob" => $searchBy[15]
                    ),
                    "katarak" => array(
                        "katarak" => $searchBy[16]
                    ),
                    "jaminan" => array(
                        "lakaLantas" => $searchBy[17],
                        "penjamin" => array(
                            "penjamin" => $searchBy[18],
                            "tglKejadian" => $searchBy[19],
                            "keterangan" => $searchBy[20],
                            "suplesi" => array(
                                "suplesi" => $searchBy[21],
                                "noSepSuplesi" => $searchBy[22],
                                "lokasiLaka" => array(
                                    "kdPropinsi" => $searchBy[23],
                                    "kdKabupaten" => $searchBy[24],
                                    "kdKecamatan" => $searchBy[25]
                                )
                            )
                        )
                    ),
                    "skdp" => array(
                        "noSurat" => $searchBy[26],
                        "kodeDPJP" => $searchBy[27]
                    ),
                    "noTelp" => $searchBy[28],
                    "user" => "coba ws"
                )
            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);

        $data = $peserta->insertSEP($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }



    public function updateSep($searchBy)
    {

        function encrypt($str)
        {
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) + ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return urlencode(base64_encode($hasil));
        }
        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);


        $datasep = array(
            "request" => array(
                "t_sep" => array(
                    "noSep" => $searchBy[1],
                    "klsRawat" => $searchBy[2],
                    "noMR" => $searchBy[3],

                    "rujukan" => array(
                        "asalRujukan" => $searchBy[4],
                        "tglRujukan" => $searchBy[5],
                        "noRujukan" => $searchBy[6],
                        "ppkRujukan" => $searchBy[7]
                    ),
                    "catatan" => $searchBy[8],
                    "diagAwal" => $searchBy[9],
                    "poli" => array(
                        "eksekutif" => $searchBy[10],

                    ),
                    "cob" => array(
                        "cob" => $searchBy[11]
                    ),
                    "katarak" => array(
                        "katarak" => $searchBy[12]
                    ),
                    "skdp" => array(
                        "noSurat" => $searchBy[13],
                        "kodeDPJP" => $searchBy[14]
                    ),
                    "jaminan" => array(
                        "lakaLantas" => $searchBy[15],
                        "penjamin" => array(
                            "penjamin" => $searchBy[16],
                            "tglKejadian" => $searchBy[17],
                            "keterangan" => $searchBy[18],
                            "suplesi" => array(
                                "suplesi" => $searchBy[19],
                                "noSepSuplesi" => $searchBy[20],
                                "lokasiLaka" => array(
                                    "kdPropinsi" => $searchBy[21],
                                    "kdKabupaten" => $searchBy[22],
                                    "kdKecamatan" => $searchBy[23]
                                )
                            )
                        )
                    ),

                    "noTelp" => $searchBy[24],
                    "user" => "coba ws"
                )
            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);

        $data = $peserta->updateSEP($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }


    public function deleteSep($searchBy)
    {

        function encrypt($str)
        {
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) + ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return urlencode(base64_encode($hasil));
        }
        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);


        $datasep = array(
            "request" => array(
                "t_sep" => array(
                    "noSep" => $searchBy[1],
                    "user" => "coba ws"
                )
            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);

        $data = $peserta->deleteSEP($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }


    public function delSep($searchBy)
    {

        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);





        $datasep = array(
            "request" => array(
                "t_sep" => array(
                    "noSep" => $searchBy[0],
                    "user" => "coba ws"
                )
            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);

        $data = $peserta->deleteSEP($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }


    public function suplesiJasaRaharja($noKartu, $tglPelayanan)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);
        $data = $peserta->suplesiJasaRaharja($noKartu, $tglPelayanan);

        echo $data;
    }


    public function pengajuanPenjaminanSep($searchBy)
    {

        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);





        $datasep = array(
            "request" => array(
                "t_sep" => array(
                    "noKartu" => $searchBy[1],
                    "tglSep" => $searchBy[2],
                    "jnsPelayanan" => $searchBy[3],
                    "keterangan" => $searchBy[4],
                    "user" => "coba ws"
                )
            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);

        $data = $peserta->pengajuanPenjaminanSep($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }


    public function approvalPenjaminanSep($searchBy)
    {

        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);





        $datasep = array(
            "request" => array(
                "t_sep" => array(
                    "noKartu" => $searchBy[1],
                    "tglSep" => $searchBy[2],
                    "jnsPelayanan" => $searchBy[3],
                    "keterangan" => $searchBy[4],
                    "user" => "coba ws"
                )
            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);

        $data = $peserta->approvalPenjaminanSep($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }


    public function updateTglPlg($searchBy)
    {

        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);





        $datasep = array(
            "request" =>
            array(
                "t_sep" =>
                array(
                    "noSep" => $searchBy[0],
                    "tglPulang" => $searchBy[1],
                    "user" => "coba ws"
                )
            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);

        $data = $peserta->updateTglPlg($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }

    public function updateTglPlg2($searchBy)
    {

        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);





        $datasep = array(
            "request" =>
            array(
                "t_sep" =>
                array(
                    "noSep" => $searchBy[0],
                    "statusPulang" => $searchBy[1],
                    "noSuratMeninggal" => $searchBy[2],
                    "tglMeninggal" => $searchBy[3],
                    "tglPulang" => $searchBy[4],
                    "noLPManual" => $searchBy[5],
                    "user" => "coba ws"
                )
            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);

        $data = $peserta->updateTglPlg2($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }


    public function inacbgSEP($keyword)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Sep($vclaim_conf);
        $data = $peserta->inacbgSEP($keyword);

        echo $data;
    }


    public function insertRujukan($searchBy)
    {

        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);





        $datasep = array(
            "request" => array(
                "t_rujukan" => array(
                    "noSep" => $searchBy[1],
                    "tglRujukan" => $searchBy[2],
                    "ppkDirujuk" => $searchBy[3],
                    "jnsPelayanan" => $searchBy[4],
                    "catatan" => $searchBy[5],
                    "diagRujukan" => $searchBy[6],
                    "tipeRujukan" => $searchBy[7],
                    "poliRujukan" => $searchBy[8],
                    "user" => "coba ws"
                )
            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Rujukan($vclaim_conf);

        $data = $peserta->insertRujukan($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }

    public function updateRujukan($searchBy)
    {

        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);





        $datasep = array(
            "request" => array(
                "t_rujukan" => array(
                    "noRujukan" => $searchBy[1],
                    "ppkDirujuk" => $searchBy[2],
                    "tipe" => $searchBy[7],
                    "jnsPelayanan" => $searchBy[4],
                    "catatan" => $searchBy[5],
                    "diagRujukan" => $searchBy[6],
                    "tipeRujukan" => $searchBy[7],
                    "poliRujukan" => $searchBy[8],
                    "user" => "coba ws"
                )
            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Rujukan($vclaim_conf);

        $data = $peserta->updateRujukan($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }


    public function deleteRujukan($searchBy)
    {

        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);





        $datasep = array(
            "request" => array(
                "t_rujukan" => array(
                    "noRujukan" => $searchBy[1],
                    "user" => "coba ws"
                )
            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Rujukan($vclaim_conf);

        $data = $peserta->deleteRujukan($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }

    //BAGIAN LPK


    public function insertLPK($searchBy)
    {
        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);






        $datasep = array(
            "request" => array(
                "t_lpk" => array(
                    "noSep" => $searchBy[1],
                    "tglMasuk" => $searchBy[2],
                    "tglKeluar" => $searchBy[3],
                    "jaminan" => $searchBy[4],
                    "poli" => array(
                        "poli" => $searchBy[5]
                    ),
                    "perawatan" => array(
                        "ruangRawat" => $searchBy[6],
                        "kelasRawat" => "",
                        "spesialistik" => $searchBy[8],
                        "caraKeluar" => $searchBy[9],
                        "kondisiPulang" => $searchBy[10]
                    ),
                    "diagnosa" => [
                        array(
                            "kode" => $searchBy[11],
                            "level" => $searchBy[12]
                        ),
                        array(
                            "kode" => $searchBy[13],
                            "level" => $searchBy[14]
                        )
                    ],
                    "procedure" => [
                        array(
                            "kode" => $searchBy[15]
                        ),
                        array(
                            "kode" => $searchBy[16]
                        )
                    ],
                    "rencanaTL" => array(
                        "tindakLanjut" => $searchBy[17],
                        "dirujukKe" => array(
                            "kodePPK" => $searchBy[18]
                        ),
                        "kontrolKembali" => array(
                            "tglKontrol" => $searchBy[19],
                            "poli" => $searchBy[20]
                        )
                    ),
                    "DPJP" => $searchBy[21],
                    "user" => $searchBy[22]
                )
            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\LembarPengajuanKlaim($vclaim_conf);

        $data = $peserta->insertLPK($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }

    //end LPK



    //monitoring

    public function dataKunjungan($tglSep, $jnsPelayanan)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Monitoring($vclaim_conf);
        $data = $peserta->dataKunjungan($tglSep, $jnsPelayanan);

        echo $data;
    }


    public function dataKlaim($tglPulang, $jnsPelayanan, $statusKlaim)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Monitoring($vclaim_conf);
        $data = $peserta->dataKlaim($tglPulang, $jnsPelayanan, $statusKlaim);

        echo $data;
    }

    public function historyPelayanan($noKartu, $tglAwal, $tglAkhir)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Monitoring($vclaim_conf);
        $data = $peserta->historyPelayanan($noKartu, $tglAwal, $tglAkhir);

        echo $data;
    }

    public function dataKlaimJasaRaharja($tglMulai, $tglAkhir)
    {

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Monitoring($vclaim_conf);
        $data = $peserta->dataKlaimJasaRaharja($tglMulai, $tglAkhir);

        echo $data;
    }


    // KETERSEDIAAN TEMPAT TIDUR

    public function refKelas()
    {

        $aplicares_conf = $this->aplicares_conf;
        $peserta = new Nsulistiyawan\Bpjs\Aplicare\KetersediaanKamar($aplicares_conf);
        $data = $peserta->refKelas();

        echo $data;
    }

    public function insertSpri($searchBy)
    {

        function decrypt($str)
        {
            $str = base64_decode(urldecode($str));
            $hasil = '';
            $kunci = '979a218e0632df2935317f98d47956c7';
            for ($i = 0; $i < strlen($str); $i++) {
                $karakter = substr($str, $i, 1);
                $kuncikarakter = substr($kunci, ($i % strlen($kunci)) - 1, 1);
                $karakter = chr(ord($karakter) - ord($kuncikarakter));
                $hasil .= $karakter;
            }
            return $hasil;
        }

        $searchBy = decrypt($searchBy);
        $searchBy = explode("|", $searchBy);

        $datasep = array(
            "request" => array(

                "noKartu" => $searchBy[1],
                "kodeDokter" => $searchBy[2],
                "poliKontrol" => $searchBy[3],
                "tglRencanaKontrol" => $searchBy[4],
                "user" => "coba ws"

            )
        );

        //var_dump($searchBy);

        $vclaim_conf = $this->vclaim_conf;
        $peserta = new \Nsulistiyawan\Bpjs\VClaim\Rujukan($vclaim_conf);

        $data = $peserta->insertSpri($datasep);
        //$isi=json_decode($data, true);
        echo $data;
        //echo "<pre>";
        //print_r($isi); 
        //echo "</pre>";

    }
}
