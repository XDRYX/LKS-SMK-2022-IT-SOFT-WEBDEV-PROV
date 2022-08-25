@extends('layouts.layout')
@section('main-content')
@if (session("checkout.success"))
    {!! session("checkout.success") !!}
@endif
    <section class="content-header">
        <div class="container-fluid">
            <h2 class="text-center display-4">Cart</h2>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="simple-results.html">
                        <div class="input-group input-group-lg">
                            <input type="search" class="form-control form-control-lg" placeholder="Type your keywords here"
                                value="Lorem ipsum">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-10 offset-md-1">
                    <div class="list-group">
                        @foreach ($products as $index => $item)
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo"
                                            style="max-height: 160px;">
                                    </div>
                                    <div class="col px-4">
                                        <div>
                                            <div class="float-right">Rp {{ $item['price'] }}</div>
                                            <h3>{{ $item['name'] }}</h3>
                                            <p class="mb-0">{{ $item['description'] }}</p>
                                            <p class="mb-0">Quantity:
                                                {{ $carts->where('productID', $item['id_product'])->first()['productQty'] }}
                                            </p>
                                            <form action="{{ route('remove.cart', ['index' => $index]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">REMOVE FROM CART</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="row mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="d-none">
                                    <th>Task</th>
                                    <th>Progress</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Sub Total</td>
                                    <td>Rp {{ $subtotal }}</td>
                                </tr>
                                <tr>
                                    <td>5% Fee</td>
                                    <td>Rp {{ $fee }}</td>
                                </tr>
                                <tr>
                                    <td>Ammount to pay</td>
                                    <td>Rp {{ $total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row mt-4 mb-4">
                        <form action="{{ route('post.order') }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-primary">CHECKOUT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
