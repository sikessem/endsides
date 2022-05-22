<?php

namespace Endsides\Common\Trait;

trait Name {
	protected string $name;

	public function setName(string $name): self {
		$this->name = $name;
		return $this;
	}

	public function getName(): string {
		return $this->name;
	}

	public function nameIs(string $name): bool {
		return strtolower($this->getName()) === strtolower($name);
	}

	public function nameMatches(string $pattern): bool {
		return fnmatch($pattern, $this->getName());
	}

	public function nameStartsWith(string $prefix): bool {
		return str_starts_with($this->getName(), $prefix);
	}

	public function nameEndsWith(string $suffix): bool {
		return str_ends_with($this->getName(), $suffix);
	}

	public function nameContains(string $substring): bool {
		return str_contains($this->getName(), $substring);
	}

	public function nameMatchesRegex(string $regex): bool {
		return 1 === preg_match($regex, $this->getName());
	}
}
