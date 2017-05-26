<?php

namespace AWeberForLaravel;

class AWeberList
{
    protected $aweber;
    protected $name;
    protected $id;

    public function __construct(AWeber $aweber, $name, $id)
    {
        $this->aweber = $aweber;
        $this->name = $name;
        $this->id = $id;
    }
    public function aweber()
    {
        return $this->aweber;
    }
    public function id()
    {
        return $this->id;
    }
    public function subscribers()
    {
        return new SubscribersList($this);
    }

    public function addSubscriber(Subscriber $subscriber)
    {
    }

    public function removeSubscriber(Subscriber $subscriber)
    {
    }
}
