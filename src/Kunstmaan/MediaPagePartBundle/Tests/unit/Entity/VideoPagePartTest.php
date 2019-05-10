<?php

namespace Kunstmaan\MediaPagePartBundle\Tests\Entity;

use Kunstmaan\MediaBundle\Entity\Media;
use Kunstmaan\MediaPagePartBundle\Entity\VideoPagePart;
use Kunstmaan\MediaPagePartBundle\Form\VideoPagePartAdminType;
use PHPUnit\Framework\TestCase;

class VideoPagePartTest extends TestCase
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

    public function testSetGetMedia()
    {
        $media = new Media();
        $media->setUrl('https://nasa.gov/spongebob.jpg');
        $media->setId(5);
        $this->object->setMedia($media);
        $this->assertEquals(5, $this->object->getMedia()->getId());
        $this->assertEquals('https://nasa.gov/spongebob.jpg', $this->object->__toString());
        $pp = new VideoPagePart();
        $this->assertEquals('', $pp->__toString());
    }

    public function testGetDefaultView()
    {
        $defaultView = $this->object->getDefaultView();
        $this->assertEquals('KunstmaanMediaPagePartBundle:VideoPagePart:view.html.twig', $defaultView);
    }

    public function testGetDefaultAdminType()
    {
        $this->assertEquals(VideoPagePartAdminType::class, $this->object->getDefaultAdminType());
    }
}
