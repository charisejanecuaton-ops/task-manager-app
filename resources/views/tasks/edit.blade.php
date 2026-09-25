<!DOCTYPE html>
<html>
<head>
    <title>Edit Task - Task Manager</title>

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

        .header {
            background: #1f3c88;
            color: white;
            padding: 25px 8%;
        }

        .header h1 {
            margin: 0;
        }

        .container {
            width: 84%;
            max-width: 700px;
            margin: 40px auto;
        }

        .form-box {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-size: 15px;
        }

        textarea {
            resize: vertical;
        }

        .buttons {
            margin-top: 25px;
        }

        button,
        .back-button {
            padding: 11px 18px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        button {
            background: #1f3c88;
            color: white;
        }

        .back-button {
            background: #ddd;
            color: #333;
            margin-left: 8px;
        }

        .error {
            background: #f8d7da;
            color: #842029;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Edit Task</h1>
    </div>

    <div class="container">

        <div class="form-box">

            @if($errors->any())
                <div class="error">
                    <strong>Please check the following:</strong>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.update', $task) }}" method="POST">

                @csrf
                @method('PUT')

                <label for="task_name">Task Name</label>
                <input
                    type="text"
                    id="task_name"
                    name="task_name"
                    value="{{ old('task_name', $task->task_name) }}"
                    required
                >

                <label for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    rows="5"
                >{{ old('description', $task->description) }}</textarea>

                <label for="status">Status</label>
                <select id="status" name="status">

                    <option value="Pending"
                        {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="Completed"
                        {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>
                        Completed
                    </option>

                </select>

                <label for="due_date">Due Date</label>
                <input
                    type="date"
                    id="due_date"
                    name="due_date"
                    value="{{ old('due_date', $task->due_date) }}"
                >

                <div class="buttons">

                    <button type="submit">
                        Update Task
                    </button>

                    <a href="{{ route('tasks.index') }}"
                       class="back-button">
                        Back
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>