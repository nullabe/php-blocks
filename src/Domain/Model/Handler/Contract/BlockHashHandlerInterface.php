<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler\Contract;

use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockInterface;

interface BlockHashHandlerInterface
{
    static function hashBlock(BlockInterface $block): string;

}
