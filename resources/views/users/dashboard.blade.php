@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card" style="background: #4eaf52">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <img src="{{ asset('assets/images/data/icons/school.png') }}" alt="">
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
                <div class="widget-stat card" style="background: #4eaf52">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <img src="{{ asset('assets/images/data/icons/dep.png') }}" alt="">
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
                <div class="widget-stat card" style="background: #4eaf52">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <img src="{{ asset('assets/images/data/icons/teacher.png') }}" alt="">
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
                <div class="widget-stat card" style="background: #4eaf52">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <img src="{{ asset('assets/images/data/icons/boss.png') }}" alt="">
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">عدد المدراء المساعدين</p>
                                <h3 class="text-white">{!! App\Models\User::where('role','sub_admin')->count() !!}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card" style="background: #4eaf52">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <img src="{{ asset('assets/images/data/icons/boss.png') }}" alt="">
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">عدد أعضاء فريق التشغيل</p>
                                <h3 class="text-white">{!! App\Models\User::where('role','official')->count() !!}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-xxl-3 col-sm-6">
                <div class="widget-stat card" style="background: #4eaf52">
                    <div class="card-body">
                        <div class="media">
                            <span class="me-3">
                                <img src="{{ asset('assets/images/data/icons/boss.png') }}" alt="">
                            </span>
                            <div class="media-body text-white">
                                <p class="mb-1">عدد التقييمات</p>
                                <h3 class="text-white">{!! App\Models\Review::Count() !!}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
