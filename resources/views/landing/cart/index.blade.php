@extends('Layouts.landing.master')

@section('content')
    <div class="w-full py-6 px-4">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10">
                <!-- Keranjang -->
                <div class="md:col-span-8">
                    <div class="border rounded-lg overflow-hidden">
                        <div class="bg-white border-b px-4 py-2.5 text-gray-700 font-medium flex items-center">
                            Keranjang Anda
                        </div>
                        <div class="overflow-x-auto relative">
                            <table class="w-full text-sm text-left text-gray-500 divide-y divide-gray-200">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 w-0">#</th>
                                        <th class="px-4 py-3">Nama Barang</th>
                                        <th class="px-4 py-3 text-right">Jumlah</th>
                                        <th class="px-4 py-3 w-0">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @forelse ($carts as $i => $cart)
                                        <tr>
                                            <!-- Hapus Barang -->
                                            <td class="py-3 px-4 whitespace-nowrap">
                                                <a href="#" class="text-rose-600"
                                                    onclick="deleteData({{ $cart->id }})">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eraser"
                                                        width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M19 20h-10.5l-4.21 -4.3a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9.2 9.3" />
                                                        <path d="M18 13.3l-6.3 -6.3" />
                                                    </svg>
                                                </a>
                                                <form id="delete-form-{{ $cart->id }}"
                                                    action="{{ route('cart.destroy', $cart->id) }}" method="POST"
                                                    style="display:none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                            <!-- Nama Barang -->
                                            <td class="py-3 px-4 whitespace-nowrap">
                                                {{ $cart->barang->name ?? 'Barang tidak ditemukan' }}
                                            </td>
                                            <!-- Jumlah Barang -->
                                            <td class="py-3 px-4 whitespace-nowrap text-right">
                                                {{ $cart->jumlah }} (Qty)
                                            </td>
                                            <!-- Update Jumlah -->
                                            <td class="py-3 px-4 whitespace-nowrap flex gap-2">
                                                <form action="{{ route('cart.update', $cart->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input
                                                        class="w-16 border px-2 py-0.5 rounded focus:outline-none focus:ring-2 focus:ring-sky-600"
                                                        value="{{ $cart->jumlah }}" type="number" name="jumlah" />
                                                    <button type="submit" class="text-blue-600 hover:underline">
                                                        Ubah
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-3 px-4 whitespace-nowrap">
                                                <div class="flex items-center justify-center h-96">
                                                    <div class="text-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-shopping-cart inline"
                                                            width="32" height="32" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <circle cx="6" cy="19" r="2"></circle>
                                                            <circle cx="17" cy="19" r="2"></circle>
                                                            <path d="M17 17h-11v-14h-2"></path>
                                                            <path d="M6 5l14 1l-1 7h-13"></path>
                                                        </svg>
                                                        <div class="mt-5">
                                                            Keranjang Anda Kosong
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    <!-- Total -->
                                    @if ($carts->count() > 0)
                                        <tr class="bg-blue-50 text-blue-900 font-semibold">
                                            <td class="py-3 px-4 whitespace-nowrap"></td>
                                            <td class="py-3 px-4 whitespace-nowrap">Total</td>
                                            <td class="py-3 px-4 whitespace-nowrap text-right text-teal-500">
                                                {{ $grandQuantity }} (Qty)
                                            </td>
                                            <td class="py-3 px-4 whitespace-nowrap"></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Konfirmasi Pesanan -->
                <div class="md:col-span-4" x-data="{ open: false }">
                    <form action="{{ route('transaction.store') }}" method="POST">
                        @csrf
                        <div class="border rounded-lg overflow-hidden">
                            <div class="bg-white border-b px-4 py-2.5 text-gray-700 font-medium flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-invoice mr-1"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z">
                                    </path>
                                    <line x1="9" y1="7" x2="10" y2="7"></line>
                                    <line x1="9" y1="13" x2="15" y2="13"></line>
                                    <line x1="13" y1="17" x2="15" y2="17"></line>
                                </svg>
                                Konfirmasi Pesanan
                            </div>
                            <div class="p-4 bg-white">
                                <div class="flex flex-col gap-4">
                                    <!-- Data Pengguna -->
                                    <x-confirmation-input label="Nama Lengkap" value="{{ Auth::user()->name }}" readonly />
                                    <x-confirmation-input label="Email" value="{{ Auth::user()->email }}" readonly />
                                    <x-confirmation-input
                                        label="Total Barang"
                                        value="{{ $carts->count() }} ({{ $grandQuantity }} Qty)" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="my-3">
                            <button class="text-white bg-sky-900 hover:bg-sky-800 rounded-lg w-full p-2" type="submit">
                                Order Sekarang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
