<?php

namespace Wilson\ReportingSystemDemo\Report\Content;

use DateTime;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

abstract class ReportContent
{
    protected string $templateName;

    protected string $templatePath = __DIR__ . '/Templates';

    abstract protected function generateContext(string $studentId): array;

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function getReportContent(string $studentId): string
    {
        $loader = new FilesystemLoader($this->templatePath);
        $twig = new Environment($loader, []);
        $context = $this->generateContext($studentId);
        return $twig->render($this->templateName, $context);
    }

    protected function convertTime(string $timeString, String $format = 'jS F Y h:i A'): string
    {
        return DateTime::createFromFormat('d/m/Y H:i:s', $timeString)->format($format);
    }

    protected function getItemByKeyValue(array $array, $key, $value)
    {
        foreach ($array as $item) {
            if (isset($item[$key]) && $item[$key] === $value) {
                return $item;
            }
        }
        return null;
    }
}
