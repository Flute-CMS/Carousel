<?php

class create_slides extends \Spiral\Migrations\Migration
{
    /**
     * Create tables/schemas here
     *
     * @return void
     */
    public function up()
    {
        $this->table('slides')
            ->addColumn('id', 'primary')
            ->addColumn('title', 'string')
            ->addColumn('image', 'string')
            ->addColumn('description', 'text')
            ->addColumn('link', 'string', ['nullable' => true])
            ->create();
    }

    public function down()
    {
        $this->table('slides')->drop();
    }
}