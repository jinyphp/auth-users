<x-wire-table>
    <x-wire-thead>
        {{-- 테이블 제목 --}}
        <th width='100'>작성자</th>
        <th width='100'>수신자</th>
        <th>내용</th>
        <th width='100'>확인</th>
        <th width='200'>등록일자</th>

    </x-wire-thead>
    <tbody>
        @if(!empty($rows))
            @foreach ($rows as $item)
            <x-wire-tbody-item :selected="$selected" :item="$item">
                {{-- 테이블 리스트 --}}
                <td width='100'>
                    {{$item->email}}
                </td>
                <td width='100'>
                    {{$item->to_email}}
                </td>
                <td>
                    @if($item->subject)
                        <div wire:click="edit({{$item->id}})">
                            {{$item->subject}}
                        </div>
                    @endif

                    <x-link-void wire:click="edit({{$item->id}})">
                        {{$item->message}}
                    </x-link-void>
                </td>

                <td width='100'>
                    @if($item->readed_at)
                        읽음
                    @endif
                </td>

                <td width='200'>{{$item->created_at}}</td>

            </x-wire-tbody-item>
            @endforeach
        @endif
    </tbody>
</x-wire-table>
