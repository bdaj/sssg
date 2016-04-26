<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage\Warmup;

final class BaseConfigStage extends AbstractConfigStage
{

    protected function getFilename(string $path) :string
    {
        return $this->getFilesystem()->cwd() . 'config.php';
    }
}
