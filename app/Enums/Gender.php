<?php

namespace App\Enums;

enum Gender: string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::MALE => 'Male',
            self::FEMALE => 'Female',
            self::OTHER => 'Other',
        };
    }

    public function name(): string
    {
        return match ($this) {
            self::MALE => 'Male',
            self::FEMALE => 'Female',
            self::OTHER => 'Other',
        };
    }

    public function value(): string
    {
        return match ($this) {
            self::MALE => 'male',
            self::FEMALE => 'female',
            self::OTHER => 'other',
        };
    }

    public static function options(): array
    {
        return [
            self::MALE->value() => self::MALE->label(),
            self::FEMALE->value() => self::FEMALE->label(),
            self::OTHER->value() => self::OTHER->label(),
        ];
    }

    public function fromValue(string $value): self
    {
        return match ($value) {
            self::MALE->value() => self::MALE,
            self::FEMALE->value() => self::FEMALE,
            self::OTHER->value() => self::OTHER,
        };
    }

    public function values(): array
    {
        return [
            self::MALE->value(),
            self::FEMALE->value(),
            self::OTHER->value(),
        ];
    }
}
