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
	<div>
		<div class="task-create">
			<h2>タスクを追加する</h2>
			<div class="task-create-form">
				@if($errors->any())
					<div>
						@foreach($errors->all() as $message)
							<p>{{ $message }}</p>
						@endforeach
					</div>
				@endif
				<form class="create" action="{{ route('todo.create', ['id' => $folder_id]) }}" method="post">
					@csrf
					<div class="form-group">
						<label for="title">タイトル</label>
						<input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"><br>
						<label for="due_date">期限</label>
						<input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}">
						<button class="add-task" type="submit">送信</button>
					</div>
				</form>
            </div>
            <div class="back-home"><a href="{{ route('todo.index', ['id' => $folder_id])}}">戻る</a></div>
		</div>
	</div>
@endsection

@section('footer')
	<address>Copyright&nbsp;2020&nbsp;honda.ALL&nbsp;Right&nbsp;Reserved.</address>
@endsection
