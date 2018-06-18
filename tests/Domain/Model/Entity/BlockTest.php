<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Entity;

use PHPUnit\Framework\TestCase;
use Nbe\PhpBlocks\Domain\Model\Entity\Block;
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
          new Block(1, [], 100, "")
        );
    }

    public function testCanGetIndexOfBlock(): void
    {
        $block = new Block(1, [], 100, "");
        $this->assertEquals(
          1,
          $block->getIndex()
        );
    }

    public function testCanGetTimestampOfBlock(): void
    {
        $block = new Block(1, [], 100, "");

        $this->assertEquals(
          TRUE,
          is_float($block->getTimestamp())
        );
    }

    public function testCanGetTransactionsOfBlock(): void
    {
        $block = new Block(1, [], 100, "");

        $this->assertEquals(
          [],
          $block->getTransactions()
        );
    }

    public function testCanGetProofOfBlock(): void
    {
        $block = new Block(1, [], 100, "");

        $this->assertEquals(
          100,
          $block->getProof()
        );
    }

    public function testCanGetPreviousHashOfBlock(): void
    {
        $block = new Block(1, [], 100, "azerty");

        $this->assertEquals(
          "azerty",
          $block->getPreviousHash()
        );
    }

    public function testCanGetHashOfBlock(): void
    {
        $block = new Block(1, [], 100, "");
        
        $blockHash = BlockHashHandler::hashBlock($block);
        $block->setHash($blockHash);

        $this->assertEquals(
            $blockHash,
            BlockHashHandler::hashBlock($block)
        );
        $this->assertEquals(
            $blockHash,
            $block->getHash()
        );
    }

}