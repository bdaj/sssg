<?php

namespace Sss\Filesystem;

use Sss\Pipeline\Payload\Project;

class File
{

    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $contents;

    private $root;

    public function __construct(
        Project $project,
        string $path,
        string $contents
    )
    {
        $this->path = $path;
        $this->contents = $contents;
        $this->name = basename($path);
        $this->data = $project->getData();
        $this->root = getcwd() . DIRECTORY_SEPARATOR . $project->getContentsPath();
    }

    public function getData() :array
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }

    /**
     * @param string|null $suffix
     * @return mixed
     */
    public function getBasename(string $suffix = null) :string
    {
        return basename($this->name, $suffix);
    }

    /**
     * @param string|null $suffix
     * @return string
     */
    public function getRelativePath() :string
    {
        return $this->getRelativePathname($this->name);
    }

    /**
     * @param string|null $suffix
     * @return string
     */
    public function getRelativePathname(string $suffix = null) :string
    {
        $relpath = str_replace($this->root, '', $this->path);

        if (is_null($suffix)) {
            return $relpath;
        }

        $pattern = preg_quote($suffix);
        return preg_replace("/$pattern/", '', $relpath);
    }

    public function getRealPathname(string $suffix = null) :string
    {
        return $this->root . $this->getRelativePathname($suffix);
    }

    /**
     * @return string
     */
    public function getContents() :string
    {
        return $this->contents;
    }
}
