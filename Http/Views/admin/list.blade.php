
@extends('Core.Admin.Http.Views.layout', [
    'title' => __('admin.title', ['name' => __('carousel.setting')]),
])

@push('header')
@endpush

@push('content')
    <div class="admin-header d-flex justify-content-between align-items-center">
        <div>
            <h2>@t('carousel.setting')</h2>
            <p>@t('carousel.setting_description')</p>
        </div>
        <div>
            <a href="{{url('admin/carousel/add')}}" class="btn size-s outline">
                @t('carousel.add')
            </a>
        </div>
    </div>

    {!! $table !!}
@endpush

@push('footer')
@endpush
