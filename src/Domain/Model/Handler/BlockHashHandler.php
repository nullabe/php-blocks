<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Config\Hash;
use Nbe\PhpBlocks\Domain\Config\ProofOfWork;
use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\BlockHashHandlerInterface;

/**
 * BlockHashHandler class
 */
final class BlockHashHandler implements BlockHashHandlerInterface
{
    /**
     * @param Block $block
     * @return string
     */
    public static function hashBlock(Block $block): string
    {
        $stringToHash = (string) $block->getTimestamp() . (string) $block->getProof() . ProofOfWork::DIFFICULTY;

        return hash(Hash::ALGO, hash(Hash::ALGO, base64_encode($stringToHash)));
    }

}
