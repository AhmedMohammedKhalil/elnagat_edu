@extends('layouts.app')
@section('content')
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">

        <div class="row page-titles mx-0" style="height: 200px">
            <div class="col-sm-12">
                <div class="welcome-text text-center">
                    <h4> تقارير المدارس </h4>
                </div>
            </div>
        </div>
       <div>
       @include('reports.includes.school-report')
       </div>
    </div>
@endsection
