<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perchase;
class StockController extends Controller
{
    public function stockReport(Request $request){
    	if($request->method('post')){
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $reports = Perchase::with('product','supplier','category')->whereBetween('date',[$start_date,$end_date])->where('status','1')->get();
      }
     
        return view('stock.stock',compact('start_date','end_date'))->with('reports',$reports);
    }
    }

