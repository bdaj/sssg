<?php

use League\Plates\Engine;
use Sss\Pipeline\Stage\Generation\FallbackStage;
use Sss\Pipeline\Stage\Generation\RenderStage;
use Sss\TemplateEngine\Adapter\PlatesAdapter;
use Sss\TemplateEngine\TemplateEngine;

return [
    'root' => getcwd(),

    /**
     * Relative path where to find site's content.
     * (relative to the site's sources directory) 
     */
    'content' => 'source' . DIRECTORY_SEPARATOR,
    
    'stages' => [
        new RenderStage(),
        FallbackStage::class,
    ]
];
