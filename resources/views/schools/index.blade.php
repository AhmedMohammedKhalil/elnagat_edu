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
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-bs-toggle="tab" class="nav-link me-1 show active">عرض المدرسة</a></li>
                        @if(!auth()->user()->owner)
                        <li class="nav-item"><a href="#add-school" data-bs-toggle="tab" class="nav-link">إضافة مدرسة جديدة</a></li>
                        @endif
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">بيانات المدرسة</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example5" class="display text-nowrap text-center" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>الإسم</th>
                                                    <th>مدير المدرسة</th>
                                                    <th>المدير المساعد</th>
                                                    <th>البريد الإلكترونى</th>
                                                    <th>الإعدادات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($school)
                                                    <tr>
                                                        <td>{{ $school->name }}</td>
                                                        <td>{{ $school->owner }}</td>
                                                        <td>{{ $school->sub_admin->name }}</td>
                                                        <td>{{ $school->sub_admin->email }}</td>
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
                                                @else
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
                        @if(!auth()->user()->owner)
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
                        @endif
                    </div>
                </div>
        </div>
    </div>
@endsection
