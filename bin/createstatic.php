<?php

declare(strict_types=1);

use PHPQuiz\Controller\StaticController;
use PHPQuiz\Interface\QuestionRepository;
use PHPQuiz\Service\TwigRenderer;

$container = require __DIR__ . '/../src/bootstrap.php';

$staticFolder = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'docs';

/** @psalm-suppress MixedArgument */
$ctr = new StaticController(
    $container->get(QuestionRepository::class),
    $container->get(TwigRenderer::class),
    $staticFolder
);

$ctr->createStatic();
