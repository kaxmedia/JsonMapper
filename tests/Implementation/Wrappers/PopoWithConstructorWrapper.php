<?php

declare(strict_types=1);

namespace JsonMapper\Tests\Implementation\Wrappers;


use JsonMapper\Tests\Implementation\PopoWithConstructor;

class PopoWithConstructorWrapper
{
    /** @var PopoWithConstructor */
    private $popo;

    public function getPopo(): PopoWithConstructor
    {
        return $this->popo;
    }

    /**
     * @param PopoWithConstructor $popo
     * @return PopoWithConstructorWrapper
     */
    public function setPopo(PopoWithConstructor $popo): PopoWithConstructorWrapper
    {
        $this->popo = $popo;
        return $this;
    }
}