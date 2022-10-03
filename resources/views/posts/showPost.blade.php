@extends('layouts.app')

@section('title')
Devs community {{ $slug }}
@endsection

@section('content')
@include('layouts.navbar')

<section id="main" class="@if ($dark_theme) main-dark @endif">
    <div class="container">
        <Show :user_id='@json($user_id)' :slug='@json($slug)' :langue='@json($langue)'></Show>
    </div>
</section>

@include('layouts.footer')
@endsection
