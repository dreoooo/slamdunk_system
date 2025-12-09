@extends('layouts.app')

@section('title', 'Customer Dashboard')
@section('page-title', 'Customer Dashboard')

@section('content')
    <div class="p-6 bg-white rounded-lg shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">All Customers</h2>
            <a href="{{ route('customers.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Add Customer
            </a>
        </div>


        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">CTR Number</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Name</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Email</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Phone</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Team</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Sales Rep</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Balance</th>
                        <th class="px-4 py-2"></th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($customers as $c)
                        <tr>
                            <td class="px-4 py-2">{{ $c->ctr_number }}</td>
                            <td class="px-4 py-2">{{ $c->first_name }} {{ $c->last_name }}</td>
                            <td class="px-4 py-2">{{ $c->email }}</td>
                            <td class="px-4 py-2">{{ $c->phone_number }}</td>
                            <td class="px-4 py-2">{{ $c->team?->name ?? '-' }}</td>

                            <td class="px-4 py-2">
                                {{ $c->salesRep?->first_name ?? '-' }} {{ $c->salesRep?->last_name ?? '' }}
                            </td>

                            <td class="px-4 py-2">₱{{ $c->current_balance }}</td>

                            <!-- ICON ACTIONS -->
                            <td class="px-4 py-2 flex space-x-4">

                                {{-- Professional Edit Icon --}}
                                <a href="{{ route('customers.edit', $c->ctr_number) }}"
                                    class="text-blue-600 hover:text-blue-800 transition" title="Edit Customer">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12.32 6.16l5.52 5.52M4 20h4.8l9.68-9.68a1.5 1.5 0 000-2.12l-3.76-3.76a1.5 1.5 0 00-2.12 0L4 14.8V20z" />
                                    </svg>

                                </a>

                                {{-- Delete Icon --}}
                                <form action="{{ route('customers.destroy', $c->ctr_number) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="text-red-600 hover:text-red-800 transition"
                                        title="Delete Customer">

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.8" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 13.5v5m6-5v5M4.5 7.5h15m-1.5 0l-.54
                                                            12.09A2.25 2.25 0 0115.216 22.5H8.784a2.25
                                                            2.25 0 01-2.244-2.91L6 7.5m3-3h6a1.5 1.5 0
                                                            011.5 1.5V7.5H7.5V6a1.5 1.5 0 011.5-1.5z" />
                                        </svg>
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
