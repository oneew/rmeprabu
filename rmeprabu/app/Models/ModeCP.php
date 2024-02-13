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
        'roomname', 'roomfisik', 'roomfisikname', 'bednumber', 'bedname', 'parentid', 'datein', 'timein', 'datetimein', 'locationcode', 'locationname', 'statusrawatinap', 'createdby', 'createddate',  'tgl_spr',
        'memo', 'email', 'token_ranap', 'created_at', 'updated_at', 'covid', 'koinsiden'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function search($keyword)
    {

        return $this->table('transaksi_pelayanan_daftar_rawatinap')
            ->where('statuspasien', 'REGISTRASI')
            ->like('pasienid', $keyword)
            ->orLike('smfname', $keyword);
    }

    function ambildatarajal()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('statusrawatinap', 'REGISTER');
        $this->dt->where('types', 'BARU');
        $this->dt->where('journalnumber <>', 'NONE');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

    function ambildatarajalpindahan()
    {
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('statusrawatinap', 'REGISTER');
        $this->dt->where('types', 'PINDAHAN');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(100);
        $query = $this->dt->get();
        return $query->getResultArray();
    }

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
        $this->dt = $this->db->table('transaksi_pelayanan_daftar_rawatinap');
        $this->dt->where('statusrawatinap', 'RAWAT');
        $this->dt->orderBy('id', 'DESC');
        $this->dt->limit(400);
        $query = $this->dt->get();
        return $query->getResultArray();
    }
}
