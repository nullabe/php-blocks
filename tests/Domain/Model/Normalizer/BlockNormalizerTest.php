<?php

namespace Nbe\PhpBlocks\Tests\Domain\Model\Normalizer;

use PHPUnit\Framework\TestCase;
use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Model\Handler\BlockHashHandler;
use Nbe\PhpBlocks\Domain\Model\Factory\TransactionFactory;
use Nbe\PhpBlocks\Domain\Model\Normalizer\BlockNormalizer;
use Nbe\PhpBlocks\Domain\Model\Normalizer\TransactionNormalizer;

/**
 * BlockNormalizerTest class
 */
final class BlockNormalizerTest extends TestCase
{
    public function testBlockCanBeNormalized()
    {
        $block = new Block(1, [], 100, "");

        $block->setHash(BlockHashHandler::hashBlock($block));

        $this->assertEquals(
            [
                'index'         => $block->getIndex(),
                'timestamp'     => $block->getTimestamp(),
                'transactions'  => [],
                'proof'         => $block->getProof(),
                'hash'          => $block->getHash(), 
                'previousHash'  => $block->getPreviousHash(),
            ],
            BlockNormalizer::normalize($block)
        );
    }

    public function testBlockCanBeNormalizedWithTransactions()
    {
        $transactionFactory = new TransactionFactory();
        $transaction = $transactionFactory('sender', 'receiver', 0);

        $block = new Block(1, [$transaction], 100, "");

        $block->setHash(BlockHashHandler::hashBlock($block));

        $this->assertEquals(
            [
                'index'         => $block->getIndex(),
                'timestamp'     => $block->getTimestamp(),
                'transactions'  => [TransactionNormalizer::normalize($transaction)],
                'proof'         => $block->getProof(),
                'hash'          => $block->getHash(), 
                'previousHash'  => $block->getPreviousHash(),
            ],
            BlockNormalizer::normalize($block)
        );
    }

}