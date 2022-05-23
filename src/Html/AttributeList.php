<?php

namespace Endsides\Html;

class AttributeList implements \ArrayAccess, \IteratorAggregate, \Countable {
	public function __construct(Attribute ...$attributes) {
		$this->setAttributes($attributes);
	}

	protected array $attributes = [];

	public function setAttributes(array $attributes): self {
		return $this->resetAttributes()->addAttributes($attributes);
	}

	public function resetAttributes(): self {
		$this->attributes = [];
		return $this;
	}

	public function addAttributes(array $attributes): self {
		foreach ($attributes as $attribute) {
			$this->addAttribute($attribute);
		}
		return $this;
	}

	public function addAttribute(Attribute $attribute): self {
		$this->attributes[] = $attribute;
		return $this;
	}

	public function getAttributes(array $names = []): array {
		if (empty($names)) {
			return $this->attributes;
		}

		$attributes = [];
		foreach ($names as $name) {
			if ($attribute = $this->getAttribute($name)) {
				$attributes[] = $attribute;
			}
		}
		return $attributes;
	}

	public function hasAttributes(): bool {
		return !empty($this->getAttributes());
	}

	public function getAttribute(string $name): ?Attribute {
		foreach ($this->getAttributes() as $attribute) {
			if ($attribute->nameIs($name)) {
				return $attribute;
			}
		}
		return null;
	}

	public function hasAttribute(string $name): bool {
		return !is_null($this->getAttribute($name));
	}

	public function removeAttribute(string $name): self {
		if ($attribute = $this->getAttribute($name)) {
			$key = array_search($attribute, $this->attributes);
			array_splice($this->attributes, $key, 1);
		}
		return $this;
	}

	public function removeAttributes(array $names): self {
		foreach ($names as $name) {
			$this->removeAttribute($name);
		}
		return $this;
	}

	public function getIterator(): \ArrayIterator {
		return new \ArrayIterator($this->getAttributes());
	}

	public function count(): int {
		return count($this->getAttributes());
	}

	public function offsetExists($offset): bool {
		return $this->hasAttribute($offset);
	}

	public function offsetGet($offset): ?Attribute {
		return $this->getAttribute($offset);
	}

	public function offsetSet($offset, $value): void {
		$this->addAttribute($value);
	}

	public function offsetUnset($offset): void {
		$this->removeAttribute($offset);
	}
}
