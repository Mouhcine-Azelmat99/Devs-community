@extends('layouts.app')

@section('title')
  {{ $slug }}
@endsection

@section('content')
@include('layouts.navbar')

<section id="main" class="@if (session('isDark')) main-dark @endif">
    <div class="container">
        <Show :user_id='@json($user_id)' :slug='@json($slug)'></Show>
    </div>
</section>

@include('layouts.footer')
@endsection
