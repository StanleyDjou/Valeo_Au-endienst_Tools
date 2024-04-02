<div class="flex items-center ">
    <p class="font-semi-bold text-fade-blue mr-3" >Follow:</p>

    @if(isset($model->instagram))
        <a target="_blank" href="{{$model->instagram}}" class=" flex rounded-full bg-social flex h-10 w-10 mr-3 items-center justify-center ">
            <img src="{{asset("images/icons8_instagram 1.svg")}}"  class="h-6 w-6" alt="">
        </a>
    @endif

    @if(isset($model->twitter))
        <a target="_blank" href="{{$model->twitter}}" class=" flex rounded-full bg-social flex h-10 w-10 mr-3  items-center justify-center ">
            <img src="{{asset("images/icons8_Twitter 1.svg")}}"  class="h-6 w-6" alt="">
        </a>
    @endif

    @if(isset($model->facebook))
        <a target="_blank" href="{{$model->facebook}}" class=" flex rounded-full bg-social flex h-10 w-10 mr-3 items-center justify-center ">
            <img src="{{asset("images/icons8_facebook_f 1.svg")}}"  class="h-6 w-6" alt="">
        </a>
    @endif

    @if(isset($model->website))
        <a target="_blank" href="{{$model->website}}" class=" flex rounded-full bg-social flex h-10 w-10 mr-3  items-center justify-center ">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 0 19 9.5 9.5 0 0 0 0-19ZM8.374 17.4a7.6 7.6 0 0 1-5.9-7.4c0-.83.137-1.655.406-2.441l.239.019a3.887 3.887 0 0 1 2.082 2.5 4.1 4.1 0 0 0 2.441 2.8c1.148.522 1.389 2.007.732 4.522Zm3.6-8.829a.997.997 0 0 0-.027-.225 5.456 5.456 0 0 0-2.811-3.662c-.832-.527-1.347-.854-1.486-1.89a7.584 7.584 0 0 1 8.364 2.47c-1.387.208-2.14 2.237-2.14 3.307a1.187 1.187 0 0 1-1.9 0Zm1.626 8.053-.671-2.013a1.9 1.9 0 0 1 1.771-1.757l2.032.619a7.553 7.553 0 0 1-3.132 3.151Z"/>
            </svg>
        </a>
    @endif

    @if(isset($model->tiktok))
        <a target="_blank" href="{{$model->tiktok}}" class=" flex rounded-full bg-social flex h-10 w-10 mr-3  items-center justify-center ">
            <img src="{{asset("images/icon-tiktok.svg")}}"  class="h-6 w-6" alt="">
        </a>
    @endif

    @if(isset($model->youtube))
        <a target="_blank" href="{{$model->youtube}}" class=" flex rounded-full bg-social flex h-10 w-10 mr-3  items-center justify-center ">
            <img src="{{asset("images/icons8_youtube 1.svg")}}"  class="h-6 w-6" alt="">

        </a>
    @endif

</div>
