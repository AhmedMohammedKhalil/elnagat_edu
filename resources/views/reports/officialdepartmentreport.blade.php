@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4> تقرير القسم </h4>
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-lg-12">
                <div class="row tab-content">
                    <div id="add-official" class="col-lg-12 row">
                        <div class="col-lg-6 col-sm-12 m-auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> تقرير القسم </h4>
                                </div>
                                <div class="card-body">
                                    <livewire:report.official-department-report />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
