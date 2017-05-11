<?php

namespace AppBundle\Entity;

/**
 * Votes
 */
class Votes
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Idea
     */
    private $idea;

    /**
     * @var \AppBundle\Entity\User
     */
    private $user;


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
     * Set idea
     *
     * @param \AppBundle\Entity\Idea $idea
     *
     * @return Votes
     */
    public function setIdea(\AppBundle\Entity\Idea $idea = null)
    {
        $this->idea = $idea;

        return $this;
    }

    /**
     * Get idea
     *
     * @return \AppBundle\Entity\Idea
     */
    public function getIdea()
    {
        return $this->idea;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Votes
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}

