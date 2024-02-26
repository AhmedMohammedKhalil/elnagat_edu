@extends('layouts.app')
@section('content')
<div>{{ $page_name }}</div>
<div>
    @include('companies.menu')
    @yield('section')
</div>
@endsection
