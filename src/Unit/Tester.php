<?php

namespace Endsides\Unit;

abstract class Tester {
	public function __construct(string $name, string $description = '') {
		$this->setName($name);
		$this->setDescription($description);
	}

	protected string $name;

	public function getName(): string {
		return $this->name;
	}

	public function setName(string $name): self {
		$this->name = $name;
		return $this;
	}

	protected string $description;

	public function getDescription(): string {
		return $this->description;
	}

	public function setDescription(string $description): self {
		$this->description = $description;
		return $this;
	}

	abstract public function test(): self;

	public function __toString(): string {
		return "{$this->getName()}: {$this->getDescription()}" . PHP_EOL;
	}

	protected static array $messages = [];

	public function assert(bool $condition, string $name): self {
		if ($condition) {
			self::$messages[] = new Message(Message::SUCCESS, "Passed: {$this->getName()}::{$name}");
		} else {
			self::$messages[] = new Message(Message::FAILURE, "Failed: {$this->getName()}::{$name}");
		}
		return $this;
	}

	public static function run(): void {
		$count_failures = 0;
		$count_successes = 0;

		foreach (self::$messages as $message) {
			echo $message . PHP_EOL;
			if ($message->getType() === Message::FAILURE) {
				$count_failures++;
			}
			else {
				$count_successes++;
			}
		}

		echo PHP_EOL . 'Total: ' . ($count_failures + $count_successes) . " ($count_successes successes, $count_failures failures)" . PHP_EOL;
		echo "\x07";
		exit($count_failures > 0 ? 1 : 0);
	}
}
