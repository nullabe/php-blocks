<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\BlockHashHandlerInterface;

/**
 * Class BlockHashHandler
 *
 * @package Nbe\PhpBlocks\Domain\Model\Handler
 */
final class BlockHashHandler implements BlockHashHandlerInterface
{

    /**
     * @param Block $block
     * @return Block
     * @throws \Nbe\PhpBlocks\Domain\Exception\BlockDenormalizeException
     * @throws \Nbe\PhpBlocks\Domain\Exception\TransactionDenormalizeException
     */
    public static function hashBlock(Block $block): Block
    {
        $blockchain = Blockchain::getInstance();
        $proofOfWorkHandler = new ProofOfWorkHandler();

        $blockHeader = $block->getHeader();

        $block = $block->setProof($proofOfWorkHandler->proofOfWork($blockchain->getLastBlock()->getProof(),
            $blockHeader));
        $block = $block->setHash($proofOfWorkHandler->getGeneratedHash());

        return $block;
    }

}
