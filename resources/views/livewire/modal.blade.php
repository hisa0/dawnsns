<div>
@if(Request::is('modal'))
        <!-- 投稿編集画面 -->
            <table>
            @foreach($posts as $post)
                    <tr>
                        <td>
                            {!!Form::open(['url'=>['/post/update'],'method'=>'POST'])!!}
                            {!!Form::hidden('id') !!}
                            @if('id = $post->id')
                            {!!Form::textarea('upPost', $post->posts,['required','maxlength'=>'150'])!!}
                            @endif
                            {!!Form::close()!!}
                        </td>
                    </tr>
            @endforeach
            </table>
<button wire:click="closeModal()" type="button" class="update_modal">
    <a class="btn_up btn-success primary"  href="/post/{{ $post->id }}/update"><img src="/images/edit.png" alt="内容更新"/></a>
                    </button>
@endif
</div>
