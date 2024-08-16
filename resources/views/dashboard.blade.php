@extends('layouts.master')

@section('title', 'Number Tracking | Dashboard')
@section('head')
	@include('partials.head')
@endsection

@section('header')
	@include('partials.header')
@endsection

@section('sidebar')
	@include('partials.sidebar')
@endsection

@section('contentheader')
	<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection

@section('maincontent')
    <section class="content">
      <div class="container-fluid">
             <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-coins"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">text</span>
                            <span class="info-box-number">
                                10
                                <small>₹</small>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <a href="#" style="color: #000 !important;">
                        <div class="info-box mb-3">

                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-building"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">test</span>
                                <span class="info-box-number">test</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </a>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>
                <a href="#" style="color: #000 !important;">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-building"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Sub Courts</span>
                                <span class="info-box-number">test</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                </a>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">

                <a href="#" style="color: #000 !important;">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">test</span>
                            <span class="info-box-number">test</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </a>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
@endsection  

@section('footer')
	@include('partials.footer')
@endsection
  
@section('scripts')
	@include('partials.scripts')
@endsection
