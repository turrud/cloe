<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.kunci_sukses.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('all-lms.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.kunci_sukses.inputs.name')
                        </h5>
                        <span>{{ $lms->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.kunci_sukses.inputs.text')
                        </h5>
                        <span>{{ $lms->text ?? '-' }}</span>
                    </div>
                    {{-- <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.kunci_sukses.inputs.file')
                        </h5>
                        @if($lms->file)
                        <a href="{{ \Storage::url($lms->file) }}" target="blank"
                            ><i class="mr-1 icon ion-md-download"></i
                            >&nbsp;Download</a
                        >
                        @else - @endif
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.kunci_sukses.inputs.image')
                        </h5>
                        <x-partials.thumbnail
                            src="{{ $lms->image ? \Storage::url($lms->image) : '' }}"
                            size="150"
                        />
                    </div> --}}
                </div>

                <div class="mt-10">
                    <a href="{{ route('all-lms.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Lms::class)
                    <a href="{{ route('all-lms.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
