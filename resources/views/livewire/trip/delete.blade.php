<form x-data="{ isModalOpen : @entangle('showModal') }" wire:submit.prevent="delete">
    <div
        class="modal"
        role="dialog"
        tabindex="-1"
        x-show="isModalOpen"
        x-cloak
        x-transition
    >
        <div class="modal-inner">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Trip</h5>
            </div>
            <div class="modal-body ">
                 <p class="text-center"> Are you sure you want to delete this Trip ?</p>
                @if(isset($trip))
                 <p class="text-center"> Title : <span>{{$trip->title}}</span></p>
                @endif
            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                        data-dismiss="modal">Close
                </button>
                <button type="button" wire:click="delete" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="delete"></i>
                    Delete
                </button>
            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
