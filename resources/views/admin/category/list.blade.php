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
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.category.index') }}">@lang('translate.categories')</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ $category->name }}
                </li>
            </ol>
            <!-- DataTables Example -->
            <div class="action-bar">
                <a href="{{ route('admin.category.create.child', ['id' => $category->id]) }}"
                    class="btn btn-primary btn-sm">@lang('translate.add')</a>
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
                                @foreach ($categories ?? [] as $child)
                                    <tr>
                                        <td class="text-center"><input type="checkbox" data-id="{{ $child->id }}"></td>
                                        <td class="text-center">{{ $child->name }}</td>
                                        <td class="text-center">
                                            <button
                                                class="btn {{ $child->status ? 'btn-success' : 'btn-danger' }} btn-sm btn-change-status"
                                                data-id="{{ $child->id }}" data-status="{{ 1 - ($child->status ?? 0) }}"
                                                data-url="{{ route('admin.category.change_status', ['category' => $child->id]) }}">
                                                {{ $child->status ? __('translate.active') : __('translate.inactive') }}
                                            </button>
                                        </td>
                                        <td class="text-center">{{ $child->created_at }}</td>
                                        <td class="text-center">{{ $child->updated_at }}</td>
                                        <td class="text-center row">
                                            <div class="col-md-4">
                                                <a href="{{ route('admin.category.edit.child', ['id' => $category->id, 'category' => $child->id]) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <div class="col-md-4">
                                                <form id="delete-form-{{ $child->id }}" class="hidden"
                                                    action="{{ route('admin.category.destroy', ['category' => $child->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button class="btn btn-danger btn-sm btn-remove"
                                                    data-id="{{ $child->id }}">
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
    <script type="module" src="{{ asset('') }}/adm/js/category/index.js"></script>
@endpush
