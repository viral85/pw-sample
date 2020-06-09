<h4>Json Form Comment</h4>
<form method="Post" action="{{ route('jsonComment.save', ['id' => $user->id]) }}" id="commentForm">
    @csrf
    <div class="error" id="message"></div>
    <div class="form-group pt-15">
        <label for="comment label-define">Json Input</label>
        <textarea type='text' name="json" rows="8" placeholder="Json input" class="no-text"></textarea>
        @error('comment')
            <ul class="text-danger">
                <li class="required error">{{ $message }}</li>
            </ul>
        @enderror
    </div>
    <br/>
    <p><stong>Sample JSON string</stong></p>
    <p class="no-text-wrap">
    {
        "id": "1",
        "password" : "720DF6C2482218518FA20FDC52D4DED7ECC043AB",
        "comment" : "Json Comment"
    }
    </p>
    <br/>
    <div class="form-group">
        <button id="jsonComment" onclick="sendForm()" type="button">Save Json Comment</button>
        <a href="{{route('home')}}">
            <button type="button">Back</button>
        </a>
    </div>
</form>

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript">
    function sendForm()
    {
        var form = $("#commentForm");
        $('#jsonComment').text('Sending..');

        $.ajax({
            url     :   form.attr("action"),
            dataType    : "json",
            type    :   form.attr("method"),
            data    :   form.serialize(),
            success: function( response ) {
                document.getElementById("commentForm").reset(); 
                $('#message').attr('class', 'success');
                $('#message').show().html(response.message);
                setTimeout(function(){
                    $('#message').html('');
                    $('#message').attr('class', 'error');
                }, 10000);
                $('#jsonComment').html('Save Json Comment');
            },
            error   : function(jqXHR, textStatus, error)
            {
                var collect = '';
                if (typeof jqXHR.responseJSON.errors === 'object') {
                    $.each(jqXHR.responseJSON.errors, function (i, error) {
                        collect += error[0] + '<br>';
                    });
                } else {
                    collect = jqXHR.responseJSON.message;
                }
                $('#message').attr('class', 'error');
                $('#message').show().html(collect);
                $('#jsonComment').html('Save Json Comment');
            }
        });
    }
</script>
@stop