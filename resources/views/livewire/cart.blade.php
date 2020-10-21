<div class="row">
	<div class="col-md-8">
		<div class="card">
			<div class="card-body">
				<div class="row mb-2">
					<div class="col-md-6"><h2 class="font-weight-bold">Products List</h2></div>
					<div class="col-md-6"><input wire:model="search" type="text" class="form-control" placeholder="Search Products..."></div>
				</div>
				<div class="row">
					@forelse($products as $product)
					<div class="col-md-3 mb-3">
						<div class="card">
							<div class="card-body">
								<img src="{{ asset('storage/images/'.$product->image) }}" alt="product" style="object-fit: contain; width: 100%; height: 125px">
							</div>
						</div>
						<div class="card-footer">
							<h6 class="text-center font-weight-bold">{{ $product->name }}</h6>
							<button wire:click="addItem({{ $product->id }})" class="btn btn-primary btn-sm btn-block">
								Add to cart
							</button>
						</div>
					</div>
					@empty
						<div class="col-sm-12 mt-5">
							<h3 class="text-center font-weight-bold text-primary">No Products found</h3>
						</div>
					@endforelse
				</div>
				<div style="display: flex; justify-content: center;">{{ $products->links() }}</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-body">
				<h2 class="font-weight-bold">Cart</h2>
				<p class="text-danger font-weight-bold">
					@if(session()->has('error'))
					{{ session('error') }}
					@endif
				</p>
				<table class="table table-sm table-bordered table-hovered">
					<thead class="bg-secondary text-white">
						<tr>
							<th>No</th>
							<th>Name</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
						@forelse($carts as $index=>$cart)
						<tr>
							<td>{{ $index + 1 }}</td>
							<td><a href="#" class="font-weight-bold text-dark">{{ $cart['name'] }}</a>
								<br>
								Qty: {{ $cart['qty'] }} 
								<i class="fas fa-plus" wire:click="increaseItem('{{ $cart['rowId'] }}')" style="font-size: 15px; cursor: pointer; color: grey"></i>
								<i class="fas fa-minus" wire:click="decreaseItem('{{ $cart['rowId'] }}')" style="font-size: 15px; cursor: pointer; color: grey"></i>
								<i class="fas fa-trash" wire:click="removeItem('{{ $cart['rowId'] }}')" style="font-size: 13px; cursor: pointer; color: red"></i>
							</td>
							<td>Rp {{number_format($cart['price'],2,',','.') }}</td>
						</tr>
						@empty
						<td colspan="3"><h6 class="text-center">Empty Cart</h6></td>
						@endforelse
					</tbody>
				</table>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<h4 class="font-weight-bold">Cart Summary</h4>
				<h5 class="font-weight-bold">Sub Total: Rp {{number_format($summary['sub_total'],2,',','.') }}</h5>
				<h5 class="font-weight-bold">Tax: Rp {{number_format($summary['pajak'],2,',','.') }}</h5>
				<h5 class="font-weight-bold">Total: Rp {{number_format($summary['total'],2,',','.') }}</h5>
				<div>
					<button wire:click="enableTax" class="btn btn-primary btn-block">Add Tax</button>
					<button wire:click="disableTax" class="btn btn-danger btn-block">Remove Tax</button>
				</div>
				<div class="mt-4">
					<button class="btn btn-success active btn-block">Save Transaction</button>
				</div>
			</div>
		</div>
	</div>
</div>
