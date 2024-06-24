const addDotBtnsAndClickHandlersCarousel = (emblaApiCarousel, dotsNode) => {
    let dotNodes = [];

    const addDotBtnsWithClickHandlers = () => {
        dotsNode.innerHTML = emblaApiCarousel
            .scrollSnapList()
            .map(() => '<button class="embla__dot" type="button"></button>')
            .join('');

        const scrollTo = (index) => {
            emblaApiCarousel.scrollTo(index);
        };

        dotNodes = Array.from(dotsNode.querySelectorAll('.embla__dot'));
        dotNodes.forEach((dotNode, index) => {
            dotNode.addEventListener('click', () => scrollTo(index), false);
        });
    };

    const toggleDotBtnsActive = () => {
        const previous = emblaApiCarousel.previousScrollSnap();
        const selected = emblaApiCarousel.selectedScrollSnap();
        dotNodes[previous].classList.remove('embla__dot--selected');
        dotNodes[selected].classList.add('embla__dot--selected');
    };

    emblaApiCarousel
        .on('init', addDotBtnsWithClickHandlers)
        .on('reInit', addDotBtnsWithClickHandlers)
        .on('init', toggleDotBtnsActive)
        .on('reInit', toggleDotBtnsActive)
        .on('select', toggleDotBtnsActive);

    return () => {
        dotsNode.innerHTML = '';
    };
};
const addTogglePrevNextBtnsActiveCarousel = (
    emblaApiCarousel,
    prevBtn,
    nextBtn,
) => {
    const togglePrevNextBtnsState = () => {
        if (emblaApiCarousel.canScrollPrev())
            prevBtn.removeAttribute('disabled');
        else prevBtn.setAttribute('disabled', 'disabled');

        if (emblaApiCarousel.canScrollNext())
            nextBtn.removeAttribute('disabled');
        else nextBtn.setAttribute('disabled', 'disabled');
    };

    emblaApiCarousel
        .on('select', togglePrevNextBtnsState)
        .on('init', togglePrevNextBtnsState)
        .on('reInit', togglePrevNextBtnsState);

    return () => {
        prevBtn.removeAttribute('disabled');
        nextBtn.removeAttribute('disabled');
    };
};

const addPrevNextBtnsClickHandlers = (emblaApiCarousel, prevBtn, nextBtn) => {
    const scrollPrev = () => {
        emblaApiCarousel.scrollPrev();
    };
    const scrollNext = () => {
        emblaApiCarousel.scrollNext();
    };
    prevBtn.addEventListener('click', scrollPrev, false);
    nextBtn.addEventListener('click', scrollNext, false);

    const removeTogglePrevNextBtnsActive = addTogglePrevNextBtnsActiveCarousel(
        emblaApiCarousel,
        prevBtn,
        nextBtn,
    );

    return () => {
        removeTogglePrevNextBtnsActive();
        prevBtn.removeEventListener('click', scrollPrev, false);
        nextBtn.removeEventListener('click', scrollNext, false);
    };
};

const OPTIONS_CAROUSEL = {
    loop: true,
};

const emblaNodeCarousel = document.querySelector('.embla');
const viewportNodeCarousel =
    emblaNodeCarousel.querySelector('.embla__viewport');
const prevBtnCarousel = emblaNodeCarousel.querySelector('.embla__button--prev');
const nextBtnCarousel = emblaNodeCarousel.querySelector('.embla__button--next');
const dotsNodeCarousel = document.querySelector('.embla__dots');

const emblaApiCarousel = EmblaCarousel(viewportNodeCarousel, OPTIONS_CAROUSEL, [
    EmblaCarouselAutoplay({ playOnInit: true, delay: 5000 }),
]);

const removePrevNextBtnsClickHandlersC = addPrevNextBtnsClickHandlers(
    emblaApiCarousel,
    prevBtnCarousel,
    nextBtnCarousel,
);
const removeDotBtnsAndClickHandlersC = addDotBtnsAndClickHandlersCarousel(
    emblaApiCarousel,
    dotsNodeCarousel,
);

emblaApiCarousel
    .on('destroy', removePrevNextBtnsClickHandlersC)
    .on('destroy', removeDotBtnsAndClickHandlersC);
