
<!-- Invoice No Field -->
<div class="form-group col-sm-6">
    <label>Invoice No</label>
    <input type="text" name="invoice_no" id="invoice_no" class="form-control form-control-sm" readonly style="background-color: #D8FDBA" value="{{$invoice_no}}">
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('maindate', 'Date:') !!}
    <input type="date" id="maindate" name="maindate" class="form-control" >
</div>

<!-- Category Id Field -->
<div class="form-group col-sm-6">
    <label>Category</label>
    <select name="category_id" id="category_id" class="form-control">
        <option>Select Category</option>
        @foreach($data['categories'] as $category)
        <option value="{{$category->id}}" >{{$category->category_name}}</option>
        @endforeach
    </select>
</div>


<!-- Product Id Field -->
<div class="form-group col-sm-6">
<label>Product</label>
   <select name="product_id" id="product_id" class="form-control">
        <option>Select Product</option>
        @foreach($data['products'] as $product)
        <option value="{{$product->id}}" >{{$product->product_name}}</option>
        @endforeach
    </select>
</div>

<!-- Supplier Id Field -->
<div class="form-group col-sm-6">
    <label>Stock(Pcs/Kg)</label>
    <input type="text" name="current_stock_qty" id="current_stock_qty" class="form-control form-control-sm" readonly style="background-color: #D8FDBA">
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
                    <th style="text-align: center;">Pcs/Kg</th>
                    <th style="text-align: center;">Unit price</th>
                    <th style="text-align: center;">Total Price</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody id="addRow" class="addRow">
                
            </tbody>
            <tbody>
                <tr>

                    <td colspan="4" class="text-right">Discount</td>
                    <td>
                        <input type="text" name="discount_amount" value="0" id="discount_amount" class="form-control form-control-sm text-right discount_amount" placeholder="Enter discount Amount">
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right">Grand Total</td>
                    <td>
                        <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly="" style="background-color: :$D8FDBA">
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <br/>
        <div class="form-row">
            <div class="form-group col-sm-12">
                <textarea name="description" class="form-control" id="description" placeholder="White desciption here"></textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-sm-3">
                <label>Paid Status</label>
                <select name="paid_status" id="paid_status" class="form-control form-control-sm">
                    <option value="">Select Status</option>
                    <option value="full_paid">Full Paid</option>
                    <option value="full_due">Full Due</option>
                    <option value="partial_paid">Partial Paid</option>
                </select>
                <input type="text" name="patial_paid_amount" class="form-control form-control-sm paid_status" placeholder="Enter Pain Amount" style="display:none;">
            </div>
            <div class="form-group col-sm-9">
                <label>Customer Name</label>
                <select name="customer_id" id="customer_name" class="form-control form-control-sm">
                    <option value="">Select Customer</option>
                    <option value="0">New Customer</option>
                    @foreach($data['customers'] as $customer) 
                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row new_customer" style="display: none;">
            <div class="form-group col-md-3">
                <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Customer Name">
            </div>
            <div class="form-group col-md-3">
                <input type="text" name="phone" id="phone" class="form-control form-control-sm" placeholder="Customer Name">
            </div>
            <div class="form-group col-md-3">
                <input type="text" name="address" id="address" class="form-control form-control-sm" placeholder="Address">
            </div>
            <div class="form-group col-md-3">
                <input type="text" name="email" id="email" class="form-control form-control-sm" placeholder="Email">
            </div>
        </div>
        <div class="form-group col-sm-3">
            <label></label>
            <button type="submit" class="btn btn-primary" id="storeButton" style="clear:both;">Purchase Store</button>
        </div>
    </form>
</div>










<!-- 
<div class="form-group col-sm-6">
    {!! Form::label('invoice_no', 'Invoice No:') !!}
    {!! Form::text('invoice_no', null, ['class' => 'form-control','maxlength' => 255,'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::date('date', null, ['class' => 'form-control','id'=>'date']) !!}
</div>

@push('scripts')
    <script type="text/javascript">
        $('#date').datepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        })
    </script>
@endpush


<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('status', 0) !!}
        {!! Form::checkbox('status', '1', null) !!}
    </label>
</div>


<div class="form-group col-sm-6">
    {!! Form::label('created_by', 'Created By:') !!}
    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('approved_by', 'Approved By:') !!}
    {!! Form::number('approved_by', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('invoices.index') }}" class="btn btn-default">Cancel</a>
</div> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.6/handlebars.min.js" ></script>
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
     $(function(){
        $(document).on('change','#product_id',function(){
            var product_id = $(this).val();
            $.ajax({
                url:"{{url('get/stock')}}",
                type:"GET",
                data:{product_id:product_id},
                success:function(data){
                    $('#current_stock_qty').val(data);
                }
            })
        })
     })
 </script>
 <script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
        <input type="hidden" name="date[]" value="@{{date}}">
        <input type="hidden" name="invoice_no" value="@{{invoice_no}}">
        <td>
            <input type="hidden" name="category_id[]" value="@{{category_id}}">
            @{{category_name}}
        </td>
        <td>
            <input type="hidden" name="product_id[]" value="@{{product_id}}">
            @{{product_name}}
        </td>
        <td>
            <input type="number" min="1" class="form-control form-control-sm text-right selling_qty" name="selling_qty[]" value="1">
        </td>
        <td>
            <input type="number" min="1" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="1">
        </td>

        <td> <input class="form-control form-control-sm text-right selling_price" name="selling_price[]" value="0">
        </td>

        <td><i class="btn btn-danger btn-sm fa fa-minus removeeventmore"></i></td>

    </tr>

</script>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click','.addeventmore',function(){
            var date = $('#date').val();
            var invoice_no = $('#invoice_no').val();
            var category_id = $('#category_id').val();
            var category_name = $('#category_id').find('option:selected').text();
            var product_id = $('#product_id').val();
            var product_name = $('#product_id').find('option:selected').text();
        if(date == ''){
            $.notify("Date is required", {globalPosition: 'top right', className:'error'});
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
            invoice_no:invoice_no,
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
        $(document).on('keyup click','.unit_price,.selling_qty',function(){
            var unit_price = $(this).closest('tr').find("input.unit_price").val();
            var qty = $(this).closest('tr').find("input.selling_qty").val();
            var total = unit_price*qty;
            $(this).closest("tr").find("input.selling_price").val(total);
            $('#discount_amount').trigger('keyup');
        });

        $(document).on('keyup','#discount_amount',function(){
            totalAmountPrice();
        });

        function totalAmountPrice(){
            var sum = 0;
            $(".selling_price").each(function(){
                var value = $(this).val();
                if(!isNaN(value) && value.length !=0){
                    sum += parseFloat(value);
                }
            });
            var discount_amount = parseFloat($('#discount_amount').val());
            if (!isNaN(discount_amount) && discount_amount.length !=0) {
                sum -= parseFloat(discount_amount);
            }
            $('#estimated_amount').val(sum);
        }
    })
</script>

<script type="text/javascript">
    $(document).on('change','#paid_status',function(){
        var paid_status = $(this).val();

        if (paid_status=='partial_paid') {
            $('.paid_status').show();
        }else{
            $('.paid_status').hide();
        }
    })
</script>

<script type="text/javascript">
    $(document).on('change','#customer_name',function(){
        var customer = $('#customer_name').val();
        if(customer == 0){
            $('.new_customer').show();
        }else{
            $('.new_customer').hide();
        }
    });
</script>