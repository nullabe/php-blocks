<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler\Contract;

/**
 * Interface ProofOfWorkHandlerInterface
 *
 * @package Nbe\PhpBlocks\Domain\Model\Handler\Contract
 */
interface ProofOfWorkHandlerInterface
{

    /**
     * @param int $lastProof
     * @param string $blockHeader
     *
     * @return int
     */
    public function proofOfWork(int $lastProof, string $blockHeader): int;

    /**
     * @param string $hash
     *
     * @return bool
     */
    public static function validateProof(string $hash): bool;

}

