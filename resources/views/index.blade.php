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

    <div class="modal fade my-3" tabindex="-1" >
      <div class="modal-dialog modal-xl">
        <div class="modal-content rounded">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="container-fluid row gy-3">
              <div class="col-12 col-lg-5 row mt-3">
                <div id="desc-images" class="col-4">
                </div>
                <div id="desc-image-container" class="col-8">
                  <div id="desc-image">
                    <img src="" alt="">
                  </div>
                </div>
              </div>
              <div class="col-12 col-lg-7 row">
                <div id="desc-details" class="mt-3">
                  <div class="row justify-content-between align-items-center">
                    <div id="desc-title" class="col-6 fs-2"></div>
                    <div id="desc-price" class="col-5 fs-2"></div>
                  </div>
                  <div id="desc-tags" class="py-3 gap-2">
                    <div class="tag tag-active">Card</div>
                    <div class="tag tag-active">Family</div>
                  </div>
                  <div class="fs-5">Description</div>
                  <div id="desc-text" class="px-4 py-3 fs-5">
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
              <button id="desc-add" type="button" class="col btn fs-5">Add to cart</button>
              <button id="desc-buy" type="button" class="col btn fs-5">Buy now</button>
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

    <div id="content" class="container-sm pb-5 mb-5">
      <div class="search-tags col-10 col-md-8 gap-2 my-4 mx-auto row">
        <div class="tag col">Action</div>
        <div class="tag tag-active col">Strategy</div>
        <div class="tag col">Card</div>
        <div class="tag col">Roleplay</div>
        <div class="tag col">Family</div>
      </div>
      <div id="search-list" class="container mx-auto row justify-content-evenly gap-4 gy-3 gy-md-5">

        @foreach($items as $item)
        <div class="item col-11 col-md-3" onclick="showDesc('{{ json_encode($item) }}')">
          <img src=" {{ $item->img_path }} " alt="">
          <div class="item-title">{{ $item->name }}</div>
          <div class="tag-container gap-2">
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
