@extends('layouts.app')

@section('title')
  posts
@endsection

@section('content')
@include('layouts.navbar')

<section id="main" class="@if (session('isDark')) main-dark @endif">
    <div class="container">
        <Postscategory :user_id='@json($user_id)' :category_id='@json($category_id)' :langue='@json($langue)'></Postscategory>
    </div>
</section>

@include('layouts.footer')
@endsection
