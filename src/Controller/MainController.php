<?php

declare(strict_types=1);

namespace PHPQuiz\Controller;

use PHPQuiz\Exception\ParseException;
use PHPQuiz\Exception\QuestionNotFoundException;
use PHPQuiz\Interface\QuestionRepository;
use PHPQuiz\Interface\ViewRenderer;

final readonly class MainController
{
    public function __construct(
        private QuestionRepository $repository,
        private ViewRenderer       $view
    ) {
    }

    public function showStart(): void
    {
        $params = [
            'question' => null,
            'categories' => $this->repository->getQuestionsByCategory()
        ];

        echo $this->view->render('main', $params);
    }

    public function showQuestion(string $id): void
    {
        try {
            $output = $this->getRenderedHTML($id);
        } catch (ParseException) {
            header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error');
            echo '500 Internal Server Error';
            return;
        } catch (QuestionNotFoundException) {
            header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
            echo '404 Not Found';
            return;
        }

        echo $output;
    }

    /**
     * @throws QuestionNotFoundException
     * @throws ParseException
     */
    public function getRenderedHTML(string $id): string
    {
        $question = $this->repository->getQuestionById($id);

        $params = [
            'question' => $question,
            'question_card' => $this->repository->getQuestionCardForId($id),
            'categories' => $this->repository->getQuestionsByCategory(),
            ...$this->getNavigationParams($question->index)
        ];

        return $this->view->render('main', $params);
    }

    /**
     * @param int $index
     * @return array{previous: string|null, next: string|null, numberOfQuestions: int}
     */
    private function getNavigationParams(int $index): array
    {
        return [
            'previous' => $this->getPreviousId($index),
            'next' => $this->getNextId($index),
            'numberOfQuestions' => $this->repository->count(),
        ];
    }

    private function getPreviousId(int $index): string|null
    {
        try {
            return $this->repository->getQuestionByIndex($index - 1)->id;
        } catch (QuestionNotFoundException) {
            return null;
        }
    }

    private function getNextId(int $index): string|null
    {
        try {
            return $this->repository->getQuestionByIndex($index + 1)->id;
        } catch (QuestionNotFoundException) {
            return null;
        }
    }
}
