@php
    $label = App\Models\MangaCollection::getTypeLabel( $type );
@endphp

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ $label }} Details</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.collection.save', $type ) }}" method="post">
            
            @csrf

            <input type="hidden" name="id" value="{{ isset($id) ? $id : '' }}">
            
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" required value="{{ $name }}">
            </div>  

            <div class="form-group">
                <label>Slug</label>
                <input type="text" class="form-control" name="slug" readonly value={{ isset( $slug ) ? $slug : '' }}>
            </div>  

            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text text-center flex-grow-1">Save</span>
                    </button>
                    
                    @if (isset($id))
                        <a 
                            class="btn btn-danger btn-icon-split"
                            onclick="aCommon.deleteModal(
                                '{{ $label }}',
                                '{{ $name }}',
                                '{{ route('admin.collection.delete', compact(['type', 'id'])) . '?_token=' . csrf_token() }}'
                            )"
                        >
                            <span class="icon text-white-50">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text text-center flex-grow-1">Delete</span>
                        </a>
                    @endif
                </div>
            </div>

        </form>
    </div>

</div>