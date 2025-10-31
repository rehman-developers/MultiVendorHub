{{-- resources/views/admin/users/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Manage Users')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 p-6">
    <div class="container mx-auto max-w-8xl">

        <!-- Header -->
        <div class="bg-white/80 backdrop-blur-md rounded-3xl shadow-2xl p-10 mb-10 border border-white/50">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-8">
                <div>
                    <h1
                        class="text-6xl font-black bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-3">
                        Manage Users
                    </h1>
                    <p class="text-xl text-slate-600 font-medium">Control Super Admins, Admins, Sellers, Buyers & Pending Requests</p>
                </div>
                <a href="{{ route('admin.home') }}"
                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white font-bold text-lg rounded-2xl shadow-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Home
                </a>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <!-- Total Users -->
            <div
                class="bg-gradient-to-br from-indigo-500 to-purple-600 text-white p-6 rounded-2xl shadow-lg transform hover:scale-105 transition duration-300">
                <p class="text-lg font-medium opacity-90">Total Users</p>
                <p class="text-4xl font-bold mt-2">{{ $users->total() }}</p>
            </div>

            <!-- Super Admins (role = 0) -->
            <!-- <div
                class="bg-gradient-to-br from-purple-600 to-pink-600 text-white p-6 rounded-2xl shadow-lg transform hover:scale-105 transition duration-300">
                <p class="text-lg font-medium opacity-90">Super Admins</p>
                <p class="text-4xl font-bold mt-2">
                    {{ $users->where('role', 0)->count() }}
                </p>
            </div> -->

            <!-- Sellers (role = 2) -->
            <div
                class="bg-gradient-to-br from-green-500 to-emerald-600 text-white p-6 rounded-2xl shadow-lg transform hover:scale-105 transition duration-300">
                <p class="text-lg font-medium opacity-90">Sellers</p>
                <p class="text-4xl font-bold mt-2">
                    {{ $users->where('role', 2)->count() }}
                </p>
            </div>

            <!-- Buyers (role = 3) -->
            <div
                class="bg-gradient-to-br from-blue-500 to-cyan-600 text-white p-6 rounded-2xl shadow-lg transform hover:scale-105 transition duration-300">
                <p class="text-lg font-medium opacity-90">Buyers</p>
                <p class="text-4xl font-bold mt-2">
                    {{ $users->where('role', 3)->count() }}
                </p>
            </div>

            <!-- Pending Admins (role = 1 AND status = pending) -->
            <div
                class="bg-gradient-to-br from-orange-500 to-red-600 text-white p-6 rounded-2xl shadow-lg transform hover:scale-105 transition duration-300">
                <p class="text-lg font-medium opacity-90">Pending</p>
                <p class="text-4xl font-bold mt-2">
                    {{ $users->where('role', 1)->where('status', 'pending')->count() }}
                </p>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden border border-white/50">
            <!-- Search & Filters -->
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-purple-50">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="flex items-center space-x-4 text-sm font-medium text-gray-700">
                        <span>Showing: <strong class="text-indigo-600">{{ $users->firstItem() }}-{{ $users->lastItem()
                                }}</strong> of <strong class="text-purple-600">{{ $users->total() }}</strong></span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <input type="text" placeholder="Search users..."
                            class="px-5 py-3 border border-gray-300 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-300 focus:border-transparent shadow-sm">
                        <button
                            class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl shadow-md hover:shadow-xl transition transform hover:scale-105">
                            Search
                        </button>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white">
                        <tr>
                            <th class="px-8 py-5 text-left font-bold text-sm uppercase tracking-wider">User</th>
                            <th class="px-8 py-5 text-center font-bold text-sm uppercase tracking-wider">Role</th>
                            <th class="px-8 py-5 text-center font-bold text-sm uppercase tracking-wider">Store</th>
                            <th class="px-8 py-5 text-center font-bold text-sm uppercase tracking-wider">Status</th>
                            <th class="px-8 py-5 text-center font-bold text-sm uppercase tracking-wider">Joined</th>
                            <th class="px-8 py-5 text-center font-bold text-sm uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                        <tr
                            class="hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-300 transform hover:scale-[1.002] hover:shadow-md">
                            <!-- User Info -->
                            <td class="px-8 py-6">
                                <div class="flex items-center space-x-4">
                                    <div class="relative">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white text-2xl font-extrabold shadow-xl">
                                            {{ Str::substr($user->name, 0, 2) }}
                                        </div>
                                        <div
                                            class="absolute bottom-0 right-0 w-6 h-6 {{ $user->status === 'active' ? 'bg-emerald-500' : 'bg-rose-500' }} rounded-full border-4 border-white shadow-md">
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-lg font-bold text-gray-800">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <!-- Role Badge -->
                            <td class="px-8 py-6 text-center">
                                @if($user->role == 0)
                                <span
                                    class="inline-flex items-center px-6 py-3 rounded-full text-sm font-bold bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Super Admin
                                </span>
                                @elseif($user->role == 1)
                                @if($user->status === 'pending')
                                <span
                                    class="inline-flex items-center px-6 py-3 rounded-full text-sm font-bold bg-gradient-to-r from-amber-400 to-orange-500 text-white shadow-lg animate-pulse">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.414L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Pending Admin
                                </span>
                                @else
                                <span
                                    class="inline-flex items-center px-6 py-3 rounded-full text-sm font-bold bg-gradient-to-r from-rose-500 to-pink-600 text-white shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Administrator
                                </span>
                                @endif
                                @elseif($user->role == 2)
                                <span
                                    class="inline-flex items-center px-6 py-3 rounded-full text-sm font-bold bg-gradient-to-r from-emerald-500 to-teal-600 text-white shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                    Seller
                                </span>
                                @else
                                <span
                                    class="inline-flex items-center px-6 py-3 rounded-full text-sm font-bold bg-gradient-to-r from-sky-500 to-cyan-600 text-white shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                    </svg>
                                    Buyer
                                </span>
                                @endif
                            </td>

                            <!-- Store -->
                            <td class="px-8 py-6 text-center">
                                @if($user->store)
                                <a href="{{ route('admin.stores.show', $user->store) }}"
                                    class="inline-flex items-center px-5 py-2 bg-gradient-to-r from-teal-100 to-cyan-100 text-teal-700 font-bold rounded-full hover:from-teal-200 hover:to-cyan-200 transition transform hover:scale-105 shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h-4m-6 0H5" />
                                    </svg>
                                    {{ Str::limit($user->store->name, 20) }}
                                </a>
                                @else
                                <span class="text-gray-400 text-sm">—</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="px-8 py-6 text-center">
                                @if($user->role == 1 && $user->status === 'pending')
                                <span
                                    class="inline-flex items-center px-6 py-3 rounded-full text-sm font-bold bg-gradient-to-r from-orange-400 to-red-500 text-white shadow-lg">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.414-1.414L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Pending Approval
                                </span>
                                @else
                                <form action="{{ route('admin.users.status', $user) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                        class="px-5 py-2 rounded-full text-sm font-bold border-0 shadow-lg focus:outline-none focus:ring-4 focus:ring-indigo-300 transition cursor-pointer
                                                        @if($user->status === 'active') bg-gradient-to-r from-emerald-500 to-teal-600
                                                        @else bg-gradient-to-r from-rose-500 to-red-600 @endif">
                                        <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="blocked" {{ $user->status === 'blocked' ? 'selected' : ''
                                            }}>Blocked</option>
                                    </select>
                                </form>
                                @endif
                            </td>

                            <!-- Joined -->
                            <td class="px-8 py-6 text-center">
                                <p class="text-sm font-semibold text-gray-700">{{ $user->created_at->format('d M Y') }}
                                </p>
                                <p class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                            </td>

                            <!-- Actions -->
                            <td class="px-8 py-6 flex text-center space-x-3">
                                <!-- View -->
                                <a href="{{ route('admin.users.show', $user) }}"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white font-bold rounded-full hover:from-indigo-600 hover:to-purple-600 transition transform hover:scale-110 shadow-md">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                <!-- Approve / Reject for Pending Admins -->
                                @if($user->role == 1 && $user->status === 'pending')
                                <form action="{{ route('admin.approve', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold rounded-full hover:from-emerald-600 hover:to-teal-700 transition transform hover:scale-110 shadow-md"
                                        onclick="return confirm('Approve this admin?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>
                                </form>

                                <form action="{{ route('admin.reject', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-rose-500 to-red-600 text-white font-bold rounded-full hover:from-rose-600 hover:to-red-700 transition transform hover:scale-110 shadow-md"
                                        onclick="return confirm('Reject this admin request?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>
                                @endif

                                <!-- Impersonate (Only Super Admin & Not Self) -->
                                @if(auth()->user()->isSuperAdmin() && $user->id != auth()->id())
                                <a href="{{ route('impersonate', $user) }}"
                                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold rounded-full hover:from-purple-600 hover:to-pink-600 transition transform hover:scale-110 shadow-md"
                                    title="Login as {{ $user->name }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </a>
                                @endif

                                <!-- Delete (only if not pending admin) -->
                                @if($user->role != 1 || $user->status !== 'pending')
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this user permanently?')"
                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 text-white font-bold rounded-full hover:from-red-600 hover:to-rose-700 transition transform hover:scale-110 shadow-md">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-24">
                                <div class="text-gray-400">
                                    <svg class="w-28 h-28 mx-auto mb-6" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-2xl font-bold text-gray-600">No users found</p>
                                    <p class="text-sm text-gray-500 mt-2">Try adjusting your search or filters.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-6 bg-gradient-to-r from-indigo-50 to-purple-50 border-t border-gray-200">
                {{ $users->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</div>
@endsection