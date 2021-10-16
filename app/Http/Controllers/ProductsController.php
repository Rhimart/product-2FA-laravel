<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexWeb()
    {
        //
        $products = [];
        $categories = Products::select('category')->distinct()->get();

        foreach($categories as $category){
            // echo $category->category;
            $query = Products::where('category', $category->category)->get();
            $products[$category->category] = $query;
        }
        // return $categories;
        // return $products;
        return view('mega-menu')->with('products', $products);
    }
    public function indexAPI()
    {
        //
        $products = Products::all();
        return $products;
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
    public function storeWeb(Request $request)
    {
        //
        
    }
    public function storeAPI(Request $request)
    {
        //
        $product = Products::create([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'quantity' => $request->quantity,
        ]);
        return $product;
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function showWeb($productId)
    {
        //
        $product = Products::findOrFail($productId);
        return $product;
    }
    public function showAPI($productId)
    {
        //
        $product = Products::findOrFail($productId);
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit($productId)
    {
        //
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productId)
    {
        //
    }

    public function editAPI($productId, Request $request)
    {
        //
        $product = Products::findOrFail($productId);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->save();
        return $product;

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroyWeb($productId)
    {
        //
    }
    public function destroyAPI($productId)
    {
        //
        $product = Products::findOrFail($productId);
        $product->delete();
    }
}
