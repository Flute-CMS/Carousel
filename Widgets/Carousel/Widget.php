<?php

namespace Flute\Modules\Carousel\Widgets\Carousel;

use Flute\Core\Widgets\AbstractWidget;
use Flute\Modules\Carousel\database\Entities\Slide;
use Nette\Utils\Html;

class Widget extends AbstractWidget
{
    public function __construct()
    {
        $this->setAssets([
            'https://unpkg.com/embla-carousel-autoplay@8.1.5/embla-carousel-autoplay.umd.js',
            'https://unpkg.com/embla-carousel@8.1.5/embla-carousel.umd.js',
            mm('Carousel', 'Widgets/Carousel/assets/js/carousel.js'),
            mm('Carousel', 'Widgets/Carousel/assets/scss/carousel.scss'),
        ]);
    }

    public function render(array $data = []): string
    {
        return render(mm('Carousel', 'Widgets/Carousel/views/carousel'), [
            'slides' => rep(Slide::class)->findAll()
        ]);
    }

    public function placeholder(array $settingValues = []): string
    {
        $row = Html::el('div');
        $row->addClass('row');

        $col = Html::el('div');
        $col->addClass('col-md-12');

        $placeHolder = Html::el('div');
        $placeHolder->addClass('skeleton');
        $placeHolder->style('height', '200px');

        $col->addHtml($placeHolder);

        $row->addHtml($col);

        return $row->toHtml();
    }

    public function getName(): string
    {
        return 'Carousel widget';
    }

    public function isLazyLoad(): bool
    {
        return false;
    }
}