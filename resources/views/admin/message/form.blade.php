<div>
    <x-form-hor>
        <x-form-label>수신자</x-form-label>
        <x-form-item>
            {!! xInputText()
                ->setWire('model.defer',"forms.to_email")
                ->setWidth("standard")
            !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>제목</x-form-label>
        <x-form-item>
            {!! xInputText()
                ->setWire('model.defer',"forms.subject")
                ->setWidth("standard")
            !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>메시지</x-form-label>
        <x-form-item>
            {!! xTextarea()
                ->setWire('model.defer',"forms.message")
            !!}
        </x-form-item>
    </x-form-hor>
</div>
