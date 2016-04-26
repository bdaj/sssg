<?php declare(strict_types=1);

namespace Sss\Filesystem;

use Sss\Filesystem\Adapter\CakeAdapter;

final class Filesystem
{

    private $adapter;

    public function __construct(string $path = null, FilesystemAdapterInterface $adapter = null)
    {
        if (is_null($path)) {
            $path = $this->cwd();
        }

        if (is_null($adapter)) {
            $adapter = new CakeAdapter($path);
        }

        $this->adapter = $adapter;
        $this->path = $path;
    }

    public function cd(string $path) :bool
    {
        if ($path === $this->path) {
            return false;
        }

        if ($path[0] !== '/') {
            $path = $this->path . $path;
        }

        $this->path = $path;
        return $this->adapter->cd($path);
    }

    /**
     * @param string $path
     * @return string[]
     */
    public function tree(string $path = null) :array
    {
        return call_user_func_array([$this->adapter, __FUNCTION__], func_get_args());
    }

    public function rm(string $path) :bool
    {
        return call_user_func_array([$this->adapter, __FUNCTION__], func_get_args());
    }

    public function mkdir(string $path) :bool
    {
        return call_user_func_array([$this->adapter, __FUNCTION__], func_get_args());
    }

    public function read(string $path) :string
    {
        return call_user_func_array([$this->adapter, __FUNCTION__], func_get_args());
    }

    public function write(string $path, string $content) :bool
    {
        return call_user_func_array([$this->adapter, __FUNCTION__], func_get_args());
    }

    public function copy(string $srcPath, string $dstPath) :bool
    {
        return call_user_func_array([$this->adapter, __FUNCTION__], func_get_args());
    }

    public function isFile(string $path) :bool
    {
        return call_user_func_array([$this->adapter, __FUNCTION__], func_get_args());
    }

    public function isFolder(string $path) :bool
    {
        return call_user_func_array([$this->adapter, __FUNCTION__], func_get_args());
    }

    public function cwd() :string
    {
        return getcwd() . DIRECTORY_SEPARATOR;
    }
}
