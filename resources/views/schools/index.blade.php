@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>المدارس</h4>
                </div>
            </div>
        </div>
        <div class="row">
            @if(count($sub_admins) > 0)

                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-bs-toggle="tab" class="nav-link me-1 show active">عرض المدارس</a></li>
                        <li class="nav-item"><a href="#add-school" data-bs-toggle="tab" class="nav-link">إضافة مدرسة جديدة</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع المدارس</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example5" class="display text-nowrap text-center" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>الإسم</th>
                                                    <th>مدير المدرسة</th>
                                                    <th>المدير المساعد</th>
                                                    <th>الإعدادات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($schools as $school)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $school->name }}</td>
                                                        <td>{{ $school->owner }}</td>
                                                        <td>{{ $school->sub_admin->name }}</td>

                                                        <td>
                                                            <a href="{{ route('schools.edit',['id' => $school->id]) }}" title="تعديل" class="btn btn-xs sharp btn-primary"><i class="fa fa-pencil"></i></a>
                                                            @if(count($school->departments) == 0)
                                                                <form style="display:inline-block" action="{{route('schools.destroy',['id'=>$school->id])}}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button class="btn btn-xs sharp btn-danger" type="submit" title="حذف" >
                                                                        <i class='fa fa-trash'></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @if(count($schools) == 0)
                                                    <tr>
                                                        <td colspan="5">
                                                            <h4 class="text-center">لا يوجد مدارس </h4>
                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="add-school" class="tab-pane fade col-lg-12 row">
                            <div class="col-lg-6 col-sm-12 m-auto">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">أضف مدرسة جديدة</h4>
                                    </div>
                                    <div class="card-body">
                                        <livewire:school.school  method='add' school_id='0'/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <div class="col-12">
                    <h2 class="text-center">لا يوجد مدراء مساعدين لابد من إضافة المدراء المساعدين اولاً</h2>
                </div>
            @endif
        </div>
    </div>
@endsection
