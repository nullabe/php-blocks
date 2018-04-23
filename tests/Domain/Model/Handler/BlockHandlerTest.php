<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Factory\TransactionFactory;
use Nbe\PhpBlocks\Domain\Model\Handler\BlockHandler;
use Nbe\PhpBlocks\Domain\Model\Handler\BlockHashHandler;
use PHPUnit\Framework\TestCase;

/**
 * BlockHandlerTest class
 */
final class BlockHandlerTest extends TestCase
{
    /**
     * @var Blockchain
     */
    public $blockchain;

    /**
     * @var TransactionFactory
     */
    public $transactionFactory;

    /**
     * @var BlockHandler
     */
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
        $prevBlock = $this->blockchain->getLastBlock();
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

        $this->assertEquals(
          $newBlock->getPreviousHash(),
          $prevBlock->getHash()
        );

        $this->assertEquals(
          [],
          $this->blockchain->getTransactionStack()
        );
    }
}