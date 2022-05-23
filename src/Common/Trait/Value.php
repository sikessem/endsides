<?php

namespace Endsides\Common\Trait;

trait Value {
	protected mixed $value;

	public function setValue(mixed $value): self {
		$this->value = $value;
		return $this;
	}

	public function getValue(): int|float|bool|string|null {
		return $this->value;
	}

	public function issetValue(): bool {
		return isset($this->value);
	}

	public function unsetValue(): void {
		unset($this->value);
	}

	public function valueIsSimilarTo(mixed $value): bool {
		return $value == $this->getValue();
	}

	public function valueIsIdenticalTo(mixed $value): bool {
		return $value === $this->getValue();
	}

	public function valueIs(mixed $value, bool $strict = true): bool {
		return $strict ? $this->valueIsIdenticalTo($value) : $this->valueIsSimilarTo($value);
	}

	public function valueIsBool(): bool {
		return is_bool($this->getValue());
	}

	public function valueIsInt(): bool {
		return is_int($this->getValue());
	}

	public function valueIsFloat(): bool {
		return is_float($this->getValue());
	}

	public function valueIsNumber(): bool {
		return $this->isInt() || $this->isFloat();
	}

	public function valueIsString(): bool {
		return is_string($this->getValue());
	}

	public function valueIsNull(): bool {
		return is_null($this->getValue());
	}

	public function valueIsEmpty(): bool {
		return $this->isNull() || $this->valueIs('');
	}

	public function valueIsTrue(): bool {
		return $this->valueIs(true);
	}

	public function valueIsFalse(): bool {
		return $this->valueIs(false);
	}

	public function valueHas(string $value): bool {
		return $this->valueIsString() && str_contains($this->getValue(), $value);
	}

	public function valueStartsWith(string $value): bool {
		return $this->valueIsString() && str_starts_with($this->getValue(), $value);
	}

	public function valueEndsWith(string $value): bool {
		return $this->valueIsString() && str_ends_with($this->getValue(), $value);
	}

	public function valueHasSingleQuote(): bool {
		return $this->valueHas('\'');
	}

	public function valueHasDoubleQuote(): bool {
		return $this->valueHas('"');
	}

	public function valueHasQuote(): bool {
		return $this->valueHasSingleQuote() || $this->valueHasDoubleQuote();
	}

	public function valueMatches(string $value): bool {
		return $this->valueIsString() && 1 === preg_match($value, $this->getValue());
	}
}
