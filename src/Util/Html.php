<?php

namespace Endsides\Util;

use Endsides\Html\Attribute;

class Html {
	public static function attribute(string $name, mixed $value = null): Attribute {
		return new Attribute($name, $value);
	}
}
