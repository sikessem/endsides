<?php

namespace Endsides\Common\Interface;

interface Valuable {
	public function setValue(int|float|bool|string|null $value): self;

	public function getValue(): int|float|bool|string|null;

	public function issetValue(): bool;

	public function unsetValue(): void;

	public function valueIsSimilarTo(mixed $value): bool;

	public function valueIsIdenticalTo(mixed $value): bool;

	public function valueIs(mixed $value, bool $strict = true): bool;

	public function valueIsBool(): bool;

	public function valueIsInt(): bool;

	public function valueIsFloat(): bool;

	public function valueIsNumber(): bool;

	public function valueIsString(): bool;

	public function valueIsNull(): bool;

	public function valueIsEmpty(): bool;

	public function valueIsTrue(): bool;

	public function valueIsFalse(): bool;

	public function valueHas(string $value): bool;

	public function valueStartsWith(string $value): bool;

	public function valueEndsWith(string $value): bool;

	public function valueHasSingleQuote(): bool;

	public function valueHasDoubleQuote(): bool;

	public function valueHasQuote(): bool;

	public function valueMatches(string $value): bool;
}
