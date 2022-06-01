@extends('layouts.app')

@php( $items = \App\Models\Item::all() )

@section('styles')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div id="content" class="container my-5">
        <iframe name="votar" style="display:none;"></iframe>

        <form id="edit-profile" class="container-fluid row p-5" method="POST" enctype="multipart/form-data" action="{{ route('userUpdate') }}">
            @csrf
            @method('PUT')
            @isset($item) <input type="hidden" name="id" value="{{ $item->id }}" required> @endisset
            <div id="img-container" class="col-10 col-md-3 col-lg-2">
                <img id="img-preview" src="{{ asset($user->img_path) }}"/>
                <input name="image" id="img-select" type='file' onchange="readURL(this);" style="display: none"/>
            </div>
            <div class="container-fluid col-12 col-md-9 col-lg-10">
                <div class="flex-fill row justify-content-between mx-auto">
                    <div class="col-6 col-lg-5 px-0 input-group">
                        <label class="input-group-text">Name:</label>
                        <input id="edit-name" name="username" type="text" class="form-control fs-4" placeholder="Name..." value="{{ $user->name }}"/>
                    </div>
                    <div class="col-6 col-lg-5 px-0 input-group mt-2">
                        <label class="input-group-text">Confirm password:</label>
                        <input id="edit-password" name="password" type="password" class="form-control fs-4" placeholder="Password.." required/>
                    </div>
                    <div class="col-6 col-lg-5 px-0 input-group mt-2">
                        <label class="input-group-text">New password::</label>
                        <input id="edit-password-new" name="new-password" type="password" class="form-control fs-4" placeholder="Password..."/>
                    </div>
                    <div class="col-6 col-lg-5 px-0 input-group my-2">
                        <label class="input-group-text">Repeat password::</label>
                        <input id="edit-confirm" name="new-password-repeat" type="password" class="form-control fs-4" placeholder="Password..."/>
                    </div>
                </div>
                <div class="col-12 d-flex gap-2 align-items-center fs-4">
                    <input id="new-game-save" type="submit" class="btn btn-custom rounded-pill px-4 py-2 my-auto ms-auto fs-4" value="Update information"/>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('js/profile.js')  }}"></script>
@endsection
