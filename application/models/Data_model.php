<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //ini untuk memasukkan kedalam tabel pegawai
    function convert_soal($dataarray) {
        for ($i = 0; $i < count($dataarray); $i++) {
            $data = array(
                'soal' => $dataarray[$i]['soal'],
                'a' => $dataarray[$i]['a'],
                'b' => $dataarray[$i]['b'],
                'c' => $dataarray[$i]['c'],
                'd' => $dataarray[$i]['d'],
                'e' => $dataarray[$i]['e'],
                'ujian_id' => $dataarray[$i]['ujian_id'],
                'jawaban_soal' => $dataarray[$i]['jawaban_soal'],
            );
            //ini untuk menambahkan apakah dalam tabel sudah ada data yang sama
            //apabila data sudah ada maka data di-skip
            // saya contohkan kalau ada data nama yang sama maka data tidak dimasukkan
			$this->db->insert("bank_soal", $data);
            
        }
	}
}