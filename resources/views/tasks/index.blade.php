<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef2f7;
            color: #263238;
        }

        .navbar {
            background: #1f3c88;
            color: white;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }

        .container {
            width: 84%;
            max-width: 1100px;
            margin: 35px auto;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .top-section h2 {
            margin: 0;
        }

        .add-button {
            background: #1f3c88;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 8px;
            font-weight: bold;
        }

        .success {
            background: #d9f2df;
            color: #256b35;
            padding: 13px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .task-card {
            background: white;
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 18px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .task-card h3 {
            margin-top: 0;
            color: #1f3c88;
            font-size: 21px;
        }

        .description {
            color: #555;
            line-height: 1.5;
        }

        .info {
            margin-top: 15px;
        }

        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .pending {
            background: #fff1c7;
            color: #8a6500;
        }

        .completed {
            background: #d9f2df;
            color: #256b35;
        }

        .actions {
            margin-top: 18px;
        }

        .actions form {
            display: inline;
        }

        .button {
            border: none;
            padding: 9px 14px;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            margin-right: 5px;
        }

        .status-button {
            background: #f0c14b;
            color: #333;
        }

        .edit-button {
            background: #1f3c88;
            color: white;
        }

        .delete-button {
            background: #d9534f;
            color: white;
        }

        .empty {
            background: white;
            text-align: center;
            padding: 55px 20px;
            border-radius: 12px;
        }

        .empty h3 {
            color: #1f3c88;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <h1>Task Manager</h1>
        <span>Stay organized</span>
    </div>

    <div class="container">

        <div class="top-section">
            <h2>My Tasks</h2>

            <a href="{{ route('tasks.create') }}" class="add-button">
                + Add Task
            </a>
        </div>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @forelse($tasks as $task)

            <div class="task-card">

                <h3>{{ $task->task_name }}</h3>

                <p class="description">
                    {{ $task->description ?: 'No description provided.' }}
                </p>

                <div class="info">
                    <strong>Due Date:</strong>
                    {{ $task->due_date ?: 'No due date' }}
                </div>

                <div class="info">
                    <span class="status {{ strtolower($task->status) }}">
                        {{ $task->status }}
                    </span>
                </div>

                <div class="actions">

                    <form action="{{ route('tasks.status', $task) }}"
                          method="POST">
                        @csrf
                        @method('PATCH')

                        <button type="submit"
                                class="button status-button">
                            Change Status
                        </button>
                    </form>

                    <a href="{{ route('tasks.edit', $task) }}"
                       class="button edit-button">
                        Edit
                    </a>

                    <form action="{{ route('tasks.destroy', $task) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="button delete-button"
                                onclick="return confirm('Are you sure you want to delete this task?')">
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        @empty

            <div class="empty">
                <h3>No Tasks Yet</h3>
                <p>Click "Add Task" to create your first task.</p>
            </div>

        @endforelse

    </div>

</body>
</html>