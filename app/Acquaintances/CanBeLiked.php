<?php

namespace App\Acquaintances;

use Multicaret\Acquaintances\Traits\CanBeLiked as BaseCanBeLiked;

trait CanBeLiked
{
    use BaseCanBeLiked;

    public function likersCount()
    {
        return $this->attributes['likers_count'] ?? 0;
    }

    public function likersCountFormatted($precision = 1, $divisors = null)
    {
        return Interaction::numberToReadable($this->likersCount, $precision, $divisors);
    }
}
