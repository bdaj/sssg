<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage\Warmup;

final class UserConfigStage extends AbstractConfigStage
{

    protected function getFilename(string $path) :string
    {
        return trim(`echo \$HOME`) . DIRECTORY_SEPARATOR . '.sssg_config.php';
    }
}
