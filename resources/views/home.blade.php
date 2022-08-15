@extends('layouts.app')

@section('title')
  Home
@endsection

@section('content')
@include('layouts.navbar')

<section id="main" class="@if (session('isDark')) main-dark @endif">
    <div class="container">
        <Posts :user_id='@json($user_id)' :langue='@json($langue)'></Posts>
    </div>
</section>

@include('layouts.footer')
@endsection
