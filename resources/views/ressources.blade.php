@extends('layouts.app')

@section('title')
Devs community Ressources
@endsection

@section('content')
@include('layouts.navbar')

<section id="ressources" class="@if ($dark_theme) dark @endif">
    <div class="container-fluid">
        <Ressources :user_id='@json($user_id)' :langue='@json($langue)'></Ressources>
    </div>
</section>

@include('layouts.footer')
@endsection
