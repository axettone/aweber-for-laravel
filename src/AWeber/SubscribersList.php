<?php

namespace AWeberForLaravel;

class SubscribersList
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
    public function all()
    {
        $this->query = "all";
        $this->queryParams = [];
        return $this;
    }

    public function find($parameters = [])
    {
        $this->query = "find";
        $this->queryParams = $parameters;
        return $this;
    }

    public function tag($add = [], $remove = [])
    {
    }

    public function fetch()
    {
        switch ($this->query) {
            case 'all':
                return $this->_getAll();
                break;
            case 'find':
                return $this->_find();
                break;
        }
    }

    protected function _getAll()
    {
        $ret = [];
        $url = sprintf("https://api.aweber.com/1.0/accounts/%s/lists/%s/subscribers", $this->aweber()->accountId(), $this->awList->id());
        $offset = 0;
        do {
            $options = [
            'ws.start' => $offset,
            'ws.size'  => 100
            ];
            $body = $this->aweber()->request('GET', $url, [], $options);
            $cnt = count($body['entries']);
            $ret = array_merge($ret, $body['entries']);
            $offset += $cnt;
            sleep(1);
        } while ($cnt==100);
        return $ret;
    }

    protected function _find()
    {
        return [];
    }
}
