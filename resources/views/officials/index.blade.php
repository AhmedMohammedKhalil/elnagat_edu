@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>فريق التشغيل</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-bs-toggle="tab" class="nav-link me-1 show active">عرض فريق التشغيل</a></li>
                    <li class="nav-item"><a href="#add-official" data-bs-toggle="tab" class="nav-link">إضافة عضو جديد</a></li>
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">فريق التشغيل</h4>
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
                                                <th>المدرسة</th>
                                                <th>الإعدادات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($officials as $official)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $official->name }}</td>
                                                    <td>{{ $official->gender }}</td>
                                                    <td>{{ $official->email }}</td>
                                                    <td>{{ $official->owner?->name }}</td>


                                                    <td>
                                                        <a href="{{ route('officials.edit',['id' => $official->id]) }}" title="تعديل" class="btn btn-xs sharp btn-primary"><i class="fa fa-pencil"></i></a>
                                                        @if(!$official->owner)
                                                        <form style="display:inline-block" action="{{route('officials.destroy',['id'=>$official->id])}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-xs sharp btn-danger" type="submit" title="حذف">
                                                                <i class='fa fa-trash'></i>
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @if(count($officials) == 0)
                                                <tr>
                                                    <td colspan="6">
                                                        <h4 class="text-center">لا يوجد فريق تشغيل</h4>
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="add-official" class="tab-pane fade col-lg-12 row">
                        <div class="col-lg-6 col-sm-12 m-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">أضف عضو جديد</h4>
                                </div>
                                <div class="card-body">
                                    <livewire:user.add-edit method='addOfficial' user_id='0'/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
