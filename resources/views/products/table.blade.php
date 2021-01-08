<div class="table-responsive">
    <table class="table" id="products-table">
        <thead>
            <tr>
                <th>Supplier Id</th>
        <th>Unit Id</th>
        <th>Category Id</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
            <td>{{ $product->unit }}</td>
            <td>{{ $product->category_name }}</td>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->status }}</td>
                <td>
                    {!! Form::open(['route' => ['products.destroy', $product->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('products.show', [$product->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('products.edit', [$product->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        <a href="{{ url('product/stock', [$product->id]) }}" class='btn btn-default btn-xs'>Stock</a>
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
