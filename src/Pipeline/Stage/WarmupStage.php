<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage;

final class WarmupStage extends AbstractStage
{

    public function process(array $options) :array
    {
        $fs = $this->getFilesystem();
        $target = $options['target'];

        if ($fs->isFile($target)) {
            throw new \InvalidArgumentException("Target is an existing file ($target).");
        }

        $fs->rm($target);
        $fs->mkdir($target);

        return $options;
    }
}
