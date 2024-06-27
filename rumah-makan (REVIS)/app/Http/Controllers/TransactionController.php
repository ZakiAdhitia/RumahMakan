<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;

class TransactionController extends Controller
{

    public function show(){
        $transaction = Transaction::all();

        return response()->json([
         'success' => true,
         'message' => 'Lihat semua barang',
            'produk_id' => $transaction,
            'produk_date' => $transaction,
            'quantity' => $transaction
            
        ],200);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request , [
                'product_id' => 'required|unique:transactions',
                'produk_date' => 'required',
                'quantity' => 'required'
            ]);
            $data = Transaction::create([
                'product_id' => $request->product_id,
                'produk_date' => $request->produk_date,
                'quantity' => $request->quantity,
            ]);

            return ApiFormatter::sendResponse(200, 'success', $data);
        } catch (\Exception $err) {
            return ApiFormatter::sendResponse(400, 'bad request', $err->getMessage());
        }
    }

        public function update(Request $request, $id)
        {
            try {
                $this->validate($request , [
                    'product_id' => 'required',
                    'produk_date' => 'required',
                    'quantity' => 'required'
                ]);

                $checkProses = Transaction::where('id' , $id)->update([
                    'product_id' => $request->product_id,
                    'produk_date' => $request->produk_date,
                    'quantity' => $request->quantity,
                ]);

                if ($checkProses) {
                    $data = Transaction::find($id);
                    return ApiFormatter::sendResponse(200, 'succes' ,$data);
                } else {
                    return ApiFormatter::sendResponse(400, 'bad request' , 'Gagal mengubah data!');
                }
            } catch (\Exception $err) {
                return ApiFormatter::sendResponse(400, 'bad request', $err->getMessage());
            }
        }

    public function destroy($id)
    {
        try {
            $getTransaction = Transaction::where('id' ,$id)->forceDelete();
            
            return ApiFormatter::sendResponse(200, 'success', 'Data Transaction berhasil di hapus!');
        } catch (\Exception $err) {
            return ApiFormatter::sendResponse(400, 'bad request' , $err->getMessage());
        }
    }

    
}
