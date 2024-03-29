<?php

namespace Flute\Modules\Carousel\database\Entities;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

/**
 * @Entity
 */
class Slide
{
    /**
     * @Column(type="primary")
     */
    public $id;

    /**
     * @Column(type="string")
     */
    public $title;

    /**
     * @Column(type="string")
     */
    public $image;

    /**
     * @Column(type="text")
     */
    public $description;

    /**
     * @Column(type="string", nullable=true)
     */
    public $link;
}