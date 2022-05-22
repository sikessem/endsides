<?php

namespace Endsides\Css;

class Selector {
	public function __construct(string $pattern) {
		$this->setPattern($pattern);
	}

	protected string $pattern;

	public function setPattern(string $pattern): static {
		$pattern = trim($pattern);
		if (empty($pattern)) {
			throw new \InvalidArgumentException('Selector pattern cannot be empty');
		}
		$this->pattern = $pattern;
		return $this;
	}

	public function getPattern(): string {
		return $this->pattern;
	}

	public function patternIs(string $pattern): bool {
		return $this->pattern === trim($pattern);
	}

	public function patternMatches(string $pattern): bool {
		return 1 === preg_match("/{$this->getPattern()}/", trim($pattern));
	}
}
