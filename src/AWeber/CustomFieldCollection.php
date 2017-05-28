<?php

namespace AWeberForLaravel;

class CustomFieldCollection
{
    protected $awList;
    protected $query;
    protected $queryParams;

    public function __construct(AWeberList $awList)
    {
        $this->awList = $awList;
        $this->query = "all";
        $this->queryParams = [];
    }
    protected function aweber()
    {
        return $this->awList->aweber();
    }

    public function all(callable $onUpdate = null, callable $onFinish = null)
    {
        $ret = [];
        $url = sprintf("https://api.aweber.com/1.0/accounts/%s/lists/%s/custom_fields", $this->aweber()->accountId(), $this->awList->id());
        $offset = 0;
        do {
            $subRet = [];
            $options = [
            'ws.start' => $offset,
            'ws.size'  => 100
            ];
            $body = $this->aweber()->request('GET', $url, $options);
            $cnt = count($body['entries']);
            //$ret = array_merge($ret, $body['entries']);
            foreach ($body['entries'] as $entry) {
                $s = new Campaign($entry);
                $subRet[] = $s;
                $ret[] = $s;
            }

            $offset += $cnt;
            if ($onUpdate != null) {
                $onUpdate($subRet);
            }
            sleep(1);
        } while ($cnt==100);
        if ($onFinish != null) {
            $onFinish($ret);
        }
        return $ret;
    }
}
