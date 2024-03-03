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
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display text-nowrap text-center" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>المرحلة التعليمية</th>
                                                <th>عدد الصفوف</th>
                                                <th>الإعدادات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($levels as $level)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $level->name }}</td>
                                                    <td>{!! isset($level->classrooms) ? count($level->classrooms) : 0 !!}</td>
                                                    <td>
                                                        <a href="{{ route('admin.classrooms',['id' => $level->id]) }}" title="الصفوف الدراسية" class="btn btn-xs sharp btn-primary"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @if(count($levels) == 0)
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
                </div>
            </div>
        </div>
    </div>
@endsection
