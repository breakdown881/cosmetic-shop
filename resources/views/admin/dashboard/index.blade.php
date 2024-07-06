@extends('admin.layout.app')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">@lang('translate.overview')</li>
            </ol>
            <div class="mb-3 my-3">
                <a href="#" class="active btn btn-primary">@lang('translate.today')</a>
                <a href="#" class="btn btn-primary">@lang('translate.yesterday')</a>
                <a href="#" class="btn btn-primary">@lang('translate.thisWeek')</a>
                <a href="#" class="btn btn-primary">@lang('translate.thisMonth')</a>
                <a href="#" class="btn btn-primary">@lang('translate.3month')</a>
                <a href="#" class="btn btn-primary">@lang('translate.thisYear')</a>
                <div class="dropdown" style="display:inline-block">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <div style="margin:20px">
                            @lang('translate.fromDate') <input type="date" class="form-control" id="usr">
                            @lang('translate.toDate') <input type="date" class="form-control" id="usr">
                            <br>
                            <input type="submit" value="@lang('translate.find')" class="btn btn-primary form-control">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Icon Cards-->
            <div class="row">
                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">
                                {{ 0 }} @lang('translate.orders')
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">@lang('translate.detail')</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-shopping-cart"></i>
                            </div>
                            @php
                                $revenue = 0;
                                $cancel_order = 0;
                                foreach ($orders ?? [] as $order) {
                                    if ($order->order_status_id == 6) {
                                        $cancel_order++;
                                    } else {
                                        $revenue += $order->payment_total;
                                    }
                                }
                            @endphp
                            <div class="mr-5">
                                @lang('translate.revenue') {{ number_format($revenue) }} đ
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">@lang('translate.detail')</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-3">
                    <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-fw fa-life-ring"></i>
                            </div>
                            <div class="mr-5">
                                {{ $cancel_order }} @lang('translate.cancelledOrders')
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">@lang('translate.detail')</span>
                            <span class="float-right">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- DataTables Example -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    @lang('translate.orders')
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>@lang('translate.code')</th>
                                    <th>@lang('translate.customerName')</th>
                                    <th>@lang('translate.customerPhone')</th>
                                    <th>@lang('translate.customerEmail')</th>
                                    <th>@lang('translate.status')</th>
                                    <th>@lang('translate.orderDate')</th>
                                    <th>@lang('translate.paymentMethod')</th>
                                    <th>@lang('translate.receiver')</th>
                                    <th>@lang('translate.receiverPhone')</th>
                                    <th>@lang('translate.deliveryDate')</th>
                                    <th>@lang('translate.feeShips')</th>
                                    <th>@lang('translate.temporaryCalculation')</th>
                                    <th>@lang('translate.total')</th>
                                    <th>@lang('translate.deliveryAddress')</th>
                                    <th>@lang('translate.staffIncharge')</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders ?? [] as $order)
                                    <tr>
                                        <td>#{{ $order?->id }}</td>
                                        <td>{{ $order?->customer->name }}</td>
                                        <td>{{ $order?->customer->mobile }}</td>
                                        <td>{{ $order?->customer->email }}</td>
                                        <td>{{ $order?->status->description }}</td>
                                        <td>{{ $order?->created_date }} </td>
                                        <td>{{ $order?->payment_method == 0 ? 'COD' : 'Bank' }}</td>
                                        <td>{{ $order?->shipping_fullname }}</td>
                                        <td>{{ $order?->shipping_mobile }}</td>
                                        <td>{{ $order?->delivered_date }}</td>

                                        <td>{{ number_format($order?->shipping_fee) }} đ</td>
                                        <td>{{ number_format($order?->price_inc_tax_total) }} đ</td>
                                        <td>{{ number_format($order?->payment_total) }} đ</td>
                                        <td>
                                            {{ $order?->shipping_housenumber_street }}, {{ $order?->ward?->name }},
                                            {{ $order?->ward?->district?->name }},
                                            {{ $order?->ward?->district?->province?->name }}
                                        </td>
                                        <td>{{ !empty($order?->staff) ? $order?->staff?->name : '' }}</td>
                                        <td>
                                            <input type="button" onclick="Confirm('1');" value="@lang('translate.confirm')"
                                                class="btn btn-primary btn-sm">
                                        </td>
                                        <td>
                                            <input type="button" onclick="Edit('1');" value="@lang('translate.edit')"
                                                class="btn btn-warning btn-sm">
                                        </td>
                                        <td>
                                            <input type="button" onclick="Delete('1');" value="@lang('translate.delete')"
                                                class="btn btn-danger btn-sm">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
