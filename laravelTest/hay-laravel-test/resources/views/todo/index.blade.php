@extends('layouts.hellotodo')

@section('title', 'TodoApp')

@section('menu')
	@parent
	@if (Auth::check())
	<div class="user-check">
		<p>ようこそ！{{Auth::user()->name}}さん。</p>
		    <form id="logout-form" action="{{ route('logout') }}" method="POST">
		      @csrf
		      <input type="submit" value="ログアウト">
		    </form>
		@else
			<p>※ログインしていません。(<a href="/login"> ログイン</a><br>
			<a href="/register">登録</a>)</p>
		@endif
	</div>
@endsection

@section('content')
    @parent
	<div class="folder-task">
		<nav>
			<div class="panel">
				<h2>フォルダ</h2>
				<a href="{{ route('folders.create') }}">フォルダを追加する</a>
			</div>
			<div class="list-group">
				<h2>フォルダ一覧</h2>
				<ul>
					@foreach($folders as $folder)
					<li class="folder-list">
						<a href="{{ route('todo.index', ['id' => $folder->id]) }}"
							class="list-group-item" {{ $current_folder_id === $folder->id ? 'active' : '' }}>
						{{ $folder->title }}
                        </a>
                        <form method="POST" action="delete">
                            @csrf
                            <input type="hidden" value="{{Auth::user()->name}}" name="user_id">
                            <input type="hidden" value="{{$folder->id}}" name="folder_id">
                            <input type="submit" value="削除" class="todo-delete">
                        </form>
					</li>
					@endforeach
				</ul>
			</div>
		</nav>
		<div class="tasks">
			<h2>タスク一覧<br>({{$current_folder_title}}フォルダ)</h2>
			<a href="{{ route('todo.create', ['id' => $current_folder_id]) }}">タスクを追加する</a>
			<table class="table">
				<thead>
					<tr>
						<th>タイトル</th>
						<th>状態</th>
						<th>期限</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($tasks as $task)
	              <tr>
	                <td>{{ $task->title }}</td>
	                <td>
	                  <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
	                </td>
	                <td>{{ $task->formatted_due_date }}</td>
	                <td class="task-controll"><a href="{{ route('todo.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">編集</a></td>
	              </tr>
	            @endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection

@section('footer')
	<address>Copyright&nbsp;2020&nbsp;honda.ALL&nbsp;Right&nbsp;Reserved.</address>
@endsection
