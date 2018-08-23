<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Twig\TwigTest;

class AppExtension extends AbstractExtension
{
    public function getTests()
    {
        return [
            new TwigTest('pull_request', [$this, 'testPullRequest']),
        ];
    }

    public function testPullRequest(array $issue)
    {
        return isset($issue['pull_request']);
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('is_issue_new', [$this, 'isIssueNew']),
            new TwigFunction('print_issue_new', [$this, 'printIssueNew']),
        ];
    }

    public function isIssueNew(array $issue)
    {
        $issueDate = new \DateTime($issue['created_at']);
        $compareDate = new \DateTime('-2days');

        return $issueDate > $compareDate;
    }

    public function printIssueNew(array $issue)
    {
        $issueDate = new \DateTime($issue['created_at']);
        $compareDate = new \DateTime('-2days');

        return $issueDate > $compareDate ? '(Nuevo)' : '*';
    }
}
