<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Handler\ProofOfWorkHandler;
use PHPUnit\Framework\TestCase;

/**
 * ProofOfWorkHandlerTest class
 */
class ProofOfWorkHandlerTest extends TestCase
{
    /**
     * @var Blockchain
     */
    public $blockchain;

    /**
     * @var ProofOfWorkHandler
     */
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

    public function testProofOfWorkHandlerCanValidateThatHashHas4Leading0(): void
    {
        $this->assertEquals(
          TRUE,
          $this->proofOfWorkHandler::validateProof('00001')
        );
    }

    public function testCanMakeHashByMultiplyingTwoInt(): void
    {
        $x = 1;
        $y = 2;

        $this->assertEquals(
          TRUE,
            is_string($this->proofOfWorkHandler->hashByTwoIntMultiplication($x, $y))
        );
    }

    public function testCanFindNewValidProofByTellLastOneIs100(): void
    {
        $lastProof = 100;
        $newProof = $this->proofOfWorkHandler->proofOfWork($lastProof);

        $this->assertEquals(
          TRUE,
          is_int($newProof)
        );
        $this->assertEquals(
          TRUE,
          ($lastProof !== $newProof)
        );
    }

}
