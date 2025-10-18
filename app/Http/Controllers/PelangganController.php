<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        
        $query = Pelanggan::with(['penjualans']);
        
        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('domisili', 'like', "%{$search}%")
                  ->orWhere('jenis_kelamin', 'like', "%{$search}%");
            });
        }
        
        $pelanggans = $query->paginate($perPage);
        
        return $this->paginatedResponse($pelanggans, 'Data pelanggan berhasil diambil');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'domisili' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Pria,Perempuan'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        $pelanggan = Pelanggan::create($request->all());

        return $this->successResponse($pelanggan, 'Pelanggan berhasil ditambahkan', 201);
    }

    public function show($id)
    {
        $pelanggan = Pelanggan::with(['penjualans.itemPenjualans.barang'])->find($id);

        if (!$pelanggan) {
            return $this->errorResponse('Pelanggan tidak ditemukan', null, 404);
        }

        return $this->successResponse($pelanggan, 'Detail pelanggan berhasil diambil');
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return $this->errorResponse('Pelanggan tidak ditemukan', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:255',
            'domisili' => 'string|max:255',
            'jenis_kelamin' => 'in:Pria,Perempuan'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        $pelanggan->update($request->all());

        return $this->successResponse($pelanggan, 'Pelanggan berhasil diupdate');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {
            return $this->errorResponse('Pelanggan tidak ditemukan', null, 404);
        }

        $pelanggan->delete();

        return $this->successResponse(null, 'Pelanggan berhasil dihapus');
    }
}