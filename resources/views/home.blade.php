@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="container dash">
    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">Online Orders</div>
                <div class="box-body">

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">Last Transactions</div>
                <div class="box-body">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">Penjualan</div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Belum Dibayar</label>
                        <p>{!! mp(0) !!}</p>
                    </div>

                    <div class="form-group">
                        <label>Jatuh Tempo</label>
                        <p>{!! mp(0) !!}</p>
                    </div>

                    <div class="form-group">
                        <label>Lunas</label>
                        <p>{!! mp(0) !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">Pembelian</div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Belum Dibayar</label>
                        <p>{!! mp(0) !!}</p>
                    </div>

                    <div class="form-group">
                        <label>Jatuh Tempo</label>
                        <p>{!! mp(0) !!}</p>
                    </div>

                    <div class="form-group">
                        <label>Lunas</label>
                        <p>{!! mp(0) !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">Biaya</div>
                <div class="box-body">
                    <p>
                        <i>Belum ada pengeluaran.</i>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">Cash and Bank</div>
                <div class="box-body"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">Stock</div>
                <div class="box-body"></div>
            </div>
        </div>
    </div>
</div>
@endsection
