<?php

namespace Endsides\Util;

use Endsides\Html\Attribute;
use Endsides\Html\AttributeList;
use Endsides\Html\Node;
use Endsides\Html\Text;
use Endsides\Html\Comment;
use Endsides\Html\Element;

class Html {
	public static function attribute(string $name, mixed $value = null): Attribute {
		return new Attribute($name, $value);
	}

	public static function attributeList(Attribute ...$attributes): AttributeList {
		return new AttributeList(...$attributes);
	}

	public static function text(string $text): Text {
		return new Text($text);
	}

	public static function comment(string $text): Comment {
		return new Comment($text);
	}

	public static function element(string $name, array $attributes = [], Node ...$nodes): Element {
		return new Element($name, $attributes, ...$nodes);
	}
}
