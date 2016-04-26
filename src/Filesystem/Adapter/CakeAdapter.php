<?php declare(strict_types=1);

namespace Sss\Filesystem\Adapter;

use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Sss\Filesystem\FilesystemAdapterInterface;

final class CakeAdapter implements FilesystemAdapterInterface
{
    /**
     * @var \Cake\Filesystem\Folder
     */
    private $folder;
    private $path;

    public function __construct(string $path)
    {
        $this->cd($path);
    }

    public function cd(string $path) :bool
    {
        $this->folder = new Folder($path);
        $this->path = $path;
        return true;
    }

    public function tree(string $path = null) :array
    {
        return (new Folder($this->path . $path))->findRecursive();
    }

    public function rm(string $path) :bool
    {
        if (!file_exists($path)) {
            return true;
        }

        if ($this->isFolder($path)) {
            return $this->folder->delete($path);
        }

        unlink($path);
    }

    public function isFile(string $path) :bool
    {
        return is_file($path);
    }

    public function isFolder(string $path) :bool
    {
        return is_dir($path);
    }

    public function mkdir(string $path) :bool
    {
        if ($this->isFolder($path)) {
            return true;
        }

        if (file_exists($path)) {
            throw new \RuntimeException();
        }

        return $this->folder->create($path);
    }

    public function copy(string $srcPath, string $dstPath) :bool
    {
        if (!file_exists($srcPath)) {
            throw new \RuntimeException();
        }

        if ($this->isFolder($srcPath)) {
            return $this->folder->copy(['from' => $srcPath, 'to' => $dstPath]);
        }

        return (new File($srcPath))->copy($dstPath);
    }

    public function read(string $path) :string
    {
        return (new File($path))->read();
    }

    public function write(string $path, string $content) :bool
    {
        $filename = basename($path);

        if ($filename !== $path) {
            $this->folder->create(substr($path, 0, -strlen($filename)));
        }

        $file = new File($path);
        $file->create();
        return $file->write($content);
    }
}
