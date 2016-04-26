<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage;

use Sss\Pipeline\AbstractPipeline;
use Sss\Pipeline\Stage\Warmup\CoreConfigStage;
use Sss\Pipeline\Stage\Warmup\BaseConfigStage;
use Sss\Pipeline\Stage\Warmup\PageConfigStage;
use Sss\Pipeline\Stage\Warmup\SiteConfigStage;
use Sss\Pipeline\Stage\Warmup\UserConfigStage;

final class ConfigurationPipeline extends AbstractPipeline
{

    public function initialize()
    {
        $this
            ->pipe(SiteConfigStage::class)
            ->pipe(BaseConfigStage::class)
            ->pipe(UserConfigStage::class)
            ->pipe(CoreConfigStage::class)
            ->pipe(PageConfigStage::class);
    }

    public function process(array $options) :array
    {
        foreach (['source', 'target'] as $key) {
            $options[$key] = rtrim($options[$key], DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        }

        return $this->getPipeline()->process($options);
    }
}
