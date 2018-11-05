<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Repository\Contract;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;

/**
 * Interface BlockchainRepository
 *
 * @package Nbe\PhpBlocks\Domain\Model\Repository\Contract
 */
interface BlockchainRepository
{

    /**
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Blockchain $blockchain
     *
     * @return bool
     */
    public function persist(Blockchain $blockchain): bool;

    /**
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Blockchain
     */
    public function get(): Blockchain;

}