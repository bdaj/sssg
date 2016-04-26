<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage\Warmup;

use Sss\Pipeline\Stage\AbstractStage;

final class PageConfigStage extends AbstractStage
{

    protected function process(array $options)
    {
        $paths = $this->getFilesystem()->tree($options['source'] . $options['content']);
        $options['pages'] = [];

        foreach ($paths as $path) {
            if (!preg_match('/\/_config.php$/', $path)) {
                continue;
            }

            $options['pages'][basename(dirname($path))] = include $path;
        }

        return $options;
    }
}
