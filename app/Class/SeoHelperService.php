<?php

namespace App\Class;

class SeoHelperService
{
    protected $title;
    protected $description;


    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function renderMetaTags()
    {
        return "
            <meta name='title' content='{$this->title}'>
            <meta name='description' content='{$this->description}'>
        ";
    }
}
