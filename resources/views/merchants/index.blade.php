@extends('layouts.admin')

@section('title', 'Merchant List')
@section('content-header', 'Merchant List')
@section('content-actions')
    <a href="{{route('merchants.create')}}" class="btn btn-primary disabled">Add Merchant</a>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
@endsection
@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table dataTable display">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Logo/Avatar</th>
                    <th>Title</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($merchants as $merchant)
                    <tr>
                        <td>{{$merchant->id}}</td>
                        <td>
                            <img width="50" src="{{$merchant->getAvatarUrl()}}" alt="">
                        </td>
                        <td>{{$merchant->business_name}}</td>
                        <td>{{$merchant->first_name}}</td>
                        <td>{{$merchant->last_name}}</td>
                        <td>{{$merchant->email}}</td>
                        <td>{{$merchant->phone}}</td>
                        <td>{{$merchant->address}}</td>
                        <td>{{$merchant->created_at}}</td>
                        <td>
                            <a href="{{ route('merchants.edit', $merchant) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <button class="btn btn-danger btn-delete" data-url="{{route('merchants.destroy', $merchant)}}"><i
                                    class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $merchants->render() }}
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-delete', function () {
                $this = $(this);
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                    title: 'Are you sure?',
                    text: "Do you really want to delete this merchant?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.post($this.data('url'), {_method: 'DELETE', _token: '{{csrf_token()}}'}, function (res) {
                            $this.closest('tr').fadeOut(500, function () {
                                $(this).remove();
                            })
                        })
                    }
                })
            })
        })
    </script>
@endsection
