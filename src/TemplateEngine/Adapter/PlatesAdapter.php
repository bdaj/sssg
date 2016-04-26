<?php declare(strict_types=1);

namespace Sss\TemplateEngine\Adapter;

use League\Plates\Engine;
use Sss\TemplateEngine\TemplateEngineAdapterInterface;

/**
 * Adapter for the `league/plates` engine.
 */
class PlatesAdapter implements TemplateEngineAdapterInterface
{

    const EXTENSION = '.html.php';

    /**
     * @var \League\Plates\Engine
     */
    private $engine;

    /**
     * Constructor.
     *
     * @param \League\Plates\Engine|null $engine
     */
    public function __construct(Engine $engine = null)
    {
        if (is_null($engine)) {
            $engine = new Engine();
        }

        $this->engine = $engine;
        $this->engine->setFileExtension(substr(static::EXTENSION, 1));
    }

    /**
     * {@inheritdoc}
     */
    public function setRootDirectory(string $path)
    {
        $this->engine->setDirectory($path);
    }

    /**
     * {@inheritdoc}
     */
    public function canRender(string $path) :bool
    {
        return substr($path, -strlen(static::EXTENSION)) === static::EXTENSION;
    }

    /**
     * {@inheritdoc}
     */
    public function render(string $path, array $data = []) :string
    {
        $pattern = preg_quote(static::EXTENSION);
        $template = preg_replace("/{$pattern}$/i", '', $path);
        $this->engine->addData($data);
        return $this->engine->render($template);
    }
}
