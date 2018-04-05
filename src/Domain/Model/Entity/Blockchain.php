<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockchainInterface;
use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockInterface;

final class Blockchain implements BlockchainInterface
{
    const ALGO_USED_TO_HASH = "sha256";

    private static $instance;

    private $chain;

    private $transactionStack;

    private $lastBlock;

    private function __construct()
    {
        $this->chain = [];
        $this->transactionStack = [];

        $this->addNewBlockToChain(100, "");
    }

    public static function getInstance(): BlockchainInterface
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getChain(): array
    {
        return $this->chain;
    }

    public function getTransactionStack(): array
    {
        return $this->transactionStack;
    }

    public function getLastBlock(): BlockInterface
    {
        return $this->lastBlock;
    }

    public function addNewBlockToChain(int $proof, string $previousHash = NULL): BlockInterface
    {
        $previousHash = $previousHash ?? self::hashBlock($this->lastBlock);
        $block = new Block(count($this->getChain()) + 1, $this->getTransactionStack(), $proof, $previousHash);

        array_push($this->chain, $block);
        $this->lastBlock = $block;

        $this->transactionStack = [];

        return $this->lastBlock;
    }

    public function addTransactionToStack($transaction): int
    {
        array_push($this->transactionStack, $transaction);

        $nextIndex = $this->lastBlock->index + 1;

        return $nextIndex;
    }

    public static function hashBlock(BlockInterface $block): string
    {
        $arrayBlock = json_decode(json_encode($block), TRUE);
        ksort($arrayBlock);

        $jsonBlock = json_encode($arrayBlock);

        return hash(self::ALGO_USED_TO_HASH, $jsonBlock);
    }

}
