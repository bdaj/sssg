<?php declare(strict_types=1);

namespace Sss\Filesystem\Adapter;

use Illuminate\Filesystem\Filesystem;
use Sss\Filesystem\File;
use Sss\Filesystem\FilesystemAdapterInterface;
use Symfony\Component\Finder\Finder;

final class LaravelAdapter implements FilesystemAdapterInterface
{
    private $filesystem;

    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }

    public function cd(string $path) :bool
    {
        $this->filesystem = new Filesystem($path);
        return true;
    }

    public function tree(string $path) :array
    {
        /** @var \SplFileInfo[] $paths */
        $paths = Finder::create()->ignoreDotFiles(false)->files()->in($path);
        return array_walk($paths, function (\SplFileInfo $path) {
            $path = $path->getRealPath();
        });
    }

    public function rm(string $path) :bool
    {
        if (!$this->filesystem->exists($path)) {
            return true;
        }

        if ($this->isFolder($path)) {
            return $this->filesystem->deleteDirectory($path);
        }

        return $this->filesystem->delete($path);
    }

    public function isFile(string $path) :bool
    {
        return $this->filesystem->isFile($path);
    }

    public function isFolder(string $path) :bool
    {
        return $this->filesystem->isDirectory($path);
    }

    public function mkdir(string $path) :bool
    {
        if ($this->isFolder($path)) {
            return true;
        }

        if ($this->filesystem->exists($path)) {
            throw new \RuntimeException();
        }

        return $this->filesystem->makeDirectory($path, 0755, true);
    }

    public function copy(string $srcPath, string $dstPath) :bool
    {
        if ($this->isFolder($srcPath)) {
            return $this->filesystem->copyDirectory($srcPath, $dstPath);
        }

        if (!$this->filesystem->exists($srcPath)) {
            throw new \RuntimeException();
        }

        return $this->filesystem->copy($srcPath, $dstPath);
    }

    public function read(string $path) :string
    {
        return $this->filesystem->get($path);
    }

    public function write(string $path, string $content) :bool
    {
        return (bool) !$this->filesystem->put($path, $content);
    }

}
