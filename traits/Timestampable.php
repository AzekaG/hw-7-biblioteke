<?php

trait Timestampable
{
    public $createdAt;

    public $updatedAt;

    function setCreatedAt($timestap)
    {
        $this->createdAt = $timestap;
    }


    function setUpdatedAt($timestamp)
    {
        $this->updatedAt = $timestamp;
    }
    function getCreatedAt()
    {
        return $this->createdAt;
    }
    function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
