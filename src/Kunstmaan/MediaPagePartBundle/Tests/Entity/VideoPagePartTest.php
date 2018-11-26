<?php

namespace Kunstmaan\MediaPagePartBundle\Tests\Entity;

use Kunstmaan\MediaBundle\Entity\Media;
use Kunstmaan\MediaPagePartBundle\Entity\VideoPagePart;
use Kunstmaan\MediaPagePartBundle\Form\VideoPagePartAdminType;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-10-01 at 11:05:56.
 */
class VideoPagePartTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var VideoPagePart
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new VideoPagePart();
    }

    /**
     * @covers \Kunstmaan\MediaPagePartBundle\Entity\VideoPagePart::setMedia
     * @covers \Kunstmaan\MediaPagePartBundle\Entity\VideoPagePart::getMedia
     */
    public function testSetGetMedia()
    {
        $media = new Media();
        $media->setId(5);
        $this->object->setMedia($media);
        $this->assertEquals(5, $this->object->getMedia()->getId());
    }

    /**
     * @covers \Kunstmaan\MediaPagePartBundle\Entity\VideoPagePart::getDefaultView
     */
    public function testGetDefaultView()
    {
        $defaultView = $this->object->getDefaultView();
        $this->assertEquals('KunstmaanMediaPagePartBundle:VideoPagePart:view.html.twig', $defaultView);
    }

    /**
     * @covers \Kunstmaan\MediaPagePartBundle\Entity\VideoPagePart::getDefaultAdminType
     */
    public function testGetDefaultAdminType()
    {
        $this->assertEquals(VideoPagePartAdminType::class, $this->object->getDefaultAdminType());
    }
}
