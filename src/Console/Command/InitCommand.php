<?php declare(strict_types=1);

namespace Sss\Console\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Init command.
 *
 * @package Sss
 * @subpackage Sss\Console\Command
 */
final class InitCommand extends AbstractCommand
{

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('init')
            ->setDescription('Scaffold site from skeleton.')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Relative path to your site project.'
            )
            ->addOption(
                'type',
                null,
                InputOption::VALUE_REQUIRED,
                'Type of skeleton to use.',
                'plates'
            )
            ->addOption(
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Overwrite existing files/folder.'
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function onSuccess() :string
    {
        return 'Site successfully created!';
    }
}
