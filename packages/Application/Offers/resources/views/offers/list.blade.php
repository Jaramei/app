   <div class="dd">

        <ol class="dd-list">

            @foreach($data as $item)

                <li class="dd-item" data-id="{{$item->id}}">

                    <div class="dd-handle">
                        <a href="{{ route('offers.edit',$item->id) }}" class="none">{{ $item->name }} </a>

                        <a href="{{ route('offers.edit',$item->id) }}" class=" pull-right p-l-15">EDIT </a>
                        <a href="{{ route('offers.delete',$item->id) }}" class=" pull-right "> DELETE</a>

                    </div>

                    @if($item->children)

                        <ol class="dd-list">

                            @foreach ($item->children->sortBy('sort') as $parent)

                                <li class="dd-item" data-id="{{$parent->id}}">
                                    <div class="dd-handle">

                                        <a href="{{ route('offers.edit',$parent->id) }}" class="none">{{ $parent->name }}</a>

                                        <a href="{{ route('offers.edit',$parent->id) }}" class="none pull-right p-l-15"> EDIT </a>
                                        <a href="{{ route('offers.delete',$item->id) }}" class=" pull-right "> DELETE</a>

                                    </div>
                                </li>
                            @endforeach

                        </ol>

                    @endif

                </li>

            @endforeach

        </ol>

    </div>


