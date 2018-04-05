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

    public function testChainIsEmptyArrayAtInit(): void
    {
        $this->assertEquals([], $this->blockchain->getChain());
    }

    public function testTransactionStackIsEmptyArrayAtInit(): void
    {
        $this->assertEquals([], $this->blockchain->getTransactionStack());
    }

    public function testLastBlockOfChainIsNullAtInit(): void
    {
        $this->assertEquals(
          null,
          $this->blockchain->getLastBlock()
        );
    }

    public function testCanAddNewBlockToChainAndThisBecomeLastBlock(): void
    {
        $block = new Block();
        $this->blockchain->addNewBlockToChain($block);

        $this->assertEquals(
          $block,
          $this->blockchain->getChain()[0]
        );

        $this->assertEquals(
          $block,
          $this->blockchain->getLastBlock()
        );
    }

    public function testCanAddOneNewTransactionToStack(): void
    {
        $transaction = call_user_func($this->transactionFactory,
          'sender',
          'receiver',
          0);

        // As Blochain object is a singleton, a block is already into the chain
        // (see previous tests).
        $this->assertEquals(
          1,
          $this->blockchain->addTransactionToStack($transaction)
        );

        $this->assertEquals(
            $transaction,
            $this->blockchain->getTransactionStack()[0]
        );

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
          1,
          $this->blockchain->addTransactionToStack($transaction1)
        );
        $this->assertEquals(
          1,
          $this->blockchain->addTransactionToStack($transaction2)
        );

        $this->assertEquals(
            $transaction1,
            $this->blockchain->getTransactionStack()[1]
        );
        $this->assertEquals(
            $transaction2,
            $this->blockchain->getTransactionStack()[2]
        );
    }

}
