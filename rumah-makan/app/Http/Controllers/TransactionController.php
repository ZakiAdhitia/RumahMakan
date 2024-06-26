<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        try {
            $this->validate($request , [
                'produk_id' => 'required',
                'name' => 'required',
                'quantity' => 'required'
            ]);
            $data = Transaction::create([
                'produk_id' => $request->produk_id,
                'name' => $request->name,
                'quantity' => $request->quantity,
            ]);

            return ApiFormatter::sendResponse(200, 'success', $data);
        } catch (\Exception $err) {
            return ApiFormatter::sendResponse(400, 'bad request', $err->getMessage());
        }
    }

    public function update(Request $request,$id)
    {
        try {
            $this->validate($request , [
                'name' => 'required',
                'quantity' => 'required'
            ]);

            $checkProses = Transaction::where('id' , $id)->update([
                'name' => $request->name,
                'quantity' =>$request->quantity
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
            $getTransaction = Transaction::where('id' ,$id)->delete();
            
            return ApiFormatter::sendResponse(200, 'success', 'Data Transaction berhasil di hapus!');
        } catch (\Exception $err) {
            return ApiFormatter::sendResponse(400, 'bad request' , $err->getMessage());
        }
    }

    
}
