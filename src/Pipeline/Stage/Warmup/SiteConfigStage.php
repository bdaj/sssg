<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage\Warmup;

final class SiteConfigStage extends AbstractConfigStage
{

    protected function getFilename(string $path) :string
    {
        return $path . 'config.php';
    }
}
