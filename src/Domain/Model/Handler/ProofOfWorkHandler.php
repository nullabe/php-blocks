<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\ProofOfWorkHandlerInterface;
use Nbe\PhpBlocks\Domain\Config\Hash;
use Nbe\PhpBlocks\Domain\Config\ProofOfWork;

/**
 * ProofOfWorkHandler class
 */
class ProofOfWorkHandler implements ProofOfWorkHandlerInterface
{
    /**
     * @var Blockchain
     */
    private $blockchain;

    /**
     * Constructor
     * 
     * @param Blockchain $blockchain
     */
    public function __construct(Blockchain $blockchain)
    {
        $this->blockchain = $blockchain;
    }

    /**
     * @param integer $lastProof
     * @return integer
     */
    public function proofOfWork(int $lastProof): int
    {
        $proof = 0;
        $hash = "";

        while(!self::validateProof($hash)){
            $hash = $this->hashByTwoIntMultiplication($lastProof, $proof++);
        }

        return $proof;
    }

    /**
     * @param integer $x
     * @param integer $y
     * @return string
     */
    public function hashByTwoIntMultiplication(int $x, int $y): string
    {
        $result = $x * $y;
        $encodedString = base64_encode((string)$result);

        return hash(Hash::ALGO, $encodedString);
    }

    /**
     * @param string $hash
     * @return boolean
     */
    public static function validateProof(string $hash): bool
    {
        $output = FALSE;

        if (strpos($hash, ProofOfWork::DIFFICULTY) === 0)
            $output = TRUE;

        return $output;
    }

}
