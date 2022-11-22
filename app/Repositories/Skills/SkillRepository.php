<?php

namespace App\Repositories\Skills;

use App\Models\Skills\Skill;

class SkillRepository
{
    protected $skill;
    /**
     * Instantiate reporitory
     *
     * @param Skill $skill
     */
    public function __construct(Skill $skill)
    {
        $this->skill = $skill;
    }

    public function getAll($request)
    {
        return $this->skill
            ->when($request->search_text, function ($q) use ($request) {
                return $q->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search_text . '%')
                        ->orWhere('detail', 'like', '%' . $request->search_text . '%');
                });
            })
            ->when($request->start_date, function ($q) use ($request) {
                return $q->where('created_at', '>=', $request->start_date);
            })
            ->when($request->end_date, function ($q) use ($request) {
                return $q->where('created_at', '<=', $request->end_date);
            })
            ->latest()
            ->paginate(config('constants.paginate'));
    }
}
