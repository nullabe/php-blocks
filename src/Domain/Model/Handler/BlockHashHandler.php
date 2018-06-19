<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Config\Hash;
use Nbe\PhpBlocks\Domain\Config\ProofOfWork;
use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Handler\ProofOfWorkHandler;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\BlockHashHandlerInterface;

/**
 * BlockHashHandler class
 */
final class BlockHashHandler implements BlockHashHandlerInterface
{
    /**
     * @param Block $block
     * @return Block
     */
    public static function hashBlock(Block $block): Block
    {
        $blockchain = Blockchain::getInstance();
        $proofOfWorkHandler = new ProofOfWorkHandler();

        $blockHeader = (string) $block->getTimestamp() . ProofOfWork::DIFFICULTY;

        $block = $block->setProof($proofOfWorkHandler->proofOfWork($blockchain->getLastBlock()->getProof(), $blockHeader));
        $block = $block->setHash($proofOfWorkHandler->getGeneratedHash());

        return $block;
    }

}
