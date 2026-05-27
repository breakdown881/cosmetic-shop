@extends('admin.layout.app')
@section('title', 'Brands')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">@lang('translate.management')</a>
                </li>
                <li class="breadcrumb-item active">@lang('translate.brands')</li>
            </ol>
            <!-- DataTables Example -->
            <div class="action-bar">
                <a href="{{ route('admin.brand.create') }}" class="btn btn-primary btn-sm">@lang('translate.add')</a>
                <input type="submit" class="btn btn-danger btn-sm" value="@lang('translate.delete')" name="delete">
            </div>
            <form method="get" action="{{ route('admin.brand.index') }}" class="form-inline mb-3">
                <div class="form-group mr-2">
                    <input name="name" type="text" value="{{ $name ?? '' }}" class="form-control"
                        placeholder="@lang('translate.name')">
                </div>
                <button type="submit" class="btn btn-primary btn-sm mr-2">@lang('translate.find')</button>
                <a href="{{ route('admin.brand.index') }}" class="btn btn-secondary btn-sm">@lang('translate.cancel')</a>
            </form>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="no-sort text-center" width="50"><input type="checkbox"
                                            onclick="checkAll(this)"></th>
                                    <th class="no-sort text-center" width="100">@lang('translate.logo')</th>
                                    <th class="text-center" width="300">@lang('translate.name')</th>
                                    <th class="text-center" width="100">@lang('translate.status')</th>
                                    <th class="text-center" width="100">@lang('translate.createdAt')</th>
                                    <th class="text-center" width="100">@lang('translate.updatedAt')</th>
                                    <th class="no-sort text-center" width="100">@lang('translate.management')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands ?? [] as $brand)
                                    <tr>
                                        <td class="text-center"><input type="checkbox" data-id="{{ $brand->id }}"></td>
                                        <td class="text-center">
                                            @if ($brand->getFirstMediaUrl('brands'))
                                                <img src="{{ $brand->getFirstMediaUrl('brands') }}"
                                                    alt="Hình ảnh thương hiệu" class="img-thumbnail" width="200">
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $brand->name }}</td>
                                        <td class="text-center">
                                            <button
                                                class="btn {{ $brand->status ? 'btn-success' : 'btn-danger' }} btn-sm btn-change-status"
                                                data-id="{{ $brand->id }}" data-status="{{ 1 - ($brand->status ?? 0) }}">
                                                {{ $brand->status ? __('translate.active') : __('translate.inactive') }}
                                            </button>
                                        </td>
                                        <td class="text-center">{{ $brand->created_at }}</td>
                                        <td class="text-center">{{ $brand->updated_at }}</td>
                                        <td class="text-center row">
                                            <div class="col-md-6">
                                                <a href="{{ route('admin.brand.edit', ['id' => $brand->id]) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-6">
                                                <form id="delete-form-{{ $brand->id }}" class="hidden"
                                                    action="{{ route('admin.brand.destroy', ['brand' => $brand->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button class="btn btn-danger btn-sm btn-remove"
                                                    data-id="{{ $brand->id }}">
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
    <script type="module" src="{{ asset('') }}/adm/js/brand/index.js"></script>
@endpush
