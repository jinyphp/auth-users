<div>
    @foreach ($message as $item)
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <span>
                            {{ $item->subject }}
                        </sapn>
                    </div>
                    <div>
                        <small class="float-end text-navy">{{ $item->created_at }}</small>
                    </div>
                </div>
                <div>
                    {{ $item->message }}
                </div>
            </div>
        </div>
    @endforeach
</div>
