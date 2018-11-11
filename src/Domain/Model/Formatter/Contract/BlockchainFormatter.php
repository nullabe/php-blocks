<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Formatter\Contract;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;

/**
 * Interface BlockchainFormatter
 *
 * @package Nbe\PhpBlocks\Domain\Model\Formatter\Contract
 */
interface BlockchainFormatter
{

    /**
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Blockchain $blockchain
     *
     * @return mixed
     */
    public static function format(Blockchain $blockchain);
}