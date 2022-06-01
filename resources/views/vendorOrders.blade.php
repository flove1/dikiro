@extends('layouts.app')

@php( $items = \App\Models\Item::all() )

@section('styles')
<link href="{{ asset('css/vendorOrders.css') }}" rel="stylesheet">
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
            <a class="nav-link" href="/vendor/new">Add a game</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active user-select-none">Orders</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div id="content" class="container my-5">

      <iframe name="votar" style="display:none;"></iframe>

      <table class="container mx-auto" style="border: 2px dashed black; box-shadow: 5px 5px 5px #00000090">
          <tr style="background-color: var(--accent-bg); border-bottom: 1px solid black ">
              <td>Date</td>
              <td>Customer</td>
              <td>Address + number</td>
              <td>Order</td>
              <td>Price</td>
              <td>Done</td>
          </tr>
        @foreach($items as $item)
            <tr>
                <td>{{ \Illuminate\Support\Carbon::now() }}</td>
                <td>{{ \Illuminate\Support\Facades\Auth::user()->name }}</td>
                <td>Address + number</td>
                <td>Game1 - 2<br>Game2 - 4<br></td>
                <td>31231 kzt</td>
                <td><input type="checkbox" style="width: 25px; height: 25px"></td>
            </tr>
        @endforeach
      </table>

  </div>

@endsection

@section('scripts')
<script src="{{ asset('js/vendorOrders.js')  }}"></script>
@endsection
