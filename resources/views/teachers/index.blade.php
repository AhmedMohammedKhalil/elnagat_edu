@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>جميع المدارس</h4>
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
                                                <th>عدد الأقسام</th>
                                                <th>الإعدادات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($schools as $school)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $school->name }}</td>
                                                    <td>{{ count($school->departments) }}</td>

                                                    <td>
                                                        @if(count($school->departments) > 0)
                                                            <a href="{{ route('teachers.teachers',['id' => $school->id]) }}" title="عرض المعلمين" class="btn btn-xs sharp btn-primary"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @if(count($schools) == 0)
                                                <tr>
                                                    <td colspan="4">
                                                        <h4 class="text-center">لا يوجد مدارس</h4>
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
