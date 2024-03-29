<?php

namespace Flute\Modules\Carousel\Services;

use Flute\Modules\Carousel\database\Entities\Slide;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CarouselService
{
    /**
     * Загрузка и обработка изображения слайда.
     *
     * @param UploadedFile $file
     * @return string
     */
    public function uploadImage(UploadedFile $file)
    {
        $maxSize = 5000000; // Максимальный размер файла, например 5 МБ
        $allowedMimeTypes = ['image/png', 'image/jpeg', 'image/gif', 'image/webp']; // Разрешенные MIME-типы

        if ($file->getSize() > $maxSize) {
            throw new \Exception(__('validator.max_post_size', ['%d' => $maxSize]));
        }

        try {
            $mimeType = $file->getMimeType();
        } catch (\Exception $e) {
            logs()->error($file->getErrorMessage());

            throw new \Exception(__('def.unknown_error'));
        }

        if (!in_array($mimeType, $allowedMimeTypes)) {
            throw new \Exception(__('validator.image'));
        }

        $fileName = hash('sha256', uniqid()) . '.' . $file->getClientOriginalExtension();
        $destination = BASE_PATH . '/public/assets/uploads';

        if (!file_exists($destination)) {
            mkdir($destination, 0700, true);
        }

        $file->move($destination, $fileName);

        // Конвертация в WebP при необходимости
        $newFileDestination = 'assets/uploads/' . $fileName;
        if (in_array($mimeType, ['image/png', 'image/jpeg']) && config('profile.convert_to_webp')) {
            $webPFileName = hash('sha256', uniqid()) . '.webp';
            try {
                \WebPConvert\WebPConvert::convert($destination . '/' . $fileName, $destination . '/' . $webPFileName);
                fs()->remove($destination . '/' . $fileName); // Удаление исходного файла
                $newFileDestination = 'assets/uploads/' . $webPFileName;
            } catch (\Exception $e) {
                // Обработка ошибок конвертации
            }
        }

        return $newFileDestination;
    }

    public function store(string $title, string $description, $img, ?string $link = null)
    {
        $slide = new Slide();

        $slide->title = $title;
        $slide->description = $description;
        $slide->image = $this->uploadImage($img);
        $slide->link = $link;

        transaction($slide)->run();
    }

    public function update(int $id, string $title, string $description, $img, ?string $link = null)
    {
        $slide = $this->find($id);

        $slide->title = $title;
        $slide->description = $description;

        if ($img) {
            try {
                fs()->remove(BASE_PATH . '/public/' . $slide->image);
            } catch (\Exception $e) {
                // we ignore
            } 

            $slide->image = $this->uploadImage($img);
        }
        
        $slide->link = $link;

        transaction($slide)->run();
    }

    public function delete(int $id): void
    {
        $slide = $this->find($id);

        transaction($slide, 'delete')->run();

        return;
    }

    /**
     * @return Slide
     * 
     * @throws \Exception
     */
    public function find(int $id)
    {
        $item = rep(Slide::class)->findByPK($id);

        if (!$item) {
            throw new \Exception(__('carousel.not_found'));
        }

        return $item;
    }
}