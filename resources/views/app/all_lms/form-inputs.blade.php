@php $editing = isset($lms) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $lms->name : ''))"
            placeholder="Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.textarea name="text" label="Text" required
            >{{ old('text', ($editing ? $lms->text : '')) }}</x-inputs.textarea
        >
    </x-inputs.group>
</div>
