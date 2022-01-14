@push('headerScripts')
    <link href="/assets/vendor/select2.min.css" rel="stylesheet" />
    <link href="/assets/vendor/select2-bootstrap.css" rel="stylesheet" />
    <script src="/assets/vendor/select2.min.js"></script>
@endpush

@section('pageTitle', 'Admin | Settings')

@section('pageHeading')
    <h1 class="h3 text-gray-800">Settings</h1>
@endsection

<x-dashboard-layout>

    <x-alert-errors></x-alert-errors>
    <x-alert-success></x-alert-success>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Settings</h6>
        </div>
        <div class="card-body">
            <form action="" id="settingForm" method="post">
    
                @csrf
    
                <div class="row mb-4">
    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Featured Collection</label>
                            <select class="select2 form-control" name="featured_collection[]" data-ajax-url="{{ route('admin.ajax.manga.search') }}" multiple>
                                @foreach($featured_collection as $manga)
                                    <option value="{{ $manga->id }}" selected>{{ $manga->title }}</option>
                                @endforeach
                            </select>
                        </div>  
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Default Chapter Token</label>
                            <input type="number" name="default_coin" id="" class="form-control" value="{{ $default_coin }}">
                        </div>  
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Token Rate</label>
                            <input type="number" name="token_rate" id="" class="form-control" required value="{{ $token_rate }}">
                        </div>  
                    </div>

                </div>
    
                <hr>
    
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text text-center flex-grow-1">Save</span>
                        </button>
                    </div>
                </div>
    
            </form>
        </div>
    
        <script>
            jQuery(".select2").each((i, e) => {
                let $this = $(e);
                $this.select2({
                    tags: true,
                    minimumInputLength: 1,
                    ajax: {
                        url: $this.data('ajax-url'),
                        data: function (params) {

                            var query = {
                                search: params.term,
                                page: params.page || 1,
                                selected: $this.val()
                            }

                            // Query parameters will be ?search=[term]&page=[page]
                            return query;

                        }
                    }
                });
            })
        </script>
    </div>
</x-dashboard-layout>