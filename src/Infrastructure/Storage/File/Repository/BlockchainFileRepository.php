<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\Storage\File\Repository;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Repository\Contract\BlockchainRepository;

/**
 * Class BlockchainFileRepository
 * @package Nbe\PhpBlocks\Infrastructure\Storage\File\Repository
 */
class BlockchainFileRepository implements BlockchainRepository
{

    /**
     * @param Blockchain $blockchain
     * @return bool
     */
    public function persist(Blockchain $blockchain): bool
    {
        // TODO: Implement persist() method.
    }

    /**
     * @return Blockchain
     */
    public function get(): Blockchain
    {
        // TODO: Implement get() method.
    }

}