<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $a = DB::table('tabel_user')
             ->get();
        
        return $a;
    }

    public function update(Request $request)
    {
        $pk    = $request->pk;
        $name  = $request->name;
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


        DB::table('tabel_user')->where('id_user', '=', $pk)->update([
            $name => $value
        ]);

        return 'Success';
    }

    public function insert(Request $request)
    {
        $nama_user = $request->nama_user;
        $username  = $request->username;
        $password  = $request->password;

        $validasi = array();
        if($nama_user == NULL):
            $validasi['nama_user'] = 'ID harus Diisi';
        elseif($username == NULL):
            $validasi['username'] = 'name kosong harus diiisi';
        elseif($password == NULL):
            $validasi['password'] = 'value atau yang mau di edit jangan lupa diisi ya';
        endif;

        if(!empty($validasi)): 
            return response()->json(["mesage_validasi" => $validasi], 400);
        endif;

        $data = DB::table('tabel_user')->insert([
            'nama_user' =>  $nama_user,
            'username'  =>  $username,
            'password'  =>  $password
        ]);

        return ['data' => $data, 'message' => 'Data Berhasil di input'];

    }

    public function delete(Request $request)
    {
        $pk = $request->pk;

        if($pk == NULL): 
            return 'Idnya Harus Diisi';
        endif;

        $data = DB::table('tabel_user')->where('id_user', '=', $pk)->delete();

        return ['data' => $data, 'message' => 'Berhasil di Hapus'];
    }
}
