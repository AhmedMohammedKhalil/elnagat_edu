@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-primary">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <i class="la la-school"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">عدد المدارس</p>
                                <h3 class="text-white">{!! App\Models\School::count() !!}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-warning">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <i class="la la-building"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">عدد الأقسام</p>
                                <h3 class="text-white">{!! App\Models\Department::count() !!}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-secondary">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <i class="la la-users"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">عدد المعلمين</p>
                                <h3 class="text-white">{!! App\Models\Teacher::count() !!}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card bg-danger">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <i class="la la-user"></i>
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">عدد المدراء المساعدين</p>
                                <h3 class="text-white">{!! App\Models\User::where('role','sub_admin')->count() !!}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
