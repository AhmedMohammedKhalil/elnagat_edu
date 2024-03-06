@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>الأقسام</h4>
                </div>
            </div>
        </div>

        <div class="row">
            @if(auth()->user()->owner)
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-bs-toggle="tab" class="nav-link me-1 show active">عرض الأقسام</a></li>
                        <li class="nav-item"><a href="#add-department" data-bs-toggle="tab" class="nav-link">إضافة قسم جديد</a></li>
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع الأقسام</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example5" class="display text-nowrap text-center" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>الإسم</th>
                                                    <th>رئيس القسم</th>
                                                    <th>المدرسة</th>
                                                    <th>الإعدادات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($departments as $department)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $department->name }}</td>
                                                        <td>{{ $department->department_owner->name }}</td>
                                                        <td>{{ $department->school->name }}</td>
                                                        <td>
                                                            <a href="{{ route('departments.edit',['id' => $department->id]) }}" title="تعديل" class="btn btn-xs sharp btn-primary"><i class="fa fa-pencil"></i></a>
                                                            @if(count($department->teachers) == 0)
                                                                <form style="display:inline-block" action="{{route('departments.destroy',['id'=>$department->id])}}" method="post">
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
                                                @if(count($departments) == 0)
                                                    <tr>
                                                        <td colspan="5">
                                                            <h4 class="text-center">لا يوجد أقسام </h4>
                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="add-department" class="tab-pane fade col-lg-12 row">
                            <div class="col-lg-6 col-sm-12 m-auto">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">أضف قسم جديد</h4>
                                    </div>
                                    <div class="card-body">
                                        <livewire:department.department  method='add' department_id='0'/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <div class="col-12">
                    <h2 class="text-center">لا يوجد  مدرسة لديك لابد من إضافة المدرسة اولاً</h2>
                </div>
            @endif
        </div>
    </div>
@endsection
