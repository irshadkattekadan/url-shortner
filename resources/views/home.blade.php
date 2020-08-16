@extends('layouts.app')
@section('dashboard', 'active')
@section('breadcumb')
<div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </div><!-- /.col -->
  </div>
@endsection
@section('content')
<div class="container-fluid">
    <!-- Info boxes -->
    <div class="row">
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fa fa-link"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Total Urls</span>
            <span class="info-box-number">
              {{ $total_urls }}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->
      <div class="col-12 col-sm-6 col-md-6">
        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-copy"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Duplicate Urls</span>
            <span class="info-box-number">
                {{ $duplicate_url_count }}
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <!-- /.col -->

    </div>
    <!-- /.row -->




    <!-- /.row -->
  </div><!--/. container-fluid -->
@endsection
