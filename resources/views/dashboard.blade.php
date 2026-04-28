<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Leave Dashboard') }}
            </h2>
        </div>
    </x-slot>

    @can('employee_dashboard')
    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Leave Usage --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Leave Usage</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor"
                                         viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Sick Leave Taken</p>
                                    <p class="text-2xl font-bold text-gray-800">{{ $sickCount ?? 0 }}
                                        <span class="text-sm font-normal text-gray-400">days</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Casual Leave Taken</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $casualCount ?? 0 }}
                                    <span class="text-sm font-normal text-gray-400">days</span>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Remaining Balance --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Remaining Balance</h3>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 space-y-6">

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700">Sick Leave</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $hasSickCal ?? 0 }} days left</span>
                        </div>
                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-2 bg-red-400 rounded-full"
                                 style="width: {{ min(($hasSickCal ?? 0) * 10, 100) }}%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium text-gray-700">Casual Leave</span>
                            <span class="text-sm font-semibold text-gray-800">{{ $hasCasualCal ?? 0 }} days left</span>
                        </div>
                        <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                            <div class="h-2 bg-blue-400 rounded-full"
                                 style="width: {{ min(($hasCasualCal ?? 0) * 10, 100) }}%"></div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Leave Status --}}
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">Leave History</h3>
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

                    {{-- Pending --}}
                    <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                            <span class="text-sm text-gray-700">Pending Leaves</span>
                        </div>
                        <span class="text-xs text-gray-500 font-semibold">
                     {{ $pendingCount  ?? 0}}
                 </span>
                    </div>

                    {{-- Approved --}}
                    <div class="flex items-center justify-between px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-green-400"></div>
                            <span class="text-sm text-gray-700">Approved Leaves</span>
                        </div>
                        <span class="text-xs text-gray-500 font-semibold">
                    {{ $approvedCount ?? 0 }}
                    </span>
                    </div>

                </div>
            </div>

        </div>
    </div>
    @endcan
</x-app-layout>
