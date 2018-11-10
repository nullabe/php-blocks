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
        $block = new Block(1, [], "TEST");
        $block = BlockHashHandler::hashBlock($block);

        $this->assertEquals(
            [
                'index'         => 1,
                'timestamp'     => $block->getTimestamp(),
                'transactions'  => [],
                'proof'         => $block->getProof(),
                'hash'          => $block->getHash(), 
                'previousHash'  => "TEST",
            ],
            BlockNormalizer::normalize($block)
        );
    }

    public function testBlockCanBeNormalizedWithTransactions()
    {
        $transactionFactory = new TransactionFactory();
        $transaction = $transactionFactory('sender', 'receiver', 0);

        $block = new Block(1, [$transaction], "TEST");
        $block = BlockHashHandler::hashBlock($block);

        $this->assertEquals(
            [
                'index'         => 1,
                'timestamp'     => $block->getTimestamp(),
                'transactions'  => [TransactionNormalizer::normalize($transaction)],
                'proof'         => $block->getProof(),
                'hash'          => $block->getHash(), 
                'previousHash'  => "TEST",
            ],
            BlockNormalizer::normalize($block)
        );
    }

    /**
     * @throws \Nbe\PhpBlocks\Domain\Exception\BlockDenormalizeException
     * @throws \Nbe\PhpBlocks\Domain\Exception\TransactionDenormalizeException
     */
    public function testBlockCanBeDenormalizedWithTransactions()
    {
        $transactionFactory = new TransactionFactory();
        $transaction = $transactionFactory('sender', 'receiver', 0);

        $block = new Block(1, [$transaction], "TEST");
        $block = BlockHashHandler::hashBlock($block);

        $blockData = BlockNormalizer::normalize($block);

        $this->assertEquals(
            $block,
            BlockNormalizer::denormalize($blockData)
        );
    }

}