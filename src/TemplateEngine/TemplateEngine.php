<?php declare(strict_types=1);

namespace Sss\TemplateEngine;

use Sss\TemplateEngine\Adapter\PlatesAdapter;

class TemplateEngine
{

    /**
     * @var \Sss\TemplateEngine\TemplateEngineAdapterInterface
     */
    private $adapter;

    /**
     * Constructor
     *
     * @param \Sss\TemplateEngine\TemplateEngineAdapterInterface|null $adapter
     */
    public function __construct(TemplateEngineAdapterInterface $adapter = null)
    {
        if (is_null($adapter)) {
            $adapter = new PlatesAdapter();
        }

        $this->adapter = $adapter;
    }

    /**
     * Sets the engine's base directory.
     *
     * @param string $path
     * @return \Sss\TemplateEngine\TemplateEngine
     */
    public function setRootDirectory(string $path) :TemplateEngine
    {
        call_user_func([$this->adapter, __FUNCTION__], $path);
        return $this;
    }

    /**
     * Tells if engine can render given path.
     *
     * @param string $path
     * @return bool
     */
    public function canRender(string $path) :bool
    {
        return call_user_func([$this->adapter, __FUNCTION__], $path);
    }

    /**
     * Renders given template's path using passed data.
     *
     * @param string $path Template to render.
     * @param array $data Data to replace template variables.
     * @return string
     */
    public function render(string $path, array $data = []) :string
    {
        return call_user_func([$this->adapter, __FUNCTION__], $path, $data);
    }
}
