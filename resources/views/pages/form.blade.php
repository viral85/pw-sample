<h4>Form Comment</h4>
<form method="Post" action="{{ route('comment.save', ['id' => $user->id]) }}" id="commentForm">
    @csrf
    <div class="form-group">
        <label for="id" class="label-define">User ID</label>
        <input type="text" name="id" class="form-control" value="{{$user->id}}" maxlength="10" placeholder="User ID" required="required" />
        @error('id')
            <ul class="text-danger">
                <li class="required error">{{ $message }}</li>
            </ul>
        @enderror
    </div>
    <div class="form-group pt-15">
        <label for="password" class="label-define">Password</label>
        <input type="text" name="password" value="{{ old('password') ?? $user->password }}" maxlength="44" placeholder="Password" required="required" />
        @error('password')
            <ul class="text-danger">
                <li class="required error">{{ $message }}</li>
            </ul>
        @enderror
    </div>
    <div class="form-group pt-15">
        <label for="comment" class="label-define">Comment</label>
        <input type="text" name="comment" maxlength="160" placeholder="Comment" required="required" />
        @error('comment')
            <ul class="text-danger">
                <li class="required error">{{ $message }}</li>
            </ul>
        @enderror
    </div>
    <br/>
    <div class="form-group">
	   <button type="submit">Save Form Comment</button>
       <a href="{{route('home')}}">
            <button type="button">Back</button>
        </a>
    </div>
</form>
