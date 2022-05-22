<?php

namespace Endsides\Css;

class SelectorGroup implements \ArrayAccess, \IteratorAggregate, \Countable {
	public function __construct(Selector ...$selectors) {
		$this->setSelectors($selectors);
	}

	protected array $selectors = [];

	public function setSelectors(array $selectors): self {
		return $this->resetSelectors()->addSelectors($selectors);
	}

	public function resetSelectors(): self {
		$this->selectors = [];
		return $this;
	}

	public function addSelectors(array $selectors): self {
		foreach ($selectors as $selector) {
			$this->addSelector($selector);
		}
		return $this;
	}

	public function addSelector(Selector $selector): self {
		$this->selectors[] = $selector;
		return $this;
	}

	public function getSelectors(array $patterns = []): array {
		if (empty($patterns)) {
			return $this->selectors;
		}

		$selectors = [];
		foreach ($patterns as $pattern) {
			if ($selector = $this->getSelector($pattern)) {
				$selectors[] = $selector;
			}
		}
		return $selectors;
	}

	public function hasSelectors(): bool {
		return !empty($this->getSelectors());
	}

	public function getSelector(string $pattern): ?Selector {
		foreach ($this->getSelectors() as $selector) {
			if ($selector->patternIs($pattern)) {
				return $selector;
			}
		}
		return null;
	}

	public function hasSelector(string $pattern): bool {
		return !is_null($this->getSelector($pattern));
	}

	public function removeSelector(string $pattern): self {
		if ($selector = $this->getSelector($pattern)) {
			$key = array_search($selector, $this->selectors);
			array_splice($this->selectors, $key, 1);
		}
		return $this;
	}

	public function removeSelectors(array $patterns): self {
		foreach ($patterns as $pattern) {
			$this->removeSelector($pattern);
		}
		return $this;
	}

	public function getIterator(): \ArrayIterator {
		return new \ArrayIterator($this->getSelectors());
	}

	public function count(): int {
		return count($this->getSelectors());
	}

	public function offsetExists($offset): bool {
		return $this->hasSelector($offset);
	}

	public function offsetGet($offset): ?Selector {
		return $this->getSelector($offset);
	}

	public function offsetSet($offset, $value): void {
		$this->addSelector($value);
	}

	public function offsetUnset($offset): void {
		$this->removeSelector($offset);
	}
}
