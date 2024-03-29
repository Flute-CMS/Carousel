@extends('Core.Admin.Http.Views.layout', [
    'title' => __('admin.title', ['name' => __('carousel.edit_title', [
        ':name' => $slide->title
    ])]),
])

@push('content')
    <div class="admin-header d-flex align-items-center">
        <a href="{{ url('admin/carousel/list') }}" class="back_btn">
            <i class="ph ph-caret-left"></i>
        </a>
        <div>
            <h2>@t('carousel.edit_title', [
                ':name' => $slide->title
            ])</h2>
            <p>@t('carousel.edit_description')</p>
        </div>
    </div>

    <form data-id="{{ $slide->id }}" data-carouselform="edit" data-page="carousel" enctype="multipart/form-data">
        @csrf
        <div class="position-relative row form-group">
            <div class="col-sm-3 col-form-label required">
                <label for="title">
                    @t('carousel.title_label')
                </label>
            </div>
            <div class="col-sm-9">
                <input name="title" id="title" placeholder="@t('carousel.title_label')" type="text" class="form-control"
                    required value="{{ $slide->title }}">
            </div>
        </div>

        <div class="position-relative row form-group">
            <div class="col-sm-3 col-form-label required">
                <label for="title">
                    @t('carousel.description')
                </label>
            </div>
            <div class="col-sm-9">
                <input name="description" id="description" placeholder="@t('carousel.description')" type="text"
                    class="form-control" required value="{{ $slide->description }}">
            </div>
        </div>

        <div class="position-relative row form-group">
            <div class="col-sm-3 col-form-label">
                <label for="image">
                    @t('carousel.image')
                </label>
            </div>
            <div class="col-sm-9">
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
            </div>
        </div>

        <div class="position-relative row form-group">
            <div class="col-sm-3 col-form-label">
                <label for="title">
                    @t('carousel.link')
                </label>
            </div>
            <div class="col-sm-9">
                <input name="link" id="link" placeholder="@t('carousel.link')" value="{{ $slide->link }}"
                    type="text" class="form-control">
            </div>
        </div>

        <!-- Кнопка отправки -->
        <div class="position-relative row form-check">
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" data-save class="btn size-m btn--with-icon primary">
                    @t('def.save')
                    <span class="btn__icon arrow"><i class="ph ph-arrow-right"></i></span>
                </button>
            </div>
        </div>
    </form>
@endpush

@push('footer')
    @at('Modules/Carousel/Http/assets/js/admin_form.js')
@endpush
