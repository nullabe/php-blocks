<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Infrastructure\Storage\File\Repository;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Repository\Contract\BlockchainRepository;

class BlockchainFileRepository implements BlockchainRepository
{
    const PATH_TO_FILE = '../../../../../blockchain.json';

    public function persist(Blockchain $blockchain): bool
    {
        // TODO: Implement persist() method.
    }

    public function get(): Blockchain
    {
        // TODO: Implement get() method.
    }

}