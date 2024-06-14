<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case InProgress = 'in_progress';
    case Completed = 'completed';
}
