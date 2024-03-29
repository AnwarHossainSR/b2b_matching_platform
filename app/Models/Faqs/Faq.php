<?php

namespace App\Models\Faqs;

use App\Enums\CmnEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

class Faq extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['question', 'answer'];

    protected $primaryKey = 'id';

    protected $keyType = 'string';

    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->setAttribute($model->getKeyName(), Uuid::uuid4());
        });
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($model) {
            $model->user_id = Auth::id() ?? CmnEnum::ONE;
            $model->created_by = Auth::id() ?? CmnEnum::ONE;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::id() ?? CmnEnum::ONE;
        });

        static::deleting(function ($model) {
            $model->delete_by = Auth::id() ?? CmnEnum::ONE;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
