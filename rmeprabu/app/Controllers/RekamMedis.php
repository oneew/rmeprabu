<?php

namespace App\Controllers;

use App\Models\ModelRawatJalanDaftar;
use App\Models\Modelrajal;
use App\Models\Model_autocomplete;
use App\Models\ModelPasienRanap;
use App\Models\ModelMasterPasien;
use App\Models\ModelUpdatePasien;
use App\Models\ModelDiagnosa;

use Config\Services;
use CodeIgniter\HTTP\Request;
use Dompdf\Dompdf;




class RekamMedis extends BaseController
{

    public function index()
    {
        $data = [
            'list' => $this->data_payment(),
        ];
        return view('rawatjalan/registerrajal', $data);
    }

    public function ambildata()
    {
        if ($this->request->isAJAX()) {

            $register = new ModelRawatJalanDaftar();
            $data = [
                'tampildata' => $register->ambildatarajal()
            ];
            $msg = [
                'data' => view('rawatjalan/dataregisterrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }


    public function caridataregisterpoli()
    {
        if ($this->request->isAJAX()) {

            $search = $this->request->getPost();
            $dateout = explode('-', $search['DateOut']);
            $search['mulai'] = date('Y-m-d', strtotime($dateout[0]));
            $search['sampai'] = date('Y-m-d', strtotime($dateout[1]));

            $register = new ModelRawatJalanDaftar();
            $data = [
                'tampildata' => $register->search_RegisterRajal($search)
            ];

            $msg = [
                'data' => view('rawatjalan/dataregisterrajal', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }








    public function data_payment()
    {

        $m_auto = new ModelRawatJalanDaftar();
        $list = $m_auto->get_list_payment();
        return $list;
    }
    public function smf()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_poli();
        return $list;
    }
    public function pelayanan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pelayanan();
        return $list;
    }

    public function sebabsakit()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_sebab_sakit();
        return $list;
    }

    private function _data_dokter()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $list = $m_auto->get_list_dokter();
        return $list;
    }

    public function ajax_diagnosa()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $key = $request->getGet('term');
        $data = $m_auto->get_list_diagnosa($key);
        foreach ($data as $row) {

            $json[] = [
                'value' => $row['originalcode'] . ' | ' . $row['name'],
                'id' => $row['id'],
                'code' => $row['code'],
                'subname' => $row['subname'],
                'name' => $row['name']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }


    public function ajax_faskes()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);

        $key = $request->getGet('term');
        $data = $m_auto->get_list_faskes($key);
        foreach ($data as $row) {

            $json[] = [
                'value' => $row['name'],
                'id' => $row['id'],
                'code' => $row['code']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }


    public function inisial()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_inisial();
        return $list;
    }

    public function agama()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_agama();
        return $list;
    }

    public function statusnikah()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_nikah();
        return $list;
    }

    public function pendidikan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pendidikan();
        return $list;
    }

    public function pekerjaan()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pekerjaan();
        return $list;
    }

    public function ajax_wilayah()
    {
        $request = Services::request();
        $m_auto = new Model_autocomplete($request);
        $key = $request->getGet('term');
        $data = $m_auto->get_list_wilayah($key);
        foreach ($data as $row) {

            $json[] = [
                'value' => $row['NAMA_KEC'] . ' | ' . $row['NAMA_KEL'] . ' | ' . $row['NAMA_KAB'],
                'id' => $row['ID'],
                'kecamatan' => $row['NAMA_KEC'],
                'kelurahan' => $row['NAMA_KEL'],
                'kabupaten' => $row['NAMA_KAB'],
                'propinsi' => $row['NAMA_PROP'],
                'kodewilayah' => $row['code'],
                'namasubarea' => $row['name']
            ];
        }

        if (isset($json)) {
            return json_encode($json);
        }
    }

    public function metodepembayaran()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_metode_pembayaran();
        return $list;
    }
    public function hubunganpjb()
    {

        $m_auto = new Modelrajal();
        $list = $m_auto->get_list_pjb();
        return $list;
    }

    public function detailpasien($id = '')
    {
        $id = $this->request->getVar('id');
        $m_icd = new ModelMasterPasien($this->request);
        $row = $m_icd->get_data_pasien($id);
        $tanggallahir = ($row['dateofbirth']);
        $dob = strtotime($tanggallahir);
        $current_time = time();
        $age_years = date('Y', $current_time) - date('Y', $dob);
        $age_months = date('m', $current_time) - date('m', $dob);
        $age_days = date('d', $current_time) - date('d', $dob);

        if ($age_days < 0) {
            $days_in_month = date('t', $current_time);
            $age_months--;
            $age_days = $days_in_month + $age_days;
        }

        if ($age_months < 0) {
            $age_years--;
            $age_months = 12 + $age_months;
        }

        $umur = $age_years . " tahun " . $age_months . " bulan " . $age_days . " hari";
        $data = [
            'id' => $row['id'],
            'initial' => $row['initial'],
            'pasienname' => $row['name'],
            'pasiengender' => $row['gender'],
            'maritalstatus' => $row['maritalstatus'],
            'religion' => $row['religion'],
            'referencenumber' => $row['code'],
            'pasienid' => $row['code'],
            'oldcode' => $row['oldcode'],
            'pasienname' => $row['name'],
            'bloodtype' => $row['bloodtype'],
            'bloodrhesus' => $row['bloodrhesus'],
            'ssn' => $row['ssn'],
            'placeofbirth' => $row['placeofbirth'],
            'pasiendateofbirth' => $row['dateofbirth'],
            'umur' => $umur,
            'education' => $row['education'],
            'citizenship' => $row['citizenship'],
            'work' => $row['work'],
            'telephone' => $row['telephone'],
            'mobilephone' => $row['mobilephone'],
            'pasienarea' => $row['area'],
            'pasiensubareaname' => $row['subareaname'],
            'pasienaddress' => $row['address'],
            'postalcode' => $row['postalcode'],
            'parentname' => $row['parentname'],
            'couplename' => $row['couplename'],
            'parenttelephone' => $row['parenttelephone'],
            'paymentmethod' => $row['paymentmethodname'],
            'paymentmethodname' => $row['paymentmethodname'],
            'paymentcardnumber' => $row['cardnumber'],
            'registerdate' => $row['registerdate'],
            'district' => $row['district'],
            'rt' => $row['rt'],
            'rw' => $row['rw'],
            'kecamatan' => $row['kecamatan'],
            'kabupaten' => $row['kabupaten'],
            'propinsi' => $row['propinsi'],
            'namaibukandung' => $row['namaibukandung'],
            'datelastin' => $row['datelastin'],
            'list' => $this->_data_dokter(),
        ];

        return view('rekammedik/detail_pasien', $data);
    }

    public function resumeDiagnosa()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelDiagnosa();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'DIAGNOSA' => $resume->search_diagnosa($referencenumber),
            ];
            $msg = [
                'data' => view('rekammedik/data_resume_diagnosa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeRajal()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelDiagnosa();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'POLI' => $resume->search_poli($referencenumber),
            ];
            $msg = [
                'data' => view('rekammedik/data_resume_rawatjalan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeIGD()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelDiagnosa();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'IGD' => $resume->search_igd($referencenumber),
            ];
            $msg = [
                'data' => view('rekammedik/data_resume_igd', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeRanap()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelDiagnosa();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'RANAP' => $resume->search_ranap($referencenumber),
            ];
            $msg = [
                'data' => view('rekammedik/data_resume_ranap', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeOperasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelDiagnosa();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'RANAP' => $resume->search_operasi($referencenumber),
            ];
            $msg = [
                'data' => view('rekammedik/data_resume_operasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
    public function resumePenunjang()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelDiagnosa();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'RANAP' => $resume->search_penunjang($referencenumber),
            ];
            $msg = [
                'data' => view('rekammedik/data_resume_penunjang', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }

    public function resumeFarmasi()
    {
        if ($this->request->isAJAX()) {

            $resume = new ModelDiagnosa();
            $referencenumber = $this->request->getVar('referencenumber');
            $data = [
                'FARMASI' => $resume->search_farmasi($referencenumber),
            ];
            $msg = [
                'data' => view('rekammedik/data_resume_farmasi', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }



    public function ubahdatapasien()
    {
        if ($this->request->isAJAX()) {

            $id = $this->request->getVar('id');
            $perawat = new ModelMasterPasien($this->request);
            $row = $perawat->get_data_pasien($id);
            $data = [
                'id' => $row['id'],
                'pasienid' => $row['code'],
                'oldcode' => $row['oldcode'],
                'pasienname' => $row['name'],
                'pasiengender' => $row['gender'],
                'pasiendateofbirth' => $row['dateofbirth'],
                'pasienaddress' => $row['address'],
                'pasienarea' => $row['area'],
                'pasiensubarea' => $row['area'],
                'pasiensubareaname' => $row['subareaname'],
                'paymentmethod' => $row['paymentmethod'],
                'paymentmethodname' => $row['paymentmethodname'],
                'paymentcardnumber' => $row['cardnumber'],
                'parentname' => $row['parentname'],
                'createdby' => $row['createdby'],
                'createddate' => $row['createddate'],
                'namapjb' => $row['parentname'],
                'telppjb' => $row['parenttelephone'],
                'hubunganpjb' => $row['couplename'],
                'HPJB' => $this->hubunganpjb(),
            ];
            $msg = [
                'sukses' => view('rekammedik/modalubahpasien', $data)
            ];
            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $tgllahir = date('Y-m-d', strtotime($this->request->getVar("tgllahir")));
            $simpandata = [
                'name' => $this->request->getVar('pasienname'),
                'dateofbirth' => $tgllahir,
                'couplename' => $this->request->getVar('hubunganpjb'),
                'address' => $this->request->getVar('pasienaddress'),
                'paymentmethod' => $this->request->getVar('paymentmethodname'),
                'paymentmethodname' => $this->request->getVar('paymentmethodname'),
                'modifiedby' => $this->request->getVar('modifiedby'),
                'modifieddate' => $this->request->getVar('modifieddate'),


            ];
            $perawat = new ModelUpdatePasien;
            $id = $this->request->getVar('id');
            $perawat->update($id, $simpandata);
            $msg = [
                'sukses' => 'Data pasien sudah berhasil diubah'
            ];

            echo json_encode($msg);
        } else {
            exit('tidak dapat diproses');
        }
    }
}
