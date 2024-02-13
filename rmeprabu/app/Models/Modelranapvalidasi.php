<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelranapvalidasi extends Model
{

    protected $table      = 'transaksi_pelayanan_daftar_rawatinap';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'types', 'groups', 'journalnumber', 'parentjournalnumber', 'transferjournalnumber', 'documentdate', 'documentyear', 'documentmonth',  'referencenumber',
        'bpjs_sep_poli', 'bpjs_sep', 'noantrian', 'pasienid', 'oldcode', 'pasienname', 'pasiengender', 'pasienage', 'pasiendateofbirth', 'pasienaddress', 'pasienarea', 'pasiensubarea', 'pasiensubareaname',
        'paymentmethod', 'paymentmethodname', 'paymentcardnumber', 'paymentmethodori', 'paymentmethodnameori', 'paymentcardnumberori', 'poliklinik', 'poliklinikname', 'faskes', 'faskesname', 'dokterpoli', 'dokterpoliname', 'icdx', 'icdxname', 'reasoncode', 'statuspasien', 'bumil', 'lakalantas', 'lokasilakalantas', 'namapjb', 'hubunganpjb', 'telppjb', 'alamatpjb', 'pasienclassroom', 'dokter', 'doktername', 'smf', 'smfname', 'titipan', 'classroom', 'classroomname', 'room',
        'roomname', 'roomfisik', 'roomfisikname', 'bednumber', 'bedname', 'parentid', 'datein', 'timein', 'datetimein', 'locationcode', 'locationname', 'statuspasienpulang', 'statusrawatinap', 'createdby', 'createddate',  'tgl_spr',
        'memo', 'token_ranap', 'covid', 'koinsiden'
    ];

    // protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';


    public function search($keyword)
    {

        return $this->table('transaksi_pelayanan_daftar_rawatinap')
            ->where('statuspasien', 'REGISTRASI')
            ->like('pasienid', $keyword)
            ->orLike('smfname', $keyword);
    }

    function ambildatarajal()
    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        if ($lokasi == "NONE") {
            $this->dt->where('statusrawatinap', 'REGISTER');
            $this->dt->where('types', 'BARU');
        } else {
            $this->dt->where('statusrawatinap', 'REGISTER');
            $this->dt->where('room', $lokasi);
            $this->dt->where('types', 'BARU');
        }
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajalpindahan()
    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        if ($lokasi == "NONE") {
            $this->dt->where('statusrawatinap', 'REGISTER');
            $this->dt->where('types', 'PINDAHAN');
            $this->dt->where('documentdate >', '2022-12-31');
        } else {
            $this->dt->where('room', $lokasi);
            $this->dt->where('statusrawatinap', 'REGISTER');
            $this->dt->where('types', 'PINDAHAN');
            $this->dt->where('documentdate >', '2022-12-31');
        }

        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(400);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    // function ambildatarajal()
    // {
    //     $lokasi = session()->get('locationcode');
    //     $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
    //     if ($lokasi == "NONE") {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('types', 'BARU');
    //     } elseif ($lokasi == "IGD") {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('types', 'BARU');
    //     }
    //     // elseif($lokasi == 'PDL-ROOM'){
    //     //     $this->dt->where('statusrawatinap', 'REGISTER');
    //     //     // $this->dt->where('room', 'gelatik');
    //     //     // $this->dt->orwhere('room', 'murai');
    //     //     // $this->dt->orwhere('room', 'betet 1');
    //     //     $this->dt->where('smfname', 'PENYAKIT DALAM');
    //     //     $this->dt->where('types', 'BARU');
    //     // } 
    //     elseif ($lokasi == 'NICU, PICU, NEONATUS') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'NEO');
    //         $this->dt->orwhere('room', 'PICU');
    //         $this->dt->orwhere('room', 'NICU');
    //         $this->dt->where('types', 'BARU');
    //     } elseif ($lokasi == 'UTAMA') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'SERASAN');
    //         $this->dt->orwhere('room', 'SEKUNDANG');
    //         $this->dt->orwhere('room', 'UTAMA');
    //         $this->dt->where('types', 'BARU');
    //     } elseif ($lokasi == 'LEMATANG,ENIM') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'LEMATANG');
    //         $this->dt->orwhere('room', 'ENIM');
    //         $this->dt->where('types', 'BARU');
    //     } elseif ($lokasi == 'vip, vvip') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'PAVILIUN VIP');
    //         $this->dt->orwhere('room', 'PAVILIUN VVIP');
    //         $this->dt->where('types', 'BARU');
    //     } elseif ($lokasi == 'CEMARA') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'CEMARA');
    //         $this->dt->orwhere('room', 'CEMARA KLS 3');
    //         $this->dt->orwhere('room', 'CEMARA MONITOR');
    //         $this->dt->where('types', 'BARU');
    //     } elseif ($lokasi == 'MAWAR,FLAMBOYAN,ENDELWIES,BOGENVILLE,TULIP,ALAMANDA,ANGGREK,KEMUNING,MELATI') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'MAWAR');
    //         $this->dt->orwhere('room', 'FLAMBOYAN');
    //         $this->dt->orwhere('room', 'ENDELWIES');
    //         $this->dt->orwhere('room', 'BOGENVILLE');
    //         $this->dt->orwhere('room', 'TULIP');
    //         $this->dt->orwhere('room', 'ALAMANDA');
    //         $this->dt->orwhere('room', 'ANGGREK');
    //         $this->dt->orwhere('room', 'KEMUNING');
    //         $this->dt->orwhere('room', 'MELATI');
    //         $this->dt->where('types', 'BARU');
    //     } elseif ($lokasi == 'MEARAK 2,MERAK 1,NURI,MURAI,PERKUTUT 1,PERKUTUT 2,BETET 1,BETET 2,GELATIK,BANGAU,CENDRAWASIH,PIPIT') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->orwhere('room', 'MERAK 2');
    //         $this->dt->orwhere('room', 'MERAK 1');
    //         $this->dt->orwhere('room', 'NURI');
    //         $this->dt->orwhere('room', 'MURAI');
    //         $this->dt->orwhere('room', 'PERKUTUT 1');
    //         $this->dt->orwhere('room', 'PERKUTUT 2');
    //         $this->dt->orwhere('room', 'BETET 1');
    //         $this->dt->orwhere('room', 'BETET 2');
    //         $this->dt->orwhere('room', 'GELATIK');
    //         $this->dt->orwhere('room', 'BANGAU');
    //         $this->dt->orwhere('room', 'CENDRAWASIH');
    //         $this->dt->orwhere('room', 'MERPATI');
    //         $this->dt->orwhere('room', 'PIPIT');
    //         $this->dt->where('types', 'BARU');
    //     } else {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', $lokasi);
    //         $this->dt->where('types', 'BARU');
    //     }
    //     $this->dt->orderBy('id', 'DESC');
    //     $this->dt->limit(10000);
    //     $query = $this->dt->get();
    //     return $query->getResultArray();
    // }

    // function ambildatarajalpindahan()
    // {
    //     $lokasi = session()->get('locationcode');
    //     $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
    //     if ($lokasi == "NONE") {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('types', 'PINDAHAN');
    //         $this->dt->where('documentdate >', '2022-12-31');
    //     } elseif ($lokasi == "IGD") {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('types', 'PINDAHAN');
    //         $this->dt->where('documentdate >', '2022-12-31');
    //     } elseif ($lokasi == 'NICU, PICU, NEONATUS') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'NEO');
    //         $this->dt->orwhere('room', 'PICU');
    //         $this->dt->orwhere('room', 'NICU');
    //         $this->dt->where('types', 'PINDAHAN');
    //         $this->dt->where('documentdate >', '2022-12-31');
    //     } elseif ($lokasi == 'UTAMA') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'SERASAN');
    //         $this->dt->orwhere('room', 'SEKUNDANG');
    //         $this->dt->orwhere('room', 'UTAMA');
    //         $this->dt->where('documentdate >', '2022-12-31');
    //     } elseif ($lokasi == 'LEMATANG,ENIM') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'LEMATANG');
    //         $this->dt->orwhere('room', 'ENIM');
    //         $this->dt->where('types', 'PINDAHAN');
    //         $this->dt->where('documentdate >', '2022-12-31');
    //     } elseif ($lokasi == 'vip, vvip') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'PAVILIUN VIP');
    //         $this->dt->orwhere('room', 'PAVILIUN VVIP');
    //         $this->dt->where('types', 'PINDAHAN');
    //         $this->dt->where('documentdate >', '2022-12-31');
    //     } elseif ($lokasi == 'MAWAR,FLAMBOYAN,ENDELWIES,BOGENVILLE,TULIP,ALAMANDA,ANGGREK,KEMUNING,MELATI') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'MAWAR');
    //         $this->dt->orwhere('room', 'FLAMBOYAN');
    //         $this->dt->orwhere('room', 'ENDELWIES');
    //         $this->dt->orwhere('room', 'BOGENVILLE');
    //         $this->dt->orwhere('room', 'TULIP');
    //         $this->dt->orwhere('room', 'ALAMANDA');
    //         $this->dt->orwhere('room', 'ANGGREK');
    //         $this->dt->orwhere('room', 'KEMUNING');
    //         $this->dt->orwhere('room', 'MELATI');
    //         $this->dt->where('types', 'PINDAHAN');
    //         $this->dt->where('documentdate >', '2022-12-31');
    //     } elseif ($lokasi == 'CEMARA') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'CEMARA');
    //         $this->dt->orwhere('room', 'CEMARA KLS 3');
    //         $this->dt->orwhere('room', 'CEMARA MONITOR');
    //         $this->dt->where('types', 'PINDAHAN');
    //         $this->dt->where('documentdate >', '2022-12-31');
    //     } elseif ($lokasi == 'MEARAK 2,MERAK 1,NURI,MURAI,PERKUTUT 1,PERKUTUT 2,BETET 1,BETET 2,GELATIK,BANGAU,CENDRAWASIH,PIPIT') {
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('room', 'MERAK 2');
    //         $this->dt->orwhere('room', 'MERAK 1');
    //         $this->dt->orwhere('room', 'NURI');
    //         $this->dt->orwhere('room', 'MURAI');
    //         $this->dt->orwhere('room', 'PERKUTUT 1');
    //         $this->dt->orwhere('room', 'PERKUTUT 2');
    //         $this->dt->orwhere('room', 'BETET 1');
    //         $this->dt->orwhere('room', 'BETET 2');
    //         $this->dt->orwhere('room', 'GELATIK');
    //         $this->dt->orwhere('room', 'BANGAU');
    //         $this->dt->orwhere('room', 'CENDRAWASIH');
    //         $this->dt->orwhere('room', 'MERPATI');
    //         $this->dt->orwhere('room', 'PIPIT');
    //         $this->dt->where('types', 'PINDAHAN');
    //         $this->dt->where('documentdate >', '2022-12-31');
    //     } else {
    //         $this->dt->where('room', $lokasi);
    //         $this->dt->where('statusrawatinap', 'REGISTER');
    //         $this->dt->where('types', 'PINDAHAN');
    //         $this->dt->where('documentdate >', '2022-12-31');
    //     }

    //     $this->dt->orderBy('id', 'DESC');
    //     $this->dt->limit(4000);
    //     $query = $this->dt->get();
    //     return $query->getResultArray();
    // }

    function get_list_pjb()
    {
        $this->dt = $this->db->table('hubungan_pjb');
        $this->dt->orderBy('hubunganpjb');
        $this->dt->select(' hubunganpjb , id ');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kelas()
    {
        $this->dt = $this->db->table('pelayanan_kelas');

        $this->dt->select(' code , id ');
        $this->dt->notLIKE('vclaimclass', 'NULL ');
        $this->dt->orderBy('code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_kamar($classroom)
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->select(' code ,  name, roomname, id , room');
        $this->dt->where('classroom', $classroom);
        $this->dt->groupBy('roomname');
        $this->dt->orderBy('code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_bed($room)
    {
        $this->dt = $this->db->table('pelayanan_tempat_tidur');
        $this->dt->select(' code ,  name, roomname, id ');
        $this->dt->where('status', 'KOSONG');
        $this->dt->where('room', $room);
        $this->dt->orderBy('code');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function get_list_smf()
    {
        $this->dt = $this->db->table('pelayanan_smf');
        $this->dt->select(' code ,  name, id ');
        $this->dt->orderBy('name');
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function hakpasien()
    {
        $this->dt = $this->db->table('master_hakpasien');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function kewajibanpasien()
    {
        $this->dt = $this->db->table('master_kewajibanpasien');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function administrasi()
    {
        $this->dt = $this->db->table('master_tatatertib_pasien');
        $this->dt->where('kelompok', 'ADMINISTRASI');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function keuangan()
    {
        $this->dt = $this->db->table('master_tatatertib_pasien');
        $this->dt->where('kelompok', 'KEUANGAN');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function pelayanan()
    {
        $this->dt = $this->db->table('master_tatatertib_pasien');
        $this->dt->where('kelompok', 'PELAYANAN');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
    function ambildataranap_exist()
    {
        $lokasi = session()->get('locationcode');
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        if ($lokasi == "NONE") {
            $this->dt->where('statusrawatinap', 'RAWAT');
            $this->dt->where('paymentby', '');
        } else {
            $this->dt->where('statusrawatinap', 'RAWAT');
            $this->dt->where('room', $lokasi);
            $this->dt->where('paymentby', '');
        }

        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(1000);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    // function ambildataranap_exist()
    // {
    //     $lokasi = session()->get('locationcode');
    //     $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
    //     $statuspasien = 'RAWAT';
    //     $querystatus = $this->dt->whereIn('statusrawatinap', $statuspasien);

    //     if ($lokasi == "NONE") {
    //         $this->dt->where('statusrawatinap', 'RAWAT');
    //         $this->dt->where('paymentby', '');
    //     } elseif ($lokasi == "IGD") {
    //         $this->dt->where('statusrawatinap', 'RAWAT');
    //         $this->dt->where('paymentby', '');
    //     } elseif ($lokasi == 'NICU, PICU, NEONATUS') {
    //         $this->dt->where('statusrawatinap', 'RAWAT');
    //         $this->dt->where('room', 'NEO');
    //         $this->dt->orwhere('room', 'PICU');
    //         $this->dt->orwhere('room', 'NICU');
    //         $this->dt->where('paymentby', '');
    //     } elseif ($lokasi == 'LEMATANG,ENIM') {
    //         $this->dt->where('statusrawatinap', 'RAWAT');
    //         $this->dt->where('room', 'LEMATANG');
    //         $this->dt->orwhere('room', 'ENIM');
    //         $this->dt->where('paymentby', '');
    //     } elseif ($lokasi == 'UTAMA') {
    //         $this->dt->where('statusrawatinap', 'RAWAT');
    //         $this->dt->where('room', 'SERASAN');
    //         $this->dt->orwhere('room', 'SEKUNDANG');
    //         $this->dt->orwhere('room', 'UTAMA');
    //         $this->dt->where('paymentby', '');
    //     } elseif ($lokasi == 'MEARAK 2,MERAK 1,NURI,MURAI,PERKUTUT 1,PERKUTUT 2,BETET 1,BETET 2,GELATIK,BANGAU,CENDRAWASIH,PIPIT') {
    //         $this->dt->where('statusrawatinap', 'RAWAT');
    //         $this->dt->where('room', 'MERAK 2');
    //         $this->dt->orwhere('room', 'MERAK 1');
    //         $this->dt->orwhere('room', 'NURI');
    //         $this->dt->orwhere('room', 'MURAI');
    //         $this->dt->orwhere('room', 'PERKUTUT 1');
    //         $this->dt->orwhere('room', 'PERKUTUT 2');
    //         $this->dt->orwhere('room', 'BETET 1');
    //         $this->dt->orwhere('room', 'BETET 2');
    //         $this->dt->orwhere('room', 'GELATIK');
    //         $this->dt->orwhere('room', 'BANGAU');
    //         $this->dt->orwhere('room', 'CENDRAWASIH');
    //         $this->dt->orwhere('room', 'MERPATI');
    //         $this->dt->orwhere('room', 'PIPIT');
    //         $this->dt->where('paymentby', '');
    //     } elseif ($lokasi == 'vip, vvip') {
    //         $this->dt->where('statusrawatinap', 'RAWAT');
    //         $this->dt->where('room', 'PAVILIUN VIP');
    //         $this->dt->orwhere('room', 'PAVILIUN VVIP');
    //         $this->dt->where('paymentby', '');
    //     } elseif ($lokasi == 'CEMARA') {
    //         $this->dt->where('statusrawatinap', 'RAWAT');
    //         $this->dt->where('room', 'CEMARA');
    //         $this->dt->orwhere('room', 'CEMARA KLS 3');
    //         $this->dt->orwhere('room', 'CEMARA MONITOR');
    //         $this->dt->where('paymentby', '');
    //     } elseif ($lokasi == 'MAWAR,FLAMBOYAN,ENDELWIES,BOGENVILLE,TULIP,ALAMANDA,ANGGREK,KEMUNING,MELATI') {
    //         $this->dt->where('statusrawatinap', 'RAWAT');
    //         $this->dt->where('room', 'MAWAR');
    //         $this->dt->orwhere('room', 'FLAMBOYAN');
    //         $this->dt->orwhere('room', 'ENDELWIES');
    //         $this->dt->orwhere('room', 'BOGENVILLE');
    //         $this->dt->orwhere('room', 'TULIP');
    //         $this->dt->orwhere('room', 'ALAMANDA');
    //         $this->dt->orwhere('room', 'ANGGREK');
    //         $this->dt->orwhere('room', 'KEMUNING');
    //         $this->dt->orwhere('room', 'MELATI');
    //         $this->dt->where('paymentby', '');
    //     } else {
    //         $this->dt->where('statusrawatinap', 'RAWAT');
    //         $this->dt->where('room', $lokasi);
    //         $this->dt->where('paymentby', '');
    //     }

    //     $this->dt->orderBy('id', 'DESC');
    //     $this->dt->limit(100000);
    //     $query = $this->dt->get();
    //     return $query->getResultArray();
    // }

    function ambildataranap_exist_jendela()
    {

        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');

        $this->dt->where('statusrawatinap', 'RAWAT');
        $this->dt->where('paymentby', '');

        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(100000);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
