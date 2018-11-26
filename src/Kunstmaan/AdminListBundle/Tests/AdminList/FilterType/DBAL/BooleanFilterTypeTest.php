<?php

namespace Kunstmaan\AdminListBundle\Tests\AdminList\FilterType\DBAL;

use Kunstmaan\AdminListBundle\AdminList\FilterType\DBAL\BooleanFilterType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-09-26 at 13:21:33.
 */
class BooleanFilterTypeTest extends DBALFilterTypeTestCase
{
    /**
     * @var BooleanFilterType
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new BooleanFilterType('boolean', 'e');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers \Kunstmaan\AdminListBundle\AdminList\FilterType\DBAL\BooleanFilterType::bindRequest
     */
    public function testBindRequest()
    {
        $request = new Request(array('filter_value_boolean' => 'true'));

        $data = array();
        $uniqueId = 'boolean';
        $this->object->bindRequest($request, $data, $uniqueId);

        $this->assertEquals(array('value' => 'true'), $data);
    }

    /**
     * @param mixed $value
     *
     * @covers \Kunstmaan\AdminListBundle\AdminList\FilterType\DBAL\BooleanFilterType::apply
     * @dataProvider applyDataProvider
     */
    public function testApply($value)
    {
        $qb = $this->getQueryBuilder();
        $qb->select('*')
           ->from('entity', 'e');
        $this->object->setQueryBuilder($qb);
        $this->object->apply(array('value' => $value), 'boolean');

        $this->assertEquals("SELECT * FROM entity e WHERE e.boolean = $value", $qb->getSQL());
    }

    /**
     * @return array
     */
    public static function applyDataProvider()
    {
        return array(
            array('true'),
            array('false'),
        );
    }

    /**
     * @covers \Kunstmaan\AdminListBundle\AdminList\FilterType\DBAL\BooleanFilterType::getTemplate
     */
    public function testGetTemplate()
    {
        $this->assertEquals('KunstmaanAdminListBundle:FilterType:booleanFilter.html.twig', $this->object->getTemplate());
    }
}
