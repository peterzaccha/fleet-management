<x-app-layout>
    @php
        Auth::user()->tokens()->delete();
        $token = Auth::user()->createToken("For Testing");
    @endphp
    <rapi-doc
        spec-url = "/apis/reference/fleet-management.v1.json"
        show-header = 'false'
        show-info = 'false'
        {{-- allow-server-selection = 'false' --}}
        {{-- allow-api-list-style-selection ='false' --}}
        primary-color="#818CF8"
        server-url="{{Request::root()}}/api"
        default-api-server="{{Request::root()}}/api"
        api-key-name="Authorization"
        api-key-location="header"
        api-key-value="Bearer {{ $token->plainTextToken }}"
    > </rapi-doc>
    @push("scripts")
        <script type="module" src="https://unpkg.com/rapidoc/dist/rapidoc-min.js"></script>
    @endpush
</x-app-layout>

