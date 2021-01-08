@extends('layouts.app')

@section('content')


<section class="content-header">
           <h3 class="text-center">Daily Report</h3>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <form method="post" action="/daily-report">
                	@csrf
					<!-- Date Field -->
				<div class="form-group col-md-6">
				    {!! Form::label('start_date', 'Start Date:') !!}
				     <input type="date" id="start_date" name="start_date" class="form-control " >
				</div>
				<!-- Date Field -->
				<div class="form-group col-md-6">
				    {!! Form::label('end_date', 'End Date:') !!}
				    <input type="date" id="end_date" name="end_date" class="form-control " >
				</div>
				<div class="form-group col-sm-3">
            	<button type="submit" class="btn btn-primary" id="storeButton" style="clear:both;">Report</button>
        		</div>
				</form>
            </div>
            <h2 class="text-center"> Daily Invoice Report({{date('d-m-Y',strtotime($start_date))}}-{{date('d-m-Y',strtotime($end_date))}})</h2>
           	<hr>
            <table class="table table-striped">
            	<thead>
            		<tr>
	            		<th>SL.</th>
	            		<th>Customer Name</th>
	            		<th>Invoice No</th>
	            		<th>Date</th>
	            		<th>Description</th>
	            		<th>Amount</th>
            		</tr>
            	</thead>
            	<tbody>
            		@php $no=1 @endphp
            		@foreach($reports as $report)
            		<tr>
            			<td scope="row">{{$no++}}</td>
            			<td scope="row">{{$report->payment->customer->name}}</td>
            			<td scope="row">{{$report->invoice_no}}</td>
            			<td scope="row">{{$report->date}}</td>
            			<td scope="row">{{$report->description}}</td>
            			<td scope="row">{{$report->payment->total_amount}}</td>
            		</tr>
            		@endforeach
            	</tbody>
            </table>
        </div>
    </div>
       
@endsection