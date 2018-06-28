<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Api;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;

/**
 * BlockchainInterface interface
 */
interface BlockchainInterface
{
    /**
     * GET method, return current Blockhain.
     *
     * @return mixed
     */
    public function getAction();

}
