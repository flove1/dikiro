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

    <div id="desc-modal" class="modal fade my-3 pb-4" tabindex="-1" >
        <div id="desc" class="modal-dialog modal-xl">
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
                                <div id="desc-image" class="text-center">
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
                <div class="modal-footer" >
                    @if (\Illuminate\Support\Facades\Auth::check())
                    <div class="flex-fill gap-3">
                        <form method="post" class="d-flex justify-content-end align-items-center" action="/cart" target="votar">
                            @csrf
                            @method('POST')
                            <input id="cart-item-count" class="rounded py-2 px-1 col-1 me-2 text-center fs-5" type="text" name="count" placeholder="Count...">
                            <input id="cart-item-id" type="hidden" name="id">
                            <button id="desc-add" type="submit" class="btn fs-4 py-3 px-5 text-nowrap ">Add to cart</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div id="comments-dialog" class="modal-dialog modal-lg">
            <div class="modal-content rounded">
                <form id="new-comment" method="post" action="/comments">
                    @csrf
                    <input id="comment-id" type="hidden" name="id">
                    <div class="d-flex m-3 align-items-center">
                        <textarea name="comment" class="flex-fill fs-4 p-2 rounded" style="resize: none" placeholder="Start typing your new comment here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-custom mx-auto py-2 px-4 fs-4 d-block rounded">Save comment</button>
                </form>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" style="position: relative; right: 25px"></button>
                </div>
                <div class="modal-body">
                    <div id="cart-container" class="container-fluid row gy-3 mx-auto"></div>
                </div>
                <div class="modal-footer">
                    <div class="row gap-3 align-items-center">
                        <div class="col text-nowrap">
                            <span class="fs-4 me-1">Total of:</span>
                            <span id="sum" class="fs-4 fw-bold">0</span>
                            <span class="fs-5"> kzt</span>
                        </div>
                        <button id="desc-buy" type="button" class="col btn py-2 px-4 fs-3 text-nowrap fw-bold">Buy now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (\Illuminate\Support\Facades\Auth::check())
        <div id="cart" class="rounded-circle" onclick="showCart()">
            <div id="cart-symbol"><i class="fa-solid fa-cart-shopping"></i></div>
        </div>
    @endif

    <iframe name="votar" style="display:none;"></iframe>

    <div id="content" class="container-fluid pb-5 mb-5">
      <div class="search-tags col-10 col-md-8 gap-2 my-4 mx-auto row">
        <div class="tag col" >Action</div>
        <div class="tag col">Strategy</div>
        <div class="tag col">Card</div>
        <div class="tag col">Roleplay</div>
          <div class="tag col">Family</div>
          <div class="tag col">Random</div>
      </div>

        <div id="btn-page-container" class="container mx-auto d-flex justify-content-center gap-2 mb-3">
        </div>

      <div id="search-list" class="container-fluid mx-auto row justify-content-evenly gap-4 gy-3 gy-md-5">

{{--        @foreach($items as $item)--}}
{{--        <div class="item col-11 col-md-3 p-4" onclick="showDesc('{{ json_encode($item) }}')">--}}
{{--          <img src=" {{ $item->img_path }} " class="rounded">--}}
{{--          <div class="item-title">{{ $item->name }}</div>--}}
{{--          <div class="tag-container gap-2 mb-3">--}}
{{--            <div class="tag tag-active">Card</div>--}}
{{--            <div class="tag tag-active">Family</div>--}}
{{--          </div>--}}
{{--        </div>--}}
{{--        @endforeach--}}

      </div>
    </div>
@endsection

@section('scripts')
  <script src=" {{ asset('js/index.js') }} "></script>
@endsection
