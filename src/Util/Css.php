<?php

namespace Endsides\Util;

use Endsides\Css\{
	Selector,
	Declaration,
	DeclarationBlock,
	Property,
};

class Css {
	public static function property(string $name): Property {
		return new Property($name);
	}

	public static function declaration(string $name, int|string $value, bool $important = false): Declaration {
		return new Declaration($name, $value, $important);
	}

	public static function declarationBlock(Declaration ...$declarations): DeclarationBlock {
		return new DeclarationBlock(...$declarations);
	}

	public static function selector(string $pattern): Selector {
		return new Selector($pattern);
	}
}
