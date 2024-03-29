<?php

namespace Flute\Modules\Carousel\ServiceProviders\Extensions;

use Flute\Core\Admin\Builders\AdminSidebarBuilder;
use Flute\Core\Admin\Http\Middlewares\HasPermissionMiddleware;
use Flute\Core\Router\RouteGroup;
use Flute\Modules\Carousel\Http\Controllers\AdminApiController;
use Flute\Modules\Carousel\Http\Controllers\AdminViewController;

class AdminExtension implements \Flute\Core\Contracts\ModuleExtensionInterface
{
    public function register(): void
    {
        AdminSidebarBuilder::add('additional', [
            'title' => 'carousel.title',
            'icon' => 'ph-images',
            'permission' => 'admin.system',
            'url' => '/admin/carousel/list'
        ]);

        router()->group(function( RouteGroup $routeGroup ) {

            $routeGroup->get('/carousel/list', [AdminViewController::class, 'index']);
            $routeGroup->get('/carousel/add', [AdminViewController::class, 'create']);
            $routeGroup->get('/carousel/edit/{id}', [AdminViewController::class, 'update']);

            $routeGroup->group(function( RouteGroup $routeApiGroup ) {
                $routeApiGroup->post('/add', [AdminApiController::class, 'store']);
                $routeApiGroup->post('/{id}', [AdminApiController::class, 'update']);
                $routeApiGroup->delete('/{id}', [AdminApiController::class, 'delete']);
            }, '/api/carousel');

        }, '/admin');
    }
}