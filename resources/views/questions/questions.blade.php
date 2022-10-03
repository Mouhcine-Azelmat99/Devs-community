@extends('layouts.app')

@section('title')
Devs community Questions
@endsection

@section('content')
@include('layouts.navbar')

<section id="questions" class="@if ($dark_theme) dark @endif">
    <div class="container-fluid">
        <div class="row">
            <Questions :user_id='@json($user_id)' :langue='@json($langue)'></Questions>
        </div>
    </div>
</section>

@include('layouts.footer')
@endsection
