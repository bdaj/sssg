<?php declare(strict_types=1);

namespace Sss\Pipeline;

final class InitPipeline extends AbstractPipeline
{
    public function process(array $options) :bool
    {
        $fs = $this->getFilesystem();

        $skeleton = $this->skeleton($options['type']);
        $destination = $fs->cwd() . $options['name'];

        if ($fs->isFolder($destination) && !$options['force']) {
            throw new \InvalidArgumentException("The '{$options['name']}' folder already exists.");
        }

        return $fs->copy($skeleton, $destination);
    }

    private function skeleton(string $type) :string
    {
        $skeleton = implode(DIRECTORY_SEPARATOR, [
            dirname(dirname(__DIR__)),
            '.skeleton',
            $type
        ]);

        if (!is_dir($skeleton)) {
            throw new \InvalidArgumentException("Could not find the '$type' skeleton.");
        }

        return $skeleton;
    }
}
