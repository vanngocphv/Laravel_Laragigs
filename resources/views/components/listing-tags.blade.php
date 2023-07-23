@props(['tagsJob'])

@php

    $tags = explode(',', $tagsJob);

@endphp


<ul class="flex">
    @foreach ($tags as $tag)
        <li {{$attributes->merge([
            'class' => 'bg-black text-white rounded-xl px-3 py-1 mr-2'
        ])}}>
            <a href="/?tag={{$tag}}">{{$tag}}</a>
        </li>
    @endforeach
</ul>