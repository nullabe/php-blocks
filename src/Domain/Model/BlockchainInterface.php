<?php
declare(strict_types=1);

namespace Nullabe\PhpBlocks\Domain\Model;

interface BlockchainInterface
{
    static function getInstance(): self;

    function getChain(): array;

    function getTransactionStack(): array;

    function getLastBlock(): BlockInterface;

    function addNewBlockToChain(): self;

    function addNewTransactionToStack(): self;

    static function hashBlock(): string;

}
