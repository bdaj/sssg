<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage\Warmup;

final class CoreConfigStage extends AbstractConfigStage
{

    protected function getFilename(string $path) :string
    {
        return dirname(dirname(dirname(dirname(__DIR__)))) . DIRECTORY_SEPARATOR . 'config.php';
    }
}
