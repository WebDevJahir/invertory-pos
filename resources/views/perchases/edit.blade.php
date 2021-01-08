@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Perchase
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($perchase, ['route' => ['perchases.update', $perchase->id], 'method' => 'patch']) !!}

                       <!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    <input type="text" id="date" name="date" class="form-control">
</div>





<!-- Supplier Id Field -->
<div class="form-group col-sm-6">
    <label>Supplier</label>
    <select name="supplier_id" id="supplier_id" class="form-control">
        <option>Select Supplier</option>
        @foreach($suppliers as $supplier)
        <option value="{{$supplier->id}}">{{$supplier->name}}</option>
        @endforeach
    </select>
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    <label>Category</label>
    <select name="category_id" id="category_id" class="form-control">
        <option>Select Category</option>
        @foreach($categories as $category)
        <option value="{{$category->id}}" >{{$category->category_name}}</option>
        @endforeach
    </select>
</div>

<!-- Product Id Field -->
<div class="form-group col-sm-6">
<label>Product</label>
   <select name="product_id" id="product_id" class="form-control">
        <option>Select Product</option>
        @foreach($products as $product)
        <option value="{{$product->id}}" >{{$product->product_name}}</option>
        @endforeach
    </select>
</div>

<!-- Purchase No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('purchase_no', 'Purchase No:') !!}
    {!! Form::text('purchase_no', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>
<div class="form-group col-sm-2" style="padding-top: 28px;">
        <i class="btn btn-primary fa fa-plus addeventmore">Add Item</i>
</div>
<div class="card-body" style="margin:15px">
    <form method="post" action="" id="myForm">
        @csrf
        <table class="table-sm table-bordered" width="100%" style="align:center">
            <thead>
                <tr>
                    <th style="text-align: center;">Category</th>
                    <th style="text-align: center;">Product Name</th>
                    <th style="text-align: center;">PCS/KGS</th>
                    <th style="text-align: center;">Unit price</th>
                    <th style="text-align: center;">Description</th>
                    <th style="text-align: center;">Total Price</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody id="addRow" class="addRow">
                
            </tbody>
            <tbody>
                <tr>
                    <td colspan="5"> </td>
                    <td>
                        <input type="text" name="extimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right extimated_amount" readonly="" style="background-color: :$D8FDBA">
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <br>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" id="storeButton">Purchase Store</button>
        </div>
    </form>
</div>




<!-- 
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('buying_qty', 'Buying Qty:') !!}
    {!! Form::number('buying_qty', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('unit_price', 'Unit Price:') !!}
    {!! Form::number('unit_price', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('buying_price', 'Buying Price:') !!}
    {!! Form::number('buying_price', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null) !!}
    </label>
</div>



<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('perchases.index') }}" class="btn btn-default">Cancel</a>
</div>
 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js" ></script>

 <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','#supplier_id',function(){
            var supplier_id = $(this).val();
            $.ajax({
                url:"{{url('/get-category')}}",
                type:"GET",
                data: {id:supplier_id},
                success:function(data){
                    var html = '<option value="">Select Category</option>';
                    $.each(data,function(key,v){
                        html +='<option value="'+v.category_id+'">'+v.category.category_name+'</option>';
                    });
                    $('#category_id').html(html);
                }
            });
        });
     });
 </script>
  <script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','#category_id',function(){
            var category_id = $(this).val();
            $.ajax({
                url:"{{url('/get-product')}}",
                type:"GET",
                data: {product_id:category_id},
                success:function(data){
                    var html = '<option value="">Select Product</option>';
                    $.each(data,function(key,v){
                        html +='<option value="'+v.id+'">'+v.product_name+'</option>';
                    });
                    $('#product_id').html(html);
                }
            });
        });
     });
 </script>

     <script type="text/javascript">
        $('#date').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true
        })
    </script>


<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
        <input type="hidden" name="date[]" value="@{{date}}">
        <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
        <input type="hidden" name="supplier_id[]" value="@{{supplier_id}}">
        <td>
            <input type="hidden" name="category_id[]" value="@{{category_id}}">
            @{{category_name}}
        </td>
        <td>
            <input type="hidden" name="product_id[]" value="@{{product_id}}">
            @{{product_name}}
        </td>
        <td>
            <input type="number" min="1" class="form-control form-control-sm text-right buying_qty" name="buying_qty[]" value="1">
        </td>
        <td>
            <input type="number" min="1" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="1">
        </td>
        <td>
            <input type="text" class="form-control form-control-sm" name="description[]">
        </td>
        <td> <input class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="0">
        </td>

        <td><i class="btn btn-danger btn-sm fa fa-minus removeeventmore"></i></td>

    </tr>

</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click','.addeventmore',function(){
            var date = $('#date').val();
            var purchase_no = $('#purchase_no').val();
            var supplier_id = $('#supplier_id').val();
            var supplier_name = $('supplier_id').find('option:selected').text();
            var category_id = $('#category_id').val();
            var category_name = $('#category_id').find('option:selected').text();
            var product_id = $('#product_id').val();
            var product_name = $('#product_id').find('option:selected').text();
        if(date == ''){
            $.notify("Date is required", {globalPosition: 'top right', className:'error'});
            return false;
        }

        if(supplier_id == ''){
            $.notify("Supplier is required", {globalPosition: 'top right', className:'error'});
            return false;
        }
        if(category_id == ''){
            $.notify('Category is required', {globalPosition: 'top right', className:'error'});
            return false;
        }
        if(product_id == ''){
            $.notify('Product is required', {globalPosition: 'top right', className:'error'});
            return false;
        }

        var source = $('#document-template').html();
        var template = Handlebars.compile(source);
        var data={
            date:date,
            purchase_no:purchase_no,
            supplier_id:supplier_id,
            supplier_name:supplier_name,
            category_id:category_id,
            category_name:category_name,
            product_id:product_id,
            product_name:product_name
        };
        var html=template(data);
        $('#addRow').append(html);
        });
        $(document).on("click",".removeeventmore", function(event){
            $(this).closest('.delete_add_more_item').remove();
            totalAmountPrice();
        });
        $(document).on('keyup click','.unit_price,.buying_qty',function(){
            var unit_price = $(this).closest('tr').find("input.unit_price").val();
            var qty = $(this).closest('tr').find("input.buying_qty").val();
            var total = unit_price*qty;
            $(this).closest("tr").find("input.buying_price").val(total);
            totalAmountPrice();
        });

        function totalAmountPrice(){
            var sum = 0;
            $(".buying_price").each(function(){
                var value = $(this).val();
                if(!isNaN(value) && value.length !=0){
                    sum += parseFloat(value);
                }
            });
            $('#estimated_amount').val(sum);
        }
    })
</script>

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection