
@isset($items)
    <option value=""></option>
    @foreach($items as $item)
        <option value="{{ $item->id }}">{{ $item->name }}</option>
    @endforeach
@endisset