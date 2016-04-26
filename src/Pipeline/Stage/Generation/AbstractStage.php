<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage\Generation;

use Sss\Filesystem\File;

abstract class AbstractStage extends \Sss\Pipeline\Stage\AbstractStage
{
    /**
     * @param mixed $payload
     * @return mixed
     */
    final protected function process($payload)
    {
        if (!($payload instanceof File)) {
            return $payload;
        }

        return $this->handle($payload);
    }

    /**
     * @param \Sss\Filesystem\File $file
     * @return \Sss\Filesystem\File|bool
     */
    abstract protected function handle(File $file);
}
