<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Repository\Contract;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;

interface BlockchainRepository
{
    public function persist(Blockchain $blockchain): bool;

    public function get(): Blockchain;

}