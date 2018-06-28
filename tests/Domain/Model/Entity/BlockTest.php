<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Entity;

use PHPUnit\Framework\TestCase;
use Nbe\PhpBlocks\Domain\Config\ProofOfWork;
use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Config\GenesisBlock;
use Nbe\PhpBlocks\Domain\Model\Handler\BlockHashHandler;

/**
 * Blocktest class
 */
final class BlockTest extends TestCase
{
    public function testCanInstantiateBlock(): void
    {
        $this->assertInstanceOf(
          Block::class,
          new Block(1, [], "")
        );
    }

    public function testCanGetIndexOfBlock(): void
    {
        $block = new Block(1, [], "");
        $this->assertEquals(
          1,
          $block->getIndex()
        );
    }

    public function testCanGetTimestampOfBlock(): void
    {
        $block = new Block(1, [], "");

        $this->assertEquals(
          TRUE,
          is_float($block->getTimestamp())
        );
    }

    public function testCanGetTransactionsOfBlock(): void
    {
        $block = new Block(1, [], "");

        $this->assertEquals(
          [],
          $block->getTransactions()
        );
    }

    public function testCanGetProofOfBlock(): void
    {
        $block = new Block(1, [], "");

        $this->assertEquals(
          GenesisBlock::PROOF,
          $block->getProof()
        );
    }

    public function testCanSetProofOfBlock(): void
    {
        $block = new Block(1, [], "");
        $block->setProof(1000);

        $this->assertEquals(
          1000,
          $block->getProof()
        );
    }

    public function testCanGetPreviousHashOfBlock(): void
    {
        $block = new Block(1, [], "azerty");

        $this->assertEquals(
          "azerty",
          $block->getPreviousHash()
        );
    }

    public function testCanGetHashOfBlock(): void
    {
        $block = new Block(1, [], "");

        $block = BlockHashHandler::hashBlock($block);

        $this->assertTrue(\is_string($block->getHash()));
        $this->assertTrue(GenesisBlock::HASH !== $block->getHash());
    }

}
