@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4>تعديل بيانات المدير المساعد</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-sm-12 m-auto">
                <div class="card">
                    <div class="card-body">
                        <livewire:user.add-edit method='editSubAdmin' :user_id='$user_id' />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
