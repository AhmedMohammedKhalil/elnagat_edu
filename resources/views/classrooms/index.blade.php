@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>الصفوف الدراسية</h4>
                </div>
            </div>
        </div>

        <div class="row">
            @if($level)
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-bs-toggle="tab" class="nav-link me-1 show active">عرض الصفوف الدراسية</a></li>
                    <li class="nav-item"><a href="#add-teacher" data-bs-toggle="tab" class="nav-link">إضافة صف دراسي جديد</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">جميع الصفوف الدراسية</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display text-nowrap text-center" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الصف الدراسى</th>
                                                <th>المرحلة التعليمية</th>
                                                <th>الإعدادات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $flag = false;
                                                $i = 0;
                                            @endphp
                                            @foreach ($level->classrooms as $classroom)
                                                    @php
                                                        $flag = true;
                                                    @endphp
                                                    <tr>
                                                        <td>{!! ++$i !!}</td>
                                                        <td>{{ $classroom->name }}</td>
                                                        <td>{{ $level->name }}</td>

                                                        <td>
                                                            <a href="{{ route('classrooms.edit',['id' => $classroom->id]) }}" title="تعديل" class="btn btn-xs sharp btn-primary"><i class="fa fa-pencil"></i></a>

                                                                <form style="display:inline-block" action="{{route('classrooms.destroy',['classroom_id'=>$classroom->id,'id'=>$level->id])}}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button class="btn btn-xs sharp btn-danger" type="submit" title="حذف" >
                                                                        <i class='fa fa-trash'></i>
                                                                    </button>
                                                                </form>

                                                        </td>
                                                    </tr>
                                            @endforeach
                                            @if($flag == false)
                                                <tr>
                                                    <td colspan="4">
                                                        <h4 class="text-center">لا يوجد صفوف دراسية</h4>
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="add-teacher" class="tab-pane fade col-lg-12 row">
                        <div class="col-lg-6 col-sm-12 m-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">أضف صف دراسي جديد</h4>
                                </div>
                                <div class="card-body">
                                    <livewire:classroom.classroom :level_id="$level->id" method='add' classroom_id='0'/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="col-12">
                    <h2 class="text-center">لا يوجد صفوف دراسية لديك لابد من إضافة صف واحد على الأقل</h2>
                </div>
            @endif
        </div>
    </div>
@endsection
