<div>
    <h1 class="mt-4">{{$header}}</h1>
    <ol class="breadcrumb mb-4">
        @foreach($breadcrums as $key => $item)
        <li class="breadcrumb-item @if($key + 1 == count($breadcrums)) active @endif ">{{$item}}</li>
        @endforeach
    </ol>
</div>