@extends('layouts.app')

@section('title')
Devs community Profile
@endsection

@section('content')
@include('layouts.navbar')

<section id="profile" class="@if ($dark_theme) dark @endif">
    <Profile :user_id='@json($user_id)' :langue='@json($langue)'></Profile>
</section>

@include('layouts.footer')
@endsection
