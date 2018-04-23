<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Factory\TransactionFactory;
use PHPUnit\Framework\TestCase;

/**
 * BlockchainTest class
 */
final class BlockchainTest extends TestCase
{
    /**
     * @var Blockchain
     */
    public $blockchain;

    public function __construct(
      ?string $name = null,
      array $data = [],
      string $dataName = ''
    ) {
        parent::__construct($name, $data, $dataName);

        $this->blockchain = Blockchain::getInstance();
    }

    public function testCanGetBlockchainInstance(): void
    {
        $this->assertInstanceOf(
            Blockchain::class,
            $this->blockchain
        );
    }

    public function testChainContainGenesisBlockAtInit(): void
    {
        $this->assertInstanceOf(Block::class, $this->blockchain->getChain()[0]);
    }

    public function testLastBlockIsGenesisBlockAtInit(): void
    {
        $this->assertEquals(
          $this->blockchain->getChain()[0],
          $this->blockchain->getLastBlock()
        );
    }

    public function testTransactionStackIsEmptyArrayAtInit(): void
    {
        $this->assertEquals([], $this->blockchain->getTransactionStack());
    }

}
