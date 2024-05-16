@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="w-25 mx-auto">
            <h2>Update cart Tax</h2>
            <form action="{{ route('cart.updateTax') }}" method="post">
                @csrf
                <div class="form-group mb-2">
                    <label for="tax_percentage">Tax Percentage (%)</label>
                    <input type="number" class="form-control" id="tax_percentage" name="tax_percentage" min="0"
                        step="0.01">
                </div>
                <button type="submit" class="btn btn-primary">Update Tax</button>
            </form>
        </div>
    </div>
@endsection
