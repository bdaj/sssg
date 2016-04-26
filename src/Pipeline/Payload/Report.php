<?php declare(strict_types=1);

namespace Sss\Pipeline\Payload;

use Iterator;

final class Report
{
    /**
     * Relative path to the temporary directories used by project.
     *
     * @var \Iterator
     */
    private $temporaryDirectories;

    /**
     * Returns the project's temporary directories.
     *
     * @return \Iterator
     */
    public function getTemporaryDirectories() :Iterator
    {
        return $this->temporaryDirectories;
    }
}
