<?php

namespace Kunstmaan\AdminListBundle\Tests\AdminList\FilterType\ORM;

use Doctrine\ORM\QueryBuilder;
use Kunstmaan\AdminListBundle\AdminList\FilterType\ORM\DateFilterType;
use Kunstmaan\AdminListBundle\Tests\unit\AdminList\FilterType\ORM\BaseOrmFilterTest;
use Kunstmaan\AdminListBundle\Tests\UnitTester;
use ReflectionClass;
use Symfony\Component\HttpFoundation\Request;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-09-26 at 13:21:34.
 */
class DateFilterTypeTest extends BaseOrmFilterTest
{
    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @var DateFilterType
     */
    protected $object;

    protected function setUp()
    {
        $this->object = new DateFilterType('date', 'b');
    }

    public function testBindRequest()
    {
        $request = new Request(array('filter_comparator_date' => 'before', 'filter_value_date' => '01/01/2012'));

        $data = array();
        $uniqueId = 'date';
        $this->object->bindRequest($request, $data, $uniqueId);

        $this->assertEquals(array('comparator' => 'before', 'value' => '01/01/2012'), $data);
    }

    /**
     * @param string $comparator  The comparator
     * @param string $whereClause The where clause
     * @param mixed  $value       The value
     * @param mixed  $testValue   The test value
     *
     * @dataProvider applyDataProvider
     */
    public function testApply($comparator, $whereClause, $value, $testValue)
    {
        $qb = $this->getQueryBuilder();

        $qb->select('b')
            ->from('Entity', 'b');
        $this->object->setQueryBuilder($qb);
        $this->object->apply(array('comparator' => $comparator, 'value' => $value), 'date');

        $this->assertEquals("SELECT b FROM Entity b WHERE b.date $whereClause", $qb->getDQL());
        $this->assertEquals($testValue, $qb->getParameter('var_date')->getValue());
    }

    /**
     * @return array
     */
    public static function applyDataProvider()
    {
        return array(
            array('before', '<= :var_date', '20/12/2012', '2012-12-20'),
            array('after', '> :var_date', '21/12/2012', '2012-12-21'),
        );
    }

    public function testGetTemplate()
    {
        $this->assertEquals('KunstmaanAdminListBundle:FilterType:dateFilter.html.twig', $this->object->getTemplate());
    }

    /**
     * @throws \ReflectionException
     */
    public function testGetAlias()
    {
        $this->object = new DateFilterType('date', null);
        $mirror = new ReflectionClass(DateFilterType::class);
        $method = $mirror->getMethod('getAlias');
        $method->setAccessible(true);
        $alias = $method->invoke($this->object);
        $this->assertEquals('', $alias);
        $this->object = new DateFilterType('date', 'hello.');
        $mirror = new ReflectionClass(DateFilterType::class);
        $method = $mirror->getMethod('getAlias');
        $method->setAccessible(true);
        $alias = $method->invoke($this->object);
        $this->assertEquals('hello.', $alias);
    }

    /**
     * @throws \ReflectionException
     */
    public function testApplyReturnsNull()
    {
        $queryBuilder = $this->createMock(QueryBuilder::class);
        $queryBuilder->expects($this->never())->method('setParameter');
        $mirror = new ReflectionClass(DateFilterType::class);
        $property = $mirror->getProperty('queryBuilder');
        $property->setAccessible(true);
        $property->setValue($this->object, $queryBuilder);
        $badData = [
            'value' => 'oopsNotADate',
            'comparator' => 'true',
        ];
        $this->object->apply($badData, uniqid());
    }
}
