<?php

namespace App\Repositories\Faqs;

use App\Models\Faqs\Faq;

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

    public function getAll($request)
    {
        return $this->faq->all();
    }

    public function store($request)
    {
        return $this->faq->create($request->all());
    }

    // public function store($request)
    // {
    //     $post = $this->post->create($request->all());
    //     return $post->fresh();
    // }
}
