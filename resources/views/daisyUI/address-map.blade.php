<x-divider>{{ __('adminlte::landingpage.contactdetails') }}</x-divider>
<div class="flex flex-col sm:flex-row items-center gap-6">
    <div class="w-full lg:w-1/2 space-y-3 lg:ps-[5%]">
        @foreach ($contactDetails as $contactDetail)
            <x-text-icon :post="$contactDetail" />
        @endforeach
    
    </div>
    @isset($map)
        <div class="w-full lg:w-1/2 text-center space-y-4 tooltip tooltip-bottom"
        {{-- data-tip="{{ __('adminlte::landingpage.clicktomove') }}" --}}
        >
            <h2 class="text-2xl font-bold">{{ __('adminlte::landingpage.ourlocation') }}:</h2>
            <div class="aspect-video w-full rounded-xl overflow-hidden shadow-lg">
                    <iframe class="w-full h-full"
                        src="{{ $map->postDetailOne->content }}"
                        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
            </div>
        </div>
    @endisset
</div>