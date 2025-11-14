<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Models\Attraction;
use InvalidArgumentException;

final class AttractionsController
{
    /** @return Attraction[] */
    public function getAttractions(): array
    {
        return Attraction::all();
    }

    public function getAttraction(int $id): ?Attraction
    {
        return Attraction::find($id);
    }

    public function addAttraction(string $name, int $capacity, string $status, int $waitTime): void
    {
        Attraction::create([
            'name'      => $name,
            'capacity'  => $capacity,
            'status'    => $status,
            'wait_time' => $waitTime,
        ]);
    }

    public function updateAttraction(int $id, string $name, int $capacity, string $status, int $waitTime): void
    {
        $a = Attraction::find($id);
        if (!$a) {
            throw new InvalidArgumentException(json_encode(['_all' => 'Attractie niet gevonden'], JSON_UNESCAPED_UNICODE));
        }
        $a->update([
            'name'      => $name,
            'capacity'  => $capacity,
            'status'    => $status,
            'wait_time' => $waitTime,
        ]);
    }

    public function deleteAttraction(int $id): void
    {
        $a = Attraction::find($id);
        if ($a) {
            $a->delete();
        }
    }
}