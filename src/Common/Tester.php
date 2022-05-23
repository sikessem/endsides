<?php

namespace Endsides\Common;

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

	public static function performTestsFrom(string $path, string $namespace, string $pattern = '*Tester', string $extension = '.php'): void {
		if (!($path = realpath($path))) {
			throw new \InvalidArgumentException("$path does not exist.");
		}

		is_dir($path) ? self::performTestsFromDir($path, $namespace, $pattern, $extension) : self::performTestsFromFile($path, $namespace, $pattern, $extension);
	}

	public static function performTestsFromDir(string $dir, string $namespace, string $pattern = '*Tester', string $extension = '.php'): void {
		if (!is_dir($dir)) {
			throw new \InvalidArgumentException("$dir is not a directory.");
		}

		$names = scandir($dir);
		foreach ($names as $name) {
			 if (!str_starts_with($name, '.')) {
				 self::performTestsFrom($path = $dir . DIRECTORY_SEPARATOR . $name, is_dir($path) ? "$namespace\\$name" : $namespace, $pattern, $extension);
			 }
		}
	}

	public static function performTestsFromFile(string $file, string $namespace, string $pattern = '*Tester', string $extension = '.php'): void {
		if (!is_file($file)) {
			throw new \InvalidArgumentException("$file is not a file.");
		}

		$name = substr(basename($file), 0, -strlen($extension));
		if (fnmatch($pattern, $name)) {
			 $tester = "\\$namespace\\$name";
			 if (class_exists($tester) && is_subclass_of($tester, Tester::class)) {
				 self::performTestsFromObject($tester);
			 }
		}
	}

	public static function performTestsFromObject(string|object $class): void {
		if (is_string($class)) {
			$class = new $class;
		}

		if (!is_object($class)) {
			throw new \InvalidArgumentException("$class is not an object.");
		}

		if (!is_subclass_of($class, Tester::class)) {
			throw new \InvalidArgumentException("$class is not a subclass of " . Tester::class . ".");
		}

		if (!method_exists($class, 'test')) {
			throw new \InvalidArgumentException("$class does not have a test method.");
		}

		$class->test();
	}

	public static function displayResults(): void {
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
