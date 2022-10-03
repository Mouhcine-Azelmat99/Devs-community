@extends('layouts.app')

@section('title')
  Devs community
@endsection

@section('content')
@include('layouts.navbar')

<section id="main" class="@if ($dark_theme) main-dark @endif">
    <div class="container">
        <Posts :user_id='@json($user_id)' :langue='@json($langue)'></Posts>
    </div>
</section>

@include('layouts.footer')
@endsection
