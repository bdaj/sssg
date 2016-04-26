<?php declare(strict_types=1);

namespace Sss\Pipeline;

use League\Pipeline\Pipeline;
use Psr\Log\LoggerInterface;
use Sss\Filesystem\Filesystem;

class AbstractPipeline
{

    private $filesystem;

    private $logger;

    /**
     * @var \League\Pipeline\Pipeline
     */
    private $pipeline;

    final public function __construct(Filesystem $filesystem, LoggerInterface $logger)
    {
        $this->filesystem = $filesystem;
        $this->logger = $logger;
        $this->initialize();
    }

    protected function initialize()
    {
    }

    final protected function getFilesystem() :Filesystem
    {
        return $this->filesystem;
    }

    final protected function getLogger() :LoggerInterface
    {
        return $this->logger;
    }

    final protected function getPipeline(array $stages = []) :Pipeline
    {
        if (!$this->pipeline) {
            $this->pipeline = $this->newPipeline($stages);
        }

        return $this->pipeline;
    }

    final public function __invoke($payload)
    {
        return $this->process($payload);
    }

    /**
     * Proxy to `Pipeline::pipe()`
     * @param string $pipeline Pipeline class name.
     * @return \Sss\Pipeline\AbstractPipeline
     */
    final public function pipe($pipeline) :AbstractPipeline
    {
//        if (!is_string($pipeline)) {
//            $bindings = \Closure::bind(
//                function ($obj) {
//                    $obj->filesystem = $this->filesystem;
//                    $obj->logger = $this->logger;
//                },
//                $this,
//                get_class($pipeline)
//            );
//
//            $bindings($pipeline);
//        } else {
//            $pipeline = new $pipeline($this->filesystem, $this->logger);
//        }
//
//        $this->pipeline = $this->getPipeline()->pipe($pipeline);

        $this->pipeline = $this->getPipeline()->pipe(new $pipeline($this->filesystem, $this->logger));
        return $this;
    }

    final private function newPipeline(array $stages = []) :Pipeline
    {
        foreach ($stages as &$stage) {
            if (is_string($stage)) {
                $stage = new $stage($this->filesystem, $this->logger);
                continue;
            }

            $bindings = \Closure::bind(
                function ($filesystem, $logger) use ($stage) {
                    $stage->filesystem = $filesystem;
                    $stage->logger = $logger;
                },
                $this,
                get_class($stage)
            );

            $bindings($this->filesystem, $this->logger);
        }

        return new Pipeline($stages);
    }
}
