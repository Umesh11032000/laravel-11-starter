@foreach ($properties as $property)
    <ul>
        @foreach ($property as $field => $value)
            <li>
                {{ Str::ucfirst(__("module.user.{$field}")) }}: {{ $value ?? '' }}
            </li>
        @endforeach
    </ul>
@endforeach
