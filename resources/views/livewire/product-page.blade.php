<div>
    <section>
        <div class="relative max-w-screen-xl px-4 py-8 mx-auto">
            <div class="grid items-start grid-cols-1 gap-8 md:grid-cols-2">
                <div class="grid grid-cols-2 gap-4 md:grid-cols-1">
                    <div class="aspect-w-1 aspect-h-1">
                        <img
                            alt="Mobile Phone Stand"
                            class="object-cover rounded-xl"
                            src="{{ $this->image }}"
                        />
                    </div>
                </div>

                <div class="sticky top-0">
                    <strong class="border border-blue-600 rounded-full tracking-wide px-3 font-medium py-0.5 text-xs bg-gray-100 text-blue-600"> Pre Order </strong>

                    <div class="flex justify-between mt-8">
                        <div class="max-w-[35ch]">
                            <h1 class="text-2xl font-bold">
                                {{ $this->product->translateAttribute('name') }}
                            </h1>
                        </div>

                        <x-product-price :variant="$this->variant" class="text-lg font-bold" />
                    </div>

                    <article class="relative mt-4">
                        {{ $this->product->translateAttribute('description') }}
                    </article>

                    <form class="mt-8">
                    <fieldset>
                        <legend class="mb-1 text-sm font-medium">Color</legend>

                        <div class="flow-root">
                        <div class="flex flex-wrap -m-0.5">
                            <label for="color_tt" class="cursor-pointer p-0.5">
                            <input type="radio" name="color" id="color_tt" class="sr-only peer" />

                            <span class="inline-block px-3 py-1 text-xs font-medium border rounded-full group peer-checked:bg-black peer-checked:text-white">
                                Texas Tea
                            </span>
                            </label>

                            <label for="color_fr" class="cursor-pointer p-0.5">
                            <input type="radio" name="color" id="color_fr" class="sr-only peer" />

                            <span class="inline-block px-3 py-1 text-xs font-medium border rounded-full group peer-checked:bg-black peer-checked:text-white">
                                Fiesta Red
                            </span>
                            </label>

                            <label for="color_cb" class="cursor-pointer p-0.5">
                            <input type="radio" name="color" id="color_cb" class="sr-only peer" />

                            <span class="inline-block px-3 py-1 text-xs font-medium border rounded-full group peer-checked:bg-black peer-checked:text-white">
                                Cobalt Blue
                            </span>
                            </label>
                        </div>
                        </div>
                    </fieldset>

                    <fieldset class="mt-4">
                        <legend class="mb-1 text-sm font-medium">Size</legend>

                        <div class="flow-root">
                        <div class="flex flex-wrap -m-0.5">
                            <label for="size_xs" class="cursor-pointer p-0.5">
                            <input type="radio" name="size" id="size_xs" class="sr-only peer" />

                            <span class="inline-flex items-center justify-center w-8 h-8 text-xs font-medium border rounded-full group peer-checked:bg-black peer-checked:text-white">
                                XS
                            </span>
                            </label>

                            <label for="size_s" class="cursor-pointer p-0.5">
                            <input type="radio" name="size" id="size_s" class="sr-only peer" />

                            <span class="inline-flex items-center justify-center w-8 h-8 text-xs font-medium border rounded-full group peer-checked:bg-black peer-checked:text-white">
                                S
                            </span>
                            </label>

                            <label for="size_m" class="cursor-pointer p-0.5">
                            <input type="radio" name="size" id="size_m" class="sr-only peer" />

                            <span class="inline-flex items-center justify-center w-8 h-8 text-xs font-medium border rounded-full group peer-checked:bg-black peer-checked:text-white">
                                M
                            </span>
                            </label>

                            <label for="size_l" class="cursor-pointer p-0.5">
                            <input type="radio" name="size" id="size_l" class="sr-only peer" />

                            <span class="inline-flex items-center justify-center w-8 h-8 text-xs font-medium border rounded-full group peer-checked:bg-black peer-checked:text-white">
                                L
                            </span>
                            </label>

                            <label for="size_xl" class="cursor-pointer p-0.5">
                            <input type="radio" name="size" id="size_xl" class="sr-only peer" />

                            <span class="inline-flex items-center justify-center w-8 h-8 text-xs font-medium border rounded-full group peer-checked:bg-black peer-checked:text-white">
                                XL
                            </span>
                            </label>
                        </div>
                        </div>
                    </fieldset>

                    <div class="flex mt-8">
                        <div>
                        <label for="quantity" class="sr-only">Qty</label>

                        <input
                            type="number"
                            id="quantity"
                            min="1"
                            value="1"
                            class="w-12 py-3 text-xs text-center border-gray-200 rounded no-spinners"
                        />
                        </div>

                        <button
                        type="submit"
                        class="block px-5 py-3 ml-3 text-xs font-medium text-white bg-green-600 rounded hover:bg-green-500"
                        >
                        Add to Cart
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
