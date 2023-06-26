<x-shop::layouts
    :has-header="false"
    :has-feature="false"
    :has-footer="false"
>
    <div class="bs-dekstop-menu flex flex-wrap max-lg:hidden">
        <div
            class="w-full flex justify-between px-[60px] border border-t-0 border-b-[1px] border-l-0 border-r-0 pb-[5px] pt-[17px]"
        >
            <div class="flex items-center gap-x-[54px] max-[1180px]:gap-x-[35px]">
                <a
                    href="{{ route('shop.home.index') }}" 
                    class="bs-logo bg-[position:-5px_-3px] bs-main-sprite w-[131px] h-[29px] inline-block mb-[16px]"
                >
                </a>
            </div>
        </div>
    </div>

    <div class="bs-mobile-menu flex-wrap hidden max-lg:flex px-[15px]gap-[15px] max-lg:mb-[15px]">
        <div class="bs-mobile-menu flex-wrap hidden max-lg:flex px-[15px] pt-[25px] gap-[15px] max-lg:mb-[15px]">
            <div class="w-full flex justify-between items-center px-[6px]">
                <div class="flex  items-center gap-x-[5px]">
                    <span class="icon-hamburger text-[24px]"></span>
        
                    <a herf="" class="bs-logo bg-[position:-5px_-3px] bs-main-sprite w-[131px] h-[29px] inline-block"></a>
                </div>
            </div>
        </div>
    </div>

    {{-- Checkout component --}}
    {{-- Todo (@suraj-webkul): need change translation of this page.  --}}
    {{-- @translations --}}
    <v-checkout>
        <x-shop::shimmer.checkout.onepage></x-shop::shimmer.checkout.onepage>
    </v-checkout>

    @pushOnce('scripts')
        <script type="text/x-template" id="v-checkout-template">
            <div class="container px-[60px] max-lg:px-[30px] max-sm:px-[15px]">
                {{-- Breadcrumb --}}
                <div class="flex justify-start mt-[30px] max-lg:hidden">
                    <div class="flex gap-x-[14px] items-center">
                        <p class="flex items-center gap-x-[14px] text-[16px] font-medium">
                            @lang('shop::app.checkout.onepage.index.home')
                            <span class="icon-arrow-right text-[24px]"></span>
                        </p>
                        <p class="text-[#7D7D7D] text-[12px] flex items-center gap-x-[16px] font-medium  after:content[' '] after:bg-[position:-7px_-41px] after:bs-main-sprite after:w-[9px] after:h-[20px] after:last:hidden">
                            @lang('shop::app.checkout.onepage.index.checkout')
                        </p>
                    </div>
                </div>


                <div class="grid grid-cols-[1fr_auto] gap-[30px] max-lg:grid-cols-[1fr]">
                    <div>
                        @include('shop::checkout.onepage.addresses.index')

                        @include('shop::checkout.onepage.shipping')

                        @include('shop::checkout.onepage.payment')

                        <div class="flex justify-between items-center flex-wrap gap-[15px] mb-[60px] max-sm:mb-[10px]">
                            <a 
                                href="{{ route('shop.checkout.cart.index') }}"
                                class="flex gap-x-[6px] items-center"
                            >
                                <span class="icon-arrow-left text-[24px] max-sm:text-[14px]"></span>
                                @lang('Return to cart')
                            </a>
            
                            <a 
                                href="{{ route('shop.home.index')}}"
                                class="block bg-navyBlue text-white text-base w-max font-medium py-[11px] px-[43px] rounded-[18px] text-center cursor-pointer max-sm:text-[14px] max-sm:px-[25px]"
                            >
                                @lang('Return To Shop')
                            </a>
                        </div>
                    </div>
                    
                    @include('shop::checkout.onepage.summary')
                </div>
            </div>
        </script>

        <script type="module">
            app.component('v-checkout', {
                template: '#v-checkout-template',

                data() {
                    return {
                        cart: {},

                        isCartLoading: true,
                    }
                },

                created() {
                    this.getOrderSummary();
                }, 

                methods: {
                    getOrderSummary() {
                        this.$axios.get("{{ route('shop.checkout.onepage.summary') }}")
                            .then(response => {
                                this.cart = response.data.data;

                                this.isCartLoading = false;
                            })
                            .catch(error => console.log(error))
                    },

                }
            });
        </script>
    @endPushOnce
</x-shop::layouts>
