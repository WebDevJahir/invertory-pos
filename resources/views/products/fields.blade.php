<!-- Supplier Id Field -->
<div class="form-group col-sm-6">
    <select name="supplier_id" class="form-control">
        <option>Select Supplier</option>
        @foreach($suppliers as $supplier)
        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
        @endforeach
    </select>
</div>

<!-- Unit Id Field -->
<div class="form-group col-sm-6">
<select name="unit_id" class="form-control">
        <option>Select Unit</option>
        @foreach($units as $unit)
        <option value="{{$unit->id}}" >{{$unit->unit}}</option>
        @endforeach
    </select>
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    <select name="category_id" class="form-control">
        <option>Select Category</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}" >{{$category->category_name}}</option>
        @endforeach
    </select>
</div>

<!-- Product Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_name', 'Product Name:') !!}
    {!! Form::text('product_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>
</div>
