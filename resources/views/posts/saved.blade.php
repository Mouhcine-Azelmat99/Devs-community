@extends('layouts.app')

@section('title')
  Saved posts
@endsection

@section('content')
@include('layouts.navbar')

<section id="saved" class="@if (session('isDark')) main-dark @endif">
    <div class="container">
        <Saved :user_id='@json($user_id)'></Saved>
    </div>
</section>

@include('layouts.footer')
@endsection
