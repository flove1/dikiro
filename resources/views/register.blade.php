@extends('layouts.app')

@section('content')
  <form action="/store" method="post">
    @csrf
    <div> 
      <span>Name</span>
      <input type="text" name="name">
    </div>
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