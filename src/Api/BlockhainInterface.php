<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Api;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;

/**
 * BlockhainInterface interface
 */
interface BlockhainInterface
{
    /**
     * GET method, return current Blockhain.
     *
     * @return Blockchain
     */
    public function get(): Blockchain;

}
