<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\Category;
use Auth;
use App\Model\Purchase;

class DefaultController extends Controller
{
    public function getCategory(Request $request){
    	$supplier_id = $request->id;
    	$allCategory = Product::with('category')->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
    	//dd($allCategory);
    	return response()->json($allCategory);
    	 
    }
    public function getProduct(Request $request){
    	$category_id = $request->product_id;
    	$allProduct = Product::where('category_id',$category_id)->get();
    	//dd($allProduct);
    	return response()->json($allProduct);
    	 
    }
}
