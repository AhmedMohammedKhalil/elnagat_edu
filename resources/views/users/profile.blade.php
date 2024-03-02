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
                    <div class="text-center p-3">
                        <div class="profile-photo">
                            @if(auth()->user()->gender == 'ذكر')
                                <img src="{{ asset('assets/images/data/icons/profile.png') }}" width="100" class="img-fluid rounded-circle" alt=""/>
                            @else
                                <img src="{{ asset('assets/images/data/icons/woman.png') }}" width="100" class="img-fluid rounded-circle" alt=""/>
                            @endif
                        </div>
                        <h3 class="mt-3 mb-1" style="color:#044c71">{{ auth()->user()->name }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
