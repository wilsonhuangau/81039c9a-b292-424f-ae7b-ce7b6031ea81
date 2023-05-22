# Reporting system demo

This is a simple assessment reporting system demo for ACER coding challenge.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)
- [File Structure](#file-structure)

# Installation

Before you can run this project, you need to have the following software installed:

- [PHP 8](https://www.php.net/) or later
- [Composer](https://getcomposer.org/)

### Installing PHP 8

You can download and install the latest version of PHP 8 from the official website: https://www.php.net/downloads

Follow the installation instructions for your operating system to install PHP 8.

Once you have installed PHP 8, you can verify that it is installed correctly by opening a terminal or command prompt and typing the following command:

```php
php -v
```

This should display the version of PHP that you have installed.

### Installing Composer

Composer is a dependency manager for PHP. You can use it to install and manage dependencies for your projects.

To install Composer, follow the instructions on the official website: https://getcomposer.org/download/

Once you have installed Composer, you can verify that it is installed correctly by opening a terminal or command prompt and typing the following command:
```
composer --version
```
This should display the version of Composer that you have installed.

### Installing Project Dependencies

Once you have PHP 8 and Composer installed, you can install the project dependencies by running the following command in the root of the project directory:
```
composer install
```
This will install all the required dependencies for the project.

## Usage

You can run the app by running the following command in the root of the project directory:
```
php bin/app
```
## Testing

Run phpunit test by
```
composer test
```
Run code standard check by
```
composer check-cs
```
Tested on [GitHub Actions](https://github.com/wilsonhuangau/81039c9a-b292-424f-ae7b-ce7b6031ea81/actions)

- [x] PHP 8.0
- [x] PHP 8.1
- [x] PHP 8.2

[![Code Analysis](https://github.com/wilsonhuangau/81039c9a-b292-424f-ae7b-ce7b6031ea81/actions/workflows/code_analysis.yaml/badge.svg?branch=main)](https://github.com/wilsonhuangau/81039c9a-b292-424f-ae7b-ce7b6031ea81/actions/workflows/code_analysis.yaml)
[![Unit Tests](https://github.com/wilsonhuangau/81039c9a-b292-424f-ae7b-ce7b6031ea81/actions/workflows/tests.yaml/badge.svg)](https://github.com/wilsonhuangau/81039c9a-b292-424f-ae7b-ce7b6031ea81/actions/workflows/tests.yaml)

## File Structure

```
├── bin
|  ├── app
|  └── app.php 
├── composer.json
├── composer.lock
├── ecs.php
├── phpstan.neon
├── README.md
├── src
|  ├── ConsoleClient.php
|  ├── data                                    (Sample data)
|  |  ├── assessments.json
|  |  ├── questions.json
|  |  ├── student-responses.json
|  |  └── students.json
|  ├── DummyDB.php                             (Load json data as a sql like DB)
|  ├── Helper                                  (Helper function)
|  |  └── until.php
|  ├── Model                                   (Data access object)
|  |  ├── Assessments.php
|  |  ├── Model.php
|  |  ├── Questions.php
|  |  ├── StudentResponses.php
|  |  └── Students.php
|  └── Report                                  (Report builder)
|     ├── Content                              
|     |  ├── DiagnosticReportContent.php
|     |  ├── FeedbackReportContent.php
|     |  ├── ProgressReportContent.php
|     |  ├── ReportContent.php
|     |  └── Templates                         (Report templates)
|     |     ├── diagnosticReportTemplate.txt
|     |     ├── feedbackReportTemplate.txt
|     |     └── progressReportTemplate.txt
|     ├── Printer                              (Printer classes, currently only have one printer) 
|     |  ├── ConsolePinter.php
|     |  └── Printer.php
|     └── ReportBuilder.php
└── tests                                      (test cases)
|  ├── data                                    (test data)
|  |  ├── assessments.json
|  |  ├── questions.json
|  |  ├── student-responses.json
|  |  └── students.json
|  ├── Helper
|  |  └── untilTest.php
|  ├── Model
|  |  ├── QuestionsTest.php
|  |  └── StudentResponsesTest.php
|  └── Report
|     └── ReportContentTest.php
```