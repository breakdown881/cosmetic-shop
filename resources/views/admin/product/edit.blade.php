@extends('admin.layout.app')
@section('title', 'Products')
@section('content')
    <div id="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">@lang('translate.management')</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.product.index') }}">@lang('translate.products')</a>
                </li>
                <li class="breadcrumb-item active">
                    {{ $product->name }}
                </li>
            </ol>
            <form method="post" action="{{ route('admin.product.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="code">Code<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <input name="code" id="code" type="text" value="{{ old('code', $product->code) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="name">@lang('translate.name')<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <input name="name" id="name" type="text" value="{{ old('name', $product->name) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="brand_id">@lang('translate.brands')<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <select name="brand_id" id="brand_id" class="form-control">
                            @foreach ($brands ?? [] as $brand)
                                <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id) == $brand->id)>{{ $brand->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="category_id">@lang('translate.categories')<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ($categories ?? [] as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="price">Price<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <input name="price" id="price" type="number" min="0" value="{{ old('price', $product->price) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="discount_percentage">Discount percentage<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <input name="discount_percentage" id="discount_percentage" type="number" min="0" max="100" value="{{ old('discount_percentage', $product->discount_percentage) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="discount_from_date">Discount from date<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <input name="discount_from_date" id="discount_from_date" type="date" value="{{ old('discount_from_date', $product->discount_from_date) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="discount_to_date">Discount to date<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <input name="discount_to_date" id="discount_to_date" type="date" value="{{ old('discount_to_date', $product->discount_to_date) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="media_id">Media ID<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <input name="media_id" id="media_id" type="number" min="1" value="{{ old('media_id', $product->media_id) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="inventory_qty">Inventory quantity<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <input name="inventory_qty" id="inventory_qty" type="number" min="0" value="{{ old('inventory_qty', $product->inventory_qty) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="description">Description<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="star">Star<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <input name="star" id="star" type="number" min="0" max="5" step="0.1" value="{{ old('star', $product->star) }}" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="featured">Featured<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <select name="featured" id="featured" class="form-control">
                            <option value="0" @selected(old('featured', $product->featured) == 0)>No</option>
                            <option value="1" @selected(old('featured', $product->featured) == 1)>Yes</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-12 control-label" for="status">@lang('translate.status')<span class="required">*</span></label>
                    <div class="col-md-9 col-lg-6">
                        <select name="status" id="status" class="form-control">
                            <option value="0" @selected(old('status', $product->status) == 0)>@lang('translate.inactive')</option>
                            <option value="1" @selected(old('status', $product->status) == 1)>@lang('translate.active')</option>
                        </select>
                    </div>
                </div>
                <div class="form-action row">
                    <div class="col-md-9 col-lg-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-md mr-2">@lang('translate.save')</button>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary btn-md">@lang('translate.back')</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
