@extends('backend.legacy.layouts.app')

@section('meta-title')
    {{ __('Editing Customer') }} "{{ $customer->label }}"
@endsection

@section('page-title')
    {{ __('Editing Customer') }} "{{ $customer->title }}"
@endsection

@section('breadcrumb-title')
    {{ __('Edit Customer') }}
@endsection

@section('content')
    <form role="form" action="{{ route('admin.customers.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('backend.legacy.layouts._formErrors')

        <div class="form-group">
            <input type="text" name="label" value="{{ old('label', $customer->label) }}" placeholder="{{ __('Label') }}" class="form-control">
        </div>
        <div class="form-group">
            <textarea class="form-control summernote" name="description" placeholder="{{ __('Description') }}" cols="30" rows="10">{{ old('description', $customer->description) }}</textarea>
        </div>
        <div class="form-group">
            <div>
                @if ($customer->image)
                    <img src="{{ asset($customer->image) }}" alt="" height="100">
                @endif
            </div>
            <label for="image">{{ __('Image') }}</label>
            <input type="file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-rw btn-primary">{{ __('Submit') }}</button>
    </form>
@endsection
