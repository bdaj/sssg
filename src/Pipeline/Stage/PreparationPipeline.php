<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage;

use Sss\Pipeline\AbstractPipeline;
use Sss\Pipeline\Payload\Configuration;

/**
 * Class PreparationPipeline
 *
 * @package Sss
 * @subpackage Sss\Pipeline\Stage
 */
final class PreparationPipeline extends AbstractPipeline
{

    /**
     * {@inheritdoc}
     */
    public function initialize()
    {
        $this
            ->pipe(ConfigurationPipeline::class)
            ->pipe(WarmupStage::class);
    }

    /**
     * @param array $options
     * @return \Sss\Pipeline\Payload\Configuration
     */
    public function process(array $options) :Configuration
    {
        return $this->newConfiguration($this->getPipeline()->process($options));
    }

    /**
     * @param array $options
     * @return \Sss\Pipeline\Payload\Configuration
     */
    private function newConfiguration(array $options) :Configuration
    {
        return new Configuration($options);
    }
}
