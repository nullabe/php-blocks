<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Formatter\Contract;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;

interface BlockchainFormatter
{
    public function format(Blockchain $blockchain);
}