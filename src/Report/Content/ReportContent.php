<?php

namespace Wilson\ReportingSystemDemo\Report\Content;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class ReportContent
{
    protected string $templateName;

    protected string $templatePath = __DIR__ . '/Templates';

    abstract protected function generateContext(string $studentId): array;

    public function getReportContent(string $studentId): string
    {
        $loader = new FilesystemLoader($this->templatePath);
        $twig = new Environment($loader, []);
        $context = $this->generateContext($studentId);
        try {
            return $twig->render($this->templateName, $context);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
