<?php declare(strict_types=1);

namespace Sss\Pipeline\Payload;

final class Project
{
    private $configuration;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getStages(string $path) :array
    {
        return $this->configuration->getStages($path);
    }

    public function getData() :array
    {
        return $this->configuration->getData();
    }

    public function getContentsRealPath() :string
    {
        return $this->configuration->getRoot() . $this->getContentsPath();
    }

    public function getRootRealPath() :string
    {
        return $this->configuration->getRoot() . $this->getRootPath();
    }

    public function getTargetRealPath() :string
    {
        return $this->configuration->getRoot() . $this->getTargetPath();
    }

    public function getContentsPath() :string
    {
        return $this->getRootPath()  . $this->configuration->getContent();
    }
    
    public function getRootPath() :string
    {
        return $this->configuration->getSource();
    }

    public function getTargetPath() :string
    {
        return $this->configuration->getTarget();
    }
}
