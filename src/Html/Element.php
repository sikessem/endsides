<?php

namespace Endsides\Html;

use Endsides\Common\{
	Trait\Name,
	Interface\Nameable,
};

class Element extends Node implements Nameable {
	use Name;

	public function __construct(string $name, array $attributes = [], Node ...$nodes) {
		parent::__construct('element');
		$this->setName($name)->setAttributes($attributes)->setNodes($nodes);
	}

	protected AttributeList $attributes;

	public function setAttributes(array $attributes): self {
		if (!isset($this->attributes)) {
			$this->attributes = new AttributeList(...$attributes);
		}
		else {
			$this->attributes->setAttributes($attributes);
		}
		return $this;
	}

	public function setAttribute(string $name, $value): self {
		if ($attribute = $this->attributes->getAttribute($name)) {
			$attribute->setValue($value);
		}
		else {
			$this->attributes->setAttribute($name, $value);
		}

		return $this;
	}

	public function getAttributes(array $names = []): array {
		return $this->attributes?->getAttributes($names);
	}

	public function getAttribute(string $name): ?Attribute {
		return $this->attributes?->getAttribute($name);
	}

	public function hasAttributes(array $attributes = []): bool {
		return isset($this->attributes) && $this->attributes->hasAttributes($attributes);
	}

	public function hasAttribute(string $name): bool {
		return isset($this->attributes) && $this->attributes->hasAttribute($name);
	}

	public function removeAttribute(string $name): self {
		if (isset($this->attributes)) {
			$this->attributes->removeAttribute($name);
		}

		return $this;
	}

	public function removeAttributes(array $attributes): self {
		if (isset($this->attributes)) {
			$this->attributes->removeAttributes($attributes);
		}

		return $this;
	}

	protected array $nodes = [];

	public function setNodes(array $nodes): self {
		return $this->resetNodes()->addNodes($nodes);
	}

	public function resetNodes(): self {
		$this->nodes = [];
		return $this;
	}

	public function addNodes(array $nodes): self {
		foreach ($nodes as $node) {
			$this->addNode($node);
		}

		return $this;
	}

	public function addNode(Node $node): self {
		$this->nodes[] = $node;
		return $this;
	}

	public function getNodes(): array {
		return $this->nodes;
	}

	public function hasNodes(): bool {
		return !empty($this->nodes);
	}

	public function removeNode(Node $node): self {
		foreach ($this->nodes as $key => $value) {
			if ($value === $node) {
				array_splice($this->nodes, $key, 1);
			}
		}

		return $this;
	}

	public function removeNodes(array $nodes): self {
		foreach ($nodes as $node) {
			$this->removeNode($node);
		}

		return $this;
	}

	public function addText(string|Text $text): self {
		$this->addNode($text instanceof Text ? $text : new Text($text));
		return $this;
	}

	public function addComment(string|Comment $comment): self {
		$this->addNode($comment instanceof Comment ? $comment : new Comment($comment));
		return $this;
	}

	public function addElement(string|Element $element, array $attributes = [], Node ...$nodes): self {
		$this->addNode($element instanceof Element ? $element : new Element($element, $attributes, ...$nodes));
		return $this;
	}

	public function getTexts(): array {
		return array_filter($this->getNodes(), function($node) {
			return $node instanceof Text;
		});
	}

	public function getComments(): array {
		return array_filter($this->getNodes(), function($node) {
			return $node instanceof Comment;
		});
	}

	public function getElements(): array {
		return array_filter($this->getNodes(), function($node) {
			return $node instanceof Element;
		});
	}
}
