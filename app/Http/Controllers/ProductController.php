<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\AdminUser;
use App\Product;
use App\ProductImage;
use Auth;
use Validator;
use DB;
use File;
use Image;
use DateTime;
use Illuminate\Support\Facades\Input;   

class ProductController extends Controller
{
    public $data = array(
        'home' => 'admin/dashboard',
        'user' => 'admin/listAdminUser',
        'shopping-cart' => 'admin/listProduct'
    );

    /**
     *  List the products
     */
    public function listProduct(Request $request)
    {
        $adminuser = Auth::guard('admin')->user();
        $products = DB::table('product')
        ->orderBy('updated_at', 'desc')
            ->paginate(5);
        return view('admin.listProduct', ['adminuser' => $adminuser, 'products' => $products, 'title' => 'Admin Dashboard', 'page_title' => 'Product', 'linkData' => $this->data]);
    }

    /**
     *  Add new product
     */
    public function addProduct()
    {
        $adminuser = Auth::guard('admin')->user();
        return view('admin.addProduct', ['adminuser' => $adminuser, 'title' => "Admin Dashboard", 'page_title' => 'Add New Product', 'linkData' => $this->data]);
    }

    /**
     *  Save the new product in database
     */
    public function saveProduct(Request $request)
    {
        $input = $request->all();
        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'title' => 'required',
            'video' => 'required',
            'image' => 'required',
            'qrCodeText' => 'required',
            'pin' => 'required | numeric'
        );
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }
        $video = $request->file('video');
        $image = $request->file('image');
        $productData = array(
            'name' => $request->get('name'),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'qrCodeText' => $request->get('qrCodeText'),
            'pin' => $request->get('pin'),

        );
        if($video){
            $date = new DateTime();
            $timestamp = $date->getTimestamp();
            $filename = $timestamp .$request->file('video')->getClientOriginalName();
            $destination_path = getcwd() . '/assets/productVideo/';
            $video->move($destination_path, $filename);
            $productData['videoLink'] = $filename;
        }

        //save the product data
        $productId = Product::create($productData);

        foreach ($image as $newImage) {

            if($newImage){
                $date = round(microtime(true) * 1000);
                $filename = $date.$newImage->getClientOriginalName();

                $destination_path = getcwd() . '/assets/productImage/';
                $newImage->move($destination_path, $filename);
                $productImage['imageName'] = $filename;
                $productImage['product_id'] = $productId->id;
                $productSave = ProductImage::create($productImage);
            }
        }       
        

        return redirect('/admin/listProduct')->with('status', 'Product added successfully');
    }

    /**
     *  Update product data view
     */
    public function editProduct(Request $request, $id)
    {
        $adminuser = Auth::guard('admin')->user();

        $product = DB::table('product')
            ->leftJoin('productImage', 'productImage.product_id', '=', 'product.id')
            ->select('productImage.imageName', 'productImage.id as imageId', 'product.*')
            ->where('product.id', $id)
            ->get();
        $productData = array();
        foreach ($product as $value) { 
            $productData['images'][$value->imageId] = $value->imageName;
        }
        $productData['id'] = $product[0]->id;
        $productData['name'] = $product[0]->name;
        $productData['title'] = $product[0]->title; 
        $productData['videoLink'] = $product[0]->videoLink;
        $productData['qrCodeText'] = $product[0]->qrCodeText;
        $productData['description'] = $product[0]->description;
        $productData['pin'] = $product[0]->pin;

        return view('admin.editProduct', ['adminuser' => $adminuser, 'product' => $productData, 'title' => "Admin Dashboard", 'page_title' => 'Edit Product', 'linkData' => $this->data]);
    }

    /**
     *  update product data
     */
    public function updateProduct(Request $request, $id)
    {
        $input = $request->all();
    
        $rules = array(
            'name' => 'required',
            'description' => 'required',
            'title' => 'required',
            'video' => 'required',
            'qrCodeText' => 'required',
            'pin' => 'required | numeric'
        );
        $validation = Validator::make($input, $rules);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation);
        }
        $productData = array(
            'name' => $request->get('name'),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'qrCodeText' => $request->get('qrCodeText'),
            'pin' => $request->get('pin'),
        );

        $newVideo = $request->file('video');

        if($newVideo) {
            $videoFilePath = getcwd() . '/assets/productVideo/';
            $oldVideo = Product::where('id', $id)->first();
            if (File::exists($videoFilePath . '/' . $oldVideo->name)) {
                File::delete($videoFilePath . '/' . $oldVideo->name);
            }

            $date = new DateTime();
            $timestamp = $date->getTimestamp();
            $filename = $timestamp . $newVideo->getClientOriginalName();
            $destination_path = getcwd() . '/assets/productVideo/';
            $newVideo->move($destination_path, $filename);
            $productData['videoLink'] = $timestamp . $newVideo->getClientOriginalName();
        }

        $newImage = $request->file('image');
        print_r($newImage);
        $oldImages = $request->get('oldImages');
       
    
        // dd($newImage);
        $imageFilePath = getcwd().'/assets/productImage/';

        if($newImage) {

            foreach ($newImage as $key => $image) {
                if($image !== null){
                    $oldImage = explode("#", $oldImages[$key]);
                    $oldImageName = $oldImage[0];
                    $oldImageId = $oldImage[1];
                    if(File::exists($imageFilePath. '/' . $oldImageName)) {
                        File::delete($imageFilePath . '/' . $oldImageName);
                    }

                    $date = round(microtime(true) * 1000);

                    $filename = $date.$image->getClientOriginalName();

                    //changed path
                    $destination_path = $imageFilePath;
                    $image->move($destination_path, $filename);
                    $productImage['imageName'] = $filename;
                    $productSave = ProductImage::where('id', $oldImageId)->update($productImage);
                }
            }

        }

        //save the product data
        $product = Product::where('id', $id)->update($productData);

        return redirect('/admin/listProduct')->with('status', 'Product updated successfully');
    }


    /**
     *  Delete Product
     */
    public function deleteProduct(Request $request, $id)
    {
        Product::where('id', $id)->delete();
        return redirect('admin/listProduct')->with('status', 'Product deleted successfully');
    }
    
}
