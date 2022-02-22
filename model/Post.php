<?php

class Post extends Model
{
    // déclarer les propriétés
    private $id;
    private $title;
    private $image;
    private $content;
    private $created_at;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at): void
    {
        $this->createdAt = $created_at;
    }

    public function getAll()
    {

        $posts = Dao::getMany(self::class);
        return $posts;
    }

    public function getOneById(int $id)
    {

        $post = Dao::getOne(Post::class,
            [
                'id' => $id
            ]);
        return $post;
    }
}


// monsite.fr/posts