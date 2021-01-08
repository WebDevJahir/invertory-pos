<div class="table-responsive">
    <table class="table" id="invoices-table">
        <thead>
        <tr >
        <th>SL.</th>
        <th>Customer Name</th>
        <th colspan="1">Invoice No</th>
        <th>Date</th>
        <th>Description</th>
        <th>Paid Status</th>
        <th>status</th>
        <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr style="background: gray;">
            <td @if($invoice->payment->paid_status == "full_paid") style="color:green" @else style="color:red" @endif>{{ $invoice->id}}</td>
            <td>{{ $invoice->payment->customer->name }}</td>
            <td>{{ $invoice->invoice_no }}</td>
            <td>{{ $invoice->date }}</td>
            <td>{{ $invoice->description }}</td>
            <td>@if($invoice->payment->paid_status=="full_paid")<span style="color:lime">Full Paid</span> @elseif($invoice->payment->paid_status=="full_due") <span style="color:red">Full Due</span> @else <span style="color:red">Partial Due</span> @endif </td>
            <td>@if($invoice->status == 0) <span style="color:red;">Pending</span> @else <span style="color:lime;">Approved</span> @endif</td>
                <td>
                    {!! Form::open(['route' => ['invoices.destroy', $invoice->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('invoices.show', [$invoice->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('invoices.edit', [$invoice->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="{{ url('/print',[$invoice->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-print"></i></a>
                        <a href="{{ url('invoice/approved', [$invoice->id]) }}" class='btn btn-default btn-xs' onclick ="return confirm('Are you sure to approve?')"><i class="glyphicon glyphicon-ok"></i></a>

                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>

            <tr>
                <th></th>
                <th></th>
                <th class="text-center">SL</th>
                <th class="text-center">Product Name</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Unit Price</th>
                <th class="text-center">Total Price</th>
            </tr>
    
            @php $sum = 0; $count = 1 @endphp
            @foreach($invoice->invoice_details as $invoiceDetail)
            <tr>
                <input type="hidden" name="category_id[]" value="{{$invoiceDetail->category_id}}">
                <input type="hidden" name="product_id[]" value="{{$invoiceDetail->product_id}}">
                <input type="hidden" name="selling_qty[{{$invoiceDetail->id}}]" value="{{$invoiceDetail->selling_qty}}">
                <td></td>
                <td></td>
                <td class="text-center">{{$count++}}</td>
                <td class="text-center">{{$invoiceDetail->product->product_name}}</td>
                <td class="text-center">{{$invoiceDetail->selling_qty}}</td>
                <td class="text-center">{{$invoiceDetail->unit_price}}</td>
                <td class="text-center">{{$invoiceDetail->selling_price}}</td>
            </tr>
            @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
