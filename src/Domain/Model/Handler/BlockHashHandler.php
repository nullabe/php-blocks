<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\BlockHashHandlerInterface;

final class BlockHashHandler implements BlockHashHandlerInterface
{
    const ALGO_USED_TO_HASH = "sha256";

    public static function hashBlock(Block $block): string
    {
        $arrayBlock = json_decode(json_encode($block), TRUE);
        ksort($arrayBlock);

        $jsonBlockEncoded = base64_encode(json_encode($arrayBlock));

        return hash(self::ALGO_USED_TO_HASH, $jsonBlockEncoded);
    }

}
