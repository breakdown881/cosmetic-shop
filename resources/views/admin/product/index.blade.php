@extends('admin.layout.app')
@section('title', 'Products')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">@lang('translate.management')</a>
                </li>
                <li class="breadcrumb-item active">@lang('translate.products')</li>
            </ol>
            <div class="action-bar">
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">@lang('translate.add')</a>
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="120">Code</th>
                                    <th class="text-center">@lang('translate.name')</th>
                                    <th class="text-center" width="120">Price</th>
                                    <th class="text-center" width="100">Inventory</th>
                                    <th class="text-center" width="100">@lang('translate.status')</th>
                                    <th class="text-center" width="140">@lang('translate.createdAt')</th>
                                    <th class="no-sort text-center" width="120">@lang('translate.management')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products ?? [] as $product)
                                    <tr>
                                        <td class="text-center">{{ $product->code }}</td>
                                        <td class="text-center">{{ $product->name }}</td>
                                        <td class="text-center">{{ number_format($product->price) }}</td>
                                        <td class="text-center">{{ $product->inventory_qty }}</td>
                                        <td class="text-center">
                                            <button
                                                class="btn {{ $product->status ? 'btn-success' : 'btn-danger' }} btn-sm btn-change-status"
                                                data-id="{{ $product->id }}"
                                                data-status="{{ 1 - ($product->status ?? 0) }}"
                                                data-url="{{ route('admin.product.change_status', ['product' => $product->id]) }}">
                                                {{ $product->status ? __('translate.active') : __('translate.inactive') }}
                                            </button>
                                        </td>
                                        <td class="text-center">{{ $product->created_at }}</td>
                                        <td class="text-center row">
                                            <div class="col-md-6">
                                                <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <form id="delete-form-{{ $product->id }}" class="hidden"
                                                    action="{{ route('admin.product.destroy', ['product' => $product->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button class="btn btn-danger btn-sm btn-remove"
                                                    data-id="{{ $product->id }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
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
@push('scripts')
    <script>
        window.translations = {
            confirmDelete: @json(__('translate.confirmDelete')),
            deleteButton: @json(__('translate.buttonDelete')),
            cancelButton: @json(__('translate.buttonCancel')),
            confirmButton: @json(__('translate.confirmButton')),
            confirmChangeStatus: @json(__('translate.confirmChangeStatus')),
        };
    </script>
    <script type="module" src="{{ asset('') }}/adm/js/product/index.js"></script>
@endpush
