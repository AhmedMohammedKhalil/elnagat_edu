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
                                                    <th>الإسم</th>
                                                    <th>رئيس القسم</th>
                                                    <th>عدد المعلمين</th>
                                                    <th>الإعدادات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($departments as $department)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $department->name }}</td>
                                                        <td>{{ $department->owner }}</td>
                                                        <td>{!! isset($department->teachers) ? count($department->teachers) : 0 !!}</td>
                                                        <td>
                                                            <a href="{{ route('admin.teachers',['id' => $department->id]) }}" title="عرض المعلمين" class="btn btn-xs sharp btn-primary"><i class="fa fa-eye"></i></a>
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
                    </div>
                </div>
        </div>
    </div>
@endsection
