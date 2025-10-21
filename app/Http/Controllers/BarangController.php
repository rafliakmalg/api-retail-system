<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
        public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        
        $query = Barang::query();
        
        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('harga', 'like', "%{$search}%");
            });
        }
        
        $barangs = $query->paginate($perPage);
        
        return $this->paginatedResponse($barangs, 'Data barang berhasil diambil');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kategori' => 'integer|' . Barang::getKategoriValidationRules(),
            'harga' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        $barang = Barang::create($request->all());

        return $this->successResponse($barang, 'Barang berhasil ditambahkan', 201);
    }

    public function show($id)
    {
        $barang = Barang::with(['itemPenjualans.penjualan.pelanggan'])->find($id);

        if (!$barang) {
            return $this->errorResponse('Barang tidak ditemukan', null, 404);
        }

        return $this->successResponse($barang, 'Detail barang berhasil diambil');
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return $this->errorResponse('Barang tidak ditemukan', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:255',
            'kategori' => 'integer|' . Barang::getKategoriValidationRules(),
            'harga' => 'numeric|min:0'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        $barang->update($request->all());

        return $this->successResponse($barang, 'Barang berhasil diupdate');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return $this->errorResponse('Barang tidak ditemukan', null, 404);
        }

        $barang->delete();

        return $this->successResponse(null, 'Barang berhasil dihapus');
    }

    public function listKategori()
    {
        $kategoriList = Barang::getKategoriOptions();
        return $this->successResponse($kategoriList, 'Daftar kategori berhasil diambil');
    }
}
