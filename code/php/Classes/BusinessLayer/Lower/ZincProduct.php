<?php
/**
 * Created by PhpStorm.
 * User: becke
 * Date: 2/4/2019
 * Time: 9:22 AM
 */

namespace code\php\Classes\BusinessLayer\Upper;

use Exception;

class ZincProduct
{

    private $productId;
    private $quantity;
    private $prime;
    private $title;
    private $image;
    private $brand;
    private $productDetails;
    private $pantry;
    private $numReviews;
    private $stars;
    private $fresh;
    private $price;
    private $addon;

    public function getFullArray()
    {
        return array(
            'productId' => $this->productId,
            'quantity' => $this->quantity,
            'prime' => $this->prime,
            'title' => $this->title,
            'image' => $this->image,
            'brand' => $this->brand,
            'productDetails' => $this->productDetails,
            'pantry' => $this->pantry,
            'numReviews' => $this->numReviews,
            'stars' => $this->stars,
            'fresh' => $this->fresh,
            'price' => $this->price,
            'addon' => $this->addon
        );
    }

    public function isReadyToBeProcessedInOrder()
    {
        return !is_null($this->productId) && !is_null($this->price) && !is_null($this->quantity);
    }

    public static function loadFromZincProductSearch($itemArray)
    {
        if (!is_array($itemArray)) {
            throw new Exception('$itemArray must be an array');
        }
        if (!array_key_exists('product_id', $itemArray)) throw new Exception('$itemArray does not have product_id index');
        if (!array_key_exists('title', $itemArray)) throw new Exception('$itemArray does not have title index');
        if (!array_key_exists('brand', $itemArray)) throw new Exception('$itemArray does not have brand index');
        if (!array_key_exists('pantry', $itemArray)) throw new Exception('$itemArray does not have pantry index');
        if (!array_key_exists('price', $itemArray)) throw new Exception('$itemArray does not have price index');
        if (!array_key_exists('image', $itemArray)) throw new Exception('$itemArray does not have image index');

        $zincProduct = new ZincProduct();
        $zincProduct->setProductId($itemArray['product_id']);
        $zincProduct->setQuantity(1);
        $zincProduct->setPrime($itemArray['prime']);
        $zincProduct->setTitle($itemArray['title']);
        $zincProduct->setImage($itemArray['image']);
        $zincProduct->setBrand($itemArray['brand']);
        $zincProduct->setProductDetails($itemArray['product_details']);
        $zincProduct->setPantry($itemArray['pantry']);
        $zincProduct->setNumReviews($itemArray['num_reviews']);
        $zincProduct->setStars($itemArray['stars']);
        $zincProduct->setFresh($itemArray['fresh']);
        $zincProduct->setPrice($itemArray['price']);
        $zincProduct->setAddon($itemArray['addon']);
        return $zincProduct;
    }

    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param mixed $productId
     */
    public function setProductId($productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getPrime()
    {
        return $this->prime;
    }

    /**
     * @param mixed $prime
     */
    public function setPrime($prime): void
    {
        $this->prime = $prime;
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
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed $brand
     */
    public function setBrand($brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return mixed
     */
    public function getProductDetails()
    {
        return $this->productDetails;
    }

    /**
     * @param mixed $productDetails
     */
    public function setProductDetails($productDetails): void
    {
        $this->productDetails = $productDetails;
    }

    /**
     * @return mixed
     */
    public function getPantry()
    {
        return $this->pantry;
    }

    /**
     * @param mixed $pantry
     */
    public function setPantry($pantry): void
    {
        $this->pantry = $pantry;
    }

    /**
     * @return mixed
     */
    public function getNumReviews()
    {
        return $this->numReviews;
    }

    /**
     * @param mixed $numReviews
     */
    public function setNumReviews($numReviews): void
    {
        $this->numReviews = $numReviews;
    }

    /**
     * @return mixed
     */
    public function getStars()
    {
        return $this->stars;
    }

    /**
     * @param mixed $stars
     */
    public function setStars($stars): void
    {
        $this->stars = $stars;
    }

    /**
     * @return mixed
     */
    public function getFresh()
    {
        return $this->fresh;
    }

    /**
     * @param mixed $fresh
     */
    public function setFresh($fresh): void
    {
        $this->fresh = $fresh;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getAddon()
    {
        return $this->addon;
    }

    /**
     * @param mixed $addon
     */
    public function setAddon($addon): void
    {
        $this->addon = $addon;
    }

    public function getOrderArray()
    {
        if (is_null($this->productId) || is_null($this->quantity))
            throw new Exception('zinc product is not completely set');
        return array(
            'product_id' => $this->productId,
            'quantity' => $this->quantity
        );
    }


}