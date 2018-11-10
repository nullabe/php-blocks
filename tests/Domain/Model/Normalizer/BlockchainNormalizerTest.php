<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Normalizer;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Normalizer\BlockchainNormalizer;
use Nbe\PhpBlocks\Domain\Model\Normalizer\BlockNormalizer;
use Nbe\PhpBlocks\Domain\Model\Normalizer\TransactionNormalizer;
use Nbe\PhpBlocks\Domain\Model\State\BlockchainState;
use PHPUnit\Framework\TestCase;

/**
 * BlockchainNormalizerTest class
 */
final class BlockchainNormalizerTest extends TestCase
{
    /**
     * @throws \Nbe\PhpBlocks\Domain\Exception\BlockDenormalizeException
     * @throws \Nbe\PhpBlocks\Domain\Exception\BuildBlockchainStateException
     * @throws \Nbe\PhpBlocks\Domain\Exception\TransactionDenormalizeException
     */
    public function testBlockchainCanBeNormalizeAndRebuiltFromState()
    {
        $blockchain = Blockchain::getInstance();

        foreach ($blockchain->getChain() as $index => $block) {
            $blocks[] = BlockNormalizer::normalize($block);
        }
        foreach ($blockchain->getTransactionStack() as $transaction) {
            $transactions[] = TransactionNormalizer::normalize($transaction);
        }

        $this->assertEquals(
            [
                'uuid' => $blockchain->uuid(),
                'chain' => $blocks ?? [],
                'transactionStack' => $transactions ?? [],
                'lastBlock' => BlockNormalizer::normalize($blockchain->getLastBlock()),
                'length' => $blockchain->getNextIndex() - 1,
            ],
            $blockchainData = BlockchainNormalizer::normalize($blockchain)
        );

        // Only test uuid to be sure Blockchain instance has been updated.
        $blockchainData['uuid'] = 'test';
        $blockchainState = new BlockchainState($blockchainData);

        $this->assertEquals(
            'test',
            Blockchain::getInstance($blockchainState)->uuid()
        );
    }
}