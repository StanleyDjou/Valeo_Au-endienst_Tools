<form x-data="{ isModalOpen : @entangle('showModal') }" wire:submit.prevent="change">
    <div
        class="modal"
        role="dialog"
        tabindex="-1"
        x-show="isModalOpen"
        x-cloak
        x-transition
    >
        <div class="modal-inner short">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update request status</h5>
            </div>

            <div class="modal-body ">
                 <p class="text-center"> Are you sure you want to mark this request as {{ucfirst($status)}} ?</p>
            </div>

            <div class="modal-footer">
                <button type="button" x-on:click="isModalOpen = !isModalOpen;" class="btn btn-secondary"
                        data-dismiss="modal">Close
                </button>
                <button type="button" wire:click="change" class="btn btn-primary" wire:loading.attribute = 'disabled'>
                    <i class="fa fa-spinner d-none" wire:loading.class.remove="d-none"   wire:target="change"></i>
                    Mark as {{ucfirst($status)}}
                </button>
            </div>
        </div>
    </div>

    <div class="overlay" x-show="isModalOpen" x-cloak></div>
</form>
