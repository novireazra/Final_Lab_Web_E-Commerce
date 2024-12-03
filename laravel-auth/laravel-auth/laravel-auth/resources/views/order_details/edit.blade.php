@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Order Detail</h1>
    <form action="{{ route('order_details.update', $orderDetail->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="id_order" class="form-label">Order</label>
            <select name="id_order" id="id_order" class="form-select" required>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}" {{ $orderDetail->id_order == $order->id ? 'selected' : '' }}>
                        Order #{{ $order->id }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_menu" class="form-label">Menu</label>
            <select name="id_menu" id="id_menu" class="form-select" required>
                @foreach ($menus as $menu)
                    <option value="{{ $menu->id }}" {{ $orderDetail->id_menu == $menu->id ? 'selected' : '' }}>
                        {{ $menu->nama_menu }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" id="jumlah" class="form-control" value="{{ $orderDetail->jumlah }}" required>
        </div>
        <div class="mb-3">
            <label for="sub_total" class="form-label">Sub Total</label>
            <input type="number" step="0.01" name="sub_total" id="sub_total" class="form-control" value="{{ $orderDetail->sub_total }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Update</button>
        <a href="{{ route('order_details.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
