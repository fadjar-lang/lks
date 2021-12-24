<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\Pesanandetail;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function pesan(Request $request, $id)
    {
        $barang = Barang::find($id);

        $cek_pesan = Pesanan::where('id_pesanan', Auth::user()->id_user)->where('status', 0)->first();
        if (empty($cek_pesan)) {     
            $pesan = new Pesanan;
            $pesan->user_id = Auth::user()->id_user;
            $pesan->jumlah_harga = $barang->harga;
            $pesan->status = 0;
            $pesan->save();
        }else{
            $cek_pesan->jumlah_harga = $cek_pesan->jumlah_harga+$barang->harga;
            $cek_pesan->update();
        }

        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id_user)->where('status', 0)->first();
        $pesanan_detail = new Pesanandetail;
        $pesanan_detail->pesanan_id = $pesanan_baru->id_pesanan;
        $pesanan_detail->barang_id = $barang->id_barang;
        $pesanan_detail->jumlah_barang = 1;
        $pesanan_detail->jumlah_harga = $barang->harga;
        $pesanan_detail->save();

        return response()->json(['message' => 'barang berhasil dipesan'], 200);
    }
}
