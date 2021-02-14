<?php

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;


class test {
    protected $manager;
    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }
}

new test();