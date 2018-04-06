<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockInterface;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\BlockHashHandlerInterface;

class BlockHashHandler implements BlockHashHandlerInterface
{
    const ALGO_USED_TO_HASH = "sha256";

    public static function hashBlock(BlockInterface $block): string
    {
        $arrayBlock = json_decode(json_encode($block), TRUE);
        ksort($arrayBlock);

        $jsonBlock = json_encode($arrayBlock);

        return hash(self::ALGO_USED_TO_HASH, $jsonBlock);
    }

}
