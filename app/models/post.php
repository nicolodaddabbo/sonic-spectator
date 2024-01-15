<?php
namespace App\Models;

class Post
{
    protected $id;
    protected $description;
    protected $image;
    protected $user;
    protected $date;

    public function getId()
    {
        return $this->id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function read(int $id)
    {
        $this->description = 'Post description';
        $this->image = '';
        $this->user = 'User name';
        $this->date = '2020-01-01';
        $this->id = $id;

        return $this;
    }
}