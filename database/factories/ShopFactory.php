<?php

namespace Database\Factories;

use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ShopFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => fake()->name,
            "description" => fake()->sentence(2),
            "owner_id" => User::factory()->create(),
            "category_id" => ShopCategory::factory()->create(),
            "open_hours" => json_encode([
                "Monday" => $this->getWorkingHoursOfDay(order: 1),
                "Tuesday" => $this->getWorkingHoursOfDay(order: 2),
                "Wednesday" => $this->getWorkingHoursOfDay(order: 3),
                "Thursday" => $this->getWorkingHoursOfDay(order: 4, openingMinute: 30),
                "Friday" => $this->getWorkingHoursOfDay(order: 5),
                "Saturday" => $this->getWorkingHoursOfDay(order: 6, openingHour: 10),
                "Sunday" => $this->getWorkingHoursOfDay(order: 7, isClosed: true),
            ]),
            "city" => fake()->city,
            "address" => fake()->address,
        ];
    }

    private function getWorkingHoursOfDay(
        int   $order,
        ?bool $isClosed = false,
        ?int  $openingHour = 9,
        ?int  $openingMinute = 0,
    ): array
    {
        if ($isClosed) {
            return [
                "opening_time" => "Closed",
                "closing_time" => "Closed",
                "order" => $order,
            ];
        }

        $currentCarbon = Carbon::now();
        $openingTimeCarbon = $currentCarbon->setTime($openingHour, $openingMinute);

        return [
            "opening_time" => $openingTimeCarbon->toTimeString(),
            "closing_time" => $openingTimeCarbon->addHours(rand(7, 12))->toTimeString(),
            "order" => $order,
        ];
    }
}
