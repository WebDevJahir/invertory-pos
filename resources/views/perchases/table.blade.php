<div class="table-responsive">
    <table class="table" id="perchases-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Supplier Name</th>
                <th>Category Name</th>
                <th>Product Name</th>
                <th>Purchase No</th>
                <th>Description</th>
                <th>Buying Qty</th>
                <th>Unit Price</th>
                <th>Buying Price</th>
                <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($perchases as $perchase)
            <tr>
            <td>{{ $perchase->date }}</td>
            <td>{{ $perchase->supplier->name }}</td>
            <td>{{ $perchase->category->category_name }}</td>
            <td>{{ $perchase->product->product_name }}</td>
            <td>{{ $perchase->purchase_no }}</td>
            <td>{{ $perchase->description }}</td>
            <td>{{ $perchase->buying_qty }} {{$perchase->product->unit->unit}}</td>
            <td>{{ $perchase->unit_price }}</td>
            <td>{{ $perchase->buying_price }}</td>
            <td>@if($perchase->status == 0)<span style="color: red;">pending</span>  @else <span style="color: Green;">Approved</span> @endif</td>
                <td>
                    {!! Form::open(['route' => ['perchases.destroy', $perchase->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('perchases.show', [$perchase->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('perchases.edit', [$perchase->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit" ></i></a>
                        @if($perchase->status =='0')
                        <a href="{{ url('perchases/approved', [$perchase->id]) }}" class='btn btn-default btn-xs' onclick ="return confirm('Are you sure to approve?')"><i class="glyphicon glyphicon-ok"></i></a>
                        @endif
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

