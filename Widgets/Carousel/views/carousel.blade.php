@if (!empty($slides))
    <section class="embla">
        <div class="embla__viewport">
            <div class="embla__container">
                @foreach ($slides as $slide)
                    <div class="embla__slide">
                        <img class="embla__slide__img" src="@at($slide->image)" />

                        <div class="slide__text">
                            <div>
                                <h1>{{ __($slide->title) }}</h1>
                                <p>{{ __($slide->description) }}</p>
                            </div>

                            @if ($slide->link)
                                <a class="btn btn--with-icon size-s primary" href="{{ url($slide->link) }}" target="_blank"
                                    role="button">
                                    @t('def.goto')
                                    <span class="btn__icon arrow"><i class="ph ph-arrow-right"></i></span>
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="embla__controls">
            <div class="embla__buttons">
                <button class="embla__button embla__button--prev" type="button" disabled="">
                    <svg class="embla__button__svg" viewBox="0 0 532 532">
                        <path fill="currentColor"
                            d="M355.66 11.354c13.793-13.805 36.208-13.805 50.001 0 13.785 13.804 13.785 36.238 0 50.034L201.22 266l204.442 204.61c13.785 13.805 13.785 36.239 0 50.044-13.793 13.796-36.208 13.796-50.002 0a5994246.277 5994246.277 0 0 0-229.332-229.454 35.065 35.065 0 0 1-10.326-25.126c0-9.2 3.393-18.26 10.326-25.2C172.192 194.973 332.731 34.31 355.66 11.354Z">
                        </path>
                    </svg></button><button class="embla__button embla__button--next" type="button" disabled="">
                    <svg class="embla__button__svg" viewBox="0 0 532 532">
                        <path fill="currentColor"
                            d="M176.34 520.646c-13.793 13.805-36.208 13.805-50.001 0-13.785-13.804-13.785-36.238 0-50.034L330.78 266 126.34 61.391c-13.785-13.805-13.785-36.239 0-50.044 13.793-13.796 36.208-13.796 50.002 0 22.928 22.947 206.395 206.507 229.332 229.454a35.065 35.065 0 0 1 10.326 25.126c0 9.2-3.393 18.26-10.326 25.2-45.865 45.901-206.404 206.564-229.332 229.52Z">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="embla__dots"></div>
        </div>
    </section>
@endif