<!-- Supplier Id Field -->
<div class="form-group">
    {!! Form::label('supplier_id', 'Supplier Name:') !!}
    <p>{{$perchase->supplier->name}}</p>
</div>

<!-- Category Id Field -->
<div class="form-group">
    {!! Form::label('category_id', 'Category:') !!}
    <p>{{ $perchase->category->category_name }}</p>
</div>

<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', 'Product:') !!}
    <p>{{ $perchase->product->product_name }}</p>
</div>

<!-- Purchase No Field -->
<div class="form-group">
    {!! Form::label('purchase_no', 'Purchase No:') !!}
    <p>{{ $perchase->purchase_no }}</p>
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $perchase->date }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $perchase->description }}</p>
</div>

<!-- Buying Qty Field -->
<div class="form-group">
    {!! Form::label('buying_qty', 'Buying Qty:') !!}
    <p>{{ $perchase->buying_qty }} {{$perchase->product->unit->unit}}</p>
</div>

<!-- Unit Price Field -->
<div class="form-group">
    {!! Form::label('unit_price', 'Unit Price:') !!}
    <p>{{ $perchase->unit_price }}</p>
</div>

<!-- Buying Price Field -->
<div class="form-group">
    {!! Form::label('buying_price', 'Buying Price:') !!}
    <p>{{ $perchase->buying_price }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>@if($perchase->status==0) Pending @else Approve @endif</p>
</div>

