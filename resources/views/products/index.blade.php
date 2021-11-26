@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href={{route('products.create')}} class="btn btn-primary float-left">Add New Product</a>
                    <br><br>
                    <table Border=2 class="text-center col-md-8" >
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                        </tr>
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2"> No Product Found!!!</td>
                        </tr>
                        @endforelse   
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
