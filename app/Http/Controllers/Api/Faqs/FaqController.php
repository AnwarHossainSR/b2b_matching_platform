<?php

namespace App\Http\Controllers\Api\Faqs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Faqs\FaqStoreRequest;
use App\Models\Faqs\Faq;
use App\Services\Faqs\FaqService;
use Illuminate\Http\Request;

class FaqController extends Controller
{

    /**
     * @var $faqService
     */
    protected $faqService;

    public function __construct(FaqService $faqService)
    {
        $this->faqService = $faqService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->faqService->getAll($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqStoreRequest $request)
    {
        return $this->faqService->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faqs\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        $this->authorize('faq-view');
        return $this->faqService->get($faq);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faqs\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $this->authorize('faq-edit');
        return $this->faqService->update($request, $faq);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faqs\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $this->authorize('faq-delete');
        return $this->faqService->destroy($faq);
    }
}

// FN : getAll
    /**
     * @OA\Get(
     *      path="/faqs",
     *      operationId="getFaqListAll",
     *      tags={"Faqs"},
     *      summary="Get list of Faqs All",
     *      description="Returns list of Faq All",

     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(
     *              @OA\Property(property="success", type="string", example=false),
     *              @OA\Property(property="message", type="string", example="This action is unauthorized."),
     *          )
     *      ),
     * )
     */
