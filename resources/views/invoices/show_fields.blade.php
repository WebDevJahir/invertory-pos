<!-- Invoice No Field -->
<div class="form-group">
    {!! Form::label('invoice_no', 'Invoice No:') !!}
    <p>{{ $invoice->invoice_no }}</p>
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', 'Date:') !!}
    <p>{{ $invoice->date }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $invoice->description }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $invoice->status }}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $invoice->created_by }}</p>
</div>

<!-- Approved By Field -->
<div class="form-group">
    {!! Form::label('approved_by', 'Approved By:') !!}
    <p>{{ $invoice->approved_by }}</p>
</div>

