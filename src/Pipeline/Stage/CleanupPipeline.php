<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage;

use Sss\Pipeline\AbstractPipeline;
use Sss\Pipeline\Payload\Project;

final class CleanupPipeline extends AbstractPipeline
{

    public function process(Project $project) :bool
    {

        // TODO: delete temporary directories
        // TODO: release

        return true;
    }
}
