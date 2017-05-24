<?php

namespace AWeberForLaravel;

class SubscribersList
{
    protected $list;
    protected $query;
    protected $queryParams;

    public function __construct(AWeberList $list)
    {
        $this->list = $list;
        $this->query = "";
        $this->queryParams = [];
    }
    protected function aweber()
    {
        return $this->list->aweber();
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
        $url = sprintf("https://api.aweber.com/1.0/accounts/%s/lists/%s/subscribers", $this->aweber()->accountId(), $this->list->id());
        $options = [
            'ws.start' => 0,
            'ws.size'  => 100
            ];
        $body = $this->aweber->adapter->request('GET', $url, [], $options);
        $ret = array_merge($ret, $body['entries']);
        return $ret;
    }

    protected function _find()
    {
        return [];
    }
}
