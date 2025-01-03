<?php

namespace App\Models;

use Botble\ACL\Models\User;
use App\Casts\SafeContent;
use Botble\Base\Facades\Html;
use App\Models\BaseModel;
use Botble\Payment\Models\Payment;
use Botble\RealEstate\Enums\TransactionTypeEnum;
use Botble\RealEstate\Facades\RealEstateHelper;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends BaseModel
{
    protected $table = 'transactions';

    protected $fillable = [
        'credits',
        'description',
        'user_id',
        'account_id',
        'payment_id',
        'type',
    ];

    protected $casts = [
        'type' => TransactionTypeEnum::class,
        'description' => SafeContent::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class)->withDefault();
    }

    public function getDescription(): string
    {
        if (! RealEstateHelper::isEnabledCreditsSystem()) {
            return '';
        }

        $time = Html::tag('span', $this->created_at->diffForHumans(), ['class' => 'small italic']);

        $credits = indian_number_format($this->credits);

        if ($this->user_id) {
            if ($this->type == TransactionTypeEnum::ADD) {
                return __(
                    'Added :credits credit(s) by admin ":user"',
                    ['credits' => $credits, 'user' => $this->user->name]
                );
            }

            return __(
                'Removed :credits credit(s) by admin ":user"',
                ['credits' => $credits, 'user' => $this->user->name]
            );
        }

        $description = __('You have purchased :credits credit(s)', ['credits' => $credits]);
        if ($this->payment_id) {
            $description .= ' ' . __('via') . ' ' . $this->payment->payment_channel->label() . ' ' . $time .
                ': ' . indian_number_format($this->payment->amount, 2) . $this->payment->currency;
        }

        return $description;
    }
}
