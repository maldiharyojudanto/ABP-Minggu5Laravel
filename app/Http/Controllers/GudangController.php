<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;
use App\Models\Produk;

class GudangController extends Controller
{
    public function index() {
        $list = Gudang::with('produk')->get();
        return view("gudang.index",compact('list'));
    }

    public function create() {
        return view("gudang.create");
    }

    public function store(Request $req) {

        $new = new Gudang();
        $new->nama_gudang = $req->nama_gudang;
        $new->alamat_gudang = $req->alamat_gudang;
        $new->save();

        return redirect("/gudang");
    }

    public function edit($id) {
        //$detail = Gudang::where("id",$id)->get();
        $detail = Gudang::find($id); // find dapat dipakai jika primary key
        return view("gudang.edit",compact('detail'));
    }

    public function update($id, Request $req) {

        $cek = Gudang::find($id);
        
        if($cek) {

            $cek->nama_gudang = $req->nama_gudang;
            $cek->alamat_gudang = $req->alamat_gudang;
            $cek->save();

            return redirect("/gudang");

        } else {
            
            echo "Data tidak ditemukan";

        }
    }

    public function delete($id) {

        $cek = Gudang::find($id);

        if($cek) {

            $cek->delete();
            return redirect("/gudang");

        } else {

            echo "Data tidak ditemukan";
        
        }
    }
}
