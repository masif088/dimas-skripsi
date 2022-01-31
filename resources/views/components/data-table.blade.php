<div>
    <div class="row mb-4 mt-4">
        <div class="col-2">
            Per Page: &nbsp;
            <select wire:model="perPage" class="form-control" style="">
                <option>10</option>
                <option>15</option>
                <option>25</option>
            </select>
        </div>
        <div class="col-4">
        </div>
        <div class="col-6" style="float: right">
            <input wire:model="search" class="form-control" type="text" placeholder="Pencarian...">
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            {{ $head }}
            </thead>
            <tbody>
            {{ $body }}
            </tbody>
        </table>
    </div>
    <div id="table_pagination" class="py-3">
        {{ $model->onEachSide(1)->links() }}
    </div>
</div>

