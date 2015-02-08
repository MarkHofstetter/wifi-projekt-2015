<?php
namespace Album\Entity;
use Doctrine\ORM\Mapping as ORM;
/** @ORM\Entity */
class Album2 {
    /**
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    * @ORM\Column(type="integer")
    */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $title;

    /** @ORM\Column(type="string") */
    protected $artist;


    function getTitle() {
       return $this->title;
    }

    function setTitle($value) {
       $this->title = $value;
    }

    function getArtist() {
       return $this->artist;
    }

    function setArtist($value) {
       $this->artist = $value;
    }

    function getId() {
    	return $this->id;
    }
}