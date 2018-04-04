<?php
declare(strict_types=1);

namespace Nullabe\PhpBlocks\Tests\Domain\Model;

use Nullabe\PhpBlocks\Domain\Model\Blockchain;
use PHPUnit\Framework\TestCase;

final class BlockchainTest extends TestCase
{
    public function testCanGetBlockchainInstance()
    {
        $this->assertInstanceOf(
            Blockchain::class,
            Blockchain::getInstance()
        );
    }

    public function testChainIsEmptyArrayAtInit()
    {
        $blockchain = Blockchain::getInstance();
        $this->assertEquals([], $blockchain->getChain());
    }

    public function testTransactionStackIsEmptyArrayAtInit()
    {
        $blockchain = Blockchain::getInstance();
        $this->assertEquals([], $blockchain->getTransactionStack());
    }

}
