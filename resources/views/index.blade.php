@extends('layouts.app')

@php( $items = \App\Models\Item::all() )

@section('styles')
  <link href="{{ asset('css/index.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="banner" class="container">
      <img class="img-fluid" src="{{  asset('img/section 1.png') }}" alt="">
      <div>Just click on the image to see more.</div>
    </div>

    <div id="desc-modal" class="modal fade my-3" tabindex="-1" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content rounded">
                <div class="modal-header py-4">
                    <h2 class="ms-4">Description:</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="position: relative; right: 1.5%"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid row gy-3 mx-auto pe-0">
                        <div class="col-12 col-lg-5 row mt-3">
{{--                            <div id="desc-images" class="col-4">--}}
{{--                            </div>--}}
                            <div id="desc-image-container" class="col-12" style="transform: translateY(-50%); position: relative; top: 50%">
                                <div id="desc-image">
                                    <img class="rounded" src="" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-7 row pe-0">
                            <div id="desc-details" class="mt-3">
                                <div class="row justify-content-between align-items-center">
                                    <div id="desc-title" class="col-8 fs-2"></div>
                                    <div class="col-4 text-end">
                                        <span id="desc-price" class="fs-2"></span>
                                        <span class="fs-3">kzt</span>
                                    </div>
                                </div>
                                <div id="desc-tags" class="py-3 gap-2">
                                    <div class="tag tag-active">Card</div>
                                    <div class="tag tag-active">Family</div>
                                </div>
                                <div id="desc-text" class="px-4 py-3 fs-5 rounded">
                                </div>
                                <div id="desc-count-container">
                                    <div class="fs-4">In stock:</div>
                                    <div class="fs-4" id="desc-count">10</div>
                                </div>
                                <div id="desc-comments-switch" class="py-3">
                                    <div class="fs-4">Comments:</div>
                                    <label class="switch">
                                        <input id="desc-toggle-comments" type="checkbox">
                                        <span class="slider"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row gap-3">
                        <button id="desc-add" type="button" class="col btn fs-4 py-3 px-5 text-nowrap ">Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="comments-dialog" class="modal-dialog modal-lg">
            <div class="modal-content rounded">
                <div id="desc-comments" class="modal-body rounded">
                </div>
            </div>
        </div>
    </div>

    <div id="cart-modal" class="modal fade my-3" tabindex="-1" >
        <div class="modal-dialog modal-xl">
            <div class="modal-content rounded">
                <div class="modal-header p-3">
                    <h2 class="my-2 mx-4">Cart</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid row gy-3 mx-auto">

                        @foreach($items as $item)

                        <div class="cart-item row px-3 py-4">
                            <div class="col-3">
                                <img src="{{ $item->img_path }}" class="rounded" style="transform: translateY(-50%); position: relative; top: 50%"/>
                            </div>
                            <div class="col gx-5 align-items-center d-flex">
                                <div class="row flex-fill">
                                    <div class="col-6 fs-2 my-auto">{{ $item->name }}</div>
                                    <div class="col my-auto text-end text-nowrap">
                                        <span class="fs-4 text-end fw-bold">{{ $item->price }}</span>
                                        <span class="fs-5 text-end "> kzt</span>
                                        <span class="fs-4 text-end "> * </span>
                                        <span class="fs-4 text-end fw-bold">{{ $item->count }}</span>
                                        <span class="fs-5 text-end "> pcs</span>
                                    </div>
                                    <button class="col btn btn-outline-danger rounded ms-2 fs-2" type="submit">X</button>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row gap-3 align-items-center">
                        <div class="col text-nowrap">
                            <span class="fs-4 me-1">Total of:</span>
                            <span class="fs-4 fw-bold">1111102</span>
                            <span class="fs-5"> kzt</span>
                        </div>
                        <button id="desc-buy" type="button" class="col btn py-2 px-4 fs-3 text-nowrap fw-bold">Buy now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="cart" class="rounded-circle" onclick="showCart()">
        <div id="cart-number" class="rounded-circle">
            <div>2</div>
        </div>
        <div id="cart-symbol"><i class="fa-solid fa-cart-shopping"></i></div>
    </div>

    <div id="content" class="container-sm pb-5 mb-5">
      <div class="search-tags col-10 col-md-8 gap-2 my-4 mx-auto row">
        <div class="tag col">Action</div>
        <div class="tag col">Strategy</div>
        <div class="tag col">Card</div>
        <div class="tag col">Roleplay</div>
        <div class="tag col">Family</div>
      </div>
      <div id="search-list" class="container mx-auto row justify-content-evenly gap-4 gy-3 gy-md-5">

        @foreach($items as $item)
        <div class="item col-11 col-md-3 p-4" onclick="showDesc('{{ json_encode($item) }}')">
          <img src=" {{ $item->img_path }} " class="rounded">
          <div class="item-title">{{ $item->name }}</div>
          <div class="tag-container gap-2 mb-3">
            <div class="tag tag-active">Card</div>
            <div class="tag tag-active">Family</div>
          </div>
        </div>
        @endforeach

      </div>
    </div>
@endsection

@section('scripts')
  <script src=" {{ asset('js/index.js') }} "></script>
@endsection
