<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler\Contract;

interface ProofOfWorkHandlerInterface
{
    public function proofOfWork(int $lastProof, string $blockHeader): int;

    public static function validateProof(string $hash): bool;

}

