<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Citizen
 *
 * @ORM\Table(name="citizen", indexes={@ORM\Index(name="city_id", columns={"city_id"}), @ORM\Index(name="friend", columns={"friend"})})
 * @ORM\Entity
 */
class Citizen
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \AppBundle\Entity\City
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     * })
     */
    private $city;

    /**
     * @var \AppBundle\Entity\Citizen
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Citizen")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="friend", referencedColumnName="id")
     * })
     */
    private $friend;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Citizen
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set city
     *
     * @param \AppBundle\Entity\City $city
     *
     * @return Citizen
     */
    public function setCity(\AppBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \AppBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set friend
     *
     * @param \AppBundle\Entity\Citizen $friend
     *
     * @return Citizen
     */
    public function setFriend(\AppBundle\Entity\Citizen $friend = null)
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * Get friend
     *
     * @return \AppBundle\Entity\Citizen
     */
    public function getFriend()
    {
        return $this->friend;
    }
}
