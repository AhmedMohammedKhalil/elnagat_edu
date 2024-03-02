@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>التقييمات</h4>
                </div>
            </div>
        </div>

        <div class="row">
            @if($flag)
            <div class="col-lg-12">
                <ul class="nav nav-pills mb-3">
                    <li class="nav-item"><a href="#list-view" data-bs-toggle="tab" class="nav-link me-1 show active">عرض التقييمات</a></li>
                    @if($count != count($reviews))
                        <li class="nav-item"><a href="#add-review" data-bs-toggle="tab" class="nav-link">إضافة تقييم جديد</a></li>
                    @endif
                </ul>
            </div>
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="list-view" class="tab-pane fade active show col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">جميع التقييمات</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example5" class="display text-nowrap text-center" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>اسم المعلم</th>
                                                <th>المرحلة التعليمية</th>
                                                <th>الصف الدراسى</th>
                                                <th>التقييم الإجمالى</th>
                                                <th>الإعدادات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach($reviews as $review)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $review->teacher->name }}</td>
                                                    <td>{{ $review->classroom->level->name }}</td>
                                                    <td>{{ $review->classroom->name }}</td>
                                                    <td>{{ $review->result }}</td>
                                                    <td>
                                                        <a href="{{ route('reviews.edit',['id' => $review->id]) }}" title="تعديل" class="btn btn-xs sharp btn-primary"><i class="fa fa-pencil"></i></a>
                                                        <form style="display:inline-block" action="{{route('reviews.destroy',['id'=>$review->id])}}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button class="btn btn-xs sharp btn-danger" type="submit" title="حذف" >
                                                                <i class='fa fa-trash'></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @if(!$reviews)
                                                <tr>
                                                    <td colspan="6">
                                                        <h4 class="text-center">لا يوجد تقييمات</h4>
                                                    </td>
                                                </tr>
                                            @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="add-review" class="tab-pane fade col-lg-12 row">
                        <div class="col-lg-12 col-sm-12 m-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">أضف تقييم جديد</h4>
                                </div>
                                <div class="card-body">
                                    <livewire:review.review method='add' :week_id="$current_week->id" review_id='0'/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
                <div class="col-12">
                    <h2 class="text-center">لا يوجد صفوف دراسية لهذة المدرسة</h2>
                </div>
            @endif
        </div>
    </div>
@endsection
