<?php

namespace Flute\Modules\Carousel\ServiceProviders;

use Flute\Core\Support\ModuleServiceProvider;
use Flute\Modules\Carousel\ServiceProviders\Extensions\AdminExtension;
use Flute\Modules\Carousel\ServiceProviders\Extensions\WidgetExtension;

class CarouselServiceProvider extends ModuleServiceProvider
{
    public array $extensions = [
        WidgetExtension::class,
        AdminExtension::class
    ];

    public function boot(\DI\Container $container): void
    {
        $this->loadTranslations();
        $this->loadEntities();
    }

    public function register(\DI\Container $container): void
    {
    }
}