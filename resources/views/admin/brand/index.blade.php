@extends('admin.layout.app')
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
            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)"></th>
                                    <th>@lang('translate.logo')</th>
                                    <th>@lang('translate.name')</th>
                                    <th>@lang('translate.createdAt')</th>
                                    <th>@lang('translate.updatedAt')</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands ?? [] as $brand)
                                    <tr>
                                        <td><input type="checkbox" data-id="{{ $brand->id }}"></td>
                                        <td>
                                            @if ($brand->getFirstMediaUrl('brands'))
                                                <img src="{{ $brand->getFirstMediaUrl('brands') }}"
                                                    alt="Hình ảnh thương hiệu" class="img-thumbnail" width="200">
                                            @endif
                                        </td>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->created_at }}</td>
                                        <td>{{ $brand->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.brand.edit', ['id' => $brand->id]) }}"
                                                class="btn btn-warning btn-sm">
                                                @lang('translate.edit')
                                            </a>
                                        </td>
                                        <td>
                                            <form id="delete-form-{{ $brand->id }}" class="hidden"
                                                action="{{ route('admin.brand.destroy', ['brand' => $brand->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button class="btn btn-danger btn-sm btn-remove" data-id="{{ $brand->id }}">
                                                @lang('translate.delete')
                                            </button>
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
        };
    </script>
    <script type="module" src="{{ asset('') }}/adm/js/brand/index.js"></script>
@endpush
