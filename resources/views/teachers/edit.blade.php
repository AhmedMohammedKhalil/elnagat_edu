@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>تعديل بيانات المعلم </h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-sm-12 m-auto">
                <div class="card">
                    <div class="card-body">
                        <livewire:teacher.teacher method='edit' :school_id='$school_id' :teacher_id='$teacher_id' />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
