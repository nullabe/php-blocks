<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity\Contract;

interface BlockchainInterface
{
    static function getInstance(): BlockchainInterface;

    public function getChain(): array;

    public function getTransactionStack(): array;

    public function getLastBlock(): BlockInterface;

    public function appendBlockToChain(BlockInterface $block): BlockInterface;

    public function appendTransactionToStack(TransactionInterface $transaction): TransactionInterface;

    public function resetTransactionStack(): BlockchainInterface;

}
