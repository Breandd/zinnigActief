<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Array_;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PeriodRepository")
 */
class Period
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $startTime;

    /**
     * @ORM\Column(type="time")
     */
    private $endTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Activity", inversedBy="periods")
     */
    private $activityId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Place", inversedBy="periods")
     */
    private $placeId;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User")
     */
    private $userPeriod;

    public function __construct()
    {
        $this->userPeriod = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartTime(): ?\DateTimeInterface
    {
        return $this->startTime;
    }

    public function setStartTime(\DateTimeInterface $startTime): self
    {
        $this->startime = $startTime;

        return $this;
    }

    public function getEndTime(): ?\DateTimeInterface
    {
        return $this->endTime;
    }

    public function setEndTime(\DateTimeInterface $endTime): self
    {
        $this->endTime = $endTime;

        return $this;
    }

    public function getActivityId(): ?Activity
    {
        return $this->activityId;
    }

    public function setActivityId(?Activity $activityId): self
    {
        $this->activityId = $activityId;

        return $this;
    }

    public function getPlaceId(): ?Place
    {
        return $this->placeId;
    }

    public function setPlaceId(?Place $placeId): self
    {
        $this->placeId = $placeId;

        return $this;
    }
}
