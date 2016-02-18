<?php

declare(strict_types=1);

/**
 * کلاس بلاک: هر بلاک شامل داده، زمان‌سنج، هش بلاک قبلی و هش خودش است.
 */
final class Block
{
   public $index;            // شماره‌ی ترتیبی بلاک در زنجیره
   public $timestamp;        // زمان ایجاد بلاک
   public $data;             // داده‌ی ذخیره‌شده در بلاک (مثلاً تراکنش)
   public $previousHash;     // هش بلاک قبلی (برای ایجاد زنجیره)
   public $hash;             // هش فعلی این بلاک

   /**
    * سازنده‌ی بلاک
    * @param int $index شماره‌ی بلاک
    * @param string $data داده‌ی بلاک
    * @param string $previousHash هش بلاک قبلی
    */
   final public function __construct($index, $data, $previousHash = '')
   {
      $this->index = $index;
      $this->timestamp = time();
      $this->data = $data;
      $this->previousHash = $previousHash;
      $this->hash = $this->calculateHash(); // محاسبه‌ی هش بلاک هنگام ایجاد.
   }

   /**
    * محاسبه‌ی هش بلاک با استفاده از SHA256
    * تمام ویژگی‌های بلاک در هش گنجانده می‌شوند.
    * @return string هش محاسبه‌شده
    */
   final public function calculateHash()
   {
      return hash('sha256', $this->index . $this->previousHash . $this->timestamp . json_encode($this->data));
   }
}
