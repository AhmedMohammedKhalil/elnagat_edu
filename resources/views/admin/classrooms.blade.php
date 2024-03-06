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
                                                <th>الإعدادات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($classrooms)
                                            @foreach ($classrooms as $classroom)

                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $classroom->name }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.classrooms.edit',['id' => $classroom->id]) }}" title="تعديل" class="btn btn-xs sharp btn-primary"><i class="fa fa-pencil"></i></a>
                                                        </td>

                                                    </tr>
                                            @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="3">
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
                </div>
            </div>
        </div>
    </div>
@endsection
