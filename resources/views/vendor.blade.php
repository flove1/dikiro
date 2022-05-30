@extends('layouts.app')

@php( $items = \App\Models\Item::all() )

@section('styles')
  <link href="{{ asset('css/vendor.css') }}" rel="stylesheet">
@endsection

@section('content')
  <nav class="navbar navbar-expand-sm">
    <div class="container-fluid justify-content-center">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span>Navigation V</span>
      </button>
      <div class="collapse navbar-collapse justify-content-around" id="navbarNav">
        <ul class="navbar-nav text-center gap-1 gap-sm-5">
          <li class="nav-item">
            <a class="nav-link active">Catalogue</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/vendor/new">Add a game</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Orders</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="modal fade my-3" tabindex="-1">
    <div id="comments-dialog" class="modal-dialog modal-lg">
      <div class="modal-content rounded">
        <div id="desc-comments" class="modal-body">
          <div class="container-fluid row">
            <div class="profile-image col-1 rounded-circle"></div>
            <div class="col">
              <div class="desc-comment-name">Name</div>
              <div class="desc-comment-date">Date</div>
              <p class="desc-comment">Comment</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="content" class="container my-5">

    @foreach($items as $item)
    <div class="row my-5">
      <div class="col-3">
        <img src="{{ $item->img_path }}"/>
      </div>
      <div class="col gx-5">
        <div class="row">
          <div class="col-7 fs-2 my-auto">{{ $item->name }}</div>
          <div class="col-3 fs-2 my-auto text-end text-nowrap">{{ $item->price }} kzt</div>
          <button class="col btn btn-outline-dark rounded fs-3 my-auto"><i class="fas fa-pen"></i></button>
        </div>

        <div id="search-tags" class="col-12 gap-2 my-3 row">
          <div class="tag col fs-4">Action</div>
          <div class="tag tag-active col fs-4">Strategy</div>
          <div class="tag col fs-4">Card</div>
          <div class="tag col fs-4">Roleplay</div>
          <div class="tag col fs-4">Family</div>
        </div>

        <div class="my-3 fs-4">Quantity: {{ $item->count }}</div>

        <button class="btn btn-custom rounded fs-3" onclick="showComments({{ $item->id }})">Comments</button>

      </div>
    </div>
    @endforeach
  </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/vendor.js')  }}"></script>
@endsection
