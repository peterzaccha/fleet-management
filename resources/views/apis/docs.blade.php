<x-app-layout>
    <rapi-doc
        spec-url = "/apis/reference/fleet-management.v1.json"
        show-header = 'false'
        show-info = 'false'
        allow-server-selection = 'false'
        allow-api-list-style-selection ='false'
        primary-color="#818CF8"
    > </rapi-doc>
    @push("scripts")
        <script type="module" src="https://unpkg.com/rapidoc/dist/rapidoc-min.js"></script>
    @endpush
</x-app-layout>

