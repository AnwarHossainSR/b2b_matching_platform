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

// FN: store
/**
 *
 * @OA\Post(
 *      path="/faqs",
 *      operationId="storeFaq",
 *      tags={"Faqs"},
 *      summary="Store New Faq",
 *      security={{"bearerAuth": {}}},
 *
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\MediaType(
 *              mediaType="multipart/form-data",
 *              @OA\Schema(
 *                  required={"question","answer"},
 *                  @OA\Property(
 *                      property="question",
 *                      description="Question",
 *                      example="This is test question",
 *                      type="string"
 *                  ),
 *                  @OA\Property(
 *                      property="answer",
 *                      description="Answer",
 *                      example="This is the test answer",
 *                      type="string"
 *                  ),
 *              )
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=201,
 *          description="Success",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad Request"
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="string", example=false),
 *              @OA\Property(property="message", type="string", example="Unauthenticated."),
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
 *      @OA\Response(
 *          response=404,
 *          description="Not Found",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="string", example=false),
 *              @OA\Property(property="message", type="string", example="ID is not found."),
 *          )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Unprocessable Entity(Validation errors)",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="string", example=false),
 *              @OA\Property(property="message", type="string", example="The given data was invalid."),
 *              @OA\Property(
 *                  property="errors",
 *                  type="object",
 *                  @OA\Property(
 *                      property="question",
 *                      type="array",
 *                      collectionFormat="multi",
 *                      @OA\Items(
 *                          type="string",
 *                          example="The question field is required.",
 *                      )
 *                  ),
 *                  @OA\Property(
 *                      property="answer",
 *                      type="array",
 *                      collectionFormat="multi",
 *                      @OA\Items(
 *                          type="string",
 *                          example="The answer field is required.",
 *                      )
 *                  ),
 *              )
 *          )
 *      ),
 * )
 */


// FN : show
/**
 * @OA\Get(
 *      path="/faqs/{slug}",
 *      operationId="getFaqById",
 *      tags={"Faqs"},
 *      summary="Return specific Faq",
 * 		security={{"bearerAuth": {}}},
 *
 * 		@OA\Parameter(
 *          name="slug",
 *          description="Pass Faq Slug",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad Request"
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="string", example=false),
 *              @OA\Property(property="message", type="string", example="Unauthenticated."),
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
 *      @OA\Response(
 *          response=404,
 *          description="Not Found",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="string", example=false),
 *              @OA\Property(property="message", type="string", example="ID is not found."),
 *          )
 *      ),
 * )
 */

// FN : update
/**
 * @OA\Put(
 *     path="/faqs/{id}",
 *      operationId="updateFaq",
 *      tags={"Faqs"},
 *      summary="Update existing Faq",
 *      security={{"bearerAuth": {}}},
 *
 *      @OA\Parameter(
 *          name="id",
 *          description="Faq ID",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *
 *      @OA\RequestBody(
 *          required=true,
 *          description = "Update Faq",
 *          @OA\JsonContent(
 *              title="Update faq request",
 *              description="Faq request body",
 *              type="object",
 *              required={"question","answer"},
 *              @OA\Property(
 *                  property="question",
 *                  description="Question",
 *                  example="Test question",
 *                  type="string"
 *              ),
 *              @OA\Property(
 *                  property="answer",
 *                  description="Answer",
 *                  example="Test answer",
 *                  type="string"
 *              ),
 *          ),
 *      ),
 *
 *      @OA\Response(
 *          response=202,
 *          description="Success",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad Request"
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="string", example=false),
 *              @OA\Property(property="message", type="string", example="Unauthenticated."),
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
 *      @OA\Response(
 *          response=404,
 *          description="Not Found",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="string", example=false),
 *              @OA\Property(property="message", type="string", example="ID is not found."),
 *          )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Unprocessable Entity(Validation errors)",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="string", example=false),
 *              @OA\Property(property="message", type="string", example="The given data was invalid."),
 *              @OA\Property(
 *                  property="errors",
 *                  type="object",
 *                  @OA\Property(
 *                      property="title",
 *                      type="array",
 *                      collectionFormat="multi",
 *                      @OA\Items(
 *                          type="string",
 *                          example="The title field is required.",
 *                      )
 *                  ),
 *              )
 *          )
 *      ),
 * )
 */

// FN : delete
/**
 * @OA\Delete(
 *      path="/faqs/{id}",
 *      operationId="deleteFaq",
 *      tags={"Faqs"},
 *      summary="Delete existing Faq",
 *      description="Deletes a record and returns no content",
 *      security={{"bearerAuth": {}}},
 *      @OA\Parameter(
 *          name="id",
 *          description="Faq Id",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="integer",
 *              format="int64"
 *          )
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation",
 *          @OA\MediaType(
 *              mediaType="application/json",
 *          )
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Bad Request"
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="string", example=false),
 *              @OA\Property(property="message", type="string", example="Unauthenticated."),
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
 *      @OA\Response(
 *          response=404,
 *          description="Not Found",
 *          @OA\JsonContent(
 *              @OA\Property(property="success", type="string", example=false),
 *              @OA\Property(property="message", type="string", example="ID is not found."),
 *          )
 *      ),
 * )
 */
