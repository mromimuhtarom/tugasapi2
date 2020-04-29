<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SoalController extends Controller
{
    public function index()
    {
        $data = DB::table('tabel_soal')->get();

        return $data;
    }

    public function update(Request $request)
    {
        $pk = $request->pk;
        $name = $request->name;
        $value = $request->value;

        $validasi = array();
        if($pk == NULL):
            $validasi[] = 'ID harus Diisi';
        elseif($name == NULL):
            $validasi[] = 'name kosong harus diiisi';
        elseif($value == NULL):
            $validasi[] = 'value atau yang mau di edit jangan lupa diisi ya';
        endif;

        if(!empty($validasi)): 
            return ["mesage_validasi" => $validasi];
        endif;


        $data = DB::table('tabel_soal')->where('id_soal', '=', $pk)->update([
            $name => $value
        ]);

        return response()->json(['data' => $data, 'message' => 'upddate berhasil']);
    }

    public function insert(Request $request)
    {
        $pertanyaan = $request->pertanyaan;
        $a = $request->a;
        $b = $request->b;
        $c = $request->c;
        $d = $request->d;
        $jawaban = $request->jawaban;
        $publish = $request->publish;
        $tipe = $request->tipe;

        $validasi = array();
        if($pertanyaan == NULL):
            $validasi['pertanyaan'] = 'pertanyaan jangan kosong';
        elseif($a == NULL):
            $validasi['pilihan_a'] = 'Pilihan A jangan kosong';
        elseif($b == NULL):
            $validasi['pilihan_b'] = 'Pilihan B jangan kosong';
        elseif($c == NULL):
            $validasi['pilihan_c'] = 'Pilihan C jangan kosong';
        elseif($d == NULL):
            $validasi['pilihan_d'] = 'Pilihan D kosong harus diiisi';
        elseif($jawaban == NULL):
            $validasi['jawaban'] = 'jawaban jangan kosong';
        elseif($publish == NULL):
            $validasi['publish'] = 'publish jangan kosong';
        elseif($tipe == NULL):
            $validasi['tipe'] = 'tipe jangan kosong';
        endif;

        if(!empty($validasi)): 
            return ["mesage_validasi" => $validasi];
        endif;

        $data = DB::table('tabel_soal')->insert([
            'pertanyaan'    =>  $pertanyaan,
            'pilihan_a'     =>  $a,
            'pilihan_b'     =>  $b,
            'pilihan_c'     =>  $c,
            'pilihan_d'     =>  $d,
            'jawaban'       =>  $jawaban,
            'publish'       =>  $publish,
            'tipe'          =>  $tipe
        ]);


        return response()->json(['data' => $data, 'message' => 'Inser Berhasil']);
    }

    public function delete(Request $request)
    {
        $pk = $request->pk;

        if($pk == NULL): 
            return 'ID wajib di isi';
        endif;

        $data = DB::table('tabel_soal')->where('id_soal', '=', $pk)->delete();


        return response()->json(['data' => $data, 'message' => 'Delete Berhasil']);
    }
}
