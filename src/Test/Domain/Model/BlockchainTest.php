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
    
}
