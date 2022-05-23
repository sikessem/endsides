<?php

namespace Endsides\Util;

use Endsides\Html\Attribute;
use Endsides\Html\AttributeList;

class Html {
	public static function attribute(string $name, mixed $value = null): Attribute {
		return new Attribute($name, $value);
	}

	public static function attributeList(Attribute ...$attributes): AttributeList {
		return new AttributeList(...$attributes);
	}
}
