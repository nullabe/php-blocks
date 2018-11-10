<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Normalizer;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Normalizer\BlockchainNormalizer;
use Nbe\PhpBlocks\Domain\Model\Normalizer\BlockNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * BlockchainNormalizerTest class
 */
final class BlockchainNormalizerTest extends TestCase
{
    public function testBlockchainCanBeNormalize()
    {
        $blockchain = Blockchain::getInstance();

        foreach ($blockchain->getChain() as $index => $block) {
            $blocks[] = BlockNormalizer::normalize($block);
        }
        
        $this->assertEquals(
            [
                'uuid' => $blockchain->uuid(),
                'chain' => $blocks ?? [],
                'lastBlock' => BlockNormalizer::normalize($blockchain->getLastBlock()),
                'length' => $blockchain->getNextIndex() - 1,
            ],
            BlockchainNormalizer::normalize($blockchain)
        );
    }
}