@extends('admin.layout.app')
@section('title', 'Categories')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">@lang('translate.management')</a>
                </li>
                <li class="breadcrumb-item active">@lang('translate.categories')</li>
            </ol>
            <!-- DataTables Example -->
            <div class="action-bar">
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-sm">@lang('translate.add')</a>
                <input type="submit" class="btn btn-danger btn-sm" value="@lang('translate.delete')" name="delete">
            </div>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="no-sort text-center" width="50"><input type="checkbox"
                                            onclick="checkAll(this)"></th>
                                    <th class="text-center" width="300">@lang('translate.name')</th>
                                    <th class="text-center" width="100">@lang('translate.status')</th>
                                    <th class="text-center" width="100">@lang('translate.createdAt')</th>
                                    <th class="text-center" width="100">@lang('translate.updatedAt')</th>
                                    <th class="no-sort text-center" width="100">@lang('translate.management')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories ?? [] as $product)
                                    <tr>
                                        <td class="text-center"><input type="checkbox" data-id="{{ $product->id }}"></td>
                                        <td class="text-center">{{ $product->name }}</td>
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
                                        <td class="text-center">{{ $product->updated_at }}</td>
                                        <td class="text-center row">
                                            <div class="col-md-4">
                                                <a href="{{ route('admin.product.list', ['id' => $product->id]) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-list"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
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
