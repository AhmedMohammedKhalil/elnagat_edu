@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>الأسابيع </h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-bs-toggle="tab" class="nav-link me-1 show active">عرض جميع الأسابيع </a></li>
                    @if(isset($weeks) && count($weeks) < 13)
                    <li class="nav-item"><a href="#add-week" data-bs-toggle="tab" class="nav-link">إضافة أسبوع جديد</a></li>
                    @endif
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
                                                <th> الأسبوع</th>
                                                <th>بداية الأسبوع</th>
                                                <th>نهاية الأسبوع</th>
                                                <th>الإعدادات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($weeks as $week)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $week->week_index }}</td>
                                                    <td>{{ $week->start_date }}</td>
                                                    <td>{{ $week->end_date }}</td>

                                                    <td>
                                                        @if(!$week->reviews)
                                                        <a href="{{ route('weeks.edit',['id' => $week->id]) }}" title="تعديل" class="btn btn-xs sharp btn-primary"><i class="fa fa-pencil"></i></a>
                                                        <form style="display:inline-block" action="{{route('weeks.destroy',['id'=>$week->id])}}" method="post">
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
                                            @if(count($weeks) == 0)
                                                <tr>
                                                    <td colspan="6">
                                                        <h4 class="text-center">لا يوجد أسابيع</h4>
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($weeks) && count($weeks) < 13)
                    <div id="add-week" class="tab-pane fade col-lg-12 row">
                        <div class="col-lg-6 col-sm-12 m-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">إضافة أسبوع جديد</h4>
                                </div>
                                <div class="card-body">
                                    <livewire:week.week method='add' week_id='0'/>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
