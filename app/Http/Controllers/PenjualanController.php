<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        
        $query = Penjualan::with(['pelanggan', 'itemPenjualans.barang']);
        
        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('tanggal', 'like', "%{$search}%")
                  ->orWhere('sub_total', 'like', "%{$search}%")
                  ->orWhereHas('pelanggan', function($q2) use ($search) {
                      $q2->where('nama', 'like', "%{$search}%");
                  });
            });
        }
        
        $penjualans = $query->paginate($perPage);
        
        return $this->paginatedResponse($penjualans, 'Data penjualan berhasil diambil');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.qty' => 'required|integer|min:1'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        DB::beginTransaction();
        try {
            // Hitung sub_total
            $subTotal = 0;
            foreach ($request->items as $item) {
                $barang = Barang::find($item['barang_id']);
                $subTotal += $barang->harga * $item['qty'];
            }

            // Buat penjualan
            $penjualan = Penjualan::create([
                'pelanggan_id' => $request->pelanggan_id,
                'tanggal' => $request->tanggal,
                'sub_total' => $subTotal
            ]);

            // Buat item penjualan
            foreach ($request->items as $item) {
                ItemPenjualan::create([
                    'penjualan_id' => $penjualan->id,
                    'barang_id' => $item['barang_id'],
                    'qty' => $item['qty']
                ]);
            }

            DB::commit();

            $penjualan->load(['pelanggan', 'itemPenjualans.barang']);

            return $this->successResponse($penjualan, 'Penjualan berhasil ditambahkan', 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse('Terjadi kesalahan saat menyimpan penjualan', $e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        $penjualan = Penjualan::with(['pelanggan', 'itemPenjualans.barang'])->find($id);

        if (!$penjualan) {
            return $this->errorResponse('Penjualan tidak ditemukan', null, 404);
        }

        return $this->successResponse($penjualan, 'Detail penjualan berhasil diambil');
    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::find($id);

        if (!$penjualan) {
            return $this->errorResponse('Penjualan tidak ditemukan', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'exists:pelanggans,id',
            'tanggal' => 'date',
            'items' => 'array|min:1',
            'items.*.barang_id' => 'required_with:items|exists:barangs,id',
            'items.*.qty' => 'required_with:items|integer|min:1'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validasi gagal', $validator->errors(), 422);
        }

        DB::beginTransaction();
        try {
            // Update data penjualan
            if ($request->has('pelanggan_id')) {
                $penjualan->pelanggan_id = $request->pelanggan_id;
            }
            if ($request->has('tanggal')) {
                $penjualan->tanggal = $request->tanggal;
            }

            // Update items jika ada
            if ($request->has('items')) {
                // Hapus item lama
                ItemPenjualan::where('penjualan_id', $penjualan->id)->delete();

                // Hitung sub_total baru
                $subTotal = 0;
                foreach ($request->items as $item) {
                    $barang = Barang::find($item['barang_id']);
                    $subTotal += $barang->harga * $item['qty'];

                    // Buat item baru
                    ItemPenjualan::create([
                        'penjualan_id' => $penjualan->id,
                        'barang_id' => $item['barang_id'],
                        'qty' => $item['qty']
                    ]);
                }
                $penjualan->sub_total = $subTotal;
            }

            $penjualan->save();
            DB::commit();

            $penjualan->load(['pelanggan', 'itemPenjualans.barang']);

            return $this->successResponse($penjualan, 'Penjualan berhasil diupdate');

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse('Terjadi kesalahan saat mengupdate penjualan', $e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::find($id);

        if (!$penjualan) {
            return $this->errorResponse('Penjualan tidak ditemukan', null, 404);
        }

        DB::beginTransaction();
        try {
            // Hapus item penjualan
            ItemPenjualan::where('penjualan_id', $penjualan->id)->delete();
            
            // Hapus penjualan
            $penjualan->delete();

            DB::commit();

            return $this->successResponse(null, 'Penjualan berhasil dihapus');

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->errorResponse('Terjadi kesalahan saat menghapus penjualan', $e->getMessage(), 500);
        }
    }
}
