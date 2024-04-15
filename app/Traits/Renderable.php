<?php

namespace App\Traits;

use function Termwind\render;

trait Renderable
{
    public function renderInfo(?string $startText = null, ?string $endText = null): void
    {
        render('
            <div class="flex space-x-1">
                <span class="font-bold text-blue-500">' . $startText . '</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-blue-500">' . $endText . '</span>
            </div>
        ');
    }

    public function renderSuccess(?string $startText = null, ?string $endText = null): void
    {
        render('
            <div class="flex space-x-1">
                <span class="font-bold text-green-500">' . $startText . '</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-green-500">' . $endText . '</span>
            </div>
        ');
    }

    public function renderWarning(?string $startText = null, ?string $endText = null): void
    {
        render('
            <div class="flex space-x-1">
                <span class="font-bold text-yellow-500">' . $startText . '</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-yellow-500">' . $endText . '</span>
            </div>
        ');
    }

    public function renderError(?string $startText = null, ?string $endText = null): void
    {
        render('
            <div class="flex space-x-1">
                <span class="font-bold text-red-500">' . $startText . '</span>
                <span class="flex-1 content-repeat-[.] text-gray"></span>
                <span class="font-bold text-red-500">' . $endText . '</span>
            </div>
        ');
    }

    public function renderLineBreaker(): void
    {
        render('
            <div class="flex space-x-1 my-0.5">
                <span class="flex-1 content-repeat-[ ] text-white"></span>
            </div>
        ');
    }
}
