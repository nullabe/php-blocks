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
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Block $block
     *
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Block
     */
    public static function hashBlock(Block $block): Block
    {
        $blockchain = Blockchain::getInstance();
        $proofOfWorkHandler = new ProofOfWorkHandler();

        $blockHeader = $block->getHeader();

        $block = $block->setProof($proofOfWorkHandler->proofOfWork($blockchain->getLastBlock()->getProof(), $blockHeader));
        $block = $block->setHash($proofOfWorkHandler->getGeneratedHash());

        return $block;
    }

}
