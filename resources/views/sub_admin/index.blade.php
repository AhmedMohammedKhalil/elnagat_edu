@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>المدراء المساعدين</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-bs-toggle="tab" class="nav-link me-1 show active">عرض المدراء المساعدين</a></li>
                    <li class="nav-item"><a href="#add-sub-admin" data-bs-toggle="tab" class="nav-link">إضافة مدير مساعد</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">جميع المدراء المساعدين</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display text-nowrap text-center" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>الإسم</th>
                                                <th>النوع</th>
                                                <th>البريد الإلكترونى</th>
                                                <th>الإعدادات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($sub_admins as $admin)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->gender }}</td>
                                                    <td>{{ $admin->email }}</td>

                                                    <td>
                                                        <a href="{{ route('sub_admins.edit',['id' => $admin->id]) }}" title="تعديل" class="btn btn-xs sharp btn-primary"><i class="fa fa-pencil"></i></a>
                                                        @if(count($admin->schools) == 0)
                                                            <form style="display:inline-block" action="{{route('sub_admins.destroy',['id'=>$admin->id])}}" method="post">
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
                                            @if(count($sub_admins) == 0)
                                                <tr>
                                                    <td colspan="5">
                                                        <h4 class="text-center">لا يوجد مدراء مساعدين</h4>
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="add-sub-admin" class="tab-pane fade col-lg-12 row">
                        <div class="col-lg-6 col-sm-12 m-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">أضف مدير مساعد جديد</h4>
                                </div>
                                <div class="card-body">
                                    <livewire:user.add-edit method='addSubAdmin' user_id='0'/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
