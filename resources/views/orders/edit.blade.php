@extends('layouts.admin')

@section('title', 'Edit Order')
@section('content-header', 'Edit Order')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('orders.update', $order) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" name="subject" class="form-control @error('subject') is-invalid @enderror" id="subject"
                    placeholder="Subject" value="{{ old('subject', $order->subject) }}">
                @error('subject')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                    id="description"
                    placeholder="description">{{ old('description', $order->description) }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>



            <div class="form-group">
                <label for="expected_delivery_date">Expected Delivery Date</label>
                <input type="date" name="expected_delivery_date" class="form-control @error('expected_delivery_date') is-invalid @enderror"
                    id="expected_delivery_date" placeholder="expected_delivery_date" value="{{ old('expected_delivery_date', $order->expected_delivery_date) }}">
                @error('expected_delivery_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
    });
</script>
@endsection