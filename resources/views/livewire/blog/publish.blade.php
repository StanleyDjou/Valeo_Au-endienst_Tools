<form x-data="{ isModalOpen : @entangle('showModal') }" wire:submit.prevent="delete">
    <div
        class="modal"
        role="dialog"
        tabindex="-1"
        x-show="isModalOpen"
        x-cloak
        x-transition
    >
        @if(isset($blog))
        <div class="modal-inner modal-sm">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Status</h5>
            </div>
            <div class="modal-body ">
                 <p class="text-center"> Are you sure you want to {{$blog->status==="published"?"un-publish":"Publish"}} this Blog ?</p>

                 <p class="text-center"> Title : <span>{{$blog->title}}</span></p>

            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                        data-dismiss="modal">Close
                </button>
                <button type="button" wire:click="publish('{{$blog->status==="published"?"draft":"published"}}')" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="publish"></i>
                    {{$blog->status==="published"?"un-Publish":"Publish"}}
                </button>
            </div>
        </div>
        @endif
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
