<div class="content-body">
    <h1>All Tasks</h1>

        <div>
                @foreach ($tasks as $task)
                    {{ $task->id }}. Title: {{ $task->title }} <br/>
                    Description: {{ $task->description }}
                    <form method="post" action="{{ route('delete.task', ['id' => $task->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="delete-button">Delete</button>
                    </form>
                @endforeach
        </div>
</div>
