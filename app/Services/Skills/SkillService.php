<?php

namespace App\Services\Skills;

use App\Http\Resources\Skills\SkillCollection;
use App\Repositories\Skills\SkillRepository;
use App\Traits\Common\RespondsWithHttpStatus;


class SkillService
{
    use RespondsWithHttpStatus;

    /**
     * @var $skillRepository
     */
    protected $skillRepository;
    /**
       * Instantiate service
       *
       * @param SkillRepository $skillRepository
       */
    public function __construct(SkillRepository $skillRepository)
    {
        $this->skillRepository = $skillRepository;
    }

    public function getAll($request)
    {
        return $this->success('',  new SkillCollection($this->skillRepository->getAll($request)));
    }
}
