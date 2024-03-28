<?php

namespace Rafazingano\FilamentKanban\Tests\Enums;

use Rafazingano\FilamentKanban\Concerns\IsKanbanStatus;

enum TaskStatus: string
{
    use IsKanbanStatus;

    case Todo = 'Todo';
    case Doing = 'Doing';
    case Done = 'Done';
}
