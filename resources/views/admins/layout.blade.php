@extends('layouts.app')
@section('content')
    <div>{{ $page_name }}</div>
    <div>
        @include('admins.menu')
        @yield('section')
    </div>
@endsection
