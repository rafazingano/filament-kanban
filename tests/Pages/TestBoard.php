<?php

namespace Rafazingano\FilamentKanban\Tests\Pages;

use Filament\Forms;
use Rafazingano\FilamentKanban\Pages\KanbanBoard;
use Rafazingano\FilamentKanban\Tests\Enums\TaskStatus;
use Rafazingano\FilamentKanban\Tests\Models\Task;
use Rafazingano\FilamentKanban\Tests\Models\User;

class TestBoard extends KanbanBoard
{
    protected static string $model = Task::class;

    protected static string $statusEnum = TaskStatus::class;

    protected function getEditModalFormSchema(?int $recordId): array
    {
        return [
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Select::make('team')
                ->relationship('team', 'name')
                ->multiple()
                ->options(User::pluck('name', 'id')),
        ];
    }
}
