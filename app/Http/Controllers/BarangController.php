<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use File;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::latest()->get();
        return response()->json(['data' => $barang], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|min:5',
            'harga' => 'required|min:5',
            'keterangan' => 'required|min:5',
            'foto' => 'required|mimes:jpg,jpeg,png',
            'file' => 'required'
        ]);

        $foto = [];
        $file = [];

        if ($request->foto) {
            $foto = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('img'), $foto);
        }

        if ($request->file) {
            $file = $request->file->getClientOriginalName();
            $request->file->move(public_path('file'), $file);
        }

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'foto' => $foto,
            'file' => $file
        ]);

        return response()->json(['error' => false, 'message' => 'Data berhasil disimpan'], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json(['data' => $barang], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|min:5',
            'harga' => 'required|min:5',
            'keterangan' => 'required|min:5',
            'foto' => 'required|mimes:jpg,jpeg,png',
            'file' => 'required'
        ]);

        $foto = [];
        $file = [];

        if ($request->foto) {
            $foto = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('img'), $foto);
        }

        if ($request->file) {
            $file = $request->file->getClientOriginalName();
            $request->file->move(public_path('file'), $file);
        }

        $barang = Barang::find($id)->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'foto' => $foto,
            'file' => $file
        ]);

        return response()->json(['error' => false, 'message' => 'Data berhasil terupdate'], 201);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Barang::find($id);
        File::delete('img/'.$barang->foto);
        File::delete('file/'.$barang->file);
        $barang->delete();
        return response()->json(['error' => false, 'message' => 'Data berhasil terhapus'], 200);
    }
}
