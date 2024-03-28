<?php

namespace Rafazingano\FilamentKanban\Tests\Pages;

use Filament\Forms\Components\TextInput;
use Rafazingano\FilamentKanban\Pages\KanbanBoard;
use Rafazingano\FilamentKanban\Tests\Enums\TaskStatus;
use Rafazingano\FilamentKanban\Tests\Models\Task;

class TestBoardWithCustomViews extends KanbanBoard
{
    protected static string $model = Task::class;

    protected static string $statusEnum = TaskStatus::class;

    protected static string $recordView = 'kanban-record';

    protected function getEditModalFormSchema(?int $recordId): array
    {
        return [
            TextInput::make('title'),
        ];
    }
}
