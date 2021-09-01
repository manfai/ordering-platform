@component('mail::message')
# Order

## Your order Confirmed!
## Hello, {{$order->user->name}} You order has been confirmed. 
##
### Order Detail:
### Order No: SCH-DSC-{{$order->no}}
### Payment: Stripe
### Order Date: {{$order->created_at}}

@component('mail::table')
| Menu Date   |      Product Name      |  Quantity |  Student |  Price |
|:------------|:----------------------:|-----------|----------|--------|
@foreach($items as $item)
|  {{date('Y-m-d',strtotime($item->menu_date))}} |  {{$item->product->title}} | {{$item->quantity}} | {{$item->remark}} | {{$item->price}} |
@endforeach

@endcomponent

@component('mail::button', ['url' => config('app.url')])
View Detail
@endcomponent

Thank you for your order,<br>
{{ config('app.name') }}
@endcomponent
