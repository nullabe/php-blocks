<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler\Contract;

use Nbe\PhpBlocks\Domain\Model\Entity\Block;

interface BlockHashHandlerInterface
{
    static function hashBlock(Block $block): string;

}
