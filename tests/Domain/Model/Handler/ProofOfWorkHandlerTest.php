<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Handler\ProofOfWorkHandler;
use PHPUnit\Framework\TestCase;

class ProofOfWorkHandlerTest extends TestCase
{
    public $blockchain;

    public $proofOfWorkHandler;

    public function __construct(
      ?string $name = null,
      array $data = [],
      string $dataName = ''
    ) {
        parent::__construct($name, $data, $dataName);

        $this->blockchain = Blockchain::getInstance();
        $this->proofOfWorkHandler = new ProofOfWorkHandler($this->blockchain);
    }


    public function testCanInstantiateProofOfWorkHandler(): void
    {
        $this->assertInstanceOf(
          ProofOfWorkHandler::class,
          $this->proofOfWorkHandler
        );
    }

    public function testProofOfWorkReturnInt(): void
    {
        $this->assertEquals(
          TRUE,
          is_int($this->proofOfWorkHandler->proofOfWork(0))
        );
    }

    public function testProofOfWorkHandlerCanValidateThatHashHas4Leading0(): void
    {
        $this->assertEquals(
          TRUE,
          $this->proofOfWorkHandler::validateProof('00001')
        );
    }

}
