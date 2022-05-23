<?php

namespace Endsides\Common\Interface;

interface Nameable {
	public function setName(string $name): self;

	public function getName(): string;

	public function nameIs(string $name): bool;

	public function nameMatches(string $pattern): bool;

	public function nameStartsWith(string $prefix): bool;

	public function nameEndsWith(string $suffix): bool;

	public function nameContains(string $substring): bool;

	public function nameMatchesRegex(string $regex): bool;
}
