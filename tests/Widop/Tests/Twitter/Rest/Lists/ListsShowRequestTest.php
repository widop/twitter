<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Tests\Twitter\Rest\Lists;

use Widop\Twitter\Rest\Lists\ListsShowRequest;

/**
 * Lists show request test.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsShowRequestTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Widop\Twitter\Rest\Lists\ListsShowRequest */
    private $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->request = new ListsShowRequest();
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->request);
    }

    public function testDefaultState()
    {
        $this->assertInstanceOf('Widop\Twitter\Rest\AbstractRequest', $this->request);
        $this->assertNull($this->request->getListId());
        $this->assertNull($this->request->getSlug());
        $this->assertNull($this->request->getOwnerId());
        $this->assertNull($this->request->getOwnerScreenName());
    }

    public function testListId()
    {
        $this->request->setListId('123456789');

        $this->assertSame('123456789', $this->request->getListId());
    }

    public function testSlug()
    {
        $this->request->setSlug('sandwich');

        $this->assertSame('sandwich', $this->request->getSlug());
    }

    public function testOwnerId()
    {
        $this->request->setOwnerId('123456789');

        $this->assertSame('123456789', $this->request->getOwnerId());
    }

    public function testOwnerScreenName()
    {
        $this->request->setOwnerScreenName('noradio');

        $this->assertSame('noradio', $this->request->getOwnerScreenName());
    }

    public function testOAuthRequestWithListId()
    {
        $this->request->setListId('123456789');
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame('/lists/show.json', $oauthRequest->getPath());
        $this->assertSame('GET', $oauthRequest->getMethod());
        $this->assertSame(array('list_id' => '123456789'), $oauthRequest->getGetParameters());
    }

    public function testOAuthRequestWithSlugAndOwnerId()
    {
        $this->request->setSlug('sandwich');
        $this->request->setOwnerId('123456789');
        $expected = array(
            'slug'     => 'sandwich',
            'owner_id' => '123456789'
        );
        $oauthRequest = $this->request->createOAuthRequest();
        $this->assertSame($expected, $oauthRequest->getGetParameters());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide a list id or slug.
     */
    public function testOAuthRequestWithoutParameters()
    {
        $this->request->createOAuthRequest();
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage You must provide the owner screen name or id in conjuction with the slug parameter.
     */
    public function testOAuthRequestWithSlugOnly()
    {
        $this->request->setSlug('sandwich');
        $this->request->createOAuthRequest();
    }
}
