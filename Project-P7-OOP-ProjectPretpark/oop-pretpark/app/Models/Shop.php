<?php
namespace App\Models;

use PDO;

class Shop {
    public ?int $id;
    public string $name;
    public string $typeCode;
    public string $typeName;
    public ?string $location;
    public int $size;
    public int $rating;
    public string $createdAt;
    public int $capacity;
    public float $productPrice;
    public int $productsSold;
    public float $revenue;
    public float $expenses;
    public float $profitMargin;
    public ?string $paymentOptions;
    public array $openingTimes = [];

    public function __construct(
        string $name,
        string $typeCode,
        string $typeName,
        ?string $location = '',
        int $size = 0,
        int $rating = 0,
        int $capacity = 0,
        float $productPrice = 0.0,
        int $productsSold = 0,
        float $expenses = 0.0,
        ?string $paymentOptions = '',
        array $openingTimes = [],
        ?int $id = null,
        ?string $createdAt = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->typeCode = $typeCode;
        $this->typeName = $typeName;
        $this->location = $location;
        $this->size = $size;
        $this->rating = $rating;
        $this->capacity = $capacity;
        $this->productPrice = $productPrice;
        $this->productsSold = $productsSold;
        $this->revenue = $productPrice * $productsSold;
        $this->expenses = $expenses > 0 ? $expenses : $this->revenue * 0.7;
        $this->profitMargin = $this->revenue > 0 ? (($this->revenue - $this->expenses) / $this->revenue) * 100 : 0;
        $this->paymentOptions = $paymentOptions;
        $this->openingTimes = $openingTimes;
        $this->createdAt = $createdAt ?? date('Y-m-d H:i:s');
    }

    // === Getters & setters ===
    public function getId(): ?int { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getTypeCode(): string { return $this->typeCode; }
    public function getTypeName(): string { return $this->typeName; }
    public function getLocation(): ?string { return $this->location; }
    public function getSize(): int { return $this->size; }
    public function getRating(): int { return $this->rating; }
    public function getCapacity(): int { return $this->capacity; }
    public function getProductPrice(): float { return $this->productPrice; }
    public function getProductsSold(): int { return $this->productsSold; }
    public function getRevenue(): float { return $this->revenue; }
    public function getExpenses(): float { return $this->expenses; }
    public function getProfitMargin(): float { return $this->profitMargin; }
    public function getPaymentOptions(): ?string { return $this->paymentOptions; }
    public function getOpeningTimes(): array { return $this->openingTimes; }
    public function getCreatedAt(): string { return $this->createdAt; }

    public function setName(string $name) { $this->name = $name; }
    public function setType(string $code, string $name) { $this->typeCode = $code; $this->typeName = $name; }
    public function setLocation(?string $location) { $this->location = $location; }
    public function setSize(int $size) { $this->size = $size; }
    public function setRating(int $rating) { $this->rating = $rating; }
    public function setCapacity(int $capacity) { $this->capacity = $capacity; }
    public function setProductPrice(float $price) { $this->productPrice = $price; }
    public function setProductsSold(int $sold) { $this->productsSold = $sold; }
    public function setExpenses(float $expenses) { $this->expenses = $expenses; }
    public function setPaymentOptions(?string $options) { $this->paymentOptions = $options; }
    public function setOpeningTimes(array $times) { $this->openingTimes = $times; }

    // === Database functies ===
    public function save() {
        $pdo = Database::getConnection();
        $params = [
            ':name'=>$this->name, ':type_code'=>$this->typeCode, ':type_name'=>$this->typeName,
            ':location'=>$this->location, ':size'=>$this->size, ':rating'=>$this->rating,
            ':capacity'=>$this->capacity, ':product_price'=>$this->productPrice,
            ':products_sold'=>$this->productsSold, ':expenses'=>$this->expenses,
            ':payment_options'=>$this->paymentOptions, ':created_at'=>$this->createdAt
        ];

        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        foreach ($days as $day) {
            $params[":opening_time_$day"] = $this->openingTimes[$day]['open'] ?? null;
            $params[":closing_time_$day"] = $this->openingTimes[$day]['close'] ?? null;
        }

        if ($this->id === null) {
            $sql = "INSERT INTO shops
                (name,type_code,type_name,location,size,rating,capacity,product_price,products_sold,expenses,payment_options,
                 opening_time_monday,closing_time_monday,opening_time_tuesday,closing_time_tuesday,
                 opening_time_wednesday,closing_time_wednesday,opening_time_thursday,closing_time_thursday,
                 opening_time_friday,closing_time_friday,opening_time_saturday,closing_time_saturday,
                 opening_time_sunday,closing_time_sunday,created_at)
                VALUES
                (:name,:type_code,:type_name,:location,:size,:rating,:capacity,:product_price,:products_sold,:expenses,:payment_options,
                 :opening_time_monday,:closing_time_monday,:opening_time_tuesday,:closing_time_tuesday,
                 :opening_time_wednesday,:closing_time_wednesday,:opening_time_thursday,:closing_time_thursday,
                 :opening_time_friday,:closing_time_friday,:opening_time_saturday,:closing_time_saturday,
                 :opening_time_sunday,:closing_time_sunday,:created_at)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $this->id = (int)$pdo->lastInsertId();
        } else {
            $setParts = [];
            foreach ($params as $key=>$val) $setParts[] = substr($key,1)."=".$key;
            $sql = "UPDATE shops SET ".implode(", ",$setParts)." WHERE id=:id";
            $params[':id']=$this->id;
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
        }
    }

    public function delete() {
        if ($this->id === null) return;
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("DELETE FROM shops WHERE id=:id");
        $stmt->execute([':id'=>$this->id]);
    }

    public static function getAll(): array {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM shops ORDER BY created_at DESC");
        $shops = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $shops[] = self::mapRowToShop($row);
        }
        return $shops;
    }

    public static function find(int $id): ?Shop {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM shops WHERE id=:id");
        $stmt->execute([':id'=>$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? self::mapRowToShop($row) : null;
    }

    private static function mapRowToShop(array $row): Shop {
        $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
        $openingTimes = [];
        foreach ($days as $day) {
            $openingTimes[$day] = [
                'open'=>$row["opening_time_$day"]??null,
                'close'=>$row["closing_time_$day"]??null
            ];
        }

        return new Shop(
            $row['name'], $row['type_code'], $row['type_name'], $row['location']??'',
            (int)($row['size']??0), (int)($row['rating']??0), (int)($row['capacity']??0),
            (float)($row['product_price']??0.0), (int)($row['products_sold']??0),
            (float)($row['expenses']??0.0), $row['payment_options']??'', $openingTimes,
            isset($row['id'])?(int)$row['id']:null, $row['created_at']??null
        );
    }
}
