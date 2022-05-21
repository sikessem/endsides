<?php

namespace Endsides\Css;

class Declaration implements \Stringable {
	public function __construct($property, int|string $value, bool $important = false) {
		$this->setProperty($property);
		$this->setValue($value);
		$this->setImportance($important);
	}

	protected string $property;

	public function setProperty(string $property): self {
		$this->property = $property;
		return $this;
	}

	public function getProperty(): string {
		return $this->property;
	}

	protected int|string $value;

	public function setValue(int|string $value): self {
		$this->value = $value;
		return $this;
	}

	public function getValue(): int|string {
		return $this->value;
	}

	protected bool $important;

	public function setImportance(bool $important): self {
		$this->important = $important;
		return $this;
	}

	public function isImportant(): bool {
		return $this->important;
	}

	public static function prettify(self $declaration, int $indent = 0, string $tab = "\t"): string {
		$indentation = str_repeat($tab, $indent);
		return $indentation . $declaration->getProperty() . ': ' . $declaration->getValue() . ($declaration->isImportant() ? ' !important' : '') . ';';
	}

	public static function stringify(self $declaration): string {
		return $declaration->getProperty() . ':' . $declaration->getValue() . ($declaration->isImportant() ? '!important' : '');
	}

	public static function parse(string $declaration): self {
		if (preg_match('/^(?<property>[^:]+)\s*:\s*(?<value>[^;]+)\s*(?<important>!important)?;?$/', $declaration, $matches)) {
			return new self($matches['property'], $matches['value'], $matches['important'] !== null);
		}
		throw new \InvalidArgumentException('Invalid declaration given');
	}

	public function beautify(int $indent = 0, string $tab = "\t"): string {
		return self::prettify($this, $indent, $tab);
	}

	public function minify(): string {
		return self::stringify($this);
	}

	public function __toString(): string {
		return self::stringify($this);
	}
}
