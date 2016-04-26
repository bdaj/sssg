<?php declare(strict_types=1);

namespace Sss\TemplateEngine;

/**
 * Interface for a template engine adapter.
 *
 * @package Sss
 * @subpackage Sss\TemplateEngine
 */
interface TemplateEngineAdapterInterface
{

    /**
     * Sets the engine's base directory.
     *
     * @param string $path
     */
    public function setRootDirectory(string $path);

    /**
     * Tells if engine can render given path.
     *
     * @param string $path
     * @return bool
     */
    public function canRender(string $path) :bool;

    /**
     * Renders given template's path using passed data.
     *
     * @param string $path Template to render.
     * @param array $data Data to replace template variables.
     * @return string
     */
    public function render(string $path, array $data = []) :string;
}
