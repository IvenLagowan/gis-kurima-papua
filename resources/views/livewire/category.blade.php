<div wire:ignore.self class="container mt-5">
    <button type="button" class="btn btn-primary rounded-pill" data-toggle="modal" data-target="#exampleModalCenter">
        New Category
    </button>
    <div wire:ignore.self class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="formGroupExampleInput">Add new category</label>
                            <input type="text" wire:model="category_name" class="form-control" id="formGroupExampleInput" placeholder="input category">
                            @error('category_name')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" wire:click.prefetch="store" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-3">
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Category</th>
                <th scope="col">Manage Category</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $cat)
            <tr>
                <th scope="row">{{$cat->id}}</th>
                <td>{{$cat->category_name}}</td>
                <th scope="col">
                    <a class="btn btn-primary rounded-pill" wire:click='deleteWisataById' href="">Edit</a>
                    <a class="btn btn-danger rounded-pill" href="">Delete</a>
                </th>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@push('script')
<script>
    document.addEventListener('livewire:load', () => {
    });
</script>

@endpush
