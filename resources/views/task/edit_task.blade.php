<div class="content-body" style="margin-top: 15vh;">
    <h1 style="text-align: center;">Edit Task</h1>

    <div class="form_body" style="display: flex; justify-content: center; align-items: center; margin: 0;">
        <form method="post" action="{{ url('edit_task/{task_id}') }}" style="text-align: center;">
            @csrf
            @method('post')
            <div style="font-size: 30px;"><label for="title">Title</label></div>
            <div><input type="text" name="title" id="title" style="height: 40px; width: 200px; margin-top: 10px;" required></div>

            <div style="margin-top: 10px; font-size: 30px;"><label for="description">Description</label></div>
            <div><textarea name="description" style="height: 200px; width: 300px; margin-top: 10px;" required></textarea></div>

            <div><button type="submit" style="text-align: center; margin-top: 10px; font-size: 20px;">Update</button></div>
        </form>
    </div>
    @if (session('success'))
        <div class="success-message" style="text-align: center; margin-top: 10px; font-size: 30px;">{{ session('success') }}</div>
    @endif
</div>
