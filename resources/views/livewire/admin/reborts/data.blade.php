<div>
     {{--  TABLE TO SHOW ALL PRODUCTS RECIVED  --}}
	<div class="row row-sm">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header pb-0">
					<form wire:submit.prevent="submit">
                        @csrf

                       <div class="row noPrint">
                            <div class="form-group col-md-3">
                                <label for="">اختار مورد</label>
                                <select class="form-control" wire:model="supplier_id">
                                    <option></option>
                                    @foreach($suppliers as $item )
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                @error("supplier_id")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-3">
                                <label for="">اختار الحالة</label>
                                <select class="form-control" wire:model="status_id">
                                    <option></option>
                                    @foreach($status as $stat )
                                        <option value="{{$stat->id}}">{{$stat->name}}</option>
                                    @endforeach
                                </select>
                                @error("status_id")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                            <div class="form-group col-md-3">
                                <label>من :</label>
                                <input type="date" wire:model="date1" class="form-control">
                                @error("date1")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>


                            <div class="form-group col-md-3">
                                <label>الي :</label>
                                <input type="date" wire:model="date2" class="form-control">
                                @error("date2")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            @if (!$hasReports)
                            <div class="form-group col-md-3">
                                <input type="submit"  class="btn btn-primary btn-lg"   value="عرض" class="form-control" style="margin-top: 10%">
                            </div>
                            @endif


                       </div>
                    </form>
			    </div>
		    </div>
	    </div>
    </div>

    {{-- <div class="table-responsive">

    </div> --}}

</div>
