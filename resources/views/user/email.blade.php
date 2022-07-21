@extends('user.layouts.app')
@section('content')
    <h3>{{ $user['name'] }}</h3>
    <p>{{ $user['info'] }}</p>
    <p>Thank you</p>
@endsection
