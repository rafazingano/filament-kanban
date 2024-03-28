<?php

namespace Rafazingano\FilamentKanban\Tests\Pages;

use Rafazingano\FilamentKanban\Pages\KanbanBoard;
use Rafazingano\FilamentKanban\Tests\Enums\TaskStatus;
use Rafazingano\FilamentKanban\Tests\Models\UlidTask;

class TestBoardWithUlidTask extends KanbanBoard
{
    protected static string $model = UlidTask::class;

    protected static string $statusEnum = TaskStatus::class;
}
