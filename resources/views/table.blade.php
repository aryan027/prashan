<div class="row">
    @forelse($datas as $data)
        <div class="col-md-4">
            <p class="text-primary">Table Number is : this</p>
            <p class="text-secondary">Serving Capacity is : this</p>
        </div>
    @empty
        <h4 class="text-danger">No Tables available</h4>
    @endforelse
</div>
