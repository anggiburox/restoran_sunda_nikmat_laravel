@extends('layout.spv_owner')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Total Users</div>
                        <div class="stat-digit">{{$users}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Total Produk</div>
                        <div class="stat-digit">{{$produk}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Total Produk Masuk</div>
                        <div class="stat-digit">{{$produk_masuk}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-two card-body">
                    <div class="stat-content">
                        <div class="stat-text">Total Transaksi</div>
                        <div class="stat-digit">{{$transaksi}}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
</div>
@endsection