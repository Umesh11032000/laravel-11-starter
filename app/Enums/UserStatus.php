<?php

namespace App\Enums;

enum UserStatus: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;

    public function color(): string
    {
        return match ($this) {
            self::ACTIVE => 'success',
            self::INACTIVE => 'danger',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
        };
    }

    public function name(): string
    {
        return match ($this) {
            self::ACTIVE => 'Active',
            self::INACTIVE => 'Inactive',
        };
    }

    public function value(): int
    {
        return match ($this) {
            self::INACTIVE => 0,
            self::ACTIVE => 1,
        };
    }

    public static function values(): array
    {
        return [
            self::ACTIVE->value(),
            self::INACTIVE->value(),
        ];
    }

    public static function labels(): array
    {
        return [
            self::ACTIVE->label(),
            self::INACTIVE->label(),
        ];
    }

    public function badgeHtml(): string
    {
        return "<span class=\"badge bg-outline-{$this->color()}\">{$this->label()}</span>";
    }

    public static function randomStatus(): self
    {
        return match (rand(0, 1)) {
            0 => self::INACTIVE,
            1 => self::ACTIVE,
        };
    }

    public static function options(): array
    {
        return [
            self::ACTIVE->value() => self::ACTIVE->label(),
            self::INACTIVE->value() => self::INACTIVE->label(),
        ];
    }

    public static function fromValue(int $value): self
    {
        return match ($value) {
            self::ACTIVE->value() => self::ACTIVE,
            self::INACTIVE->value() => self::INACTIVE,
        };
    }
}
