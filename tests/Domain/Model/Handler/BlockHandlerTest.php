<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Factory\TransactionFactory;
use Nbe\PhpBlocks\Domain\Model\Handler\BlockHandler;
use Nbe\PhpBlocks\Domain\Model\Handler\BlockHashHandler;
use PHPUnit\Framework\TestCase;

final class BlockHandlerTest extends TestCase
{
    public $blockchain;

    public $transactionFactory;

    public $blockHandler;

    public function __construct(
      ?string $name = null,
      array $data = [],
      string $dataName = ''
    ) {
        parent::__construct($name, $data, $dataName);

        $this->blockchain = Blockchain::getInstance();
        $this->transactionFactory = new TransactionFactory();
        $this->blockHandler = new BlockHandler($this->blockchain);

    }

    public function testCanAddNewBlockToChain(): void
    {
        $newBlock = $this->blockHandler->addNewBlockToChain(100);
        $chain = $this->blockchain->getChain();

        $this->assertEquals(
          $newBlock,
          array_pop($chain)
        );
        $this->assertEquals(
          $newBlock,
          $this->blockchain->getLastBlock()
        );

        $previousBlockPosition = count($chain) - 1;
        $this->assertEquals(
          $newBlock->getPreviousHash(),
          BlockHashHandler::hashBlock($chain[$previousBlockPosition])
        );

        $this->assertEquals(
          [],
          $this->blockchain->getTransactionStack()
        );
    }
}