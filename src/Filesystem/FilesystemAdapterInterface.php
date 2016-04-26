<?php declare(strict_types=1);

namespace Sss\Filesystem;

interface FilesystemAdapterInterface
{
    public function cd(string $path): bool;
    public function tree(string $path = null) :array;
    public function rm(string $path) :bool;
    public function mkdir(string $path) :bool;
    public function read(string $path) :string;
    public function write(string $path, string $content) :bool;
    public function copy(string $srcPath, string $dstPath) :bool;
    public function isFolder(string $path) :bool;
}
