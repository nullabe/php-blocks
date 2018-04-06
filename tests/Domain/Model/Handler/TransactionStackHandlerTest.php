<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Factory\TransactionFactory;
use Nbe\PhpBlocks\Domain\Model\Handler\TransactionStackHandler;
use PHPUnit\Framework\TestCase;

class TransactionStackHandlerTest extends TestCase
{
    public $blockchain;

    public $transactionFactory;

    public $transactionStackHandler;

    public function __construct(
      ?string $name = null,
      array $data = [],
      string $dataName = ''
    ) {
        parent::__construct($name, $data, $dataName);

        $this->blockchain = Blockchain::getInstance();
        $this->transactionFactory = new TransactionFactory();
        $this->transactionStackHandler = new TransactionStackHandler($this->blockchain);
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

        $lastBlockIndex = $this->blockchain->getLastBlock()->getIndex();

        $this->assertEquals(
          $lastBlockIndex + 1,
          $this->transactionStackHandler->addTransactionToStack($transaction1)
        );
        $this->assertEquals(
          $lastBlockIndex + 1,
          $this->transactionStackHandler->addTransactionToStack($transaction2)
        );

        $this->assertEquals(
          [$transaction1, $transaction2],
          $this->blockchain->getTransactionStack()
        );
    }
}