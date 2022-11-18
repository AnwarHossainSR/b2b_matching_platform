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

    public function getAll($request)
    {
        return $this->faq->all();
    }

    public function store($request)
    {
        return $this->faq->create($request->all());
    }

    public function get($faq)
    {
        return $faq;
    }

    public function update($request, $faq)
    {
        $faq->update($request->all());
        return $faq->fresh();
    }

    public function destroy($faq)
    {
        return $faq->delete();
    }
}
