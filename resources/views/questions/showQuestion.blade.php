@extends('layouts.app')

@section('title')
  {{ $slug }}
@endsection

@section('content')
@include('layouts.navbar')

<section id="questions" class="@if ($dark_theme) dark @endif">
    <div class="container-fluid">
        <Showuestion :user_id='@json($user_id)' :slug='@json($slug)' :langue='@json($langue)'></Showuestion>
    </div>
</section>

@include('layouts.footer')
@endsection
