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
                    <div class="row tab-content">
                        <div id="list-view" class="tab-pane fade active show col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example5" class="display text-nowrap text-center" style="min-width: 845px">
                                            <thead>
                                                <tr>
                                                    <th>الإسم</th>
                                                    <th>مدير المدرسة</th>
                                                    <th>المدير المساعد</th>
                                                    <th>عدد الأقسام</th>
                                                    <th>الإعدادات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($schools)
                                                    @foreach ($schools as $school)
                                                        <tr>
                                                            <td>{{ $school->name }}</td>
                                                            <td>{{ $school->owner }}</td>
                                                            <td>{{ $school->sub_admin->name }}</td>
                                                            <td>{!! isset($school->departments) ? count($school->departments) : 0 !!}</td>
                                                            <td>
                                                                <a href="{{ route('admin.departments',['id' => $school->id]) }}" title="عرض الأقسام" class="btn btn-xs sharp btn-primary"><i class="fa fa-eye"></i></a>
                                                                <a href="{{ route('admin.schools.edit',['id' => $school->id]) }}" title="تعديل" class="btn btn-xs sharp btn-primary"><i class="fa fa-pencil"></i></a>

                                                            </td>
                                                        </tr>
                                                    @endforeach

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
                    </div>
                </div>
        </div>
    </div>
@endsection
