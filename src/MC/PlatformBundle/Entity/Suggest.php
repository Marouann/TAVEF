<?php

namespace MC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Suggest
 *
 * @ORM\Table(name="mc_suggest")
 * @ORM\Entity(repositoryClass="MC\PlatformBundle\Repository\SuggestRepository")
 */
class Suggest
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="MC\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="MC\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipient;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="MC\PlatformBundle\Entity\Category")
     */
    private $category;

    /**
     * @ORM\OneToOne(targetEntity="MC\PlatformBundle\Entity\Image", cascade={"persist", "remove"})
     * @Assert\Valid()
     */
    private $image;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Suggest
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Suggest
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Suggest
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set category
     *
     * @param \MC\PlatformBundle\Entity\Category $category
     *
     * @return Suggest
     */
    public function setCategory(\MC\PlatformBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \MC\PlatformBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set image
     *
     * @param \MC\PlatformBundle\Entity\Image $image
     *
     * @return Suggest
     */
    public function setImage(\MC\PlatformBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \MC\PlatformBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    public function __construct()
    {
      $this->date = new \Datetime();
    }


    /**
     * Set author
     *
     * @param \MC\UserBundle\Entity\User $author
     *
     * @return Suggest
     */
    public function setAuthor(\MC\UserBundle\Entity\User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return \MC\UserBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set recipient
     *
     * @param \MC\UserBundle\Entity\User $recipient
     *
     * @return Suggest
     */
    public function setRecipient(\MC\UserBundle\Entity\User $recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * Get recipient
     *
     * @return \MC\UserBundle\Entity\User
     */
    public function getRecipient()
    {
        return $this->recipient;
    }
}
