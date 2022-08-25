@extends('layouts.layout')
@section('main-content')
<section class="content-header">
    <div class="container-fluid">
      <h2 class="text-center display-4">History Transaction</h2>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
          <div class="row mt-3">
              <div class="col-md-10 offset-md-1">
                  <div class="list-group">
                      @foreach ($histories as $item)
                      <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo" style="max-height: 160px;">
                            </div>
                            <div class="col px-4">
                                <div>
                                    <div class="float-right">Order Date: {{ $item['order_date'] }} || Order Quantity: {{ $item['order_qty'] }}</div>
                                    <h3>{{ $item['name'] }}</h3>
                                    <p class="mb-0">Total Harga: {{ $item['price'] * $item['order_qty'] }}</p>
                                    <p class="mb-0">{{ $item['description'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                      @endforeach

                  </div>
              </div>
          </div>
      </div>
  </section>
@endsection
