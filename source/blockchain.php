<?php

declare(strict_types=1);

require_once 'block.php';

/**
 * کلاس بلاک‌چین: مجموعه‌ای از بلاک‌ ها که به هم متصل هستند.
 */
final class Blockchain
{
   public $chain = [];       // آرایه‌ای از بلاک‌ ها.

   /**
    * سازنده‌ بلاک‌چین
    * ایجاد بلاک اولیه (genesis block)
    */
   public function __construct()
   {
      $this->chain = [$this->createGenesisBlock()];
   }

   /**
    * ایجاد بلاک اولیه (اولین بلاک زنجیره).
    * این بلاک هیچ بلاک قبلی ندارد!
    * @return Block
    */
   public function createGenesisBlock()
   {
      return new Block(0, "First/Genesis Block", "0");
   }

   /**
    * دریافت آخرین بلاک زنجیره.
    * @return Block
    */
   public function getLastBlock()
   {
      return $this->chain[count($this->chain) - 1];
   }

   /**
    * اضافه کردن بلاک جدید به زنجیره.
    * هش بلاک قبلی به‌ طور خودکار تنظیم می‌ شود.
    * @param string $data داده‌ی بلاک جدید
    */
   public function addBlock($data)
   {
      $lastBlock = $this->getLastBlock();
      $newBlock = new Block($lastBlock->index + 1, $data, $lastBlock->hash);
      $this->chain[] = $newBlock;
   }

   /**
    * بررسی صحت زنجیره (اعتبارسنجی)
    * اگر هش هر بلاک تغییر کرده باشد یا هش بلاک قبلی اشتباه باشد، زنجیره نامعتبر است.
    * @return bool
    */
   public function isChainValid()
   {
      for ($i = 1; $i < count($this->chain); $i++)
      {
         $currentBlock = $this->chain[$i];
         $previousBlock = $this->chain[$i - 1];
         // بررسی اینکه هش فعلی بلاک با هش محاسبه‌ شده یکسان باشد.
         if ($currentBlock->hash !== $currentBlock->calculateHash())
         {
            return false;
         }
         // بررسی اینکه هش بلاک قبلی در بلاک فعلی درست باشد.
         if ($currentBlock->previousHash !== $previousBlock->hash)
         {
            return false;
         }
      }

      return true;
   }
}
