<?php

namespace Kunstmaan\PagePartBundle\Tests\Form;

use Kunstmaan\PagePartBundle\Form\ToTopPagePartAdminType;
use Kunstmaan\PagePartBundle\Tests\unit\Form\PagePartAdminTypeTestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-08-20 at 12:03:51.
 */
class ToTopPagePartAdminTypeTest extends PagePartAdminTypeTestCase
{
    /**
     * @var ToTopPagePartAdminType
     */
    protected $object;

    protected function setUp()
    {
        parent::setUp();
        $this->object = new ToTopPagePartAdminType();
    }

    public function testBuildForm()
    {
        $this->object->buildForm($this->builder, array());
    }

    public function testConfigureOptions()
    {
        $this->object->configureOptions($this->resolver);
        $resolve = $this->resolver->resolve();
        $this->assertEquals($resolve['data_class'], 'Kunstmaan\PagePartBundle\Entity\ToTopPagePart');
    }
}