@extends('layouts.app')

@section('content')
  <form action="/authenticate" method="post">
    @csrf
    <div> 
      <span>Email</span>
      <input type="email" name="email">
    </div>
    <div> 
      <span>Password</span>
      <input type="text" name="password">
    </div>
    <input type="submit" value="Login">
  </form>
@endsection