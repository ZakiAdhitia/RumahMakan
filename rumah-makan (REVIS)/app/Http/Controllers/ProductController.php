<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;

class ProductController extends Controller
{

    public function show(){
        $Product = Product::all();

        return response()->json([
         'success' => true,
         'message' => 'Lihat semua barang',
            'product_id' => $Product,
            'produk_date' => $Product,
            'quantity' => $Product
            
        ],200);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request , [
                'name' => 'required|unique:products',
                'price' => 'required'
            ]); 
            $data = Product::create([
                'name' => $request->name,
                'price' => $request->price,
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
                'name' => 'required|unique:products',
                'price' => 'required'
            ]);

            $checkProses = Product::where('id' , $id)->update([
                'name' => $request->name,
                'price' =>$request->price
            ]);

            if ($checkProses) {
                $data = Product::find($id);
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
            $getProduct = Product::where('id' ,$id)->delete();
            
            return ApiFormatter::sendResponse(200, 'success', 'Data Product berhasil di hapus!');
        } catch (\Exception $err) {
            return ApiFormatter::sendResponse(400, 'bad request' , $err->getMessage());
        }
    }

    
}
