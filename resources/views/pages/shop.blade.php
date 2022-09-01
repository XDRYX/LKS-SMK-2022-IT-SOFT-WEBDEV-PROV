@extends('layouts.layout')
@section('main-content')
<section class="content-header">
    <div class="container-fluid">
      <h2 class="text-center display-4">Search</h2>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-8 offset-md-2">
                  <form action="" method="GET">
                      <div class="input-group input-group-lg">
                          <input name="search" type="search" class="form-control form-control-lg" placeholder="Type your keywords here" value="Lorem ipsum">
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
                      @foreach ($products as $item)
                      <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo" style="max-height: 160px;">
                            </div>
                            <div class="col px-4">
                                <div>
                                    <div class="float-right">Rp {{ $item['price'] }}</div>
                                    <h3>{{ $item['name'] }}</h3>
                                    <p class="mb-0">{{ $item['description'] }}</p>
                                    <a href="{{ route('view.add-to-cart', ['productid' => $item['id_product']]) }}" class="btn btn-primary">ADD TO CART</a>
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
