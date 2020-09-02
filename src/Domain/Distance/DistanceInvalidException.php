<?php
declare(strict_types=1);

namespace App\Domain\Distance;

use App\Domain\DomainException\DomainRecordNotFoundException;

class DistanceInvalidException extends DomainRecordNotFoundException
{
    public $message = 'The distance you inserted is not valid.';
}
