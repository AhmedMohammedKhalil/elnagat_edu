@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>المعلمين</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">جميع المعلمين</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display text-nowrap text-center" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الإسم</th>
                                                <th>عدد المراحل التعليمية</th>
                                                <th>الإعدادات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($teachers)
                                                @foreach($teachers as $teacher)

                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $teacher->name }}</td>
                                                        <td>{!! isset($teacher->levels) ? count($teacher->levels) : 0 !!}</td>

                                                        <td>
                                                            <a href="{{ route('admin.levels',['id' => $teacher->id]) }}" title="المراحل التعليمية" class="btn btn-xs sharp btn-primary"><i class="fa fa-eye"></i></a>
                                                            <a href="{{ route('admin.teachers.edit',['id' => $teacher->id]) }}" title="تعديل" class="btn btn-xs sharp btn-primary"><i class="fa fa-pencil"></i></a>
                                                            <form style="display:inline-block" action="{{route('admin.teachers.destroy',['id'=>$teacher->id])}}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="btn btn-xs sharp btn-danger" type="submit" title="حذف" >
                                                                    <i class='fa fa-trash'></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="4">
                                                        <h4 class="text-center">لا يوجد معلمين</h4>
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
