<?php

class Product
{
    private $id;
    private $name;
    private $price;
    private $description;
    private $stock;
    private $type;
    private $new;
    private $actie;
    private $img;
    public function __construct($id, $name, $price, $description, $stock, $type, $new, $actie, $img )
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->stock = $stock;
        $this->type = $type;
        $this->new = $new;
        $this->actie = $actie;
        $this->img = $img;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getStock()
    {
        return $this->stock;
    }
    public function getType()
    {
        return $this->type;
    }
      public function isNew()
    {
        return $this->new;
    }
      public function isActie()
    {
        return $this->actie;
    }
       public function getImg()
    {
        return $this->img;
    }
    // Alle producten laden vanuit JSON
    public static function getAllProducts()
    {
        $file = 'data/products.json';
        if (!file_exists($file)) return [];

        $json = file_get_contents($file);
        $data = json_decode($json, true);

        $products = [];
        foreach ($data as $item) {
            $products[] = new Product(
                $item['id'],
                $item['name'],
                $item['price'],
                $item['description'],
                $item['stock'],
                $item['type'],
                $item['new'],
                $item['actie'],
                $item['img']
            );
        }

        return $products;
    }

    // Specifiek product opzoeken
    public static function getProductById($id)
    {
        $products = self::getAllProducts();
        foreach ($products as $product) {
            if ($product->getId() === $id) {
                return $product;
            }
        }
        return null;
    }
}
