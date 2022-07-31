@extends('layouts.app')

@section('title')
  Ressources
@endsection

@section('content')
@include('layouts.navbar')

<section id="questions" class="@if (session('isDark')) dark @endif">
    <div class="container-fluid">
        <div class="row">
            <Questions :user_id='@json($user_id)'></Questions>
        </div>
    </div>
</section>

@include('layouts.footer')
@endsection
