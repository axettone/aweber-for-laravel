<?php

namespace AWeberForLaravel\Providers;

class Lists extends Base
{
    /**
     * @example 'Avenue'
     */
    public static function lists()
    {
        $url = sprintf("https://api.aweber.com/1.0/accounts/%s/lists", $this->account_id);
        $body = $this->aweber->adapter->request('GET', $url);
        return $body;
    }
}
