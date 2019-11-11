<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Coduo\PHPMatcher\Factory\SimpleFactory;
use PHPUnit\Framework\Assert;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpKernel\KernelInterface;

class FeatureContext implements Context
{
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var BufferedOutput
     */
    private $bufferedOutput;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
        $this->bufferedOutput = new BufferedOutput();
    }

    /**
     * @When run command :command
     */
    public function runCommand($command)
    {
        $kernel = new App\Kernel('test', true);
        $kernel->boot();

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input   = explode(' ', $command);
        $options = array_merge(['bin/console'], $input);
        $input   = new ArgvInput($options);
        $application->run($input, $this->bufferedOutput);

        $kernel->shutdown();
    }

    /**
     * @Then the output should be
     */
    public function theOutputShouldBe(PyStringNode $expectedOutput)
    {
        $matcher = (new SimpleFactory())->createMatcher();

        if (!$matcher->match($this->bufferedOutput->fetch(), $expectedOutput->getRaw())) {
            throw new \RuntimeException($matcher->getError());
        }
    }
}
