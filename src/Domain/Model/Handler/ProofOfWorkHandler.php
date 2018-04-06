<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockchainInterface;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\ProofOfWorkHandlerInterface;

class ProofOfWorkHandler implements ProofOfWorkHandlerInterface
{
    const DIFFICULTY = '0000';

    private $blockchain;

    public function __construct(BlockchainInterface $blockchain)
    {
        $this->blockchain = $blockchain;
    }

    public function proofOfWork(int $lastProof): int
    {
        return $lastProof;
    }

    public static function validateProof(string $hash): bool
    {
        $output = FALSE;

        if (strpos($hash, self::DIFFICULTY) === 0)
            $output = TRUE;

        return $output;
    }

}
