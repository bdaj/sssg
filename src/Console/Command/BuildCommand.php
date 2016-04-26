<?php declare(strict_types=1);

namespace Sss\Console\Command;

use Symfony\Component\Console\Input\InputOption;

/**
 * Build command.
 *
 * @package Sss
 * @subpackage Sss\Console\Command
 */
final class BuildCommand extends AbstractCommand
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('build')
            ->setDescription('Generate site from source.')
            ->addOption(
                'environment',
                null,
                InputOption::VALUE_REQUIRED,
                'Environment specific configuration to use.',
                'local'
            )
            ->addOption(
                'source',
                null,
                InputOption::VALUE_REQUIRED,
                'Relative path to source directory.',
                '.' . DIRECTORY_SEPARATOR
            )
            ->addOption(
                'target',
                null,
                InputOption::VALUE_REQUIRED,
                'Relative path to target directory.',
                getcwd() . DIRECTORY_SEPARATOR . 'webroot'
            )
            ->addOption(
                'serve',
                null,
                InputOption::VALUE_NONE,
                'Serve site using PHP built-in webserver.'
            )
            ->addOption(
                'watch',
                null,
                InputOption::VALUE_NONE,
                'Watch for changes and rebuild.'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function onSuccess() :string
    {
        return 'Site successfully built!';
    }
}
