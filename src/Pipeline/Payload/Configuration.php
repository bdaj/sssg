<?php declare(strict_types=1);

namespace Sss\Pipeline\Payload;

final class Configuration
{

    const DEFAULTS = [
        'data' => [],
        'content' => 'source',
        'root' => null,
        'source' => null,
        'target' => 'webroot',
        'stages' => [],
        'pages' => [],
        'slugger' => null,
        'renderer' => null,
    ];

    private static $data;

    private static $content;

    private static $root;

    private static $source;

    private static $target;

    private static $stages;

    private static $pages;

    private static $slugger;

    private static $renderer;

    public function __construct(array $options)
    {
        foreach (static::DEFAULTS as $k => $v) {
            $key = ucfirst($k);
            $setter = [$this, 'set' . $key];
            if (!empty($options[$k])) {
                $v = $options[$k];
            }
            call_user_func($setter, $v);
        }
    }

    public function getData() :array
    {
        return static::$data;
    }

    public function getContent() :string
    {
        return static::$content;
    }

    public function getRoot() :string
    {
        return static::$root;
    }

    public function getSource() :string
    {
        return static::$source;
    }

    public function getTarget() :string
    {
        return static::$target;
    }

    public function getStages(string $page) :array
    {

        return static::$stages;
    }

    private function setData(array $data)
    {
        static::$data = $data;
    }

    private function setContent(string $content)
    {
        static::$content = rtrim($content, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }

    private function setRoot(string $root)
    {
        static::$root = rtrim($root, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }

    private function setSource(string $source)
    {
        static::$source = rtrim($source, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }

    private function setTarget(string $target)
    {
        $target = str_replace(static::$root, '', $target);
        static::$target = rtrim($target, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    }

    private function setStages(array $stages)
    {
        static::$stages = $stages;
    }

    private function setPages(array $pages)
    {
        static::$pages = $pages;
    }

    private function setSlugger($slugger)
    {
        static::$slugger = $slugger;
    }

    private function setRenderer($renderer)
    {
        static::$renderer = $renderer;
    }
}
