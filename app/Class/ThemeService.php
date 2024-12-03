<?php

namespace App\Class;


class ThemeService
{
    protected $currentTheme;

    public function setTheme($theme)
    {
        $this->currentTheme = $theme;
    }

    public function getTheme()
    {
        return $this->currentTheme ?? 'default';
    }

    public function loadThemeAssets()
    {
        return "<link rel='stylesheet' href='/themes/{$this->getTheme()}/style.css'>";
    }
}
