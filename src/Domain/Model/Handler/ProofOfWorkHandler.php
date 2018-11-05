<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Config\Hash;
use Nbe\PhpBlocks\Domain\Config\ProofOfWork;
use Nbe\PhpBlocks\Domain\Model\Entity\Block;
use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\ProofOfWorkHandlerInterface;

/**
 * Class ProofOfWorkHandler
 *
 * @package Nbe\PhpBlocks\Domain\Model\Handler
 */
class ProofOfWorkHandler implements ProofOfWorkHandlerInterface
{
    /**
     * @var string
     */
    private $generatedHash = "";

    /**
     * @return string
     */
    public function getGeneratedHash(): string
    {
        return $this->generatedHash;
    }

    /**
     * @param int $lastProof
     * @param string $blockHeader
     *
     * @return int
     */
    public function proofOfWork(int $lastProof, string $blockHeader): int
    {
        $proof = 0;

        while(!self::validateProof($this->generatedHash)){
            $this->generatedHash = $this->generateHash($lastProof, $proof++, $blockHeader);
        }

        return $proof;
    }

    /**
     * @param int $lastProof
     * @param int $currentProof
     * @param string $blockHeader
     *
     * @return string
     */
    private function generateHash(int $lastProof, int $currentProof, string $blockHeader): string
    {
        $result = (string) $currentProof . (string) $lastProof . $blockHeader;
        $encodedString = base64_encode($result);

        return hash(Hash::ALGO, hash(Hash::ALGO, $encodedString));
    }

    /**
     * @param string $hash
     *
     * @return bool
     */
    public static function validateProof(string $hash): bool
    {
        $output = FALSE;

        if (strpos($hash, ProofOfWork::DIFFICULTY) === 0)
            $output = TRUE;

        return $output;
    }

}
