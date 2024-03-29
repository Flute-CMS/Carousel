<?php

namespace Flute\Modules\Carousel\Http\Controllers;

use Flute\Core\Admin\Http\Middlewares\HasPermissionMiddleware;
use Flute\Core\Http\Middlewares\CSRFMiddleware;
use Flute\Core\Support\AbstractController;
use Flute\Core\Support\FluteRequest;
use Flute\Modules\Carousel\Services\CarouselService;
use Symfony\Component\HttpFoundation\Response;

class AdminApiController extends AbstractController
{
    protected $carouselService;

    public function __construct( CarouselService $carouselService )
    {
        $this->carouselService = $carouselService;

        HasPermissionMiddleware::permission(['admin', 'admin.system']);
        $this->middleware(HasPermissionMiddleware::class);
        $this->middleware(CSRFMiddleware::class);
    }

    public function store(FluteRequest $request) : Response
    {
        try {
            $this->carouselService->store($request->title, $request->description, $request->files->get('image'), $request->input('link', null));

            return $this->success();
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function delete(FluteRequest $request, $id) : Response
    {
        try {
            $this->carouselService->delete((int) $id);

            return $this->success();
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function update(FluteRequest $request, $id) : Response
    {
        try {
            $this->carouselService->update((int) $id, $request->title, $request->description, $request->files->get('image'), $request->input('link', null));

            return $this->success();
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}