<?php

namespace Database\Factories;

use App\Enums\UserStatus;
use App\Models\State;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $state = State::inRandomOrder()->first();
        $city = $state->cities()->inRandomOrder()->first();

        // Random date from last 1 years to now
        $at = Carbon::now()->subYears(1)->addDays(rand(1, 365));

        return [
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'username' => fake()->userName(),
            'avatar' => fake()->imageUrl(),
            'address' => fake()->address(),
            'gender' => fake()->randomElement(['male', 'female']),
            'date_of_birth' => fake()->date(),
            'mobile_number' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'status' => UserStatus::randomStatus(),
            'state_id' => $state->id,
            'city_id' => $city->id,
            'created_at' => $at,
            'updated_at' => $at,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * After creating the user assign role
     */
    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $role = Role::whereNotIn('slug', ['super-admin'])->inRandomOrder()->first();

            $user->assignRole($role);
        });
    }
}
