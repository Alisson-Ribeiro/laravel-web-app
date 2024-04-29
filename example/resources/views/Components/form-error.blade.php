    @if($errors->any())
                    
            <ul class="text-red-500 font-semibold mt-1">
                @foreach($errors->all() as $error)
                     <li>
                            {{ $error }}
                    </li>
                @endforeach
            </ul>
                    
    @endif