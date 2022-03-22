<x-layout>
    <div class="flex font-mono">
        <div class="w-8/12 bg-gray-100 h-screen p-2 resize-x">
            <form action="" class="flex items-end">
                <div class="w-9/12 flex">
                    <div class="w-6/12">
                        <div class="label">
                            <div class="label-text">
                                Description
                            </div>
                        </div>
                        <input type="text" value="{{request()->description}}" name="description" class="input input-bordered block w-full mx-1" placeholder="Product Description">
                    </div>
                    <div class="w-6/12 mx-1">
                        <div class="label">
                            <div class="label-text">
                                Category
                            </div>
                        </div>
                        <select class="select select-bordered w-full block mx-1" name="category">
                            <option value="">All</option>
                            @foreach (\App\Models\Category::get() as $c)
                                <option {{request()->category === $c->description ? 'selected':''}} value="{{$c->description}}">{{$c->description}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="w-3/12 flex">
                    <button class="btn mx-1 btn-secondary">
                        Search
                    </button>
                    <a href="/" class="btn mx-1">
                        All
                    </a>
                </div>
            </form>
            <div class="overflow-x-auto mt-2">
                <table class="table table-compact w-full table-bordered " >
                    <thead>
                        <tr>
                            <th>
                                SKU
                            </th>
                            <th>
                                Desc.
                            </th>
                            <th>
                                Price
                            </th>
                            <th>
                                UoM
                            </th>
                            <th>
                                Quantity
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                        <tr>
                            <td>
                                {{$p->sku}}
                            </td>
                            <td>
                                {{$p->description}}
                            </td>
                            <td>
                                {{$p->price}}
                            </td>
                            <td>
                                {{$p->uom}}
                            </td>
                            <td>
                                {{$p->quantity}}
                            </td>
                            <th>
                                @if (auth()->user()->isAdded($p->id))
                                    <a
                                    href="/remove-item/{{$p->id}}"
                                    class="btn bg-red-500 btn-sm hover:bg-red-900">
                                        <img src="/x.svg" alt="">
                                    </a>
                                @else
                                    <!-- The button to open modal -->
                                    @if ($p->quantity)
                                    <label for="{{$p->id}}-add" class="btn btn-secondary btn-sm">
                                        <img src="/plus.svg" alt="">
                                    </label>
                                    @else
                                    <span class="text-gray-400">
                                        Out Of Stock
                                    </span>
                                    @endif

                                    <!-- Put this part before </body> tag -->
                                    <input type="checkbox" id="{{$p->id}}-add" class="modal-toggle">
                                    <div class="modal">
                                    <div class="modal-box">
                                        <form action="/add-item/{{$p->id}}" class="flex items-center">
                                            <input type="number" name="quantity" class="input input-bordered" required value="1">
                                            <button class="btn btn-success mx-1">Place Item</button>
                                            <label for="{{$p->id}}-add" class="btn mx-1">
                                                <img src="/x.svg" alt="">
                                            </label>
                                        </form>
                                    </div>
                                    </div>
                                @endif
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="w-4/12 h-screen overflow-y-auto relative bg-gray-800 border-l-2 border-black">
            <h1 class="text-center font-bold uppercase p-2 bg-gray-300 fixed w-4/12">
                Item(s)
            </h1>
            <div class="mt-10 p-2 resize-y">
                @forelse (auth()->user()->getItems() as $i)
                    <div class="flex w-full bg-gray-200 p-2 items-center justify-between mb-1">
                        <div>
                            <span class="font-bold">
                                {{$i->product->description}}
                            </span>
                            <div>
                                <span class="text-xs">
                                    PHP {{number_format($i->product->price, 2)}}
                                </span>
                            </div>
                        </div>
                       <div class="flex items-center">
                           <div class="badge badge-warning mx-1">
                                {{$i->quantity}}
                           </div>
                           <!-- The button to open modal -->
                           <label for="{{$i->id}}-modal" class=" mx-1"><img src="/edit.svg" alt=""></label>
                            <a class="mx-1" href="/remove-item/{{$i->product_id}}">
                                <img src="/x.svg" alt="">
                            </a>

                            <!-- Put this part before </body> tag -->
                            <input type="checkbox" id="{{$i->id}}-modal" class="modal-toggle">
                            <div class="modal">
                                <div class="modal-box">
                                    <form action="/update-quantity/{{$i->product_id}}" class="flex items-center">
                                        <input type="number" name="quantity" class="input input-bordered" required value="{{$i->quantity}}">
                                        <button class="btn btn-success mx-2">
                                            Apply
                                        </button>
                                        <label for="{{$i->id}}-modal" class="btn bg-white hover:bg-gray-400 mx-2">
                                            <img src="/x.svg" alt="">
                                        </label>
                                    </form>
                                </div>
                            </div>
                       </div>
                    </div>
                @empty
                    <div class="alert alert-warning">
                        No Item.
                    </div>
                @endforelse
            </div>
            <form class="w-full bg-white h-auto p-2" action="/process-order" method="POST">
                @csrf
                <h1 class="font-bold text-xs uppercase text-center">summary</h1>
                <table class="table w-full table-bordered table-compact">
                    <tr>
                        <th>
                            Sub-total
                        </th>
                        <td>
                            {{number_format(auth()->user()->itemSubtotal(), 2)}}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Vat Due ({{nova_get_setting('vat', 12)}} %)
                        </th>
                        <td>
                            {{number_format(auth()->user()->vatDue(auth()->user()->itemSubtotal()), 2)}}
                        </td>
                    </tr>
                    <tr class="border-dashed border-2 border-black">
                        <th class="text-2xl bg-yellow-200">
                            Total
                        </th>
                        <td class="text-2xl font-bod bg-yellow-200">
                            {{number_format(auth()->user()->grandTotal(), 2)}}
                        </td>
                    </tr>
                </table>
                <div x-data="{
                    total:{{auth()->user()->grandTotal()}},
                    change:0,
                    cash:0,
                    cashHandler() {
                        this.cash = this.$refs.cashInput.value;
                        this.change = Math.floor((this.cash - this.total));
                    }
                }">
                <div>
                    <div class="label label-text">
                        Cash
                    </div>
                    <input type="number" required x-ref="cashInput" name="cash" x-on:keyup="cashHandler"  class="w-full input input-bordered">
                </div>
                <div>
                    <div class="label label-text">
                        Change
                    </div>
                    <input type="number" required readonly x-model="change" name="change" class="w-full input input-bordered">
                </div>
                </div>
                <button class="btn btn-block btn-secondary mt-2">place order</button>
            </form>
        </div>
    </div>
</x-layout>
