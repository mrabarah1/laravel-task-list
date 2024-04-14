<?php


use App\Models\Task;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\TaskRequest;



// When someone visits our url withot any additional path after the port, we want to redirect to tasks.index
Route::get('/', function () {
    return redirect()->route('tasks.index');
});


// This route is responsible of displaying list of all tasks
Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate()
    ]);
})->name('tasks.index');



// After creating the view create.blade.php file, define a Route to display the form 
Route::view('/tasks/create', 'create')->name('tasks.create');

// Route to Edit task
Route::get('/tasks/{task}/edit', function (Task $task) {
    return view('edit', ['task' => $task]);
})->name('tasks.edit');



// A route responsible of displaying a single task
Route::get('/tasks/{task}', function (Task $task) {
    return view('show', ['task' => $task]);
})->name('tasks.show');

 

// We are storing our form action to this route, and this route will handle storing new task
// validation to save a new post from your form, from view create.blade.php
// TaskRequest $request gives us access to the data that is been sent from the form
// so data is available inside this $requset object
// when u call this $request->validate method, it will use all the data that was sent through the form to validate it and it will use those keys from this validate array to check those fields against those specific validation rules
Route::post('/tasks', function (TaskRequest $request) {
  $task = Task::create($request->validated());

  // finally, you redirect to a new route or page
  return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task created successfully!');
})->name('tasks.store');
 

// Endpoint to handle the edit blade
// validate to edit the existing data
Route::put('/tasks/{task}', function (Task $task, TaskRequest $request) {
  $task->update($request->validated());
  return redirect()->route('tasks.show', ['task' => $task->id])->with('success', 'Task updated successfully!');
})->name('tasks.update');


// Endpoint to delete task
Route::delete('/tasks/{task}', function (Task $task) {
  $task->delete();
  return redirect()->route('tasks.index')->with('success', 'Task successfully deleted');
})->name('tasks.destroy');


Route::put('tasks/{task}/toggle-complete', function(Task $task) {
  // $task->completed = !$task->completed;
  // $task->save();
  $task->toggleComplete();
  return redirect()->back()->with('success','Task updated successfully!');
})->name('tasks.toggle-complete');




// summary 
// we can use blade template to render dynamic content
// To render our blade content, we use the view function and pass the name of the template
// To pass data to blade template, you will add a second argument which will be an array where keys will be the variable names and they can have values
// And then inside such blade templates,you can access those variables
// To output the values, we use {{}}

// Route Model Binding