@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>البروفايل</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-sm-12 m-auto">
                <div class="card">
                    <div class="text-center p-3 overlay-box" style="background-image: url({{ asset('assets/images/data/cover3.jpg') }});">
                        <div class="profile-photo">
                            <img src="{{ asset('assets/images/avatar/1.png') }}" width="100" class="img-fluid rounded-circle" alt="">
                        </div>
                        <h3 class="mt-3 mb-1 text-white">{{ auth()->user()->name }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
