<?php declare(strict_types=1);

namespace Sss\Pipeline\Stage;

use Iterator;
use Sss\Filesystem\File;
use Sss\Filesystem\Filesystem;
use Sss\Pipeline\AbstractPipeline;
use Sss\Pipeline\Payload\Configuration;
use Sss\Pipeline\Payload\Project;

final class GenerationPipeline extends AbstractPipeline
{

    public function process(Configuration $configuration)
    {
        $project = new Project($configuration);

        foreach ($this->generateContent($project) as $url => $renderedContent) {
            $this->persistContent($url, $renderedContent);
        }

        return $project;
    }

    private function generateContent(Project $project) :Iterator
    {
        foreach ($this->getAllContent($project) as $path => $rawContent) {
            if (preg_match('/\/_.*/', $path)) {
                continue;
            }

            $source = $project->getContentsRealPath();
            $stages = $project->getStages($path);

            // TODO: replace by permalink generation
            $key = substr($path, strpos($path, $source) + strlen($source));
            $key = $project->getTargetRealPath() . preg_replace('/.php$/', '', $key);

            $file = new File($project, $path, $rawContent);
            $value = $this->getPipeline($stages)->process($file);

            yield $key => $value;
        }
    }

    private function getAllContent(Project $project) :Iterator
    {
        $fs = $this->getFilesystem();
        $fs->cd($project->getContentsPath());
        $paths = $fs->tree();

        foreach ($paths as $path) {
            yield $path => $fs->read($path);
        }
    }

    private function persistContent(string $path, string $content)
    {
        $this->getFilesystem()->write($path, $content);
    }

    private function createProject(Filesystem $filesystem, array $options) :Project
    {
        return new Project($filesystem, $options);
    }
}
