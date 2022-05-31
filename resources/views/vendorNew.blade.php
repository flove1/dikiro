@extends('layouts.app')

@php( $items = \App\Models\Item::all() )

@section('styles')
    <link href="{{ asset('css/vendorNew.css') }}" rel="stylesheet">
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
                        <a class="nav-link" href="/vendor">Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active">Add a game</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Orders</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div id="content" class="container px-2 my-5">
        <form id="new-game-form" class="container-fluid row p-5" method="POST" enctype="multipart/form-data" action="/items">
            @csrf
            @method('PUT')
            @isset($item) <input type="hidden" name="id" value="{{ $item->id }}"> @endisset
            <div id="img-container" class="col-10 col-md-3 col-lg-2">
                <p class="fs-4 text-center user-select-none" @isset($item) hidden @endisset >Press to select file</p>
                <img id="img-preview" @isset($item)src="{{ asset($item->img_path) }}" @else style="display: none" @endisset/>
                <input name="image" id="img-select" type='file' onchange="readURL(this);" style="display: none"/>
            </div>
            <div class="container-fluid col-12 col-md-9 col-lg-10">
                <div class="flex-fill row justify-content-between mx-auto">
                    <div class="col-6 col-lg-5 px-0">
                        <input id="new-game-name" name="name" type="text" class="form-control fs-4 rounded" placeholder="Title..." @isset($item)value="{{ $item->name }}"@endisset>
                    </div>
                    <div class="col-3 col-lg-2 d-flex px-0">
                        <input id="new-game-price" name="price" type="text" class="form-control fs-4 rounded" placeholder="Price..." @isset($item)value="{{ $item->price }}"@endisset>
                        <div class="align-self-center d-block my-0 ms-3 fs-4">kzt</div>
                    </div>
                </div>
                <textarea id="new-game-description" name="desc" class="container-fluid form-control my-4 fs-5 rounded" placeholder="Start typing your description there...">@isset($item){{ $item->desc }}@endisset</textarea>
                <div id="new-game-tags" class="flex-fill gap-2 row mb-4 fs-4">
                    <div>Tags:</div>
                    <div class="tag tag-active col fs-4">Action</div>
                    <div class="tag tag-active col fs-4">Card</div>
                    <div class="tag tag-active col fs-4">Family</div>
                    <div class="tag tag-active col fs-4">Random</div>
                    <div class="tag tag-active col fs-4">Strategy</div>
                    <div class="tag tag-active col fs-4">Role play</div>
                </div>
                <div class="col-12 d-flex gap-2 align-items-center fs-4">
                    <div>Quantity:</div>
                    <div class="col-3 col-md-2">
                        <input id="new-game-quantity" name="count" type="text" class="form-control col-3 fs-4 rounded" placeholder="Count..." @isset($item)value="{{ $item->count }}"@endisset">
                    </div>
                    <input id="new-game-save" type="submit"
                           class="btn btn-custom rounded-pill px-4 py-2 my-auto ms-auto fs-4"/>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/vendorNew.js')  }}"></script>
@endsection
