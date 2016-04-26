<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage\Generation;

use Sss\Filesystem\File;

final class FallbackStage extends AbstractStage
{

    protected function handle(File $file) :string
    {
        return $file->getContents();
    }
}
