<div class="modal fade" id="access-admin-{{ $user->id }}" tabindex="-1" aria-labelledby="accessAdminModalLabel-{{ $user->id }}" aria-hidden="true" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accessAdminModalLabel-{{ $user->id }}">Access Control</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ url('admin-privillege', $user->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Admin Name</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        
                        <div class="form-check mb-2">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="can_edit" 
                                id="can_edit-{{ $user->id }}" 
                                value="on"
                                {{ ($user->can_edit ?? false) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="can_edit-{{ $user->id }}">
                                Edit
                            </label>
                        </div>
                        
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="can_add" 
                                id="can_add-{{ $user->id }}" 
                                value="on"
                                {{ ($user->can_add ?? false) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="can_add-{{ $user->id }}">
                                Add
                            </label>
                        </div>
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="can_delete" 
                                id="can_delete-{{ $user->id }}" 
                                value="on"
                                {{ ($user->can_delete ?? false) ? 'checked' : '' }}
                            >
                            <label class="form-check-label" for="can_delete-{{ $user->id }}">
                                Delete
                            </label>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn bg-danger-subtle text-danger  waves-effect"
                    data-bs-dismiss="modal">
                    Close
                    </button>
                    <button type="submit" class="btn bg-info-subtle text-info  waves-effect">
                    Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-check {
        margin-left: 10px !important;
    }
</style>