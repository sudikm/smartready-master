<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Response;
use App\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DB;

class RestController extends Controller
{
    public function qrCodeProduct(Request $request){
        $rules = array(
            'field' => 'required',
            'value' => 'required',
        );
        $input = Input::all();
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            return Response::json(['success' => false, 'message' => $validation->errors()]);
        }
        $field = $request->get('field');
        $value = $request->get('value');

        $product = DB::table('product')
                ->leftJoin('productImage', 'productImage.product_id', '=', 'product.id')
                ->select('productImage.imageName', 'product.*')
                ->where('product.'.$field, $value)
                ->get();

        if($product)
        { 
            foreach ($product as $key => $value) {
                $productData['images'][$key] = $value->imageName;
            }

            $productData['id'] = $product[0]->id;
            $productData['name'] = $product[0]->name;
            $productData['title'] = $product[0]->title; 
            $productData['videoLink'] = $product[0]->videoLink;
            $productData['qrCodeText'] = $product[0]->qrCodeText;
            $productData['description'] = $product[0]->description;
            $productData['pin'] = $product[0]->pin;

            if($productData){
                $data = $productData;
                $success = true;
            }else{
                $data = "No products found";
                $success = 0;
            }
        }else{
                $data = "No products found";
                $success = 0;
            }
        return Response::json(['success' => $success, 'message' => $data]);
    }
}
