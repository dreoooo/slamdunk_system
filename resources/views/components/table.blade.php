<table class="w-full table-auto border-collapse border border-gray-200">
    <thead>
        <tr class="bg-gray-200">
            @foreach ($headers as $header)
                <th class="border px-4 py-2 text-left">{{ $header }}</th>
            @endforeach
            <th class="border px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
            <tr class="hover:bg-gray-100">
                @foreach ($row as $value)
                    <td class="border px-4 py-2">{{ $value }}</td>
                @endforeach
                <td class="border px-4 py-2 space-x-2">
                    <a href="{{ route($routePrefix . '.edit', $row['id']) }}"
                        class="bg-blue-500 text-white px-2 py-1 rounded">Edit</a>
                    <form action="{{ route($routePrefix . '.destroy', $row['id']) }}" method="POST" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        @if (count($rows) === 0)
            <tr>
                <td colspan="{{ count($headers) + 1 }}" class="text-center p-4 text-gray-500">No records found.</td>
            </tr>
        @endif
    </tbody>
</table>
