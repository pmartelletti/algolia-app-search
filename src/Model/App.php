<?php
namespace App\Model;

use Illuminate\Support\Collection;

class App extends AlgoliaModel
{
    protected $name;
    protected $image;
    protected $link;
    protected $category;
    protected $rank;
    protected $algoliaId;

    public static function create(Collection $data)
    {
        return (new App())
            ->setName($data->get('name'))
            ->setImage($data->get('image'))
            ->setLink($data->get('link'))
            ->setCategory($data->get('category'))
            ->setRank($data->get('rank'))
            ->setAlgoliaId($data->get('algolia_id'))
        ;
    }

    /**
     * @return mixed
     */
    public function getAlgoliaId()
    {
        return $this->algoliaId;
    }

    /**
     * @param $algoliaId
     * @return $this
     */
    public function setAlgoliaId($algoliaId)
    {
        $this->algoliaId = $algoliaId;

        return $this;
    }

    public function getIndexName()
    {
        return 'apps';
    }

    /**
     * Adds the App to Algolia Index. Returns the Algolia ID
     *
     * @return App
     */
    public function addToAlgolia()
    {
        $result = $this->getIndex()->addObject([
            'name' => $this->getName(),
            'image' => $this->getImage(),
            'link' => $this->getLink(),
            'category' => $this->getCategory(),
            'rank' => $this->getRank()
        ]);

        return $this->setAlgoliaId($result['objectID']);
    }

    public function removeFromAlgolia()
    {
        $this->getIndex()->deleteObject($this->getAlgoliaId());
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return App
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
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
     * @return App
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     * @return App
     */
    public function setLink($link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     * @return App
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param mixed $rank
     * @return App
     */
    public function setRank($rank)
    {
        $this->rank = $rank;
        return $this;
    }
}