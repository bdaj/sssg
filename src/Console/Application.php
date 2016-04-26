<?php declare(strict_types=1);

namespace Sss\Console;

use Psr\Log\LoggerInterface;
use Sss\Console\Command\BuildCommand;
use Sss\Console\Command\InitCommand;
use Sss\Filesystem\Filesystem;

/**
 * Simple Static Site Generator Application.
 *
 * @package Sss
 * @subpackage Sss\Console
 */
final class Application extends \Symfony\Component\Console\Application
{

    const NAME = 'Simple Static Site';

    const VERSION = '1.0.x-dev';

    /**
     * Constructor.
     *
     * @param \Sss\Filesystem\Filesystem $filesystem
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(Filesystem $filesystem, LoggerInterface $logger)
    {
        parent::__construct(static::NAME, static::VERSION);

        $this->add(new BuildCommand($filesystem, $logger));
        $this->add(new InitCommand($filesystem, $logger));
    }
}
