@extends('layouts.app')

@section('content')


<section class="content-header">
           <h3 class="text-center">Stock Report</h3>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
            <h2 class="text-center">Product Stock Report</h2>
           	<hr>
            <table class="table table-striped">
            	<thead>
            		<tr>
	            		<th>SL.</th>
	            		<th>Supplier Name</th>
	            		<th>Category</th>
	            		<th>Product Name</th>
	            		<th>Stock</th>
	            		<th>Unit</th>
            		</tr>
            	</thead>
            	<tbody>
            		@php $no=1 @endphp
            		@foreach($productreports as $report)
            		<tr>
            			<td scope="row">{{$no++}}</td>
            			<td scope="row">{{$report->supplier->name}}</td>
            			<td scope="row">{{$report->category->category_name}}</td>
            			<td scope="row">{{$report->product->product_name}}</td>
            			<td scope="row">{{$report->buying_qty}}</td>
            			<td scope="row">{{$report->product->unit->unit}}</td>
            		</tr>
            		@endforeach
                    <tr style="background-color: gray; color: white">
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row">Current Quantity</td>
                        <td scope="row">{{$report->product->quantity}}</td>
                        <td scope="row">{{$report->product->unit->unit}}</td>
                    </tr>
            	</tbody>
            </table>
        </div>
        </div>
    </div>
       
@endsection