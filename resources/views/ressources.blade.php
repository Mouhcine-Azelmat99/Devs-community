@extends('layouts.app')

@section('title')
  Ressources
@endsection

@section('content')
@include('layouts.navbar')

<section id="ressources" class="@if (session('isDark')) dark @endif">
    <div class="container-fluid">
        <Ressources></Ressources>
    </div>
</section>

@include('layouts.footer')
@endsection
