<?php
namespace AWeberForLaravel\Providers;

use AWeberForLaravel\AWeber;

class Base
{
    /**
     * @var AWeberForLaravel\AWeber
     */
    protected $aweber;

    /**
     * @param \AWeberForLaravel\AWeber $aweber
     */
    public function __construct(AWeber $aweber)
    {
        $this->aweber = $aweber;
    }
}
