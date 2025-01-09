@extends('pembeli.landing')

@section('element')
    <div class="container my-5 px-24">
        <h1 class="w-full text-2xl font-bold mb-3">Pembayaran Tiket</h1>
        <!-- Event Cards -->
        <div class="flex flex-wrap justify-start gap-4">
            @if(count($pembelians) > 0)
                @foreach ($pembelians as $pembelian)
                    @if($pembelian->status == 0)
                        <div class="w-full sm:w-1/3 lg:w-1/4 p-4 m-2 mt-1 mb-5">
                            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                                <div class="p-4 bg-blue-500 text-white">
                                </div>
                                <div class="m-3 mx-4">
                                    <h3 class=" font-bold  text-black mb-3">Pembelian ID: {{$pembelian->id}}</h3>
                                    <p>Total: Rp{{ number_format($pembelian->total, 2, ',', '.') }}</p>
                                    <p>Status:
                                        @if ($pembelian->status == 0)
                                            <span class="text-red-500">Belum Lunas</span>
                                        @else
                                            <span class="text-green-500">Lunas</span>
                                        @endif
                                    </p>
                                    <div class="mt-3">
                                        <h5 class="font-bold text-md mb-2">Detail Pembelian:</h5>
                                        @foreach ($pembelian->details as $detail)
                                            <div class="overflow-hidden overflow-x-auto border border-gray-200 rounded-lg my-2 p-2">
                                                <table class="min-w-full text-sm divide-y divide-gray-200">
                                                    <tbody class="bg-white">
                                                        <tr>
                                                            <td class="p-1 font-medium text-gray-900 whitespace-nowrap" colspan="2">
                                                                Tiket : {{ $detail->tiket->nama_tiket }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-1 text-gray-700 whitespace-nowrap"></td>
                                                            <td class="p-1 text-gray-700 whitespace-nowrap">
                                                                Jumlah : {{ $detail->jumlah }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-1 text-gray-700 whitespace-nowrap"></td>
                                                            <td class="p-1 text-gray-700 whitespace-nowrap">
                                                                Harga : Rp{{ number_format($detail->tiket->harga, 2, ',', '.') }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                        @if ($pembelian->status == 0)
                                            <div class="flex justify-center items-center">
                                                <a href="{{route('pemesanan-create',['pembelian'=>$pembelian->id])}}" 
                                                class="inline-block w-full px-6 py-2 text-white bg-red-500 rounded hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 transition ease-in-out duration-150 text-center">
                                                    Lakukan Pembayaran
                                                </a>
                                            </div>
                                        @endif                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="flex items-center justify-center w-full">
                    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md text-center">
                        <h1 class="text-2xl font-bold text-gray-800 mb-4">Belum Ada Pembelian</h1>
                        <p class="text-gray-600 mb-6">
                            Anda belum memiliki riwayat pembelian tiket. Klik tombol di bawah untuk melakukan pembelian tiket.
                        </p>
                        <!-- Tombol Arahkan ke Halaman Pembelian -->
                        <a href="{{route('pembeli-index')}}" 
                        class="inline-block bg-blue-500 text-white text-lg font-semibold px-6 py-3 rounded-lg shadow hover:bg-blue-600 focus:ring focus:ring-blue-300 focus:outline-none">
                            Beli Tiket Sekarang
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection