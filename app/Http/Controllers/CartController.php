<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanandetail;
use Illuminate\Support\Facades\DB;
use Auth;

class CartController extends Controller
{
    public function index()
    {
        $pesanan = DB::table('pesanans')->where('user_id', Auth::user()->id_user)->where('status', 0)->first();
        $pesanan_detail = DB::table('pesanandetails')->where('pesanan_id', $pesanan->id_pesanan)->count();
        return response()->json(['data' => $pesanan_detail], 200);
    }

    public function pesanan()
    {
        $pesanan = DB::table('pesanans')->where('user_id', Auth::user()->id_user)->where('status', 0)->first();
        $pesanan_detail = DB::table('pesanandetails')->where('pesanan_id', $pesanan->id_pesanan)
        ->join('barangs', 'barangs.id_barang', '=', 'pesanandetails.barang_id')
        ->select('pesanandetails.*', 'barangs.nama_barang')
        ->get();
        return response()->json(['data' => $pesanan_detail], 200);
        //var_dump($pesanan_detail);
    }

    public function sum()
    {
        $pesanan = DB::table('pesanans')->where('user_id', Auth::user()->id_user)->where('status', 0)->first();
        $pesanan_detail = DB::table('pesanandetails')->where('pesanan_id', $pesanan->id_pesanan)->get();
        $sum = $pesanan_detail->sum('jumlah_harga');
        return response()->json(['data' => $sum], 200);
    }

    public function delete($id)
    {
        $pesanan = DB::table('pesanans')->where('user_id', Auth::user()->id_user)->where('status', 0)->first();
        $pesanan_detail = DB::table('pesanandetails')->where('pesanan_id', $pesanan->id_pesanan);
        $pesanan_detail->delete();
        return response()->json(['message' => 'Pesanan berhasil dihapus'], 200);
    }
}
