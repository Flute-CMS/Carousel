<?php

namespace Flute\Modules\Carousel\ServiceProviders\Extensions;

use Flute\Modules\Carousel\Widgets\Carousel\Widget;

class WidgetExtension implements \Flute\Core\Contracts\ModuleExtensionInterface
{
    public function register() : void
    {
        widgets()->register(new Widget);
    }
}