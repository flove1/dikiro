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
            <a class="nav-link active user-select-none">Catalogue</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/vendor/new">Add a game</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/vendor/orders">Orders</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="modal fade my-3" tabindex="-1">
    <div id="comments-dialog" class="modal-dialog modal-lg">
      <div class="modal-content rounded">
        <div id="desc-comments" class="modal-body rounded">
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

      <iframe name="votar" style="display:none;"></iframe>

    @foreach($items as $item)
    <div class="item row my-5 p-3">
      <div class="col-3 align-items-center">
        <img src="{{ $item->img_path }}" class="rounded" style="transform: translateY(-50%); position: relative; top: 50%"/>
      </div>
      <div class="col gx-5">
        <div class="row">
          <div class="col-7 fs-2 my-auto">{{ $item->name }}</div>
          <div class="col-3 fs-2 my-auto text-end text-nowrap">{{ $item->price }} kzt</div>
          <button class="col btn btn-outline-dark rounded fs-3 my-auto" onclick="window.location='vendor/new/'.concat({{ $item->id }})"><i class="fas fa-pen"></i></button>
        <form method="POST" action="/items/{{ $item->id }}" class="col" target="votar">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" value="{{ $item->id }}">
            <button class="btn btn-outline-danger rounded ms-2 fs-2" type="submit">X</button>
        </form>
        </div>

        <div id="search-tags" class="col-12 gap-2 my-3 row">
          <div class="tag col fs-4 @if ($item->tags()->where('tag', '=', 'Action')->count() == 1) tag-active @endif">Action</div>
          <div class="tag col fs-4 @if ($item->tags()->where('tag', '=', 'Strategy')->count() == 1) tag-active @endif">Strategy</div>
          <div class="tag col fs-4 @if ($item->tags()->where('tag', '=', 'Card')->count() == 1) tag-active @endif">Card</div>
          <div class="tag col fs-4 @if ($item->tags()->where('tag', '=', 'Roleplay')->count() == 1) tag-active @endif">Roleplay</div>
          <div class="tag col fs-4 @if ($item->tags()->where('tag', '=', 'Family')->count() == 1) tag-active @endif">Family</div>
        <div class="tag col fs-4 @if ($item->tags()->where('tag', '=', 'Random')->count() == 1) tag-active @endif">Random</div>
        </div>

        <div class="my-3 fs-4">Quantity: {{ $item->count }}</div>

        <button class="btn btn-bright rounded fs-3 text-white mb-3" onclick="showComments({{ $item->id }})">Comments</button>

      </div>
    </div>
    @endforeach
  </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/vendor.js')  }}"></script>
@endsection
