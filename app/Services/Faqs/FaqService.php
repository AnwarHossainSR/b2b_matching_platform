<?php

namespace App\Services\Faqs;

use App\Http\Resources\Faqs\FaqCollection;
use App\Http\Resources\Faqs\FaqResource;
use App\Repositories\Faqs\FaqRepository;
use App\Traits\Common\RespondsWithHttpStatus;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class FaqService
{
    use RespondsWithHttpStatus;
    /**
     * @var $faqRepository
     */
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

    public function getAll($request)
    {
        return $this->success('',  new FaqCollection($this->faqRepository->getAll($request)));
    }

    /**
     * Validate post data.
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function store($request)
    {
        $slug = Str::slug($request->question, '-');
        $request->merge(['slug' => $slug]);
        //return $request;
        $result = $this->faqRepository->store($request);
        if (!$result) {
            return $this->failure(__('messages.crud.storeFailed'));
        }
        return $this->success(__('messages.crud.stored'), new FaqResource($result), Response::HTTP_CREATED);
    }
}
