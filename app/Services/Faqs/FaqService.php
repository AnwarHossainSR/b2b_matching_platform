<?php

namespace App\Services\Faqs;

use App\Repositories\FaqRepositorys\FaqRepository;

class FaqService
{
    protected $faqRepository;
    /**
       * Instantiate service
       * 
       * @param FaqRepository $faqRepository
       */
    public function __construct(FaqRepository $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    // Your methods for service
}