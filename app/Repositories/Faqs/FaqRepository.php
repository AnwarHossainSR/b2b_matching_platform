<?php

namespace App\Repositories\Faqs;

use App\Models\Faq;

class FaqRepository
{
    protected $faq;
    /**
       * Instantiate reporitory
       * 
       * @param Faq $faq
       */
    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    // Your methods for repository
}