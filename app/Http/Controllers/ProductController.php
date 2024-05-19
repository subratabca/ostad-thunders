<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.pages.product.index-page',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.product.create-page');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name'        => 'required|string|max:100',
            'price'       => 'required|string|max:100',
            'description' =>'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'name.required' => 'The name field is required.',
            'price.required' => 'The price field is required.',
            'description.required' => 'The description field is required.',
            'image.required' => 'Please upload image.',
            'image.mimes' => 'Image must be jpeg,png,jpg format.',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);

            $img->resize(400,300)->save(public_path('/upload/product/large/'.$imageName));
            $img->resize(350,250)->save(public_path('/upload/product/medium/'.$imageName));
            $img->resize(300,200)->save(public_path('/upload/product/small/'.$imageName));

            $uploadImagePath = $imageName;
        } else {
            $uploadImagePath = null; 
        }

        Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $uploadImagePath,
        ]);

        $notification=array(
            'message'=>'Product Created Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route("product.index")->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
      return view('backend.pages.product.edit-page', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //dd($request->all());
        $request->validate([
            'name'        => 'required|string|max:100',
            'price'       => 'required|string|max:100',
            'description' =>'required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'name.required' => 'The name field is required.',
            'price.required' => 'The price field is required.',
            'description.required' => 'The description field is required.',
            'image.required' => 'Please upload image.',
            'image.mimes' => 'Image must be jpeg,png,jpg format.',
        ]);


        if($request->hasFile('image')) {
            $large_picture_path = public_path('/upload/product/large/');
            $medium_picture_path = public_path('/upload/product/medium/');
            $small_picture_path = public_path('/upload/product/small/');

            if(!empty($product->image)){
                if(file_exists($large_picture_path.$product->image)){
                    unlink($large_picture_path.$product->image);
                }
                if(file_exists($medium_picture_path.$product->image)){
                    unlink($medium_picture_path.$product->image);
                }
                if(file_exists($small_picture_path.$product->image)){
                    unlink($small_picture_path.$product->image);
                }
            }

            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $img = $manager->read($image);

            $img->resize(400,300)->save($large_picture_path.$imageName);
            $img->resize(350,250)->save($medium_picture_path.$imageName);
            $img->resize(300,200)->save($small_picture_path.$imageName);

            $uploadImagePath = $imageName;
        }else{
            $uploadImagePath = $product->image;
        }

        $product->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'image' => $uploadImagePath,
        ]);

        $notification=array(
            'message'=>'Product Update Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route("product.index")->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $large_picture_path = public_path('/upload/product/large/');
        $medium_picture_path = public_path('/upload/product/medium/');
        $small_picture_path = public_path('/upload/product/small/');

        if(!empty($product->image)){
            if(file_exists($large_picture_path.$product->image)){
                unlink($large_picture_path.$product->image);
            }
            if(file_exists($medium_picture_path.$product->image)){
                unlink($medium_picture_path.$product->image);
            }
            if(file_exists($small_picture_path.$product->image)){
                unlink($small_picture_path.$product->image);
            }
        }

        $product->delete();
        $notification = [
            'message' => 'Product deleted successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('product.index')->with($notification);
    }

}

