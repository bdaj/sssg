<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage\Generation;

use Sss\Filesystem\File;
use Sss\TemplateEngine\TemplateEngine;

final class RenderStage extends AbstractStage
{
    private $engine;

    public function __construct(TemplateEngine $engine = null)
    {
        if (is_null($engine)) {
            $engine = new TemplateEngine();
        }

        $this->engine = $engine;
    }

    protected function handle(File $file)
    {
        $path = $file->getRelativePathname();
        $rootDir = substr($file->getRealPathname(), 0, -strlen($path));

        if (!$this->engine->canRender($path)) {
            return $file;
        }

        return $this->engine->setRootDirectory($rootDir)
            ->render($path, $file->getData());
    }
}
