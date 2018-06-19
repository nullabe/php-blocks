<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Tests\Domain\Model\Handler;

use PHPUnit\Framework\TestCase;
use Nbe\PhpBlocks\Domain\Config\ProofOfWork;
use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Handler\ProofOfWorkHandler;

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

    public function testProofOfWorkHandlerCanValidateThatHashHasDifficultyLeading(): void
    {
        $this->assertEquals(
          TRUE,
          $this->proofOfWorkHandler::validateProof(ProofOfWork::DIFFICULTY . '1')
        );
    }

    public function testProofOfWorkHandlerCanValidateThatHashHasNotDifficultyLeading(): void
    {
        $this->assertEquals(
          FALSE,
          $this->proofOfWorkHandler::validateProof('1')
        );
    }

    public function testCanFindNewValidProofByTellLastOneIs100(): void
    {
        $lastProof = 100;
        $blockHeader = "TEST";
        $newProof = $this->proofOfWorkHandler->proofOfWork($lastProof, $blockHeader);

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
