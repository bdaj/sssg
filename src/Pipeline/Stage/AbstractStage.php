<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage;

use League\Pipeline\StageInterface;
use Psr\Log\LoggerInterface;
use Sss\Filesystem\Filesystem;

abstract class AbstractStage implements StageInterface
{

    private $filesystem;
    private $logger;

    public function __construct(Filesystem $filesystem, LoggerInterface $logger)
    {
        $this->filesystem = $filesystem;
        $this->logger = $logger;
    }

    final public function __invoke($payload)
    {
        return $this->process($payload);
    }

    final protected function getFilesystem()
    {
        return $this->filesystem;
    }

    final protected function getLogger()
    {
        return $this->logger;
    }
}
