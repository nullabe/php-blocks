<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model;

use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Factory\TransactionFactory;
use PHPUnit\Framework\TestCase;

final class BlockchainTest extends TestCase
{
    public $blockchain;

    public $transactionFactory;

    public function __construct(
      ?string $name = null,
      array $data = [],
      string $dataName = ''
    ) {
        parent::__construct($name, $data, $dataName);

        $this->blockchain = Blockchain::getInstance();
        $this->transactionFactory = new TransactionFactory();
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

    public function testCanAddTwoNewTransactionToStack(): void
    {
        $transaction1 = call_user_func($this->transactionFactory,
          'sender1',
          'receiver1',
          0);
        $transaction2 = call_user_func($this->transactionFactory,
          'sender2',
          'receiver2',
          0);


        $this->assertEquals(
          2,
          $this->blockchain->addTransactionToStack($transaction1)
        );
        $this->assertEquals(
          2,
          $this->blockchain->addTransactionToStack($transaction2)
        );

        $this->assertEquals(
            [$transaction1, $transaction2],
            $this->blockchain->getTransactionStack()
        );
    }

    public function testCanAddNewBlockWithStackedTransactionAndStackBecomeEmptyAfter()
    {
        $newBlock = $this->blockchain->addNewBlockToChain(1);
        $chain = $this->blockchain->getChain();

        $this->assertEquals(
          $newBlock,
          array_pop($chain)
        );
        $this->assertEquals(
          $newBlock,
          $this->blockchain->getLastBlock()
        );
        $this->assertEquals(
          $newBlock->getPreviousHash(),
          Blockchain::hashBlock($chain[0])
        );

        $this->assertEquals(
          [],
          $this->blockchain->getTransactionStack()
        );
    }

}
