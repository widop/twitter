<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest;

use Widop\Twitter\Rest\Statuses\StatusesShowRequest;

/**
 * Abstract request test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\AbstractRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = $this->getMockForAbstractClass('Widop\Twitter\Rest\AbstractRequest');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->request);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage The method "foo" does not exist.
     */
    public function testInvalidMethodPrefix()
    {
        $this->request->foo();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage You must provide an argument to the method "setId".
     */
    public function testInvalidOption()
    {
        $this->request = new StatusesShowRequest('123');
        $this->request->setId();
    }
}
