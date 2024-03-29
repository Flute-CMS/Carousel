<?php

namespace Flute\Modules\Carousel;

class Installer extends \Flute\Core\Support\AbstractModuleInstaller
{
    public function install(\Flute\Core\Modules\ModuleInformation &$module) : bool
    {
        return true;
    }

    public function uninstall(\Flute\Core\Modules\ModuleInformation &$module) : bool
    {
        widgets()->unregister(\Flute\Modules\Carousel\Widgets\Carousel\Widget::class);
        return true;
    }
}