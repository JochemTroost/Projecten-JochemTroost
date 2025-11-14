<?php
namespace App\Controllers;

use App\Models\Shop;

class ShopController
{
    public function addShop(
        string $name,
        string $typeCode,
        string $typeName,
        ?string $location = '',
        int $size = 0,
        int $rating = 0,
        int $capacity = 0,
        float $productPrice = 0.0,
        int $productsSold = 0,
        float $expenses = 0.0,          // ✅ toegevoegd
        ?string $paymentOptions = '',   // ✅ string zoals in Shop model
        array $openingTimes = []        // ✅ array
    ): void {
        // Bereken omzet en kosten
        $revenue = $productPrice * $productsSold;
        if ($expenses <= 0) {
            $expenses = $revenue * 0.7; // standaard 30% marge
        }

        $shop = new Shop(
            $name,
            $typeCode,
            $typeName,
            $location,
            $size,
            $rating,
            $capacity,
            $productPrice,
            $productsSold,
            $expenses,
            $paymentOptions,
            $openingTimes
        );

        $shop->save();
    }

    public function updateShop(
        int $id,
        string $name,
        string $typeCode,
        string $typeName,
        ?string $location = '',
        int $size = 0,
        int $rating = 0,
        int $capacity = 0,
        float $productPrice = 0.0,
        int $productsSold = 0,
        float $expenses = 0.0,          // ✅ toegevoegd
        ?string $paymentOptions = '',   // ✅ string
        array $openingTimes = []        // ✅ array
    ): void {
        $shop = Shop::find($id);
        if (!$shop) return;

        $revenue = $productPrice * $productsSold;
        if ($expenses <= 0) {
            $expenses = $revenue * 0.7;
        }

        $shop->setName($name);
        $shop->setType($typeCode, $typeName);
        $shop->setLocation($location);
        $shop->setSize($size);
        $shop->setRating($rating);
        $shop->setCapacity($capacity);
        $shop->setProductPrice($productPrice);
        $shop->setProductsSold($productsSold);
        $shop->setExpenses($expenses);
        $shop->setPaymentOptions($paymentOptions);
        $shop->setOpeningTimes($openingTimes);

        $shop->save();
    }

    public function deleteShop(int $id): void
    {
        $shop = Shop::find($id);
        if ($shop) {
            $shop->delete();
        }
    }

    public function getShops(): array
    {
        return Shop::getAll();
    }

    public function getShop(int $id): ?Shop
    {
        return Shop::find($id);
    }
}
