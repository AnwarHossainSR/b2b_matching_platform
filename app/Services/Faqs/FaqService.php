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

    /**
     * Get post by id.
     *
     * @param $id
     * @return String
     */
    public function get($faq)
    {
        return $this->success('', new FaqResource($faq));
    }

    /**
     * Update post data
     * Store to DB if there are no errors.
     *
     * @param array $data
     * @return String
     */
    public function update($request, $faq)
    {
        $slug = str()->slug($request->question);
        $request->merge(['slug' => $slug]);
        $result = $this->faqRepository->update($request, $faq);
        if ($result) {
            return $this->success(__('messages.crud.updated'), new FaqResource($result));
        }
        return $this->failure(__('messages.crud.updateFailed'));
    }

    /**
     * Delete post by id.
     *
     * @param $id
     * @return String
     */
    public function destroy($faq)
    {
        $result = $this->faqRepository->destroy($faq);
        if ($result) {
            return $this->success(__('messages.crud.deleted'));
            //return $this->success(__('messages.crud.deleted'), [], Response::HTTP_NO_CONTENT);
        }
        return $this->failure(__('messages.crud.deleteFailed'));
    }
}
