<?php declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework;

/**
 * @internal This class is not covered by the backward compatibility promise for PHPUnit
 */
final class SkippedTestCase extends TestCase
{
    private string $message;

    public function __construct(string $className, string $methodName, string $message = '')
    {
        parent::__construct($className . '::' . $methodName);

        $this->setBackupGlobals(false);
        $this->setBackupStaticProperties(false);
        $this->setRunClassInSeparateProcess(false);
        $this->setRunTestInSeparateProcess(false);

        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Returns a string representation of the test case.
     */
    public function toString(): string
    {
        return $this->getName();
    }

    /**
     * @throws Exception
     *
     * @psalm-return never-return
     */
    protected function runTest(): mixed
    {
        $this->markTestSkipped($this->message);
    }
}
