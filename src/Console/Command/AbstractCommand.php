<?php declare(strict_types=1);

namespace Sss\Console\Command;

use Psr\Log\LoggerInterface;
use Sss\Filesystem\Filesystem;
use Sss\Pipeline\AbstractPipeline;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends Command
{

    /**
     * @var \Sss\Filesystem\Filesystem
     */
    private $filesystem;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * Constructor.
     *
     * @param \Sss\Filesystem\Filesystem $filesystem
     * @param \Psr\Log\LoggerInterface $logger
     */
    final public function __construct(Filesystem $filesystem, LoggerInterface $logger)
    {
        $this->filesystem = $filesystem;
        $this->logger = $logger;
        parent::__construct();
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int
     */
    final public function execute(InputInterface $input, OutputInterface $output) :int
    {
        $this->getPipeline()->process($this->getOptions($input));
        $output->writeln("<info>{$this->onSuccess()}</info>");
        return 0;
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @return array
     */
    final private function getOptions(InputInterface $input) :array
    {
        $filteredKeys = ['command', 'help', 'quiet', 'verbose', 'version', 'ansi', 'no-ansi', 'no-interaction'];
        $options = $input->getArguments() + $input->getOptions();
        return array_diff_key($options, array_flip($filteredKeys));
    }

    /**
     * @return \Sss\Pipeline\AbstractPipeline
     */
    final private function getPipeline() :AbstractPipeline
    {
        $pipelineClass = str_replace('Console\Command', 'Pipeline', get_class($this));
        $pipelineClass = str_replace('Command', 'Pipeline', $pipelineClass);
        return new $pipelineClass($this->filesystem, $this->logger);
    }

    /**
     * @return string
     */
    abstract protected function onSuccess() :string;
}
