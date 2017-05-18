<?php
namespace AWeberForLaravel;

use Illuminate\Support\Collection;

class AWeber
{
    protected $aweber;
    protected $account;
    protected $account_id;
    protected $list_id;

    public function __construct()
    {
        $this->aweber = new AWeberAPI(
            config('aweber.consumer_key'),
            config('aweber.consumer_secret'));
        $this->account = $this->aweber->getAccount(config('aweber.access_key'),
            config('aweber.access_secret'));
        $this->account_id = config('aweber.account_id');
        $this->list_id = config('aweber.list_id');
    }

    public function getSubscribers($offset = 0, $limit = 100)
    {
        $url = sprintf("https://api.aweber.com/1.0/accounts/%s/lists/%s/subscribers", config('aweber.account_id'), config('aweber.list_id'));
        $options = [
            'ws.start' => $offset,
            'ws.size'  => $limit
            ];
        $body = $this->aweber->adapter->request('GET', $url, [], $options);
        print_f($body);
    }
    public function addSubscriber(Subscriber $subscriber, $tags = [], $allow_empty = true, $return = 'body')
    {
        $createSubscriberURL = sprintf('/accounts/%s/lists/%s/subscribers',
            $this->account_id,
            $this->list_id);

        $data = [
            'ws.op'         => 'create',
            'email'         => $subscriber->email,
            'ip_address'    => $subscriber->ip,
            'name'          => $subscriber->name,
            'tags'          => $tags,
        ];

        $options = [
            'allow_empty'   => $allow_empty,
            'return'        => $return
        ];

        $body = $this->aweber->adapter->request('POST', $createSubscriberURL, $data, $options);
        if ($body['Status-Code'] != 201) {
        }
        return $body;
    }
}
