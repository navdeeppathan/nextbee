<h1>Cart</h1>

@php $total = 0; @endphp

@foreach($cartItems as $item)
    @php $total += $item->product->price * $item->quantity; @endphp

    <div>
        <h3>{{ $item->product->title }}</h3>
        <p>Qty: {{ $item->quantity }}</p>
        <p>£{{ $item->product->price }}</p>
    </div>
@endforeach

<h2>Total: £{{ $total }}</h2>

<a href="/checkout">Proceed to Checkout</a>