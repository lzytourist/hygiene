<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <div class="px-6 w-full">
                <section class="">
                    <form action="{{ route('order.place') }}" method="post" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                        @csrf
                        <div class="lg:flex lg:items-start lg:gap-4 xl:gap-6">
                            <div class="bg-white rounded-md p-6 min-w-0 flex-1 space-y-8">
                                <div class="space-y-4">
                                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Delivery
                                        Details</h2>

                                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                        <div>
                                            <x-input-label for="name">
                                                Your name </x-input-label>
                                            <x-text-input class="w-full" type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}"
                                                   placeholder="Bonnie Green" required/>
                                        </div>

                                        <div>
                                            <x-input-label for="email">
                                                Your email* </x-input-label>
                                            <x-text-input class="w-full" name="email" type="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                                                   placeholder="name@flowbite.com" required/>
                                        </div>

                                        <div>
                                            <x-input-label for="phone-input-3">
                                                Phone Number* </x-input-label>
                                            <div class="flex items-center">
                                                <button id="dropdown-phone-button-3"
                                                        data-dropdown-toggle="dropdown-phone-3"
                                                        class="z-10 inline-flex shrink-0 items-center rounded-s-lg border border-gray-300 bg-gray-100 px-4 py-2.5 text-center text-sm font-medium text-gray-900 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                                                        type="button">
                                                    <svg fill="none" aria-hidden="true" class="me-2 h-4 w-4"
                                                         viewBox="0 0 20 15">
                                                        <rect width="100" height="60" fill="#006a4e"/>
                                                        <circle cx="10" cy="9" r="5" fill="#f42a41"/>
                                                    </svg>
                                                    +880
                                                </button>
                                                <div class="relative w-full">
                                                    <x-text-input type="text" name="phone" id="phone-input" class="w-full rounded-l-none border-l-0"
                                                           placeholder="123-456-7890" required/>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <x-input-label for="city">City*</x-input-label>
                                            <x-text-input class="w-full" type="text" name="city" value="{{ old('city') }}" id="city" required/>
                                        </div>

                                        <div class="col-span-2">
                                            <x-input-label for="address">Address*</x-input-label>
                                            <x-text-input class="w-full" type="text" name="address" value="{{ old('address') }}" id="address" required/>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Payment</h3>

                                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                        <div
                                            class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                                            <div class="flex items-start">
                                                <div class="flex h-5 items-center">
                                                    <input id="credit-card" aria-describedby="credit-card-text"
                                                           type="radio" name="payment-method" value=""
                                                           class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                                           checked/>
                                                </div>

                                                <div class="ms-4 text-sm">
                                                    <label for="credit-card"
                                                           class="font-medium leading-none text-gray-900 dark:text-white">
                                                        Cash on Delivery </label>
                                                    <p id="credit-card-text"
                                                       class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400">
                                                        Pay when you receive your product</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-white p-6 rounded-md mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
                                <div class="flow-root">
                                    <div class="-my-3 divide-y divide-gray-200 dark:divide-gray-800">
                                        <dl class="flex items-center justify-between gap-4 py-3">
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                Subtotal
                                            </dt>
                                            <dd class="text-base font-medium text-gray-900 dark:text-white">&#2547; {{ session()->get('total', 0) }}</dd>
                                        </dl>

                                        <dl class="flex items-center justify-between gap-4 py-3">
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Delivery charge
                                            </dt>
                                            <dd class="text-base font-medium text-gray-900 dark:text-white">&#2547; {{ session()->get('delivery_charge', 99) }}</dd>
                                        </dl>

                                        <dl class="flex items-center justify-between gap-4 py-3">
                                            <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                                            <dd class="text-base font-medium text-gray-900 dark:text-white">&#2547; {{ session()->get('tax', 0) }}</dd>
                                        </dl>

                                        <dl class="flex items-center justify-between gap-4 py-3">
                                            <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                            <dd class="text-base font-bold text-gray-900 dark:text-white">&#2547; {{ session()->get('total', 0) + session()->get('delivery_charge', 0) + session()->get('tax', 0) }}</dd>
                                        </dl>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-slate-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Place order</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
