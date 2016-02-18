<?php

declare(strict_types=1);

require_once 'blockchain.php';

// ============================
// مثال
// ============================

$myBlockchain = new Blockchain();
$myBlockchain->addBlock("Transaction #1: Ali sent 1 unit to Sara");
$myBlockchain->addBlock("Transaction #2: Sara sent 7.5 unit to Akbar");

// نمایش زنجیره.
foreach ($myBlockchain->chain as $block)
{
   echo "Block number: {$block->index}\n";
   echo "Date/Time: " . date('Y-m-d H:i:s', $block->timestamp) . PHP_EOL;
   echo "Data: {$block->data}\n";
   echo "Previous hash: {$block->previousHash}\n";
   echo "Hash: {$block->hash}\n";
   echo str_repeat('-', 50) . PHP_EOL;
}

// اعتبارسنجی زنجیره.
echo 'Is chain valid? ' . ($myBlockchain->isChainValid() ? 'Yes' : 'No') . "\n\n";

// ============================
// مثال 2
// ============================

// هش نامعتبر
$myBlockchain->chain[1]->hash = 'abcd1234invalidhash';

// نمایش زنجیره.
foreach ($myBlockchain->chain as $block)
{
   echo "Block number: {$block->index}\n";
   echo "Date/Time: " . date('Y-m-d H:i:s', $block->timestamp) . PHP_EOL;
   echo "Data: {$block->data}\n";
   echo "Previous hash: {$block->previousHash}\n";
   echo "Hash: {$block->hash}\n";
   echo str_repeat('-', 50) . PHP_EOL;
}

// اعتبارسنجی زنجیره.
echo 'Is chain valid? ' . ($myBlockchain->isChainValid() ? 'Yes' : 'No') . PHP_EOL;
