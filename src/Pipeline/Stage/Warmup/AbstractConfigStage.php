<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage\Warmup;

use Sss\Pipeline\Stage\AbstractStage;

abstract class AbstractConfigStage extends AbstractStage
{

    final protected function process(array $options)
    {
        $fs = $this->getFilesystem();
        $filename = $this->getFilename($options['source']);

        if ($fs->isFile($filename)) {
            $options += include $filename;
        }

        return $options;
    }

    abstract protected function getFilename(string $path) :string;
}
