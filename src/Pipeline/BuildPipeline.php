<?php declare(strict_types=1);

namespace Sss\Pipeline;

use Sss\Pipeline\Stage\CleanupPipeline;
use Sss\Pipeline\Stage\GenerationPipeline;
use Sss\Pipeline\Stage\PreparationPipeline;

final class BuildPipeline extends AbstractPipeline
{

    protected function initialize()
    {
        $this->pipe(PreparationPipeline::class)
            ->pipe(GenerationPipeline::class)
            ->pipe(CleanupPipeline::class);
    }

    public function process(array $options) :bool
    {
        return $this->getPipeline()->process($options);
    }
}
