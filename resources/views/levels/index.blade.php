@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>المراحل التعليمية</h4>
                </div>
            </div>
        </div>

        <div class="row">
            @if(auth()->user()->owner)
                <div class="col-lg-12">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item"><a href="#list-view" data-bs-toggle="tab" class="nav-link me-1 show active">عرض المراحل التعليمية</a></li>
                        @if(count($teacher->levels)<3)
                        <li class="nav-item"><a href="#add-level" data-bs-toggle="tab" class="nav-link">إضافة مرحلة تعليمية جديدة</a></li>
                        @endif
                    </ul>
                </div>
                <div class="col-lg-12">
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">جميع المراحل التعليمية</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example5" class="display text-nowrap text-center" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>المستوى</th>
                                                    <th>اسم المدرس</th>
                                                    <th>الإعدادات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($teacher->levels as $level)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $level->name }}</td>
                                                        <td>{{ $level->teacher->name }}</td>
                                                        <td>
                                                        <a href="{{ route('classrooms.index',['id' => $level->id]) }}" title="الصفوف الدراسية" class="btn btn-xs sharp btn-primary"><i class="fa fa-eye"></i></a>
                                                            @if(count($level->classrooms) == 0)
                                                                <form style="display:inline-block" action="{{route('levels.destroy',['level_id'=>$level->id,'id'=>$teacher->id])}}" method="post">
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
                                                @if(count($teacher->levels) == 0)
                                                    <tr>
                                                        <td colspan="4">
                                                            <h4 class="text-center">لا يوجد مرحلة تعليمية </h4>
                                                        </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="add-level" class="tab-pane fade col-lg-12 row">
                            <div class="col-lg-6 col-sm-12 m-auto">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">أضف مرحلة دراسية جديدة</h4>
                                    </div>
                                    <div class="card-body">
                                        <livewire:level.level :teacher_id="$teacher->id" />
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
