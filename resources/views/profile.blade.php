@extends('layouts.app')

@section('title')
  Profile
@endsection

@section('content')
@include('layouts.navbar')

<section class="profile">
    <Profile :user_id='@json($user_id)'></Profile>
</section>

@include('layouts.footer')
@endsection
