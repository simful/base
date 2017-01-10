@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
<div class="container dash">
    <div class="row">
        <div class="col-md-6">
            <div class="box no-padding">
                <div class="box-header">New Orders</div>
                <div class="box-body">
                    <table class="table">
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td>#{{ $invoice->id }}</td>
                                <td>{{ $invoice->customer->name }}</td>
                                <td class="text-right">{{ count($invoice->total) ? m($invoice->total[0]->price) : m(0) }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ url('invoices') }}">See all <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box no-padding">
                <div class="box-header">Last Transactions</div>
                <div class="box-body">
                    <table class="table">
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->description }}</td>
                                <td class="text-right">{{ m($transaction->details()->sum('debit')) }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ url('transactions') }}">See all <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">Sales</div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Unpaid</label>
                        <p>{!! mp($sales->unpaid) !!}</p>
                    </div>

                    <div class="form-group">
                        <label>Due</label>
                        <p>{!! mp($sales->due) !!}</p>
                    </div>

                    <div class="form-group">
                        <label>Paid</label>
                        <p>{!! mp($sales->paid) !!}</p>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ url('invoices') }}">See all <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">Purchases</div>
                <div class="box-body">
                    <div class="form-group">
                        <label>Unpaid</label>
                        <p>{!! mp($purchases->unpaid) !!}</p>
                    </div>

                    <div class="form-group">
                        <label>Due</label>
                        <p>{!! mp($purchases->due) !!}</p>
                    </div>

                    <div class="form-group">
                        <label>Paid</label>
                        <p>{!! mp($purchases->paid) !!}</p>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ url('purchases') }}">See all <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box no-padding">
                <div class="box-header">Expenses</div>
                <div class="box-body">
                    <table class="table">
                        @foreach ($expenses as $expense)
                            <tr>
                                <td>{{ $expense->name }}</td>
                                <td class="text-right">{{ m($expense->total) }}</td>
                            </tr>
                        @endforeach
                    </table>
                    @if (!count($transactions))
                        <p>
                            <i>Belum ada pengeluaran.</i>
                        </p>
                    @endif
                </div>
                <div class="box-footer text-right">
                    <a href="{{ url('expenses') }}">See all <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box no-padding">
                <div class="box-header">Cash and Bank</div>
                <div class="box-body">
                    <table class="table">
                        @foreach ($cash as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td class="text-right">{{ m($item->balance) }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ url('accounts') }}">See all <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box no-padding">
                <div class="box-header">Stock</div>
                <div class="box-body">
                    <table class="table">
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td class="text-right">{{ $product->stock }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="box-footer text-right">
                    <a href="{{ url('stock') }}">See all <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
