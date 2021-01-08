@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Invoice No #{{$invoice->invoice_no}} {{$invoice->date}}</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('invoices.index') }}">Invoice List</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        	<div class="box box-primary">
        		@php 
        			$payment = App\Models\Payment::where('invoice_id',$invoice->id)->first();
        		@endphp
          		<div class="box-body">
          			<table width="100%">
          				<tbody>
          					<tr>
          						<td width="15%"><p><strong>Customer Info</strong></p></td>
          						<td width="25%"><p><strong>Name: </strong>{{$payment->customer->name}}</p></td>
          						<td width="25%"><p><strong>Mobile No: </strong>  {{$payment->customer->phone}}</p></td>
          						<td width="35%"><p><strong>Address: </strong> {{$payment->customer->address}}</p></td>
          					</tr>
          					<tr>
          						<td width="15%"></td>
          						<td width="85%" colspan="3"><p><strong>Description:</strong>{{$invoice->description}}</p></td>
          					</tr>
          				</tbody>
          			</table>
          			<form method="post" action="{{url('confirm/approve',$invoice->id)}}">
          				@csrf
          			<table border="1" width="100%">
          				<thead>
          					<tr>
          						<th class="text-center">SL.</th>
          						<th class="text-center">Category</th>
          						<th class="text-center">Product Name</th>
          						<th class="text-center">Current Stock</th>
          						<th class="text-center">Quantity</th>
          						<th class="text-center">Unit Price</th>
          						<th class="text-center">Total Price</th>
          					</tr>
          				</thead>
          				<tbody>
          					@php $sum = 0; $count = 1 @endphp
          					@foreach($invoice->invoice_details as $invoiceDetail)
          					<tr>
          						<input type="hidden" name="category_id[]" value="{{$invoiceDetail->category_id}}">
          						<input type="hidden" name="product_id[]" value="{{$invoiceDetail->product_id}}">
          						<input type="hidden" name="selling_qty[{{$invoiceDetail->id}}]" value="{{$invoiceDetail->selling_qty}}">
          						<td class="text-center">{{$count++}}</td>
          						<td class="text-center">{{$invoiceDetail->category->category_name}}</td>
          						<td class="text-center">{{$invoiceDetail->product->product_name}}</td>
          						<td class="text-center">{{$invoiceDetail->product->quantity}}</td>
          						<td class="text-center">{{$invoiceDetail->selling_qty}}</td>
          						<td class="text-center">{{$invoiceDetail->unit_price}}</td>
          						<td class="text-center">{{$invoiceDetail->selling_price}}</td>
          					</tr>
          					{{ $sum += $invoiceDetail->selling_price }}
          					@endforeach
          					<tr>
          						<td colspan="6" class="text-right"><strong>Sub Total</strong> </td>

          						<td class="text-center">{{$sum}}</td>
          					</tr>
          					<tr>
          						<td colspan="6" class="text-right"><strong>Discount</strong> </td>
          						
          						<td class="text-center">{{$payment->discount_amount}}</td>
          					</tr>
          					<tr>
          						<td colspan="6" class="text-right"><strong>Paid Amount</strong> </td>
          						
          						<td class="text-center">{{$payment->paid_amount}}</td>
          					</tr>
          					<tr>
          						<td colspan="6" class="text-right"><strong>Due Amount</strong> </td>
          						
          						<td class="text-center">{{$payment->due_amount}}</td>
          					</tr>
          					<tr>
          						<td colspan="6" class="text-right"><strong>Grand Total</strong> </td>
          						
          						<td class="text-center">{{$sum - $payment->paid_amount}}</td>
          					</tr>
          				</tbody>
          			</table>
          			@if($invoice->status == '0')
          			<button type="submit" class="btn btn-success" style="margin-top: 20px;">Invoice Approve</button>
          			@endif
          		</form>
				</div>

        	</div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection