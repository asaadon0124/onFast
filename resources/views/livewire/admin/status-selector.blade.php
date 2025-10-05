<div>
    <form wire:submit.prevent="updateStatus" class="status">
        <select wire:model="currentStatus" class="form-control">
            <option value="">اختار الحالة</option>
            @foreach ($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
            @endforeach
        </select>

        <div class="noPrint mt-2">
            <button type="submit" class="btn btn-primary btn-block">تعديل</button>
        </div>
    </form>

    <br>
    <p class="lastUpdate">
        {{ $lastUpdate }}
    </p>
</div>
